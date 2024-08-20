<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QuizsController extends Controller
{
    public function index()
    {
        $users = Quiz::all();
        return view('quiz.index', compact('users'));
    }
    public function edit($id)
    {
        $user = Quiz::find($id);

        return View('quiz.edit', compact('user'));

    }
    public function create()
    {
        return View('quiz.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'descripcion' => 'required',
        ]);
        $quiz = new Quiz();
        $quiz->descripcion = $request->descripcion;
        $quiz->desde = Carbon::parse($request->desde)->format('Y-m-d');
        $quiz->hasta = Carbon::parse($request->hasta)->format('Y-m-d');
        $quiz->estado = $request->estado;
        $quiz->save();
        Session::flash('message', 'Se ha creado el usuario  al Sistema');
        return redirect()->route('quiz.index');
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'descripcion' => 'required',
        ]);
        try {
            $quiz = Quiz::find($id);
            // dd($quiz);
            $quiz->name = $request->name;
            $quiz->descripcion = $request->descripcion;
            $quiz->desde = Carbon::parse($request->desde)->format('Y-m-d');
            $quiz->hasta = Carbon::parse($request->hasta)->format('Y-m-d');
            $quiz->estado = $request->estado;
            $quiz->save();
            Session::flash('message', 'Se ha actualizado el cuestionario  al Sistema');
            return redirect()->route('quiz.index');
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }

    }
}
