<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static updateOrCreate(array $array, array $array1)
 */
class Pokemon extends Model
{
    use HasFactory;

    protected $table = 'pokemons';

    protected $fillable = ['name', 'url'];
}
