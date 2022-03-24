<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Seller
 *
 * @property int|null $id
 * @property int|null $user_id
 * @property string|null $name
 * @property string|null $cnpj
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User|null $user
 * @property Order|null $orders
 *
 * @package App\Models
 */
class Seller extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sellers';

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'user_id' => 'int'
    ];

    protected $fillable = [
        'user_id',
        'name',
        'cnpj'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function getCnpjAttribute($cnpj)
    {
        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj);
    }

}
