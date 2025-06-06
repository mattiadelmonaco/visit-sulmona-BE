@extends('layouts.master')

@section('title', 'Aggiungi un tag')

@section('page')

    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-header ms-background text-white">
                <h2 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Nuovo tag</h2>
            </div>
            <div class="card-body">
                <p class="text-danger fw-bold">* campo obbligatorio</p>
                <form action="{{ route('tags.store') }}" method="POST">
                    @csrf

                    <div class="d-flex flex-column gap-3">
                        <div class="mb-3" style="max-width: 280px">
                            <label for="name" class="form-label">Nome tag <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" style="height: 38px"
                                required>
                        </div>

                        <div class="mb-3" style="max-width: 200px">
                            <label for="color" class="form-label">Colore da associare al tag <span
                                    class="text-danger">*</span></label>
                            <input type="color" name="color" id="color" class="form-control" style="height: 38px"
                                required>
                        </div>
                    </div>


                    <div class="d-flex justify-content-end gap-2 flex-wrap">
                        <a href="{{ route('tags.index') }}" class="btn btn-secondary mb-2">
                            <i class="fas fa-arrow-left me-2"></i>Indietro
                        </a>
                        <button type="submit" class="btn btn-success mb-2">
                            <i class="fas fa-save me-2"></i>Salva
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
