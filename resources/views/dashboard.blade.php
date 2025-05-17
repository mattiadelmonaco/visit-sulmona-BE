@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Dashboard') }}
        </h2>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard utente') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="d-flex flex-column gap-2 align-items-center">
                            <p class="display-6">{{ __('Sei loggato! 🎉') }}</p>
                            <div>
                                <a href="{{ url('/') }}" class="btn btn-outline-danger btn-lg hover-shadow"
                                    style="border-radius: 10px; transition: all 0.3s ease;">
                                    <i class="fa-solid fa-house"></i> Vai alla HomePage
                                </a>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
