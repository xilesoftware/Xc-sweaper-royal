<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request) {
        return event(new \App\Events\MessageSent($request->message));
    }
}
