@extends('layouts.app')
@section('title', 'Listas-directores')
@section('content')
    <div class="container-fluid">
        @if (session()->has('register_complete'))
            <div class="alert alert-success">
                <strong>¡Éxito!</strong> {{ session('register_complete') }}
            </div>
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: "Se ha registrado correctamente",
                    showConfirmButton: false,
                    timer: 2500
                })

            </script>
        @endif
        @if (session()->has('register_failed'))
            <div class="alert alert-danger">
                <strong>¡Error!</strong> {{ session('register_failed') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-3 mt-2">
                <div class="card">
                    <div class="card-header bg-appsalidas py-4">
                        <h4 class="my-0 font-weight-bold">Registrar Director</h4>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title text-right font-weight-bold">Por favor llene todas las credenciales</h6>
                        <form action="{{ route('user.register') }}" method="post">
                            @csrf
                            <input type="hidden" name="role_id" value="4">
                            <div class="form-group">
                                <label class="font-weight-bold">Programa al que pertenece:</label>
                                <select name="program_id" class="custom-select">
                                    <option value="-1">Seleccione un Programa</option>
                                    @foreach ($programs as $program)
                                        <option class="text-capitalize" value="{{ $program->id }}">{{ $program->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('program_id')
                                    <small id="helpId" class="text-white bg-appsalidas font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Nombres:</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Introduzca los nombres del estudiante" aria-describedby="helpId"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <small id="helpId" class="text-white bg-appsalidas font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Apelidos:</label>
                                <input type="text" name="lastname" class="form-control"
                                    placeholder="Introduzca los apellidos del estudiante" aria-describedby="helpId"
                                    value="{{ old('lastname') }}">
                                @error('lastname')
                                    <small id="helpId" class="text-white bg-appsalidas font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Código:</label>
                                <input type="text" name="code" class="form-control"
                                    placeholder="Introduzca los apellidos del estudiante" aria-describedby="helpId"
                                    value="{{ old('code') }}" maxlength="7"
                                    onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                @error('code')
                                    <small id="helpId" class="text-white bg-appsalidas font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Tipo de Documento:</label>
                                <select name="document_type_id" class="custom-select">
                                    <option value="-1">Seleccione un Tipo</option>
                                    @foreach ($document_types as $dtype)
                                        <option class="text-capitalize" value="{{ $dtype->id }}">{{ $dtype->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('document_type_id')
                                    <small id="helpId" class="text-white bg-appsalidas font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Documento:</label>
                                <input type="text" name="document" class="form-control"
                                    placeholder="Introduzca el documento del estudiante" aria-describedby="helpId"
                                    value="{{ old('document') }}">
                                @error('document')
                                    <small id="helpId" class="text-white bg-appsalidas font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Correo electrónico Institucional:</label>
                                <input type="email" name="emailu" class="form-control"
                                    placeholder="Introduzca el correo institucional del estudiante"
                                    aria-describedby="helpId" value="{{ old('emailu') }}">
                                @error('emailu')
                                    <small id="helpId" class="text-white bg-appsalidas font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-appsalidas">Registrar</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-appsalidas py-4"></div>
                </div>
            </div>
            <div class="col-md-9 mt-2">
                <div class="card">
                    <div class="card-header bg-appsalidas py-4">
                        <h4 class="my-0 font-weight-bold">Lista de Directores de programa</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Acá puede visualizar todo los directores que se encuentran registrados.</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="thead-inverse bg-appsalidas">
                                    <tr class="text-center">
                                        <th class="font-weight-bold w-auto">Código</th>
                                        <th class="font-weight-bold w-25">Director</th>
                                        <th class="font-weight-bold w-auto">Correo Institucional</th>
                                        <th class="font-weight-bold w-25">Programa</th>
                                        <th class="font-weight-bold" style="width: 5vh">...</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($directors as $director)
                                        <tr class="text-center" id="fila{{ $loop->iteration }}">
                                            <td>{{ $director->code }}</td>
                                            <td class="text-capitalize">{{ $director->name }} {{ $director->lastname }}</td>
                                            <td>{{ $director->emailu }}</td>
                                            <td class="text-capitalize">{{ $director->program->name }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('user.show-director', $director) }}"
                                                        class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                    <button class="btn btn-danger delete-user" data-tr="{{ $loop->iteration }}"
                                                        data-id="{{ $director->id }}"><i class="fa fa-trash"
                                                            aria-hidden="true"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <h5 class="font-weight-bold bg-appsalidas py-2 px-2 text-center">No hay directores
                                                registrados.</h5>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot class="bg-appsalidas">
                                    <tr class="text-center">
                                        <th class="font-weight-bold">Código</th>
                                        <th class="font-weight-bold">Director</th>
                                        <th class="font-weight-bold">Correo Institucional</th>
                                        <th class="font-weight-bold">Programa</th>
                                        <th>...</th>
                                    </tr>
                                </tfoot>
                            </table>
                            {{ $directors->links() }}
                        </div>
                    </div>
                    <div class="card-footer bg-appsalidas py-4"></div>
                </div>


            </div>
        </div>
    </div>

@endsection
@section('scripts')
<script>
    $('.delete-user').on('click', function() {

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡El director de programa será eliminado!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Si, eliminalo!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).attr('data-id');
                axios.post("{{ route('user.delete') }}", {
                    _method: 'delete',
                    student_id: id,
                }).then(response => {
                    Swal.fire(
                        'Eliminado!',
                        response.data,
                        'success'
                    )
                    var fila = $(this).attr('data-tr');
                    $("#fila" + fila).remove();
                    setTimeout(() => {
                        location.reload(true)
                    }, 2000);
                });

            }
        }).catch(response => {
            Swal.fire(
                '¡Error!',
                '¡No se pudo eliminar el director!',
                'error'
            );
        });
    });

</script>
@endsection
