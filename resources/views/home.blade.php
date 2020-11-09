@extends('layouts.app')
@section('title', 'Inicio')
@section('content')
    <div class="container">
        @if (session()->has('update_complete'))
            <div class="alert alert-success">
                <strong>¡Éxito!</strong> Se ha actualizado correctamente.
            </div>
        @endif
        @if (session()->has('update-photo'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: "Se ha actualizado la foto de perfil correctamente",
                    showConfirmButton: false,
                    timer: 2500
                })

            </script>
        @endif
        @if (session()->has('update-password'))
            <div class="alert alert-success">
                <strong>¡Éxito!</strong> Se ha actualizado correctamente la contraseña.
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
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header bg-appsalidas py-4 text-center">
                        <h1 class="font-weight-bold text-capitalize my-1">{{ session('role') }}</h1>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-appsalidas2 float-left" data-toggle="modal"
                            data-target="#changePhoto">Cambiar
                            foto de perfil</button>
                        <button class="btn btn-appsalidas2 float-right" data-toggle="modal"
                            data-target="#changePassword">Cambiar contraseña</button>

                        <img src="{{ asset(Auth::user()->image->url . '/' . Auth::user()->image->image) }}"
                            class="img-fluid mx-auto d-block" width="200vh">
                        <button class="btn btn-appsalidas2" id="delete-photo" data-id="{{ Auth()->user()->id }}">Eliminar
                            foto</button>
                        <hr>
                        <form action="{{ route('user.update') }}" method="post" class="my-4">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Nombres:</label>
                                        <input type="text" name="name" class="form-control text-capitalize"
                                            value="{{ Auth::user()->name }}" aria-describedby="helpId">
                                        @error('name')
                                            <small id="helpId" class="text-white bg-appsalidas">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Apellidos:</label>
                                        <input type="text" name="lastname" class="form-control text-capitalize"
                                            value="{{ Auth::user()->lastname }}" aria-describedby="helpId">
                                        @error('lastname')
                                            <small id="helpId" class="text-white bg-appsalidas">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Código:</label>
                                        <input type="text" name="code" class="form-control" value="{{ Auth::user()->code }}"
                                            aria-describedby="helpId" maxlength="7">
                                        @error('code')
                                            <small id="helpId" class="text-white bg-appsalidas">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Correo Personal:</label>
                                        <input type="text" name="email" class="form-control"
                                            value="{{ Auth::user()->email }}" aria-describedby="helpId">
                                        @error('email')
                                            <small id="helpId" class="text-white bg-appsalidas">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Correo universitario:</label>
                                        <input type="text" name="emailu" class="form-control"
                                            value="{{ Auth::user()->emailu }}" aria-describedby="helpId">
                                        @error('emailu')
                                            <small id="helpId" class="text-white bg-appsalidas">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Programa al que pertenece:</label>
                                        <select class="custom-select" name="program_id">
                                            <option value="-1">Seleccione un programa</option>
                                            @foreach ($programs as $program)
                                                @if (Auth::user()->program->code == $program->code)
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
                                            value="{{ Auth::user()->address }}" aria-describedby="helpId">
                                        @error('address')
                                            <small id="helpId" class="text-white bg-appsalidas">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Teléfono Celular:</label>
                                        <input type="text" name="phone" class="form-control text-capitalize"
                                            value="{{ Auth::user()->phone }}" aria-describedby="helpId">
                                        @error('phone')
                                            <small id="helpId" class="text-white bg-appsalidas">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Documento:</label>
                                        <input type="text" name="document" class="form-control text-capitalize"
                                            value="{{ Auth::user()->document->document }}" aria-describedby="helpId">
                                        @error('document')
                                            <small id="helpId" class="text-white bg-appsalidas">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Tipo de Documento:</label>
                                        <select class="custom-select" name="document_type_id">
                                            <option value="-1">Seleccione un Tipo de Documento</option>
                                            @foreach ($document_types as $doct_type)
                                                @if (Auth::user()->document->dtype->type == $doct_type->type)
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
                                            value="{{ Auth::user()->birthday }}" aria-describedby="helpId" min="1940-01-01"
                                            max="2004-12-31">
                                        @error('birthday')
                                            <small id="helpId" class="text-white bg-appsalidas">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-appsalidas">Actualizar</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-appsalidas py-4"></div>
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
                        <input type="hidden" name="user_email" value="{{ Auth()->user()->emailu }}">
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
                        <input type="hidden" name="user_email" value="{{ Auth()->user()->emailu }}">
                        @method('patch')
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

        $('#delete-photo').on('click', function(e) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Se eliminará la foto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, eliminala!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    var id = $(this).attr('data-id');
                    axios.post("{{ route('user.delete-photo') }}", {
                        _method: 'delete',
                        user_id: id,
                    }).then(response => {
                        Swal.fire({
                            position: 'top-end',
                            icon: response.data[2],
                            title: response.data[0],
                            text: response.data[1],
                            showConfirmButton: false,
                            timer: 2500
                        });
                        location.reload();
                    });
                    var fila = $(this).attr('data-tr');
                    $("#fila" + fila).remove();
                }
            });
        })

    </script>
@endsection
@section('scripts')

@endsection
