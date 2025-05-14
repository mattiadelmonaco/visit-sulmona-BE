@extends('layouts.master')

@section('title', 'Punti di interesse')

@section('page')

    <h1 class="m-0">Elenco dei punti di interesse</h1>
    <div class="text-end">
        <a href="{{ route('points-of-interest.create') }}" class="btn btn-primary mt-3"><i class="fa-solid fa-plus"></i>
            Aggiungi
            un
            punto di interesse</a>

    </div>

    <div class="container mt-3 mb-5">
        <div class="row justify-content-center gap-4">
            @foreach ($pointsOfInterest as $poi)
                <div class="card px-0 shadow" style="width: 18rem;">
                    @if ($poi->firstImage)
                        <a href="{{ route('points-of-interest.show', $poi->id) }}" class="card px-0"
                            style="width: 18rem;"><img src="{{ asset('storage/' . $poi->firstImage->path) }}"
                                alt="Immagine di {{ $poi->name }}"></a>
                    @else
                        <a href="{{ route('points-of-interest.show', $poi->id) }}" class="card px-0"
                            style="width: 18rem;"><img
                                src="https://png.pngtree.com/png-vector/20210604/ourmid/pngtree-gray-network-placeholder-png-image_3416659.jpg"
                                alt="Immagine mancante"></a>
                    @endif
                    <div class="card-body" style="height: 115px">
                        <h5 class="card-title">{{ $poi->name }}</h5>
                        <p class="card-text clamp-2">{{ $poi->description }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex">
                            <p class="m-0 text-muted"><i class="fas fa-phone me-2"></i></p>
                            <strong><a href="tel:{{ $poi->phone_number }}">{{ $poi->phone_number }}</a></strong>
                        </li>
                        <li class="list-group-item d-flex">
                            <p class="m-0 text-muted"><i class="fas fa-envelope me-2"></i></p>
                            <strong><a href="mailto:{{ $poi->email }}">{{ $poi->email }}</a></strong>
                        </li>
                        <li class="list-group-item d-flex">
                            <p class="m-0 text-muted"><i class="fas fa-globe me-2"></i></p>
                            <a href="{{ $poi->external_link }}"
                                class="card-link d-inline-block text-truncate w-100">{{ $poi->external_link }}</a>
                        </li>
                    </ul>
                    <div class="card-body text-center">
                        <a href="{{ route('points-of-interest.show', $poi->id) }}" class="card-link btn btn-primary"><i
                                class="fa-solid fa-circle-info"></i>
                        </a>
                        <a href="#" class="card-link btn btn-warning"><i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        <a href="#" class="card-link btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </div>
            @endforeach

        </div>

    </div>

@endsection
