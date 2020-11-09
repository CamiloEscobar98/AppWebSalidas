@extends('layouts.app')
@section('title', 'Listas-facultades')
@section('content')
    <div class="container-fluid">
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
        <div class="row justify-content-center">
            <div class="col-md-3 mt-2">
                <div class="card">
                    <div class="card-header bg-appsalidas py-4">
                        <h4 class="my-0 font-weight-bold">Registrar Facultad</h4>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title text-right font-weight-bold">Por favor llene todas las credenciales</h6>
                        <form action="{{ route('faculty.register') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Nombre de la facultad:</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Introduzca el nombre de la facultad" aria-describedby="helpId"
                                    value="{{ old('name') }}">
                                @error('name')
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
                        <h4 class="my-0 font-weight-bold">Lista de Facultades</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Acá puede visualizar todo las facultades que se encuentran registradas.</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="thead-inverse bg-appsalidas">
                                    <tr class="text-center">
                                        <th>No.</th>
                                        <th class="font-weight-bold w-25">Facultad</th>
                                        <th class="font-weight-bold w-auto">Programas</th>
                                        <th class="font-weight-bold w-25">Registro</th>
                                        <th class="font-weight-bold w-25">Actualización</th>
                                        <th class="font-weight-bold w-auto">...</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($faculties as $faculty)
                                        <tr class="text-center" id="fila{{ $loop->iteration }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-capitalize">{{ $faculty->name }} </td>
                                            <td>{{ $faculty->programs->count() }}</td>
                                            <td>{{ $faculty->created_at }}</td>
                                            <td>{{ $faculty->updated_at }}</td>
                                            <td>
                                                <div class="btn-group w-100">
                                                    <a href="{{ route('user.show-faculty', $faculty) }}"
                                                        class="btn btn-info  mr-2">Visualizar</a>
                                                    <button class="btn btn-danger delete-faculty"
                                                        data-tr="{{ $loop->iteration }}"
                                                        data-id="{{ $faculty->id }}">Eliminar</button>
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
                            {{ $faculties->links() }}
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
    $('.delete-faculty').on('click', function() {

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡La Facultad será eliminada!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Si, eliminalo!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).attr('data-id');
                axios.post("{{ route('faculty.delete') }}", {
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
                        'No se pudo eliminar la facultad.',
                        'error'
                    );
                });

            }
        })
    });

</script>
@endsection
