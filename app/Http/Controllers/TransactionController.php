<?php
namespace App\Http\Controllers;

use App\Transaction;
use App\User;
use Exception;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        try {
            $transactions = Transaction::all();
            return response()->json(['status' => 200, 'message' => 'Transactions listed successfully', 'transactions' => $transactions]);
        }catch (Exception $e) {
            return response()->json(['status' => 404, 'message' => 'No Transaction']);
        }
    }

    public function getPacket(Request $request)
    {
        $receiver = User::getUSerIdFromEmail($request->receiver_email);
        $transactions = Transaction::getTransactionForReceiver($receiver->id);

        $amount = 0;
        foreach ($transactions AS $transaction){
            $amount += $transaction->amount;
        }

        return response()->json(['status' => 200, 'message' => 'You have received RM'. $amount . ' of red packets.']);

    }

    public function getTransaction(Request $request){
        $transactions = Transaction::getTransactionForPacket($request->packet_id);
        $message = [];
        foreach ($transactions AS $transaction){
            array_push($message, $transaction->receiver->name . ' received ' . $transaction->amount);
        }
        return response()->json(['status' => 200, 'message' => 'Transactions listed successfully', 'transactions' => $message]);
    }
}
