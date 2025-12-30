<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'description',
        'user_id',
        'amount_usd',
        'amount_yr',
        'amount_sr',
        'amount_egp',
        'amount_try',
    ];
    public function transactionLogs()
    {
        return $this->hasMany(TransactionLog::class);
    }

    protected array $currencyColumns = [
        'usd' => 'amount_usd',
        'yr'  => 'amount_yr',
        'sr'  => 'amount_sr',
        'egp' => 'amount_egp',
        'try' => 'amount_try',
    ];

    public function adjustBalance(string $currency, float $amount, string $type): void
    {
        $column = $this->currencyColumns[$currency];

        if ($type === 'deposit') {
            $this->$column += $amount;
        } elseif ($type === 'withdraw') {
            // if ($this->$column < $amount) {
            //     throw new \Exception('Insufficient balance');
            // }
            $this->$column -= $amount;
        }

        $this->save();
    }

    public function recalculateBalances(): void
    {
        DB::transaction(function () {

            // 1. تصفير جميع الأرصدة
            foreach ($this->currencyColumns as $column) {
                $this->$column = 0;
            }
            $this->save();

            // 2. جلب العمليات المرتبطة بالعميل
            $logs = $this->transactionLogs()
                // ->where('status', 'completed')
                ->orderBy('created_at')
                ->get();

            // 3. إعادة الحساب
            foreach ($logs as $log) {
                $column = $this->currencyColumns[$log->currency];

                if ($log->type === 'deposit') {
                    $this->$column += $log->amount;
                } elseif ($log->type === 'withdraw') {
                    $this->$column -= $log->amount;
                }
            }

            $this->save();
        });
    }
}
