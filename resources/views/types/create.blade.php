@extends('layouts.master')

@section('title', 'Aggiungi tipologia associabile')

@section('page')
    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-header ms-background text-white">
                <h2 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Nuova tipologia per attrazioni e attività</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('types.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome tipologia <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="d-flex justify-content-end gap-2 flex-wrap">
                        <a href="{{ route('types.index') }}" class="btn btn-secondary mb-2">
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
