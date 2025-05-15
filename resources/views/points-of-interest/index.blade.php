@extends('layouts.master')

@section('title', 'Punti di interesse')

@section('page')

    <h1 class="m-0">Elenco dei punti di interesse</h1>
    <div class="text-end">
        <a href="{{ route('points-of-interest.create') }}" class="btn btn-primary mt-3"><i class="fa-solid fa-plus"></i>
            Nuovo punto di interesse</a>

    </div>

    <div class="container mt-3 mb-5">
        <div class="row justify-content-center gap-4">
            @foreach ($pointsOfInterest as $poi)
                {{-- card --}}
                <div class="card px-0 shadow" style="width: 18rem;">

                    {{-- immagine principale con link alla show --}}
                    @if ($poi->firstImage)
                        <a href="{{ route('points-of-interest.show', $poi->id) }}" class="card px-0" style="width: 18rem;">
                            <img src="{{ asset('storage/' . $poi->firstImage->path) }}"
                                alt="Immagine di {{ $poi->name }}" class="card-img"
                                style="height: 200px; object-fit: cover;">
                        </a>
                        {{-- se non c'è l'immagine ne passo una di default --}}
                    @else
                        <a href="{{ route('points-of-interest.show', $poi->id) }}" class="card px-0"
                            style="width: 18rem;"><img
                                src="https://img.freepik.com/vettori-premium/vettore-icona-immagine-predefinita-pagina-immagine-mancante-per-la-progettazione-di-siti-web-o-app-per-dispositivi-mobili-nessuna-foto-disponibile_87543-11093.jpg"
                                alt="Immagine mancante" style="height: 200px; object-fit: cover;"></a>
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
                    <div class="card-body text-center d-flex gap-3 justify-content-center" style="max-height: 70px">
                        <a href="{{ route('points-of-interest.show', $poi->id) }}" class="card-link btn btn-primary"><i
                                class="fa-solid fa-circle-info"></i>
                        </a>
                        <a href="{{ route('points-of-interest.edit', $poi->id) }}" class="card-link btn btn-warning m-0"><i
                                class="fa-regular fa-pen-to-square"></i>
                        </a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#modal-{{ $poi->id }}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>


                {{-- modale per eliminazione --}}
                <div class="modal fade" id="modal-{{ $poi->id }}" tabindex="-1"
                    aria-labelledby="modalLabel-{{ $poi->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalLabel-{{ $poi->id }}">Elimina punto di interesse
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Sicuro di eliminare definitivamente il punto di interesse?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                <form action="{{ route('points-of-interest.destroy', $poi->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <input type="submit" class="btn btn-danger" value="Elimina definitivamente">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>

@endsection
