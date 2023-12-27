<?
namespace app\Enums  ;
enum TransactionStatus : string {
    case pending = 'pending';
    case cancelled = 'cancelled';
    case completed = 'completed';

    public function getLabel(): string
    {
        return match ($this) {
            self::pending => 'Pending',
            self::cancelled => 'Cancelled',
            self::completed => 'Completed',
        };
    }
}