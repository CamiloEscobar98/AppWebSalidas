<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkRole:administrador')->only('studentsList', 'registerStudent', 'destroyStudent');
        // $this->middleware('checkRole:administrador')->only('studentsList');
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'code' => ['required', 'unique:users,code'],
            'emailu' => ['required', 'email', 'unique:users,emailu'],
            'program_id' => ['required', 'exists:programs,id', 'max:2'],
            'document_type_id' => ['required', 'exists:document_types,id', 'max:1'],
            'document' => ['required', 'unique:documents,document']
        ];
        $attributes = [
            'name' => 'Nombres',
            'lastname' => 'Apellidos',
            'code' => 'Código',
            'emailu' => 'Correo electrónico Institucional',
            'program_id' => 'Programa',
            'document' => 'Documento',
            'document_type_id' => 'Tipo de Documento'
        ];
        $program = \App\Models\Program::find($request->program_id);
        $validated = $request->validate($rules, [], $attributes);
        $document = \App\Models\Document::create([
            'document' => $validated['document'],
            'document_type_id' =>  $validated['document_type_id']
        ]);
        $user = \App\User::create([
            'name' => mb_strtolower($validated['name'], 'UTF-8'),
            'lastname' => mb_strtolower($validated['lastname'], 'UTF-8'),
            'emailu' => mb_strtolower($validated['emailu'], 'UTF-8'),
            'code' => $validated['code'],
            'document_id' => $document->id,
            'password' => bcrypt('1234'),
            'program_id' => $validated['program_id'],
            'image_id' => \App\Models\ImageProfile::create([
                'image' => 'default.png',
                'url' => 'storage/images'
            ])->id
        ]);
        $user->roles()->attach($request->role_id);
        if ($user) {
            return back()->with('register_complete', 'Se ha registrado correctamente al estudiante ' . $user->name . ' ' . $user->lastname);
        }
        return back()->with('register_failed', 'No se ha podido registrar correctamente');
    }

    public function update(Request $request)
    {
        $usuario = \App\User::find($request->id);
        $rules = [
            'email' => ['required', 'email'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'birthday' => ['required', 'date']
        ];
        $attributes = [
            'email' => 'Correo electrónico Personal',
            'address' => 'Dirección de Residencia',
            'phone' => 'Teléfono Celular',
            'birthday' => 'Fecha de Nacimiento',
        ];
        if (session('role') == 'administrador') {
            $rules['emailu'] = ['required', 'email', 'unique:users,emailu,' . $usuario->id];
            $rules['code'] = ['required', 'unique:users,code,' . $usuario->id];
            $rules['name'] = ['required', 'string'];
            $rules['lastname'] =  ['required', 'string'];
            $rules['document_type_id'] = ['required', 'exists:document_types,id', 'max:1'];
            $rules['document'] = ['required', 'unique:documents,document,' . $usuario->document->id];
            $rules['program_id'] = ['required', 'exists:programs,id', 'max:2'];

            $attributes['program_i'] = 'Programa';
            $attributes['document'] = 'Documento';
            $attributes['document_type_id'] = 'Tipo de Documento';
            $attributes['name'] = 'Nombres';
            $attributes['lastname'] = 'Apellidos';
            $attributes['code'] = 'Código';
            $attributes['emailu'] = 'Correo electrónico Institucional';
        }
        $validated = $request->validate($rules, [], $attributes);
        $usuario = \App\User::find($usuario->id);

        $usuario->email = mb_strtolower($validated['email'], 'UTF-8');
        $usuario->address = mb_strtolower($validated['address'], 'UTF-8');
        $usuario->phone = $validated['phone'];
        $usuario->birthday = $validated['birthday'];
        if (session('role') == 'administrador') {
            $usuario->name = mb_strtolower($validated['name'], 'UTF-8');
            $usuario->lastname = mb_strtolower($validated['lastname'], 'UTF-8');
            $usuario->code = $validated['code'];
            $usuario->emailu = mb_strtolower($validated['emailu'], 'UTF-8');
            $usuario->program_id = $validated['program_id'];
            $usuario->document->document = $validated['document'];
            $usuario->document->document_type_id = $validated['document_type_id'];
            $usuario->document->save();
        }
        $usuario->save();
        return back()->with('update_complete', true);
    }

    public function updatePhoto(Request $request)
    {
        $usuario = \App\User::where('emailu', $request->user_email)->first();
        $rules = [
            'image_profile' => ['required', 'image', 'mimes:jpeg,jpg,png,jfif']
        ];
        $attributes = ['image_profile' => 'Imágen de Perfil'];

        $validated = $request->validate($rules, [], $attributes);

        if ($usuario->image->image != 'default.png') {
            Storage::delete('public/images/profiles/' . $usuario->image->image);
        }

        $imagen = $request->file('image_profile');
        $nombre = $usuario->code . '.' . $imagen->getClientOriginalExtension();
        $destino = public_path('storage/images/profiles');
        $request->image_profile->move($destino, $nombre);
        $usuario = \App\User::find($usuario->id);
        $usuario->image->image = $nombre;
        $usuario->image->url = 'storage/images/profiles';
        $usuario->image->save();
        return back()->with('update-photo', true);
    }

    public function updatePassword(Request $request)
    {
        $usuario = \App\User::where('emailu', $request->user_email)->first();
        $rules = [
            'password' => ['required', 'string']
        ];
        $attributes = ['password' => 'Contraseña'];

        $validated = $request->validate($rules, [], $attributes);
        $usuario->password = bcrypt($validated['password']);
        $usuario->save();
        return back()->with('update-password', 'Tu contraseña ha cambiado a ' . $validated['password']);
        // return $validated;
    }

    public function deletePhoto(Request $request)
    {
        if ($request->ajax()) {
            $usuario = \App\User::find($request->user_id);
            if ($usuario->image->image != 'default.png') {
                Storage::delete('public/images/profiles/' . $usuario->image->image);
                $usuario->image->image = 'default.png';
                $usuario->image->url = 'storage/images';
                $usuario->image->save();
                return response()->json(['¡Eliminado!', 'Se ha eliminado correctamente la foto de perfil.', 'success']);
            }
            return response()->json(['¡Error!', 'No se ha podido eliminar la foto de perfil.', 'failed']);
        }
    }

    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $usuario = \App\User::find($request->student_id);
            $aux = $usuario;
            if ($usuario->delete()) {
                return 'Se ha eliminado correctamente a ' . $aux->name . ' ' . $aux->lastname;
            }
        }
    }
}
