<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Token;

class CustomerRelationshipExecutiveController extends Controller
{
    public function index()
    {
        $tokens = Token::whereNull('finished_at')->orderBy('created_at')->get();
        return view('cre.index', compact('tokens'));
    }

    public function callToken($id)
    {
        $token = Token::findOrFail($id);
        $token->called_at = now();
        $token->save();

        return response()->json(['token' => $token]);
    }

    public function finishToken($id)
    {
        $token = Token::findOrFail($id);
        $token->finished_at = now();
        $token->save();

        return redirect()->route('cre.index');
    }

    public function printToken($id)
    {
        $token = Token::findOrFail($id);
        return view('cre.print', compact('token'));
    }
}
