<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Pool
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pool whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pool whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pool whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pool whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Pool extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
}
