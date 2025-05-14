@php
    $poi = $points_of_interest;
    use Illuminate\Support\Carbon;
    Carbon::setLocale('it');
@endphp

@extends('layouts.master')
@section('title', $poi->name)

@section('page')
    <div class="container mt-2 mb-5">
        {{-- header della show --}}
        <div class="mb-4">
            <h1 class="display-4 mb-4">{{ $poi->name }}</h1>
            <div class="d-flex gap-3 align-items-start flex-wrap">
                {{-- Type Badge --}}
                @if ($poi->type)
                    <div class="badge bg-primary p-2 d-inline-flex align-items-center">
                        <i class="fas fa-tag me-2"></i>
                        <span class="fs-6">{{ $poi->type->name }}</span>
                    </div>
                @endif

                {{-- Tags Container --}}
                @if ($poi->tags->isNotEmpty())
                    <div class="d-inline-flex gap-2 flex-wrap align-items-center">
                        @foreach ($poi->tags as $tag)
                            <span class="badge p-2 d-inline-flex align-items-center"
                                style="background-color: {{ $tag->color }}">
                                <i class="fas fa-hashtag me-1"></i>
                                <span class="fs-6">{{ $tag->name }}</span>
                            </span>
                        @endforeach
                    </div>
                @else
                    <span class="badge bg-secondary p-2 d-inline-flex align-items-center">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <span class="fs-6">Nessun tag</span>
                    </span>
                @endif
            </div>
        </div>

        {{-- giorni e orari --}}
        @if ($poi->daysOfWeek && $poi->daysOfWeek->count())
            <div class="card shadow-sm mb-5">
                <div class="card-header bg-light">
                    <h4 class="mb-0"><i class="fas fa-clock me-2"></i>Orari di apertura</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Giorno</th>
                                    <th>Mattina</th>
                                    <th>Pomeriggio</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($poi->daysOfWeek as $day)
                                    <tr>
                                        <td class="fw-bold">{{ $day->name }}</td>
                                        <td>
                                            @if ($day->pivot->first_opening && $day->pivot->first_closing)
                                                <span class="text-success">
                                                    {{ date('H:i', strtotime($day->pivot->first_opening)) }}
                                                    -
                                                    {{ date('H:i', strtotime($day->pivot->first_closing)) }}
                                                </span>
                                            @else
                                                <span class="text-danger">Chiuso</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($day->pivot->second_opening && $day->pivot->second_closing)
                                                <span class="text-success">
                                                    {{ date('H:i', strtotime($day->pivot->second_opening)) }}
                                                    -
                                                    {{ date('H:i', strtotime($day->pivot->second_closing)) }}
                                                </span>
                                            @else
                                                <span class="text-danger">Chiuso</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        {{-- galleria immagini --}}
        @if ($points_of_interest->images->isNotEmpty())
            <div class="card shadow-sm mb-5">
                <div class="card-header bg-light">
                    <h4 class="mb-0"><i class="fas fa-images me-2"></i>Galleria</h4>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        @foreach ($points_of_interest->images as $image)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card h-100">
                                    <img src="{{ asset('storage/' . $image->path) }}" class="card-img-top object-fit-cover"
                                        style="height: 200px" alt="Immagine di {{ $poi->name }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>Nessuna immagine disponibile.
                </div>
        @endif
    </div>

    {{-- descrizione --}}
    <div class="card shadow-sm mb-5">
        <div class="card-header bg-light">
            <h4 class="mb-0"><i class="fas fa-info-circle me-2"></i>Descrizione</h4>
        </div>
        <div class="card-body">
            <p class="lead mb-0 fs-5">{{ $poi->description }}</p>
        </div>
    </div>

    {{-- informazioni --}}
    <div class="my-4">
        <div class="row g-4">
            @if ($poi->address)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-muted mb-3">
                                <i class="fas fa-map-marker-alt me-2"></i>Indirizzo
                            </h5>
                            <p class="card-text">{{ $poi->address }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if ($poi->phone_number)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-muted mb-3">
                                <i class="fas fa-phone me-2"></i>Telefono
                            </h5>
                            <p class="card-text">
                                <a href="tel:{{ $poi->phone_number }}"
                                    class="text-decoration-none">{{ $poi->phone_number }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if ($poi->email)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-muted mb-3">
                                <i class="fas fa-envelope me-2"></i>Email
                            </h5>
                            <p class="card-text">
                                <a href="mailto:{{ $poi->email }}" class="text-decoration-none">{{ $poi->email }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if ($poi->external_link)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-muted mb-3">
                                <i class="fas fa-globe me-2"></i>Sito Web/pagina social
                            </h5>
                            <p class="card-text">
                                <a href="{{ $poi->external_link }}" class="text-decoration-none"
                                    target="_blank">{{ $poi->external_link }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if ($poi->start_date && $poi->end_date)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-muted mb-3">
                                <i class="fas fa-calendar me-2"></i>Periodo
                            </h5>
                            <p class="card-text">
                                Dal <strong>{{ Carbon::parse($poi->start_date)->translatedFormat('d F Y') }}</strong>
                                al <strong>{{ Carbon::parse($poi->end_date)->translatedFormat('d F Y') }}</strong>
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- mappa --}}
    @if ($poi->latitude && $poi->longitude)
        <div class="card shadow-sm mb-5">
            <div class="card-header bg-light">
                <h4 class="mb-0"><i class="fas fa-map-marked-alt me-2"></i>Posizione</h4>
            </div>
            <div class="card-body p-0">
                <div class="ratio ratio-16x9">
                    <iframe loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"
                        src="https://www.google.com/maps?q={{ $poi->latitude }},{{ $poi->longitude }}&hl=it&z=14&output=embed">
                    </iframe>
                </div>
            </div>
        </div>
    @endif
    </div>
@endsection
