<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Token;

class ReceptionistController extends Controller
{
    public function create()
    {
        return view('receptionist.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'service' => 'required|in:Acrylic,StainlessSteel,Emergency',
        ]);

        $tokenNumberPrefix = [
            'Acrylic' => 'AC',
            'StainlessSteel' => 'SS',
            'Emergency' => 'EM'
        ][$request->service];

        $latestToken = Token::where('service', $request->service)->latest()->first();
        $latestNumber = $latestToken ? (int)substr($latestToken->token_number, 2) : 0;
        $newTokenNumber = $tokenNumberPrefix . str_pad($latestNumber + 1, 3, '0', STR_PAD_LEFT);

        Token::create([
            'token_number' => $newTokenNumber,
            'service' => $request->service,
        ]);

        return redirect()->route('receptionist.create')->with('success', 'Token created successfully');
    }

    public function printToken($id)
    {
        $token = Token::findOrFail($id);
        return view('receptionist.print', compact('token'));
    }
    public function display()
    {
        return view('receptionist.display');
    }
    
}