@extends('layouts.app')
@section('content')
    <div class="jumbotron py-3 px-3 bg-light rounded-3">
        <div class="container pt-2 pb-5">
            <div class="logo_laravel d-flex justify-content-center mb-3">
                <img src="{{ asset('storage/visits-sulmona-logo-backoffice.svg') }}" alt="logo di Visits Sulmona"
                    width="300px">
            </div>
            <h1 class="display-5 fw-bold text-center">
                Benvenuto nel BackOffice di Visits Sulmona! <i class="bi bi-box"></i>
            </h1>

            <div class="col-md-8 fs-4 text-center mx-auto">
                <p class="m-0">Gestici i punti di interesse della città direttamente da questo gestionale!</p>
                <p>Quello che inserisci verrà visualizzato nel sito per i visitatori!</p>
            </div>

            <div class="card shadow-sm p-4 my-4" style="border-radius: 15px; background-color: #f8f9fa;">
                <div class="d-flex flex-column align-items-center">
                    <div class="mb-4">
                        <h3 class="fw-bold ms-color"><i class="fas fa-star me-2"></i>Scorciatoie utili</h3>
                    </div>
                    <div class="d-flex gap-3 flex-wrap justify-content-center">
                        <div class="d-flex flex-column gap-3">
                            <a href="{{ route('points-of-interest.index') }}" class="btn btn-outline-primary hover-shadow"
                                style="border-radius: 10px; transition: all 0.3s ease;">
                                <i class="fas fa-map-marker-alt me-2"></i>Elenco punti di interesse
                            </a>
                            <a href="{{ route('types.index') }}" class="btn btn-outline-primary hover-shadow"
                                style="border-radius: 10px; transition: all 0.3s ease;">
                                <i class="fas fa-th-list me-2"></i>Elenco tipologie
                            </a>
                            <a href="{{ route('tags.index') }}" class="btn btn-outline-primary hover-shadow"
                                style="border-radius: 10px; transition: all 0.3s ease;">
                                <i class="fas fa-tags me-2"></i>Elenco Tag
                            </a>
                        </div>
                        <div class="d-flex flex-column gap-3">
                            <a href="{{ route('points-of-interest.create') }}" class="btn btn-outline-primary hover-shadow"
                                style="border-radius: 10px; transition: all 0.3s ease;">
                                <i class="fas fa-map-marker-alt me-2"></i>Aggiungi punto di interesse
                            </a>
                            <a href="{{ route('types.create') }}" class="btn btn-outline-primary hover-shadow"
                                style="border-radius: 10px; transition: all 0.3s ease;">
                                <i class="fas fa-th-list me-2"></i>Aggiungi tipologia
                            </a>
                            <a href="{{ route('tags.create') }}" class="btn btn-outline-primary hover-shadow"
                                style="border-radius: 10px; transition: all 0.3s ease;">
                                <i class="fas fa-tags me-2"></i>Aggiungi tag
                            </a>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>

    @include('partials.footer')
@endsection
