<?php

namespace App\Models;

use app\Enums\TransactionCurrency;
use app\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TransactionType;
use PhpParser\Node\Expr\Cast\Double;
use PhpParser\Node\Stmt\Return_;

use function PHPSTORM_META\type;

class TransactionLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'title',
        'amount',
        'type',
        'currency',
        'description',
        'status',
        'created_at',
        'updated_at'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function change(Customer $customer, string $typeNew, string $CurrNew, float $AmouNew): bool
    {
        $this->changeType($customer, $typeNew, $CurrNew, $AmouNew);
        $this->type = $typeNew;
        $this->currency = $CurrNew;
        $this->amount = $AmouNew;
        if ($this->save()) {
            $customer->save();
            return true;
        } else {
            return false;
        }
    }

    private function changeType(Customer &$customer, string $typeNew, string $CurrNew, float $AmouNew)
    {
        $remove = true;
        if ($typeNew != $this->type) {
            if($this->amount==$AmouNew){
                $conversionFactor = ($typeNew != "deposit") ? 2 : -2;
                $remove=true;
            }else{
                $conversionFactor = ($typeNew != "deposit") ? 1 : -1;
                $this->type = $typeNew;
                $remove=false;
            }
            $customer->{$this->getAmountField()} -= $this->amount * $conversionFactor;
        }
        $this->changeCurrency($customer, $CurrNew, $AmouNew ,$remove);
    }

    private function changeCurrency(Customer &$customer, string $CurrNew, float $AmouNew,bool $remove)
    {
        if ($this->currency != $CurrNew) {
            $conversionFactor = ($this->type == "deposit") ? 1 : -1;
            if($remove){
                $customer->{$this->getAmountField()} -= $this->amount * $conversionFactor;
                $remove=false;
            }
            $customer->{$this->getAmountField($CurrNew)} += $AmouNew * $conversionFactor;
        } else {
            $this->changeAmount($customer, $AmouNew,$remove);
        }
    }

    private function changeAmount(Customer &$customer, $AmouNew,bool $remove )
    {
        if ($this->amount != $AmouNew) {
            $conversionFactor = ($this->type == "deposit") ? 1 : -1;
            if($remove){
                $customer->{$this->getAmountField()} -= $this->amount * $conversionFactor;
            }
            $customer->{$this->getAmountField()} += $AmouNew * $conversionFactor;
        }
    }

    private function getAmountField(string $currency = null)
    {
        return match($currency ?? $this->currency){
            'usd' => 'amount_usd',
            'yr' => 'amount_yr',
            'sr' => 'amount_sr',
            'egp' => 'amount_egp',
            'try' => 'amount_try',
            default => 'amount',

        };
    }

    public function get_arabic_status(): string
    {
        return match ($this->status) {
            'pending' => 'قيد الانتظار',
            'cancelled' => 'ملغي',
            'completed' => 'مكتمل',
        };
    }
    public function get_arabic_type(): string
    {
        return match ($this->type) {
            'deposit' => 'ايداع',
            'withdraw' => 'سحب',
        };
    }
    public function get_arabic_currency(): string
    {
        return match ($this->currency) {
            'usd' => 'دولار',
            'yr' => 'ريال يمني',
            'sr' => 'ريال سعودي',
            'egp' => 'جنيه مصري',
            'try' => 'ليرة تركية',
            default => 'غير معروف',

        };
    }
}
