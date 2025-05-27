@extends('layouts.master')

@section('title', 'Attrazioni e Attività')

@section('page')
    <div class="container my-5">
        <div class="card shadow-sm">
            <div
                class="card-header ms-background text-white d-flex justify-content-between align-items-center flex-wrap gap-3">
                <h2 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i> Tutte le attrazioni e attività</h2>
                <a href="{{ route('points-of-interest.create') }}" class="btn btn-light">
                    <i class="fas fa-plus me-2"></i>Nuova attrazione o attività
                </a>
            </div>

            <div class="card-body">
                @if ($pointsOfInterest->isEmpty())
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>Nessuna attrazione o attività presente
                    </div>
                @else
                    <div class="container-fluid">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                            @foreach ($pointsOfInterest as $poi)
                                <div class="col">
                                    {{-- card --}}
                                    <div class="card h-100 shadow">

                                        {{-- immagine principale con link alla show --}}
                                        @if ($poi->first_image)
                                            <a href="{{ route('points-of-interest.show', $poi->id) }}" class="card-img-top">
                                                <img src="{{ asset('storage/' . $poi->first_image) }}"
                                                    alt="Immagine di {{ $poi->name }}" class="w-100"
                                                    style="height: 200px; object-fit: cover;">
                                            </a>
                                        @else
                                            <a href="{{ route('points-of-interest.show', $poi->id) }}" class="card-img-top">
                                                <img src="https://img.freepik.com/vettori-premium/vettore-icona-immagine-predefinita-pagina-immagine-mancante-per-la-progettazione-di-siti-web-o-app-per-dispositivi-mobili-nessuna-foto-disponibile_87543-11093.jpg"
                                                    alt="Immagine mancante" class="w-100"
                                                    style="height: 200px; object-fit: cover;">
                                            </a>
                                        @endif

                                        {{-- nome e descrizione --}}
                                        <div class="card-body p-3" style="height: 130px">
                                            <h5 class="card-title clamp-2">{{ $poi->name }}</h5>
                                            <p class="card-text clamp-2">{{ $poi->description }}</p>
                                        </div>

                                        {{-- elenco contatti se presenti --}}
                                        <ul class="list-group list-group-flush">
                                            @if ($poi->phone_number)
                                                <li class="list-group-item d-flex">
                                                    <p class="m-0 text-muted"><i class="fas fa-phone me-2"></i></p>
                                                    <strong><a href="tel:{{ $poi->phone_number }}"
                                                            class="text-decoration-none">{{ $poi->phone_number }}</a></strong>
                                                </li>
                                            @endif

                                            @if ($poi->email)
                                                <li class="list-group-item d-flex">
                                                    <p class="m-0 text-muted"><i class="fas fa-envelope me-2"></i></p>
                                                    <strong class="text-truncate"><a href="mailto:{{ $poi->email }}"
                                                            class="text-decoration-none">{{ $poi->email }}</a></strong>
                                                </li>
                                            @endif

                                            @if ($poi->external_link)
                                                <li class="list-group-item d-flex">
                                                    <p class="m-0 text-muted"><i class="fas fa-globe me-2"></i></p>
                                                    <a href="{{ $poi->external_link }}"
                                                        class="card-link d-inline-block text-truncate w-100 text-decoration-none">{{ $poi->external_link }}</a>
                                                </li>
                                            @endif
                                        </ul>

                                        {{-- bottone show, edit, delete --}}
                                        <div class="card-body text-center d-flex gap-3 justify-content-center"
                                            style="max-height: 70px">
                                            <a href="{{ route('points-of-interest.show', $poi->id) }}"
                                                class="card-link btn btn-primary"><i class="fa-solid fa-circle-info"></i>
                                            </a>
                                            <a href="{{ route('points-of-interest.edit', $poi->id) }}"
                                                class="card-link btn btn-warning m-0"><i
                                                    class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#modal-{{ $poi->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                {{-- modale per eliminazione --}}
                                <div class="modal fade" id="modal-{{ $poi->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">
                                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                                    Conferma eliminazione
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                Sei sicuro di voler eliminare il punto di interesse
                                                <strong>{{ $poi->name }}</strong>?
                                                <div class="alert alert-warning mt-2 mb-0">
                                                    Questa azione non può essere annullata.
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="fas fa-times me-2"></i>Annulla
                                                </button>
                                                <form action="{{ route('points-of-interest.destroy', $poi->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash me-2"></i>Elimina
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
