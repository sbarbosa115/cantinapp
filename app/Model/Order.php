<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $array)
 * @method static whereNotIn(string $string, array $array)
 * @method static find($id)
 * @method static findOrFail($id)
 *
 * @property string payment_status
 * @property mixed id
 */
class Order extends Model
{
    /**
     * OrderServiceTest
     * enum('created', 'cooking', 'cooked', 'delivered', 'archived')
     * @var array
     */

    public const PAYMENT_METHOD_CASH = 'cash';
    public const PAYMENT_METHOD_CANTINA = 'cantina';

    public const PAYMENT_STATUS_PAID = 'paid';
    public const PAYMENT_STATUS_PENDING = 'pending';

    public const STATUS_CREATED = 'created';
    public const STATUS_COOKING = 'cooking';
    public const STATUS_COOKED = 'cooked';
    public const STATUS_DELIVERED = 'delivered';
    public const STATUS_ARCHIVED = 'archived';


    protected $fillable = ['pickup_at', 'status', 'image_path', 'user_id', 'payment_method', 'restaurant_id'];

    protected $dates = [
        'pickup_at', 'created_at', 'updated_at ',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('product_id', 'order_id', 'quantity', 'comment');
    }

    public function productsOrder(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function balances(): HasMany
    {
        return $this->hasMany(Balance::class);
    }

    public function hasPendingBalances(): bool
    {
        $orderBalances = $this->hasMany(Balance::class)->get();
        $isThereAPendingBalance = false;
        foreach ($orderBalances as $orderBalance) {
            if($orderBalance->status === Balance::STATUS_DEBT) {
                $isThereAPendingBalance = true;
            }
        }
        return $isThereAPendingBalance;
    }

    /**
     * @return float|int
     */
    public function getTotalQuantityOrder()
    {
        $result = $this->belongsToMany(Product::class)->withPivot('quantity')->pluck('quantity');
        return array_sum($result->toArray());
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }
}
