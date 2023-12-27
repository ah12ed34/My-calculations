<?php

namespace App\Models;

use app\Enums\TransactionCurrency;
use app\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TransactionType;
use PhpParser\Node\Expr\Cast\Double;

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
        switch ($currency ?? $this->currency) {
            case 'usd':
                return 'amount_usd';
            case 'yr':
                return 'amount_yr';
            case 'sr':
                return 'amount_sr';
            default:
                return null;
        }
    }


    // private function changeCurrency(Customer &$customer,string $CurrNew, float $AmouNew){
    //     if($this->currency!=$CurrNew){
    //         switch ($this->currency) {
    //             case 'usd':
    //                 $customer->amount_usd -=($this->type=="deposit")?($this->amount):-($this->amount);
    //                 break;
    //             case 'yr':
    //                 $customer->amount_yr -=($this->type=="deposit")?($this->amount):-($this->amount);
    //                 break;
    //             case 'sr':
    //                 $customer->amount_sr -=($this->type=="deposit")?($this->amount):-($this->amount);
    //                 break;
    //         }
    //         if($this->amount==$AmouNew){
    //             switch ($CurrNew) {
    //                 case 'usd':
    //                     $customer->amount_usd +=($this->type=="deposit")?($this->amount):-($this->amount);
    //                     break;
    //                 case 'yr':
    //                     $customer->amount_yr +=($this->type=="deposit")?($this->amount):-($this->amount);
    //                     break;
    //                 case 'sr':
    //                     $customer->amount_sr +=($this->type=="deposit")?($this->amount):-($this->amount);
    //                     break;
    //             }
    //         }else{
    //             switch ($CurrNew) {
    //                 case 'usd':
    //                     $customer->amount_usd +=($this->type=="deposit")?($AmouNew):-($AmouNew);
    //                     break;
    //                 case 'yr':
    //                     $customer->amount_yr +=($this->type=="deposit")?($AmouNew):-($AmouNew);
    //                     break;
    //                 case 'sr':
    //                     $customer->amount_sr +=($this->type=="deposit")?($AmouNew):-($AmouNew);
    //                     break;
    //             }
    //         }
    //     }else{
    //         $this->changeAmount($customer,$AmouNew);
    //     }
    // }
    // private function changeAmount(Customer &$customer,$AmouNew){
    //     if($this->amount!=$AmouNew){
    //         switch ($this->currency) {
    //             case 'usd':
    //                 $customer->amount_usd -=($this->type=="deposit")?($this->amount):-($this->amount);
    //                 break;
    //             case 'yr':
    //                 $customer->amount_yr -=($this->type=="deposit")?($this->amount):-($this->amount);
    //                 break;
    //             case 'sr':
    //                 $customer->amount_sr -=($this->type=="deposit")?($this->amount):-($this->amount);
    //                 break;
    //         }
    //         switch ($this->currency) {
    //             case 'usd':
    //                 $customer->amount_usd +=($this->type=="deposit")?($AmouNew):-($AmouNew);
    //                 break;
    //             case 'yr':
    //                 $customer->amount_yr +=($this->type=="deposit")?($AmouNew):-($AmouNew);
    //                 break;
    //             case 'sr':
    //                 $customer->amount_sr +=($this->type=="deposit")?($AmouNew):-($AmouNew);
    //                 break;
    //         }
    //     }
    // }
}
