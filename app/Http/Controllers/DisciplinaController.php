<?php

namespace App\Http\Controllers;

use App\Disciplina;
use Illuminate\Http\Request;
use Pusher;

class DisciplinaController extends Controller
{
    public function save(Request $request) {

       $save= Disciplina::create($request->all());

       if ($save) {

           $d = Disciplina::orderBy('id', 'desc')->get();
           $options = array(
               'cluster' => 'mt1',
               'useTLS' => true
           );

           $pusher = new Pusher\Pusher(
               '8d536f492b252577e624',
               '18c96242533200270f85',
               '665767',
               $options
           );


           $pusher->trigger('my-channel', 'my-event', $d);

           return redirect()->back();
       }

    }
}
