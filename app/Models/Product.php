<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 *
 * @property int|null $id
 * @property int|null $batch_id
 * @property string|null $code
 * @property string|null $name
 * @property string|null $color
 * @property string|null $description
 * @property int|null $price
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Batch|null $batch
 *
 * @package App\Models
 */
class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'batch_id' => 'int',
        'price' => 'int'
    ];

    protected $fillable = [
        'batch_id',
        'code',
        'name',
        'color',
        'description',
        'price'
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    public function setPriceAttribute($price)
    {
        $this->attributes['price'] = preg_replace("/[^0-9]/", "", $price);
    }

    public function getPriceAttribute()
    {
        $price = str_pad($this->attributes['price'], 3, 0, STR_PAD_LEFT);
        return substr_replace($price, '.', -2, 0);
    }

}
