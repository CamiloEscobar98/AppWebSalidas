@extends('layouts.app')
@section('title', 'Iniciar Sesión')
@section('content')
    <section id="login">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-appsalidas py-5"></div>
                        <div class="card-body">
                            <p class="font-weight-bold text-right">Por favor llene sus credenciales para iniciar sesión.</p>
                            <hr class="mt-3 mb-4">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="code"
                                        class="col-md-4 col-form-label text-md-right font-weight-bold">Código:</label>

                                    <div class="col-md-6">
                                        <input id="code" type="text"
                                            class="form-control @error('code') is-invalid @enderror" name="code"
                                            value="{{ old('code') }}" autocomplete="code" autofocus>

                                        @error('code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-right font-weight-bold">Contraseña:</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="role_id"
                                        class="col-md-4 col-form-label text-md-right font-weight-bold">Seleccione
                                        una opción:</label>
                                    <div class="col-md-6">
                                        <select class="custom-select @error('role_id') is-invalid @enderror" name="role_id"
                                            id="role_id">
                                            <option value="1">Seleccione una opción</option>
                                            @foreach ($roles as $role)
                                                @if ($role->name != 'administrador')
                                                    <option class="text-capitalize" value="{{ $role->id }}">
                                                        {{ $role->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="form-group row mb-0">
                                    <div class="col-md-10 offset-md-2">
                                        <button type="submit" class="btn btn-appsalidas">
                                            Iniciar Sesión
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                ¿Olvidaste tu contraseña?
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer bg-appsalidas py-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
