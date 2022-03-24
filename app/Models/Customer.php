<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Customer
 *
 * @property int|null $id
 * @property string|null $name
 * @property string|null $cpf
 * @property Carbon|null $birthdate
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'customers';

    protected $dates = [
        'birthdate'
    ];

    protected $fillable = [
        'name',
        'cpf',
        'birthdate'
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function setCpfAttribute($cpf)
    {
        $this->attributes['cpf'] = preg_replace("/[^0-9]/", "", $cpf);
    }

    public function getCpfAttribute($cpf)
    {
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $this->attributes['cpf']);
    }

    public function setBirthdateAttribute($birthdate)
    {
        $this->attributes['birthdate'] = Carbon::createFromFormat("d/m/Y", $birthdate);
    }

    public function getBirthdateAttribute()
    {
        return Carbon::parse($this->attributes['birthdate'])->format('d/m/Y');
    }
}
