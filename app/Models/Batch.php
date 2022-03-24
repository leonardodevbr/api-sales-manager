<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Batch
 *
 * @property int|null $id
 * @property string|null $code
 * @property Carbon|null $manufacturing_date
 * @property Carbon $created_at`
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Batch extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'batches';

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = [
        'manufacturing_date'
    ];

    protected $fillable = [
        'code',
        'manufacturing_date'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function setManufacturingDateAttribute($birthdate)
    {
        $this->attributes['manufacturing_date'] = Carbon::createFromFormat("d/m/Y", $birthdate);
    }

    public function getManufacturingDateAttribute()
    {
        return Carbon::parse($this->attributes['manufacturing_date'])->format('d/m/Y');
    }
}
