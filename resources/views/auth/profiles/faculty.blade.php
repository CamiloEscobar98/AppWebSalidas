@extends('layouts.app')
@section('title', 'Perfil-Facultad')
@section('content')
    <div class="container-fluid">
        <div>
            @if (session()->has('update_complete'))
                <div class="alert alert-success">
                    <strong>¡Éxito!</strong> {{ session('update_complete') }}
                </div>
            @endif
            @if (session()->has('update_failed'))
                <div class="alert alert-danger">
                    <strong>¡Error!</strong> {{ session('update_failed') }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header bg-appsalidas py-4">
                        <h4 class="font-weight-bold my-1">Perfil Facultad</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('faculty.update') }}" method="post" class="my-4">
                            @csrf
                            @method('put')
                            <input type="hidden" name="id" value="{{ $faculty->id }}">
                            <div class="form-group">
                                <label class="font-weight-bold">Nombre de la facultad:</label>
                                <input type="text" name="name" class="form-control text-capitalize"
                                    placeholder="Introduzca el nombre de la facultad" aria-describedby="helpId"
                                    value="{{ $faculty->name }}">
                                @error('name')
                                    <small id="helpId" class="text-white bg-appsalidas font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-appsalidas">Actualizar</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-appsalidas py-4"></div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header bg-appsalidas py-4">
                        <h4 class="font-weight-bold my-1">Mis Programas</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-inverse">
                                    <tr class="bg-appsalidas">
                                        <th style="width: 5%">No.</th>
                                        <th class="w-50">Programa</th>
                                        <th class="w-auto">Estudiantes</th>
                                        <th class="w-auto">Docentes</th>
                                        <th style="width: 10%">...</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($programs as $program)
                                        <tr class="text-capitalize" id="fila{{ $loop->iteration }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $program->name }}</td>
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
                                        No tiene programas registrados.
                                    @endforelse

                                </tbody>
                                <tfoot class="bg-appsalidas py-4">
                                    <th>No.</th>
                                    <th>Programa</th>
                                    <th>Estudiantes</th>
                                    <th>Docentes</th>
                                    <th>...</th>
                                </tfoot>
                            </table>
                            {{ $programs->links() }}
                        </div>
                    </div>
                    <div class="card-footer bg-appsalidas py-4">
                    </div>
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
                    )

                });
                var fila = $(this).attr('data-tr');
                $("#fila" + fila).remove();
            }
        })
    });

</script>
@endsection
