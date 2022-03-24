<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public static $rulesStore = [
        "*" => "required"
    ];

    public static $messages = [

    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
