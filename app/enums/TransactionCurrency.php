<?
namespace app\Enums  ;
enum TransactionCurrency : string {
    case usd = 'usd';
    case yr = 'yr';
    case sr = 'sr';

    function getArray(): array
    {
        return [
            'usd',
            'yr',
            'sr',
        ];
    }
    public function getLabel(): string
    {
        return match ($this) {
            self::usd => 'USD',
            self::yr => 'YR',
            self::sr => 'SR',
        };
    }
}