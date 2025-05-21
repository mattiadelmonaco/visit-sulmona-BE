@php

    $poi = $points_of_interest;

@endphp

@extends('layouts.master')

@section('title', 'Modifica attrazione o attività')

@section('page')
    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-white">
                <h2 class="mb-0 text-dark"><i class="fa-regular fa-pen-to-square"></i> Modifica l'attrazione o attività
                    "{{ $poi->name }}"
                </h2>
            </div>
            <div class="card-body">
                <form action="{{ route('points-of-interest.update', $poi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- informazioni base --}}
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Informazioni principali</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="name" class="form-label">Nome <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ $poi->name }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="type_id" class="form-label">Tipologia</label>
                                    <select name="type_id" id="type_id" class="form-select" required>
                                        <option value="">Seleziona una tipologia</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}"
                                                {{ $poi->type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Tags</label>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach ($tags as $tag)
                                            <div class="form-check">
                                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                                    class="form-check-input" id="tag-{{ $tag->id }}"
                                                    {{ $poi->tags->contains($tag->id) ? 'checked' : '' }}
                                                    style="cursor: pointer">
                                                <label class="form-check-label badge"
                                                    style="background-color: {{ $tag->color }}; cursor: pointer"
                                                    for="tag-{{ $tag->id }}">
                                                    {{ $tag->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- contatti e localizzazione --}}
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Contatti, localizzazione e periodo</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="phone_number" class="form-label">Telefono</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        <input type="tel" name="phone_number" id="phone_number" class="form-control"
                                            pattern="^\+?[0-9\s\-\(\)]*$" placeholder="es: +39 0864 123456"
                                            value="{{ $poi->phone_number ? $poi->phone_number : '' }}">
                                    </div>
                                    <div class="form-text">Prefisso internazionale non obbligatorio</div>
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" name="email" id="email" class="form-control"
                                            placeholder="esempio@dominio.it" value="{{ $poi->email ? $poi->email : '' }}">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="external_link" class="form-label">Sito web/Social</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                        <input type="url" name="external_link" class="form-control" id="external_link"
                                            placeholder="https://www.esempio.it"
                                            value="{{ $poi->external_link ? $poi->external_link : '' }}">
                                    </div>
                                    <div class="form-text">Inserire l'URL completo incluso http:// o https://</div>
                                </div>

                                <div class="col-12">
                                    <label for="address" class="form-label">Indirizzo</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                        <input type="text" name="address" id="address" class="form-control"
                                            placeholder="Via del codice, 1, Sulmona (AQ) 67039"
                                            value="{{ $poi->address ? $poi->address : '' }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Coordinate</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Lat</span>
                                        <input type="number" name="latitude" class="form-control" step="0.00000001"
                                            min="-90" max="90" placeholder="42.04795"
                                            value="{{ $poi->latitude ? $poi->latitude : '' }}">
                                        <span class="input-group-text">Long</span>
                                        <input type="number" name="longitude" class="form-control" step="0.00000001"
                                            min="-180" max="180" placeholder="13.92599"
                                            value="{{ $poi->longitude ? $poi->longitude : '' }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Periodo</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Dal</span>
                                        <input type="date" name="start_date" class="form-control"
                                            value="{{ $poi->start_date ? $poi->start_date : '' }}">
                                        <span class="input-group-text">Al</span>
                                        <input type="date" name="end_date" class="form-control"
                                            value="{{ $poi->end_date ? $poi->end_date : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- orari --}}
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Orari di apertura</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                @foreach ($daysOfWeek as $day)
                                    @php
                                        $dayPivot = $points_of_interest->daysOfWeek->firstWhere('id', $day->id)?->pivot;
                                    @endphp
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header py-2">
                                                <strong>{{ $day->name }}</strong>
                                            </div>
                                            <div class="card-body">
                                                <div class="row g-2">
                                                    <div class="col-md-6">
                                                        <label class="form-label small">Mattina</label>
                                                        <div class="input-group input-group-sm">
                                                            <span class="input-group-text">Da</span>
                                                            <input type="time" class="form-control"
                                                                name="hours[{{ $day->id }}][first_opening]"
                                                                value="{{ old('hours.' . $day->id . '.first_opening', $dayPivot?->first_opening) }}">
                                                            <span class="input-group-text">A</span>
                                                            <input type="time" class="form-control"
                                                                name="hours[{{ $day->id }}][first_closing]"
                                                                value="{{ old('hours.' . $day->id . '.first_closing', $dayPivot?->first_closing) }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label small">Pomeriggio</label>
                                                        <div class="input-group input-group-sm">
                                                            <span class="input-group-text">Da</span>
                                                            <input type="time" class="form-control"
                                                                name="hours[{{ $day->id }}][second_opening]"
                                                                value="{{ old('hours.' . $day->id . '.second_opening', $dayPivot?->second_opening) }}">
                                                            <span class="input-group-text">A</span>
                                                            <input type="time" class="form-control"
                                                                name="hours[{{ $day->id }}][second_closing]"
                                                                value="{{ old('hours.' . $day->id . '.second_closing', $dayPivot?->second_closing) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- descrizione e immagini --}}

                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Contenuti</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="description" class="form-label">Descrizione <span
                                        class="text-danger">*</span></label>
                                <textarea name="description" id="description" class="form-control" rows="5" required>{{ $poi->description ? $poi->description : '' }}</textarea>
                            </div>

                            <div class="mb-5">
                                <label class="form-label">Cambia immagine di copertina</label>

                                <input type="file" class="form-control mb-3" name="first_image" accept="image/*">
                                @if ($poi->first_image)
                                    <div>
                                        <h3>Immagine di copertina attuale</h3>
                                        <img src="{{ asset('storage/' . $poi->first_image) }}"
                                            class="card-img-top object-fit-cover" style="height: 200px"
                                            alt="Immagine di {{ $poi->name }}">
                                    </div>
                                @else
                                    <div class="alert alert-danger mb-0">
                                        <i class="fas fa-info-circle me-2"></i><small>Nessuna immagine presente</small>
                                    </div>
                                @endif



                            </div>

                            <div>
                                <label class="form-label">Aggiungi immagini varie</label>
                                <input type="file" class="form-control" name="images[]" multiple accept="image/*">
                                <div class="form-text">
                                    Per selezionare più immagini, tieni premuto CTRL mentre selezioni i file
                                </div>
                            </div>

                        </div>

                        {{-- immagini già caricate --}}
                        <div class="card mt-4">
                            <div class="card-header bg-light mt-4">
                                <h5 class="mb-0"><i class="fas fa-images me-2"></i>Immagini varie presenti</h5>
                            </div>


                            <div class="card-body">
                                @if ($poi->images->isNotEmpty())
                                    <div class="row g-4" id="images">

                                        @foreach ($poi->images as $image)
                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                                <div class="card h-100 shadow-sm">
                                                    <img src="{{ asset('storage/' . $image->path) }}"
                                                        class="card-img-top object-fit-cover" style="height: 200px"
                                                        alt="Immagine di {{ $poi->name }}">
                                                    <div class="d-flex justify-content-end">
                                                        <button type="button" class="btn btn-danger m-2"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-{{ $image->id }}">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="alert alert-info mb-0">
                                        <i class="fas fa-info-circle me-2"></i>Nessuna immagine presente
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-lg my-4">
                                <i class="fas fa-save me-2"></i>Salva modifiche
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modale per eliminazione immagine --}}
    @foreach ($poi->images as $image)
        <div class="modal fade" id="modal-{{ $image->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Conferma eliminazione
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Sei sicuro di voler eliminare questa immagine?
                        <div class="m-4 d-flex justify-content-center">
                            <img src="{{ asset('storage/' . $image->path) }}" alt="Immagine da eliminare"
                                class="rounded img-fluid">
                        </div>
                        <div class="alert alert-warning mt-2 mb-0">
                            Questa azione non può essere annullata.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Annulla
                        </button>
                        <form action="{{ route('images.destroy', $image->id) }}" method="POST">
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

@endsection
