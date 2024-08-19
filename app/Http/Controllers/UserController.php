<?php

namespace App\Http\Controllers;

use App\Models\Recurso;
use App\Models\User;
use App\Models\Usuario;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function migrar()
    {
        // dd("lleof");
        $usuarios = Usuario::take(18)->get();

        //  dd($viejo);

        foreach ($usuarios as $key) {
            $existingUser = User::where('usuario', $key->usuario)
                ->orWhere('email', $key->correo)
                ->orWhere('celular', $key->celular)
                ->first();
            if (!$existingUser) {
                $user = User::create([
                    'usuario' => $key->usuario,
                    'name' => $key->usuario,
                    'password' => Hash::make($key->password),
                    'email' => $key->correo,
                    'celular' => $key->celular,
                    'rol_id' => 2,
                ]);
            }
            $user = User::create([
                'usuario' => $key->usuario,
                'name' => $key->usuario,
                'password' => Hash::make($key->password),
                'email' => $key->correo,
                'celular' => $key->celular,
                'rol_id' => 2,
            ]);

        }
        return response()->json([
            'status' => 'success',
            'message' => 'Usuario registrado exitosamente',

        ], 201);
    }
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
    public function login(Request $request)
    {
        // Validar los datos recibidos

        $request->validate([
            'uss' => 'required|string',
            'pss' => 'required|string',
        ]);
        // Capturar los datos
        $username = $request->input('uss');
        $password = $request->input('pss');

        // Buscar el usuario en la base de datos
        $user = User::where('usuario', $username)->first();

        if ($user && Hash::check($password, $user->password)) {
            // Autenticación exitosa, generar token o cualquier otro manejo que necesites
            $token = $user->createToken('authToken')->accessToken;

            return response()->json($user
            );
        } else {
            // Autenticación fallida
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials',
            ], 401);
        }
    }
    public function register(Request $request)
    {
        // Validar los datos recibidos
        $validator = Validator::make($request->all(), [
            'uss' => 'required|string|max:255',
            'pss' => 'required|string|min:8',
            'correo' => 'required|string|email|max:255',
            'celular' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        // Verificar si el usuario ya existe
        $existingUser = User::where('usuario', $request->input('uss'))
            ->orWhere('email', $request->input('correo'))
            ->orWhere('celular', $request->input('celular'))
            ->first();

        if ($existingUser) {
            return response()->json([
                'status' => 'error',
                'message' => 'Usuario, correo o celular ya registrado',
            ], 400);
        }

        // Crear un nuevo usuario
        $user = User::create([
            'usuario' => $request->input('uss'),
            'name' => $request->input('uss'),
            'password' => Hash::make($request->input('pss')),
            'email' => $request->input('correo'),
            'celular' => $request->input('celular'),
            'rol_id' => 2,
        ]);

        // Devolver una respuesta exitosa
        return response()->json([
            'status' => 'success',
            'message' => 'Usuario registrado exitosamente',
            'user' => $user,
        ], 201);

    }
}
