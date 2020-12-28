<?php

namespace App\Http\Controllers;

use App\Packet;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PacketController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return JsonResponse
     */

    public function index()
    {
        try {
            $packets = Packet::all();
            foreach ($packets as $key => $packet) {
                $packets[$key]->sender_name = $packet->sender->name;
                $packets[$key]->sender_email = $packet->sender->email;
                $packets[$key]->amount = $packet->amount;
                $packets[$key]->quantity = $packet->quantity;
            }

            return response()->json(['status' => 200, 'message' => 'Packets listed successfully', 'packets' => $packets]);
        } catch (Exception $e) {
            return response()->json(['status' => $e->getCode()]);
        }
    }

    public function create(Request $request)
    {
        try {
            $packet = Packet::create_packet($request);
            return response()->json(['status' => 200, 'message' => 'Red Packet with Id = ' . $packet . ' successfully sent.']);

        } catch (Exception $e) {
            return response()->json(['status' => $e->getCode(), 'message' => $e->getMessage()]);
        }
    }

}
