@extends('layouts.master')

@section('title', 'Punti di interesse')

@section('page')

    <h1>Lista dei punti di interesse</h1>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Nome punto di interesse</th>
                <th>Immagine copertina</th>
                <th>Link esterno</th>
                <th>Contatto telefonico</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pointsOfInterest as $poi)
                <tr>
                    <td>{{ $poi->name }}</td>
                    <td>
                        @if ($poi->firstImage)
                            <img src="{{ $poi->firstImage->path }}" width="100" alt="Immagine di {{ $poi->name }}">
                        @else
                            Nessuna immagine
                        @endif
                    </td>
                    <td>{{ $poi->external_link }}</td>
                    <td>{{ $poi->phone_number }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
