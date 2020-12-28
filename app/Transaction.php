<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, $receiver_id)
 */
class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'packet_id',
        'sender_id',
        'receiver_id',
        'amount',
        'created_by'
    ];

    public static function getTransactionForReceiver($receiver_id)
    {
        return Transaction::where("receiver_id", $receiver_id)->orderBy('id', 'DESC')->get();
    }

    public static function getTransactionForPacket($packet_id)
    {
        return Transaction::where("packet_id", $packet_id)->orderBy('id', 'DESC')->get();
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function packet()
    {
        return $this->belongsTo(Packet::class);
    }

}
