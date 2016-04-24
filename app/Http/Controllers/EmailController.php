<?php

namespace Fiorella\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

use DB;
use Fiorella\Work;
use Fiorella\Show;
use Fiorella\Http\Controllers\Controller;

class EmailController extends Controller
{
    public function send()
    {
        $name = Input::get('name');
        $email = Input::get('email');
        $text = Input::get('text');

        $data = [
            'name' => $name,
            'email' => $email,
            'text' => $text
        ];

        Mail::send('email.email', $data, function($m) use ($data){
            $m->to('fiorelani64@gmail.com')->subject($data['name'] . ' ti ha contattato su lellarte.ch');
        });

        return redirect()->route('home')->with('emailSent', true);
    }
}
