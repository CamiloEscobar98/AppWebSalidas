@extends('layouts.app')
@section('title', 'Listas-estudiantes')
@section('content')
    <div class="container-fluid">
        @if (session()->has('register_complete'))
            <div class="alert alert-success">
                <strong>¡Éxito!</strong> {{ session('register_complete') }}
            </div>
        @endif
        @if (session()->has('register_failed'))
            <div class="alert alert-danger">
                <strong>¡Éxito!</strong> {{ session('register_failed') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-3 mt-2">
                <div class="card">
                    <div class="card-header bg-appsalidas py-4">
                        <h4 class="my-0 font-weight-bold">Registrar Estudiante</h4>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title text-right font-weight-bold">Por favor llene todas las credenciales</h6>
                        <form action="{{ route('user.register-student') }}" method="post">
                            @csrf
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
                        <h4 class="my-0 font-weight-bold">Lista de Estudiantes</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Acá puede visualizar todo los estudiantes que se encuentran registrados.</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="thead-inverse bg-appsalidas">
                                    <tr class="text-center">
                                        <th class="font-weight-bold w-auto">Código</th>
                                        <th class="font-weight-bold w-25">Estudiante</th>
                                        <th class="font-weight-bold w-auto">Correo Institucional</th>
                                        <th class="font-weight-bold w-25">Programa</th>
                                        <th class="font-weight-bold w-auto">...</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($students as $student)
                                        <tr class="text-center" id="fila{{ $loop->iteration }}">
                                            <td>{{ $student->code }}</td>
                                            <td>{{ $student->name }} {{ $student->lastname }}</td>
                                            <td>{{ $student->emailu }}</td>
                                            <td>{{ $student->program->name }}</td>
                                            <td>
                                                <div class="btn-group w-100">
                                                    <button class="btn btn-info  mr-2">Visualizar</button>
                                                    <button class="btn btn-danger delete-student"
                                                        data-tr="{{ $loop->iteration }}"
                                                        data-id="{{ $student->id }}">Eliminar</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        No hay registrados de estudiantes.
                                    @endforelse
                                </tbody>
                                <tfoot class="bg-appsalidas">
                                    <tr class="text-center">
                                        <th class="font-weight-bold">Código</th>
                                        <th class="font-weight-bold">Estudiante</th>
                                        <th class="font-weight-bold">Correo Institucional</th>
                                        <th class="font-weight-bold">Programa</th>
                                        <th>...</th>
                                    </tr>
                                </tfoot>
                            </table>
                            {{ $students->links() }}
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
    $('.delete-student').on('click', function() {

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡El estudiante será eliminado!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Si, eliminalo!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).attr('data-id');
                axios.post("{{ route('user.delete-student') }}", {
                    _method: 'delete',
                    student_id: id,
                }).then(response => {
                    Swal.fire(
                        'Eliminado!',
                        response.data,
                        'success'
                    )

                });
                var fila = $(this).attr('data-tr');
                $("#fila" + fila).remove();
            }
        })
    });

</script>
@endsection
