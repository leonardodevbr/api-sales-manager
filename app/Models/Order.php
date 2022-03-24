<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
