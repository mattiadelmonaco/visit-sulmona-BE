@php
    $poi = $points_of_interest;
@endphp

@extends('layouts.master')

@section('title', $poi->name)

@section('page')
    <div class="container my-5">

        <h1>{{ $poi->name }}</h1>

        @if ($points_of_interest->images->isNotEmpty())
            <div class="d-flex gap-3 flex-wrap">
                @foreach ($points_of_interest->images as $image)
                    <div class="card" style="max-width: 18rem;">
                        <img src="{{ $image->path }}" class="card-img-top" alt="Immagine di {{ $poi->name }}">
                    </div>
                @endforeach
            @else
                <p class="text-muted">Nessuna immagine disponibile.</p>
        @endif
    </div>
    <div class="d-flex flex-column bg-light px-3">
        <p>Descrizione del punto di interesse:</p>
        <p> {{ $poi->description }}</p>

    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                @if ($poi->address)
                    <th>Indirizzo</th>
                @endif
                @if ($poi->phone_number)
                    <th>Numero telefonico</th>
                @endif
                @if ($poi->email)
                    <th>Indirizzo E-Mail</th>
                @endif
                @if ($poi->external_link)
                    <th>Sito web/pagina social</th>
                @endif
            </tr>
        </thead>
        <tbody>
            <tr>
                @if ($poi->address)
                    <td>{{ $poi->address }}</td>
                @endif
                @if ($poi->phone_number)
                    <td>{{ $poi->phone_number }}</td>
                @endif
                @if ($poi->email)
                    <td>{{ $poi->email }}</td>
                @endif
                @if ($poi->external_link)
                    <td>{{ $poi->external_link }}</td>
                @endif
            </tr>
        </tbody>
    </table>

    <iframe width="600" height="450" style="border:0" loading="lazy" allowfullscreen
        referrerpolicy="no-referrer-when-downgrade"
        src="https://www.google.com/maps?q={{ $poi->latitude }},{{ $poi->longitude }}&hl=it&z=14&output=embed">
    </iframe>


    </div>
@endsection
