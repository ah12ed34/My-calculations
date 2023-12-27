<?
namespace App\Enums;

/**
 * @method static self DEPOSIT()
 * @method static self WITHDRAW()
 */
enum TransactionType: string
{
    case deposit = 'deposit';
    case withdraw = 'withdraw';

public function getValue(): string
{
    return $this->value;
}

    function getArray(): array
    {
        return [
            'deposit',
            'withdraw',
        ];
    }
    public function getLabel(): string
    {
        return match ($this) {
            self::deposit => 'Deposit',
            self::withdraw => 'Withdraw',
        };
    }
}
