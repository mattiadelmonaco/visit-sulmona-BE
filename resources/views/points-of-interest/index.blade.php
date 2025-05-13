@extends('layouts.master')

@section('title', 'Punti di interesse')

@section('page')

    <h1>Lista dei punti di interesse</h1>

    <div class="container my-5">
        <div class="row justify-content-center gap-4">
            @foreach ($pointsOfInterest as $poi)
                <div class="card px-0 shadow" style="width: 18rem;">
                    @if ($poi->firstImage)
                        <img src="{{ $poi->firstImage->path }}" alt="Immagine di {{ $poi->name }}">
                    @else
                        <img src="https://png.pngtree.com/png-vector/20210604/ourmid/pngtree-gray-network-placeholder-png-image_3416659.jpg"
                            alt="Immagine mancante">
                    @endif
                    <div class="card-body" style="height: 115px">
                        <h5 class="card-title">{{ $poi->name }}</h5>
                        <p class="card-text clamp-2">{{ $poi->description }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item flex flex-col">
                            <p class="m-0">Numero telefonico:</p>
                            <strong><a href="tel:{{ $poi->phone_number }}">{{ $poi->phone_number }}</a></strong>
                        </li>
                        <li class="list-group-item flex flex-col">
                            <p class="m-0">Indirizzo E-Mail:</p>
                            <strong><a href="mailto:{{ $poi->email }}">{{ $poi->email }}</a></strong>
                        </li>
                        <li class="list-group-item flex flex-col">
                            <p class="m-0">Link sito web/social:</p>
                            <a href="#"
                                class="card-link d-inline-block text-truncate w-100">{{ $poi->external_link }}</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('points-of-interest.show', $poi->id) }}" class="card-link">Maggiori
                                informazioni</a>
                        </li>
                    </ul>
                    <div class="card-body text-center">
                        <a href="#" class="card-link btn btn-warning"><i
                                class="fa-regular fa-pen-to-square"></i></a></a>
                        <a href="#" class="card-link btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </div>
            @endforeach

        </div>

    </div>

@endsection
