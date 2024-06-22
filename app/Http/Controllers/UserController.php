<?php

namespace App\Http\Controllers;

use App\Models\Recurso;
use App\Models\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        //   dd($users);ç
        return view('users.users', compact('users'));
    }
    public function edit($id)
    {
        $user = User::find($id);

        return View('users.edit', compact('user'));

    }
    public function create()
    {
        return View('users.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);
        $iva = new User();
        $iva->name = $request->name;
        $iva->email = $request->email;
        if ($request->passwords) {
            $iva->password = bcrypt($request->passwords);

        }

        $iva->save();
        Session::flash('message', 'Se ha creado el usuario  al Sistema');
        return redirect()->route('users.index');
    }
    public function update(Request $request, $id)
    {
        // dd($request->passwords);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);
        $iva = User::find($id);
        $iva->name = $request->name;
        $iva->email = $request->email;
        if ($request->password) {
            $iva->password = bcrypt($request->password);

        }

        $iva->save();
        Session::flash('message', 'Se ha actualizado el usuario  al Sistema');
        return redirect()->route('users.index');
    }
    public function show()
    {
        $folleto = Recurso::find(1);
        return view('users.folleto', compact('folleto'));
    }
    public function store_folleto(Request $request)
    {
        $request->validate([
            'folleto' => 'required|mimes:pdf,doc,docx|max:5048',
        ]);
        $nombre_app = config('app.name');
        $dir = $nombre_app . "/adjunto_app/";
        $folleto = Recurso::find(1);
        if ($folleto->descripcion) {
            File::delete($folleto->descripcion);
        }

        $logo = $request->file('folleto');
        $fileName2 = Str::random(10) . "_folleto" . '.' . $logo->getClientOriginalExtension();
        $dir = 'uploads'; // Directorio donde se guardarán los archivos
        $path = Storage::disk('public')->putFileAs($dir, $logo, $fileName2);

        // Obtener la URL completa del archivo
        $fullPath = Storage::url($path);
        //dd($fullPath);
        $ruta = config('app.url') . $fullPath;
        // dd($ruta);
        // Guardar la URL completa en la base de datos
        $folleto->descripcion = $ruta;
        $folleto->save();

        Session::flash('message', 'Se ha actualizado el folleto');
        return Redirect::back();

    }
}
