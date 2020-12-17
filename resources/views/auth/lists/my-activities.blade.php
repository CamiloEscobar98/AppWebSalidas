@extends('layouts.app')
@section('title', 'Listas-Actividades')
@section('content')
    <div class="container-fluid">
        <div class="col-12 mt-1">
            <div class="card">
                <div class="card-header bg-appsalidas py-4">
                    <h4 class="font-weight-bold my-0">Actividades</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Acá puede visualizar todas las actividades a las que estás participando.
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="bg-appsalidas">
                                <tr class="text-center">
                                    <th class="w-auto">Titulo</th>
                                    <th class="w-auto">Subtitulo</th>
                                    <th class="w-auto">Fecha</th>
                                    <th>Lugar</th>
                                    <th style="width: 5vh">...</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($actividades as $actividad)
                                    <tr class="text-center" id="fila{{ $loop->iteration }}">
                                        <td class="text-capitalize">{{ $actividad->title }}</td>
                                        <td class="text-capitalize">{{ $actividad->subtitle }}</td>
                                        <td>{{ $actividad->date }}</td>
                                        <td>{{$actividad->place}}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="">
                                                <a href="{{ route('user.show-activity', $actividad) }}" type="button"
                                                    class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                @if (session('administrador') || session('director'))
                                                    <button type="button" class="btn btn-danger delete-activity"
                                                        data-tr="{{ $loop->iteration }}" data-id="{{ $actividad->id }}"><i
                                                            class="fa fa-trash" aria-hidden="true"></i></button>
                                                @endif
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
                        </table>
                    </div>
                    {{ $actividades->links() }}
                </div>
                <div class="card-footer bg-appsalidas py-4"></div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
