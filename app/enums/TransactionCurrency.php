<?
namespace app\Enums  ;
enum TransactionCurrency : string {
    case usd = 'usd';
    case yr = 'yr';
    case sr = 'sr';
    case egp = 'egp';
    case try = 'try';

    function getArray(): array
    {
        return [
            'usd',
            'yr',
            'sr',
            'egp',
            'try',
        ];
    }
    public function getLabel(): string
    {
        return match ($this) {
            self::usd => 'USD',
            self::yr => 'YR',
            self::sr => 'SR',
            self::egp => 'EGP',
            self::try => 'TRY',
        };
    }
}
