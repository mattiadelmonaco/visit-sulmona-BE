@extends('layouts.master')

@section('title', 'Aggiungi un punto di interesse')

@section('page')

    <h1>Aggiungi un punto di interesse</h1>

    <p class="text-danger">*campi obbligatori</p>

    <form class="form-control d-flex flex-column gap-3 py-3" action="{{ route('points-of-interest.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf

        <div class="d-flex flex-column gap-1">
            <label for="name" class="text-danger">Nome punto di interesse*: </label>
            <input type="text" name="name" id="name" class="rounded-1 border-1 px-2 py-1">
        </div>

        <div class="d-flex flex-row align-items-center gap-1">
            <label for="type_id">Tipologia del punto di interesse: </label>
            <select name="type_id" id="type_id" required>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="d-flex flex-row align-items-center gap-2 flex-wrap">
            <p class="m-0">Tags: </p>
            @foreach ($tags as $tag)
                <div class="border rounded px-2 py-1">
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag-{{ $tag->id }}">
                    <label for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
                </div>
            @endforeach
        </div>

        <div class="d-flex flex-column gap-1">
            <label for="address">Indirizzo: </label>
            <input type="text" name="address" id="address" class="rounded-1 border-1 px-2 py-1">
        </div>

        <div class="d-flex flex-column gap-1">
            <label for="phone_number">Numero telefonico: </label>
            <input type="tel" name="phone_number" id="phone_number" class="rounded-1 border-1 px-2 py-1"
                pattern="^\+?[0-9\s\-\(\)]*$">
        </div>

        <div class="d-flex flex-column gap-1">
            <label for="email">E-Mail: </label>
            <input type="email" name="email" id="email" class="rounded-1 border-1 px-2 py-1">
        </div>

        <div class="d-flex flex-column gap-1">
            <label for="external_link">Sito web o pagina social: </label>
            <input type="url" name="external_link" id="external_link" class="rounded-1 border-1 px-2 py-1">
        </div>

        <div class="d-flex flex-column gap-1">
            <label for="latitude">Latitudine: </label>
            <input type="number" id="latitude" name="latitude" step="0.00000001" min="-90" max="90"
                class="rounded-1 border-1 px-2 py-1">
        </div>

        <div class="d-flex flex-column gap-1">
            <label for="longitude">Longitudine: </label>
            <input type="number" id="longitude" name="longitude" step="0.00000001" min="-180" max="180"
                class="rounded-1 border-1 px-2 py-1">
        </div>

        <div class="d-flex align-items-center gap-4">
            <div>
                <label for="start_date">Data inizio: </label>
                <input type="date" id="start_date" name="start_date" class="rounded-1 border-1 px-2 py-1">
            </div>
            <div>
                <label for="end_date">Data fine: </label>
                <input type="date" id="end_date" name="end_date" class="rounded-1 border-1 px-2 py-1">
            </div>
        </div>

        <div class="d-flex flex-column gap-1">
            <label for="description" class="text-danger">Descrizione:* </label>
            <textarea name="description" id="description" rows="5" class="rounded-1 border-1 px-2 py-1"></textarea>
        </div>

        <div>
            <h4>Orari di apertura</h4>
            @foreach ($daysOfWeek as $day)
                <div class="border rounded p-2 mb-2">
                    <strong>{{ $day->name }}</strong>
                    <div class="row">
                        <div class="col">
                            <label>Mattina da</label>
                            <input type="time" class="form-control" name="hours[{{ $day->id }}][first_opening]">
                        </div>
                        <div class="col">
                            <label>Mattina a</label>
                            <input type="time" class="form-control" name="hours[{{ $day->id }}][first_closing]">
                        </div>
                        <div class="col">
                            <label>Pomeriggio da</label>
                            <input type="time" class="form-control" name="hours[{{ $day->id }}][second_opening]">
                        </div>
                        <div class="col">
                            <label>Pomeriggio a</label>
                            <input type="time" class="form-control"
                                name="hours[{{ $day->id }}][second_closing]">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label class="form-label">Aggiungi immagini</label>
            <input type="file" class="form-control" name="images[]" multiple>
        </div>

        <div class="d-flex justify-content-center my-2">
            <input type="submit" class="btn btn-success fs-4" value="Aggiungi">
        </div>

    </form>

@endsection
