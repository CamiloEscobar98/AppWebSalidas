@extends('layouts.app')
@section('title', 'Listas-Actividades')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-3 mt-1">
                <div>
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
                </div>
                <div class="card shadow">
                    <div class="card-header bg-appsalidas py-4">
                        <h4 class="font-weight-bold my-0">Registrar Actividad</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('activity.register') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="title"
                                    class="font-weight-bold @error('title') is-invalid @enderror">Titulo</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}"
                                    placeholder="Titulo de la actividad" aria-describedby="helpId">
                                @error('title')
                                    <small id="helpId" class="text-white bg-appsalidas font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="subtitle"
                                    class="font-weight-bold @error('subtitle') is-invalid @enderror">Subtitulo</label>
                                <input type="text" name="subtitle" id="subtitle" class="form-control"
                                    value="{{ old('subtitle') }}" placeholder="Subtitulo de la actividad"
                                    aria-describedby="helpId">
                                @error('subtitle')
                                    <small id="helpId" class="text-white bg-appsalidas font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="place"
                                    class="font-weight-bold @error('place') is-invalid @enderror">Lugar</label>
                                <input type="text" name="place" id="place" class="form-control" value="{{ old('place') }}"
                                    placeholder="Lugar de la actividad" aria-describedby="helpId">
                                @error('place')
                                    <small id="helpId" class="text-white bg-appsalidas font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description" class="font-weight-bold ">Descripción</label>
                                <textarea name="description" id="description" rows="3"
                                    class="form-control @error('description') is-invalid @enderror"
                                    aria-describedby="helpId">{{ old('description') }}</textarea>
                                @error('description')
                                    <small id="helpId" class="text-white bg-appsalidas font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="date" class="font-weight-bold @error('date') is-invalid @enderror">Fecha de
                                    Actividad</label>
                                <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}"
                                    aria-describedby="helpId">
                                @error('date')
                                    <small id="helpId" class="text-white bg-appsalidas font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="teacher" class="font-weight-bold">Seleccionar docente</label>
                                <select class="form-control @error('teacher') is-invalid  @enderror " name="teacher"
                                    id="teacher">
                                    <option value="-1">Selecciona una opción</option>
                                    @foreach ($docentes as $docente)
                                        <option value="{{ $docente->emailu }}">{{ $docente->fullname() }}</option>
                                    @endforeach
                                </select>
                                @error('teacher')
                                    <small id="helpId" class="text-white bg-appsalidas font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-appsalidas btn-block">Registar</button>
                            </div>

                        </form>
                    </div>
                    <div class="card-footer bg-appsalidas py-4"></div>
                </div>
            </div>
            <div class="col-12 col-md-9 mt-1">
                <div class="card">
                    <div class="card-header bg-appsalidas py-4">
                        <h4 class="font-weight-bold my-0">Lista de Actividades</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Acá puede visualizar todas las actividades que se encuentran registradas.
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="bg-appsalidas">
                                    <tr class="text-center">
                                        <th class="w-auto">Titulo</th>
                                        <th class="w-auto">Subtitulo</th>
                                        <th class="w-auto">Docente</th>
                                        <th style="width: 5vh">...</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($actividades as $actividad)
                                        <tr class="text-center" id="fila{{ $loop->iteration }}">
                                            <td class="text-capitalize">{{ $actividad->title }}</td>
                                            <td class="text-capitalize">{{ $actividad->subtitle }}</td>
                                            <td><a href="{{ route('user.show-teacher', $actividad->teacher) }}"
                                                    class="btn btn-info">{{ $actividad->teacher->fullname() }}</a></td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="">
                                                    <a href="{{ route('user.show-activity', $actividad) }}" type="button"
                                                        class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                    <button type="button" class="btn btn-danger delete-activity"
                                                        data-tr="{{ $loop->iteration }}" data-id="{{ $actividad->id }}"><i
                                                            class="fa fa-trash" aria-hidden="true"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <h5 class="font-weight-bold bg-appsalidas py-2 px-2 text-center">No hay actividades
                                                registradas.</h5>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot class="text-center bg-appsalidas py-4">
                                    <tr>
                                        <th>Titulo</th>
                                        <th>Subtitulo</th>
                                        <th>Docente</th>
                                        <th>...</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        {{ $actividades->links() }}
                    </div>
                    <div class="card-footer bg-appsalidas py-4"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $('.delete-activity').on('click', function() {

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡La actividad será eliminada!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Si, eliminalo!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).attr('data-id');
                axios.post("{{ route('activity.delete') }}", {
                    _method: 'delete',
                    activity_id: id,
                }).then(response => {
                    Swal.fire(
                        'Eliminado!',
                        response.data,
                        'success'
                    )

                });
                var fila = $(this).attr('data-tr');
                $("#fila" + fila).remove();
                setTimeout(() => {
                    location.reload(true)
                }, 2000);
            }
        }).catch(response => {
            Swal.fire(
                '¡Error!',
                'No se pudo eliminar la actividad.',
                'error'
            );
        });
    });

    window.onload = function() {
        fecha = new Date().toISOString().split('T')[0];
        date = document.getElementById("date");
        date.min = fecha;
    }

</script>

@endsection
