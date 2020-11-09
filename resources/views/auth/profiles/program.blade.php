@extends('layouts.app')
@section('title', 'Perfil-Programa')
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
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-appsalidas py-4">
                        <h4 class="font-weight-bold my-1">Perfil Programa</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('program.update') }}" method="post" class="my-4">
                            @csrf
                            <input type="hidden" name="id" value="{{ $program->id }}">
                            @method('put')
                            <div class="form-group">
                                <label class="font-weight-bold">Nombre del programa:</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Introduzca el nombre del programa" aria-describedby="helpId"
                                    value="{{ $program->name }}">
                                @error('name')
                                    <small id="helpId" class="text-white bg-appsalidas font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Código:</label>
                                <input type="text" name="code" class="form-control"
                                    placeholder="Introduzca el código del programa" aria-describedby="helpId"
                                    value="{{ $program->code }}" maxlength="7"
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
                                        @if ($faculty->id == $program->faculty->id)
                                            <option value="{{ $faculty->id }}" selected>{{ $faculty->name }}</option>
                                        @endif
                                        <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                                    @endforeach
                                </select>
                                @error('faculty_id')
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
            <div class="col-md-9">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header bg-appsalidas py-4">
                                <h4 class="my-0 font-weight-bold">Lista de Docentes</h4>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Acá puede visualizar todo los docentes que se encuentran registrados.
                                </h5>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="thead-inverse bg-appsalidas">
                                            <tr class="text-center">
                                                <th class="font-weight-bold w-auto">Código</th>
                                                <th class="font-weight-bold w-25">Docente</th>
                                                <th class="font-weight-bold w-auto">Correo Institucional</th>
                                                <th class="font-weight-bold w-auto">...</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($teachers as $teacher)
                                                <tr class="text-center" id="fila1{{ $loop->iteration }}">
                                                    <td>{{ $teacher->code }}</td>
                                                    <td class="text-capitalize">{{ $teacher->name }} {{ $teacher->lastname }}
                                                    </td>
                                                    <td>{{ $teacher->emailu }}</td>
                                                    <td>
                                                        <div class="btn-group w-100">
                                                            <a href="{{ route('user.show-teacher', $teacher) }}"
                                                                class="btn btn-info  mr-2">Visualizar</a>
                                                            <button class="btn btn-danger delete-teacher"
                                                                data-tr="{{ $loop->iteration }}"
                                                                data-id="{{ $teacher->id }}">Eliminar</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                No hay registrados de docentes.
                                            @endforelse
                                        </tbody>
                                        <tfoot class="bg-appsalidas">
                                            <tr class="text-center">
                                                <th class="font-weight-bold">Código</th>
                                                <th class="font-weight-bold">Docente</th>
                                                <th class="font-weight-bold">Correo Institucional</th>
                                                <th>...</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    {{ $teachers->links() }}
                                </div>
                            </div>
                            <div class="card-footer bg-appsalidas py-4"></div>
                        </div>

                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header bg-appsalidas py-4">
                                <h4 class="my-0 font-weight-bold">Lista de Estudiantes</h4>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Acá puede visualizar todo los estudiantes que se encuentran
                                    registrados.</h5>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="thead-inverse bg-appsalidas">
                                            <tr class="text-center">
                                                <th class="font-weight-bold w-auto">Código</th>
                                                <th class="font-weight-bold w-25">Estudiante</th>
                                                <th class="font-weight-bold w-auto">Correo Institucional</th>
                                                <th class="font-weight-bold w-auto">...</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($students as $student)
                                                <tr class="text-center" id="fila2{{ $loop->iteration }}">
                                                    <td>{{ $student->code }}</td>
                                                    <td class="text-capitalize">{{ $student->name }} {{ $student->lastname }}
                                                    </td>
                                                    <td>{{ $student->emailu }}</td>
                                                    <td>
                                                        <div class="btn-group w-100">
                                                            <a href="{{ route('user.show-student', $student) }}"
                                                                class="btn btn-info  mr-2">Visualizar</a>
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
                    axios.post("{{ route('user.delete') }}", {
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
                    $("#fila2" + fila).remove();
                }
            });
        });

    </script>
    <script>
        $('.delete-teacher').on('click', function() {

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡El docente será eliminado!",
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

                    });
                    var fila = $(this).attr('data-tr');
                    $("#fila1" + fila).remove();
                }
            })
        });

    </script>
@endsection
