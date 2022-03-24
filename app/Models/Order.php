<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Order
 *
 * @property int|null $id
 * @property int|null $seller_id
 * @property int|null $customer_id
 * @property int|null $amount
 * @property string|null $code
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Customer|null $customer
 * @property Seller|null $seller
 *
 * @package App\Models
 */
class Order extends Model
{
    use SoftDeletes;

    protected $table = 'orders';

    protected $hidden = [
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'seller_id' => 'int',
        'customer_id' => 'int',
        'amount' => 'int'
    ];

    protected $fillable = [
        'seller_id',
        'customer_id',
        'amount',
        'code'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function setAmountAttribute($amount)
    {
        $this->attributes['amount'] = preg_replace("/[^0-9]/", "", $amount);
    }

    public function getAmountAttribute()
    {
        $amount = str_pad($this->attributes['amount'], 3, 0, STR_PAD_LEFT);
        return substr_replace($amount, '.', -2, 0);
    }
}
