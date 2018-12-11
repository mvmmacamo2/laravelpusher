<?php

namespace App\Http\Controllers;

use App\Disciplina;
use Illuminate\Http\Request;
use Pusher;

class DisciplinaController extends Controller
{
    public function getDisciplina(){

        $disciplina = Disciplina::orderBy('nome', 'asc')->get();
        return view('Disciplina.lista', compact('disciplina'));
    }

    public function save(Request $request) {

       $save= Disciplina::create($request->all());

       if ($save) {

           $d = Disciplina::orderBy('nome', 'asc')->get();
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

           return response()->json(['message' => 'Salvo com Sucesso!', 'data' => $d], 200);
       }

    }
}
