@extends('layouts.master')

@section('title', 'Aggiungi un punto di interesse')

@section('page')
    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Nuovo punto di interesse</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('points-of-interest.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Informazioni base --}}
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Informazioni principali</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="name" class="form-label">Nome punto di interesse <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="types" class="form-label">Tipologia</label>
                                    <select name="type_id" id="types" class="form-select" required>
                                        <option value="">Seleziona una tipologia</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
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

                    {{-- Contatti e localizzazione --}}
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
                                            pattern="^\+?[0-9\s\-\(\)]*$" placeholder="es: +39 0864 123456">
                                    </div>
                                    <div class="form-text">Prefisso internazionale non obbligatorio</div>
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" name="email" id="email" class="form-control"
                                            placeholder="esempio@dominio.it">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="external_link" class="form-label">Sito web/Social</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                        <input type="url" name="external_link" class="form-control" id="external_link"
                                            placeholder="https://www.esempio.it">
                                    </div>
                                    <div class="form-text">Inserire l'URL completo incluso http:// o https://</div>
                                </div>

                                <div class="col-12">
                                    <label for="address" class="form-label">Indirizzo</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                        <input type="text" name="address" id="address" class="form-control"
                                            placeholder="Via del codice, 1, Sulmona (AQ) 67039">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Coordinate</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Lat</span>
                                        <input type="number" name="latitude" class="form-control" step="0.00000001"
                                            min="-90" max="90" placeholder="42.04795">
                                        <span class="input-group-text">Long</span>
                                        <input type="number" name="longitude" class="form-control" step="0.00000001"
                                            min="-180" max="180" placeholder="13.92599">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Periodo</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Dal</span>
                                        <input type="date" name="start_date" class="form-control">
                                        <span class="input-group-text">Al</span>
                                        <input type="date" name="end_date" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Orari --}}
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Orari di apertura</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                @foreach ($daysOfWeek as $day)
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
                                                                name="hours[{{ $day->id }}][first_opening]">
                                                            <span class="input-group-text">A</span>
                                                            <input type="time" class="form-control"
                                                                name="hours[{{ $day->id }}][first_closing]">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label small">Pomeriggio</label>
                                                        <div class="input-group input-group-sm">
                                                            <span class="input-group-text">Da</span>
                                                            <input type="time" class="form-control"
                                                                name="hours[{{ $day->id }}][second_opening]">
                                                            <span class="input-group-text">A</span>
                                                            <input type="time" class="form-control"
                                                                name="hours[{{ $day->id }}][second_closing]">
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
                                <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
                            </div>

                            <div>
                                <label class="form-label">Immagini</label>
                                <input type="file" class="form-control" name="images[]" multiple accept="image/*">
                                <div class="form-text">
                                    Per selezionare più immagini, tieni premuto CTRL mentre selezioni i file
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>Salva punto di interesse
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
