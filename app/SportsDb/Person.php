<?php

namespace App\SportsDb;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'sportdb';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'persons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
    ];

    /**
     * Return the Person's goals
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goals()
    {
        return $this->hasMany(Goal::class);
    }
}
