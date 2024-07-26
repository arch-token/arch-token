<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Token;

class TokenController extends Controller
{
    public function callToken($id)
    {
        $token = Token::findOrFail($id);
        $token->called_at = now();
        $token->save();

        return response()->json(['token' => $token]);
    }

    public function currentToken()
    {
        $token = Token::whereNotNull('called_at')->orderBy('called_at', 'desc')->first();
        return response()->json(['token' => $token]);
    }
    public function resetTokens()
    {
        if (Token::count() > 0) {
            Token::truncate();
            return redirect()->back()->with('success', 'All tokens have been reset.');
        } else {
            return redirect()->back()->with('error', 'Nothing to reset.');
        }
    }
    
    
}
