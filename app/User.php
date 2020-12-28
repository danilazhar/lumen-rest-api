<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static inRandomOrder()
 * @method static select(string $string)
 */
class User extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    public static function getRandomUser($quantity)
    {
        return User::inRandomOrder()->limit($quantity)->get();
    }

    public static function getUSerIdFromEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function packets(){
        return $this->hasMany(Packet::class, 'receiver_id');
    }

}
