<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $rules = [
            'name' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'code' => ['required', 'unique:users,id,' . Auth()->user()->id],
            'emailu' => ['required', 'email', 'unique:users,emailu,' . Auth()->user()->id],
            'email' => ['required', 'email'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'birthday' => ['required', 'date'],
            'program_id' => ['required', 'exists:programs,id', 'max:2'],
            'document_type_id' => ['required', 'exists:document_types,id', 'max:1'],
            'document' => ['required', 'unique:documents,document,' . Auth()->user()->document->id]
        ];
        $attributes = [
            'name' => 'Nombres',
            'lastname' => 'Apellidos',
            'code' => 'Código',
            'emailu' => 'Correo electrónico Institucional',
            'email' => 'Correo electrónico Personal',
            'address' => 'Dirección de Residencia',
            'phone' => 'Teléfono Celular',
            'birthday' => 'Fecha de Nacimiento',
            'program_id' => 'Programa',
            'document' => 'Documento',
            'document_type_id' => 'Tipo de Documento'
        ];
        $validated = $request->validate($rules, [], $attributes);
        $usuario = \App\User::find(Auth()->user()->id);
        $usuario->name = $validated['name'];
        $usuario->lastname = $validated['lastname'];
        $usuario->code = $validated['code'];
        $usuario->emailu = $validated['emailu'];
        $usuario->email = $validated['email'];
        $usuario->address = $validated['address'];
        $usuario->phone = $validated['phone'];
        $usuario->birthday = $validated['birthday'];
        $usuario->program_id = $validated['program_id'];
        $usuario->document->document = $validated['document'];
        $usuario->document->document_type_id = $validated['document_type_id'];
        $usuario->document->save();
        $usuario->save();
        // return $validated;
        return back()->with('update_complete', true);
    }

    public function updatePhoto(Request $request)
    {
        $rules = [
            'image_profile' => ['required', 'image', 'mimes:jpeg,jpg,png']
        ];
        $attributes = ['image_profile' => 'Imágen de Perfil'];

        $validated = $request->validate($rules, [], $attributes);
        $imagen = $request->file('image_profile');
        $nombre = Auth()->user()->code . '.' . $imagen->getClientOriginalExtension();
        $destino = public_path('storage/images/profiles');
        $request->image_profile->move($destino, $nombre);
        $usuario = \App\User::find(Auth()->user()->id);
        $usuario->image->image = $nombre;
        $usuario->image->url = 'storage/images/profiles';
        $usuario->image->save();
        return back()->with('update-photo', true);
    }

    public function updatePassword(Request $request)
    {
        $rules = [
            'password' => ['required', 'string']
        ];
        $attributes = ['password' => 'Contraseña'];

        $validated = $request->validate($rules, [], $attributes);

        $usuario = \App\User::find(Auth()->user()->id);
        $usuario->password = bcrypt($validated['password']);
        $usuario->save();
        return back()->with('update-password', true);
        // return $validated;
    }
}
