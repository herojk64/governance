<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Log;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function index(){
        return view('balance.index');
    }

    public function create(){
        return view('balance.create');
    }


    public function store(Request $request){
        // Validate the request data
        $validatedData = $request->validate([
            'balance' => ['required', 'numeric']
        ]);

        // Retrieve the authenticated user
        $user = auth()->user();

        // Retrieve the user's balance record
        $userBalance = $user->balance;

        // If the user has no balance record, create a new one
        if (!$userBalance) {
            $userBalance = new Balance();
            $userBalance->user_id = $user->id;
        }

        // Calculate the new balance by adding the submitted balance to the current user's balance column
        $newBalance = $userBalance->balance + $validatedData['balance'];

        // Update the balance column of the user's balance record
        $userBalance->update(['balance' => $newBalance]);


        // Redirect back with success message
        return redirect('balance')->with('success', 'Balance added successfully');
    }


}
