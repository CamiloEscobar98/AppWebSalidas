@extends('layouts.app')
@section('title', 'Perfil-Actividad')
@section('content')
    <div class="container-fluid">
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
            <div class="col-12 col-md-3">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header bg-appsalidas py-4">
                                <h4 class="font-weight-bold my-0">Perfil Actividad</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('activity.update', $activity) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="activity" value="{{ $activity->id }}">
                                    <div class="form-group">
                                        <label for="title"
                                            class="font-weight-bold @error('title') is-invalid @enderror">Titulo</label>
                                        <input type="text" name="title" id="title" class="form-control"
                                            value="{{ $activity->title }}" placeholder="Titulo de la actividad"
                                            aria-describedby="helpId">
                                        @error('title')
                                            <small id="helpId"
                                                class="text-white bg-appsalidas font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="subtitle"
                                            class="font-weight-bold @error('subtitle') is-invalid @enderror">Subtitulo</label>
                                        <input type="text" name="subtitle" id="subtitle" class="form-control"
                                            value="{{ $activity->subtitle }}" placeholder="Subtitulo de la actividad"
                                            aria-describedby="helpId">
                                        @error('subtitle')
                                            <small id="helpId"
                                                class="text-white bg-appsalidas font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="place"
                                            class="font-weight-bold @error('place') is-invalid @enderror">Lugar</label>
                                        <input type="text" name="place" id="place" class="form-control"
                                            value="{{ $activity->place }}" placeholder="Lugar de la actividad"
                                            aria-describedby="helpId">
                                        @error('place')
                                            <small id="helpId"
                                                class="text-white bg-appsalidas font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="font-weight-bold ">Descripción</label>
                                        <textarea name="description" id="description" rows="3"
                                            class="form-control @error('description') is-invalid @enderror"
                                            aria-describedby="helpId">{{ $activity->description }}</textarea>
                                        @error('description')
                                            <small id="helpId"
                                                class="text-white bg-appsalidas font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="date" class="font-weight-bold @error('date') is-invalid @enderror">Fecha
                                            de
                                            Actividad</label>
                                        <input type="date" name="date" id="date" class="form-control"
                                            value="{{ $activity->date }}" aria-describedby="helpId">
                                        @error('date')
                                            <small id="helpId"
                                                class="text-white bg-appsalidas font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="teacher" class="font-weight-bold">Seleccionar docente</label>
                                        <select class="form-control @error('teacher') is-invalid  @enderror " name="teacher"
                                            id="teacher">
                                            <option value="-1">Selecciona una opción</option>
                                            @foreach ($docentes as $docente)
                                                @if ($docente->emailu == $activity->teacher->emailu)
                                                    <option value="{{ $docente->emailu }}" selected>
                                                        {{ $docente->fullname() }}
                                                    </option>
                                                @else
                                                    <option value="{{ $docente->emailu }}">{{ $docente->fullname() }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('teacher')
                                            <small id="helpId"
                                                class="text-white bg-appsalidas font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-appsalidas btn-block">Actualizar</button>
                                    </div>

                                </form>
                            </div>
                            <div class="card-footer bg-appsalidas py-4"></div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="card shadow">
                            <div class="card-header bg-appsalidas py-4">
                                <h4 class="font-weight-bold my-0">Registrar Requerimiento</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('requirement.register') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="activity" value="{{ $activity->id }}">
                                    <div class="form-group">
                                        <label for="requirement" class="font-weight-bold">Requerimiento</label>
                                        <input type="text" class="form-control @error('requirement') is-invalid @enderror"
                                            name="requirement" id="requirement" aria-describedby="helpId"
                                            placeholder="Introduce el requerimiento de la actividad">
                                        @error('requirement')
                                            <small id="helpId"
                                                class="text-white bg-appsalidas font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-appsalidas btn-block">Registrar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer bg-appsalidas py-4"></div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-md-9">
                <div class="card">
                    <div class="card-header bg-appsalidas py-4">
                        <h4 class="font-weight-bold my-0">Lista de Requerimientos</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="bg-appsalidas">
                                    <tr class="text-center">
                                        <th style="width: 5vh">No.</th>
                                        <th class="w-auto">Requerimiento</th>
                                        <th style="width: 5vh">...</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @forelse ($requirements as $requirement)
                                        <tr id="fila{{ $loop->iteration }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $requirement->text }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="">
                                                    <button type="button" class="btn btn-primary">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger delete-requirement"
                                                        data-tr="{{ $loop->iteration }}" data-id="{{ $requirement->id }}">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <h5>No hay requerimientos registrados</h5>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
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
    $('.delete-requirement').on('click', function() {

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡El requerimiento será eliminado!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Si, eliminalo!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).attr('data-id');
                axios.post("{{ route('requirement.delete') }}", {
                    _method: 'delete',
                    requirement_id: id,
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
                'No se pudo eliminar el requerimiento.',
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
