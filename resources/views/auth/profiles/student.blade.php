@extends('layouts.app')
@section('title', 'Perfil-Estudiante')
@section('content')
    <div class="container-fluid">
        @if (session()->has('update_complete'))
            <div class="alert alert-success">
                <strong>¡Éxito!</strong> Se ha actualizado correctamente.
            </div>
        @endif
        @if (session()->has('update-photo'))
            <div class="alert alert-success">
                <strong>¡Éxito!</strong> Se ha actualizado correctamente la foto de perfil.
            </div>
        @endif
        @if (session()->has('update-password'))
            <div class="alert alert-success">
                <strong>¡Éxito!</strong> {{ session('update-password') }}
            </div>
        @endif
        @error('image_profile')
            <div class="alert alert-danger">
                <strong>¡Error!</strong> {{ $message }}
            </div>
        @enderror
        @error('password')
            <div class="alert alert-danger">
                <strong>¡Error!</strong> {{ $message }}
            </div>
        @enderror
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header bg-appsalidas py-4">
                        <h4 class="font-weight-bold my-1">Perfil Estudiante</h4>
                    </div>
                    <div class="card-body">
                        @if (session('role') == 'administrador')
                            <button class="btn btn-appsalidas2 float-left" data-toggle="modal"
                                data-target="#changePassword">Cambiar contraseña</button>
                            <button class="btn btn-appsalidas2 float-right" data-toggle="modal"
                                data-target="#changePhoto">Cambiar
                                foto de perfil</button>
                        @endif
                        <img src="{{ asset($student->image->url . '/' . $student->image->image) }}"
                            class="img-fluid mx-auto d-block" width="200vh">
                        <hr>
                        <form action="{{ route('user.update') }}" method="post" class="my-4">
                            @csrf
                            @method('put')
                            <input type="hidden" name="id" value="{{ $student->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Nombres:</label>
                                        <input type="text" name="name" class="form-control text-capitalize"
                                            value="{{ $student->name }}" aria-describedby="helpId"
                                            {{ checkInputAdministrador(session('role')) }}>
                                        @error('name')
                                            <small id="helpId" class="text-white bg-appsalidas">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Apellidos:</label>
                                        <input type="text" name="lastname" class="form-control text-capitalize"
                                            value="{{ $student->lastname }}" aria-describedby="helpId"
                                            {{ checkInputAdministrador(session('role')) }}>
                                        @error('lastname')
                                            <small id="helpId" class="text-white bg-appsalidas">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Código:</label>
                                        <input type="text" name="code" class="form-control" value="{{ $student->code }}"
                                            aria-describedby="helpId" {{ checkInputAdministrador(session('role')) }}
                                            maxlength="7">
                                        @error('code')
                                            <small id="helpId" class="text-white bg-appsalidas">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Correo Personal:</label>
                                        <input type="text" name="email" class="form-control" value="{{ $student->email }}"
                                            aria-describedby="helpId" {{ checkInputAdministrador(session('role')) }}>
                                        @error('email')
                                            <small id="helpId" class="text-white bg-appsalidas">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Correo universitario:</label>
                                        <input type="text" name="emailu" class="form-control" value="{{ $student->emailu }}"
                                            aria-describedby="helpId" {{ checkInputAdministrador(session('role')) }}>
                                        @error('emailu')
                                            <small id="helpId" class="text-white bg-appsalidas">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Programa al que pertenece:</label>
                                        <select class="custom-select text-capitalize" name="program_id"
                                            {{ checkInputAdministrador(session('role')) }}>
                                            <option value="-1">Seleccione un programa</option>
                                            @foreach ($programs as $program)
                                                @if ($student->program->code == $program->code)
                                                    <option value="{{ $program->id }}" class="text-capitalize" selected>
                                                        {{ $program->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $program->id }}" class="text-capitalize">
                                                        {{ $program->name }}
                                                    </option>
                                                @endif

                                            @endforeach
                                        </select>
                                        @error('program_id')
                                            <small id="helpId" class="text-white bg-appsalidas">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Dirección de Residencia:</label>
                                        <input type="text" name="address" class="form-control text-capitalize"
                                            value="{{ $student->address }}" aria-describedby="helpId"
                                            {{ checkInputAdministrador(session('role')) }}>
                                        @error('address')
                                            <small id="helpId" class="text-white bg-appsalidas">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Teléfono Celular:</label>
                                        <input type="text" name="phone" class="form-control text-capitalize"
                                            value="{{ $student->phone }}" aria-describedby="helpId"
                                            {{ checkInputAdministrador(session('role')) }}>
                                        @error('phone')
                                            <small id="helpId" class="text-white bg-appsalidas">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Documento:</label>
                                        <input type="text" name="document" class="form-control text-capitalize"
                                            value="{{ $student->document->document }}" aria-describedby="helpId"
                                            {{ checkInputAdministrador(session('role')) }}>
                                        @error('document')
                                            <small id="helpId" class="text-white bg-appsalidas">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Tipo de Documento:</label>
                                        <select class="custom-select text-capitalize" name="document_type_id"
                                            {{ checkInputAdministrador(session('role')) }}>
                                            <option value="-1">Seleccione un Tipo de Documento</option>
                                            @foreach ($document_types as $doct_type)
                                                @if ($student->document->dtype->type == $doct_type->type)
                                                    <option value="{{ $doct_type->id }}" class="text-capitalize" selected>
                                                        {{ $doct_type->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $doct_type->id }}" class="text-capitalize">
                                                        {{ $doct_type->name }}
                                                    </option>
                                                @endif

                                            @endforeach
                                        </select>
                                        @error('document_type_id')
                                            <small id="helpId" class="text-white bg-appsalidas">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Fecha de Nacimiento:</label>
                                        <input type="date" name="birthday" class="form-control text-capitalize"
                                            value="{{ $student->birthday }}" aria-describedby="helpId"
                                            {{ checkInputAdministrador(session('role')) }} min="1940-01-01"
                                            max="2004-12-31">
                                        @error('birthday')
                                            <small id="helpId" class="text-white bg-appsalidas">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @if (session('role') == 'administrador')
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-appsalidas">Actualizar</button>
                                </div>
                            @endif
                        </form>
                    </div>
                    <div class="card-footer bg-appsalidas py-4"></div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header bg-appsalidas py-4">
                        <h4 class="font-weight-bold my-1">Mis Actividades</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-inverse">
                                    <tr class="bg-appsalidas">
                                        <th>No.</th>
                                        <th>Actividad</th>
                                        <th>Descripción</th>
                                        <th>Inicio</th>
                                        <th>Fin</th>
                                        <th>...</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-appsalidas py-4">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="changePhoto">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-appsalidas py-5">
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.update-photo') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="user_email" value="{{ $student->emailu }}">
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="image_profile">
                                <label class="custom-file-label" for="customFile">Seleccione una imágen de perfil</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-appsalidas2">Actualizar foto de perfil</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="changePassword">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-appsalidas py-5">
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.update-password') }}" method="post">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="id" value="{{ $student->id }}">
                        <div class="form-group">
                            <label class="font-weight-bold">Nueva Contraseña:</label>
                            <input class="form-control" type="password" name="password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-appsalidas2">Actualizar Contraseña</button>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

    </script>
@endsection
