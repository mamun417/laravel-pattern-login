<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class Setting extends Model
{
    protected $fillable = ['user_id', 'value'];
}
