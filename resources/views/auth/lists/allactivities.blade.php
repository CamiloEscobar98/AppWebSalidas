@extends('layouts.app')
@section('title', 'Listas-Actividades')
@section('content')
    <div class="container-fluid">
        <div class="row">
            @forelse ($activities as $activity)
                @if (!auth()->user()->hasParticipate($activity->title))
                    <div class="col-12 col-md-6 col-lg-6 col-xl-4 pt-2 mb-4">
                        <div class="card rounded shadow h-100">
                            <div class="card-header bg-appsalidas py-4">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold">Actividad</h5>
                                <p class="card-text">{{ $activity->title }}</p>
                                <p class="card-text font-italic">{{ $activity->subtitle }}</p>
                                <h5 class="card-title font-weight-bold">Lugar</h5>
                                <p class="card-text">{{ $activity->place }}</p>
                                <h5 class="card-title font-weight-bold">Fecha establecida</h5>
                                <p class="card-text">{{ $activity->date }}</p>
                                <div class="form-group float-right">
                                    <h5 class="card-title font-weight-bold">Participantes</h5>
                                    <p class="card-text text-right">{{ sizeof($activity->users) }}</p>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="btn-group">
                                    @if (session('role') != 'administrador')
                                        <button type="button" class="btn btn-outline-primary btn-inscribir"
                                            data-activity="{{ $activity->id }}">Inscribirse</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @empty

            @endforelse
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $('.btn-inscribir').on('click', function() {
        var activity = $(this).attr('data-activity');
        axios.post("{{ route('user.addActivity') }}", {
            activity: activity,
            user: "{{ Auth()->user()->id }}",
        }).then(res => {
            console.log(res.data);
            Swal.fire({
                title: res.data.title,
                text: res.data.message,
                icon: res.data.alert
            });
            setTimeout(() => {
                location.reload(true)
            }, 2000);

        }).catch(res => {
            // console.log(res);
            Swal.fire({
                title: res.data.title,
                text: 'Error, no se ha inscrito correctamente a la temática.',
                icon: 'error'
            });
        });
    });

</script>
@endsection
