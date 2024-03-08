<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    public function index()
    {
     return view('transfer.index');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $attribute = $request->validate([
            'account_number' => ['required'],
            'name' => ['required'],
            'amount' => ['required', 'numeric']
        ]);

        // Retrieve the authenticated user (the sender)
        $sender = auth()->user();

        // Find the recipient user by account number and name
        $recipient = User::where('account_number', $attribute['account_number'])
            ->where('name', $attribute['name'])
            ->first();

        // Ensure the recipient exists
        if (!$recipient) {
            return back()->withErrors(['message' => 'Recipient not found']);
        }

        // Ensure the sender has enough balance to transfer
        if ($sender->balance->balance < $attribute['amount']) {
            return back()->withErrors(['message' => 'Insufficient balance']);
        }

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Deduct the amount from the sender's balance
            $sender->balance->decrement('balance', $attribute['amount']);

            // Add the amount to the recipient's balance
            $recipient->balance->increment('balance', $attribute['amount']);

            // Commit the transaction
            DB::commit();

            // Redirect back with success message
            return back()->with('success', 'Amount has been transferred successfully');
        } catch (\Exception $e) {
            // Rollback the transaction in case of any error
            DB::rollback();
            return back()->withErrors(['message' => 'Failed to transfer amount']);
        }
    }


}
