<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderProduct
 * 
 * @property int|null $id
 * @property int|null $order_id
 * @property int|null $product_id
 * 
 * @property Product|null $product
 * @property Order|null $order
 *
 * @package App\Models
 */
class OrderProduct extends Model
{
	protected $table = 'order_product';
	public $timestamps = false;

	protected $casts = [
		'order_id' => 'int',
		'product_id' => 'int'
	];

	protected $fillable = [
		'order_id',
		'product_id'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function order()
	{
		return $this->belongsTo(Order::class);
	}
}
