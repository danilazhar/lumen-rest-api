<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


/**
 * @method static get()
 * @method static insertGetId(array $array)
 * @method static create(array $array)
 * @method static find()
 */
class Packet extends Model
{
    protected $fillable = [
        'sender_id',
        'amount',
        'quantity',
        'random',
        'created_by'
    ];


    public static function create_packet($request)
    {

        DB::beginTransaction();

        if ($request->amount < 0.01) {
            throw new Exception("Minimum amount should be more than 0.01.");
        }

        if ($request->sender_email === '') {
            throw new Exception("Please key-in sender email.");
        }

        $packet = Packet::insertPacket($request);

        Packet::create_transaction($packet);

        DB::commit();

        return $packet->id;
    }

    private static function create_transaction($packet)
    {
        if ($packet->random === 1) {
            $amountToReceived = round($packet->amount / $packet->quantity, 2);
            $selectRandomUser = User::getRandomUser($packet->quantity);

            foreach ($selectRandomUser as $randomUser) {
                Transaction::create([
                    'packet_id' => $packet->id,
                    'receiver_id' => $randomUser->id,
                    'sender_id' => $packet->sender_id,
                    'amount' => $amountToReceived
                ]);
            }

        } else {
            $amountToReceived = Packet::generateRandomNumbers($packet->amount, $packet->quantity);
            $selectRandomUser = User::getRandomUser($packet->quantity);

            for ($i = 0; $i < $packet->quantity; $i++) {
                Transaction::create([
                    'packet_id' => $packet->id,
                    'receiver_id' => $selectRandomUser[$i]->id,
                    'sender_id' => $packet->sender_id,
                    'amount' => $amountToReceived[$i]
                ]);
            }
        }

    }

    private static function generateRandomNumbers($amount, $quantity)
    {
        $numbers = [];

        for ($i = 1; $i < $quantity; $i++) {
            $random = mt_rand(0.01, $amount / ($quantity - $i));
            $numbers[] = $random;
            $amount -= $random;
        }

        $numbers[] = $amount;

        shuffle($numbers);

        return $numbers;
    }

    private static function insertPacket($request)
    {

        $sender = User::getUSerIdFromEmail($request->sender_email);
        return Packet::create([
            'sender_id' => $sender->id,
            'amount' => $request->amount,
            'quantity' => $request->quantity,
            'random' => $request->random,
        ]);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

}
