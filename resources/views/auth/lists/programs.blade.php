@extends('layouts.app')
@section('title', 'Listas-Programas')
@section('content')
    <div class="container-fluid">
        <div>
            @if (session()->has('register_complete'))
                <div class="alert alert-success">
                    <strong>¡Éxito!</strong> {{ session('register_complete') }}
                </div>
            @endif
            @if (session()->has('register_failed'))
                <div class="alert alert-danger">
                    <strong>¡Error!</strong> {{ session('register_failed') }}
                </div>
            @endif
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3 mt-2">
                <div class="card">
                    <div class="card-header bg-appsalidas py-4">
                        <h4 class="my-0 font-weight-bold">Registrar Programa</h4>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title text-right font-weight-bold">Por favor llene todas las credenciales</h6>
                        <form action="{{ route('program.register') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Nombre del programa:</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Introduzca el nombre del programa" aria-describedby="helpId"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <small id="helpId" class="text-white bg-appsalidas font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Código:</label>
                                <input type="text" name="code" class="form-control"
                                    placeholder="Introduzca el código del programa" aria-describedby="helpId"
                                    value="{{ old('code') }}" maxlength="7"
                                    onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                @error('code')
                                    <small id="helpId" class="text-white bg-appsalidas font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Selecciona una facultad:</label>
                                <select name="faculty_id" class="custom-select text-capitalize" aria-describedby="helpId">
                                    <option value="-1">Selecciona una facultad</option>
                                    @foreach ($faculties as $faculty)
                                        <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                                    @endforeach
                                </select>
                                @error('faculty_id')
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
                        <h4 class="my-0 font-weight-bold">Lista de Usuarios</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Acá puede visualizar todo las facultades que se encuentran registradas.</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="thead-inverse bg-appsalidas">
                                    <tr class="text-center">
                                        <th>No.</th>
                                        <th class="font-weight-bold w-25">Programa</th>
                                        <th class="font-weight-bold w-auto">Estudiantes</th>
                                        <th class="font-weight-bold w-25">Docentes</th>
                                        <th class="font-weight-bold w-25">Actualización</th>
                                        <th class="font-weight-bold w-auto">...</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($programs as $program)
                                        <tr class="text-center" id="fila{{ $loop->iteration }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-capitalize">{{ $program->name }} </td>
                                            <td>{{ $program->students()->count() }}</td>
                                            <td>{{ $program->teachers()->count() }}</td>
                                            <td>
                                                <div class="btn-group w-100">
                                                    <a href="{{ route('user.show-program', $program) }}"
                                                        class="btn btn-info  mr-2">Visualizar</a>
                                                    <button class="btn btn-danger delete-program"
                                                        data-tr="{{ $loop->iteration }}"
                                                        data-id="{{ $program->id }}">Eliminar</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        No hay facultades registradas.
                                    @endforelse
                                </tbody>
                                <tfoot class="bg-appsalidas">
                                    <tr class="text-center">
                                        <th>No.</th>
                                        <th class="font-weight-bold">Facultad</th>
                                        <th class="font-weight-bold">Programas</th>
                                        <th class="font-weight-bold">Registro</th>
                                        <th class="font-weight-bold">Actualización</th>
                                        <th>...</th>
                                    </tr>
                                </tfoot>
                            </table>
                            {{ $programs->links() }}
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
    $('.delete-program').on('click', function() {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡El programa será eliminado!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Si, eliminalo!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).attr('data-id');
                axios.post("{{ route('program.delete') }}", {
                    _method: 'delete',
                    id: id,
                }).then(response => {
                    Swal.fire(
                        'Eliminado!',
                        response.data,
                        'success'
                    );
                    var fila = $(this).attr('data-tr');
                    $("#fila" + fila).remove();
                }).catch(response => {
                    Swal.fire(
                        '¡Error!',
                        'No se ha podido eliminar.',
                        'error'
                    );
                });

            }
        })
    });

</script>
@endsection
