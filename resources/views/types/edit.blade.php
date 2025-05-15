{{-- @dd($type) --}}

@extends('layouts.master')

@section('title', 'Modifica tipologia punto di interesse')

@section('page')

    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-white">
                <h2 class="mb-0 text-dark"><i class="fas fa-plus-circle me-2"></i>Modifica tipologia punto di interesse</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('types.update', $type->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome tipologia <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $type->name }}"
                            required>
                    </div>

                    <div class="d-flex justify-content-end gap-2 flex-wrap">
                        <a href="{{ route('types.index') }}" class="btn btn-secondary mb-2">
                            <i class="fas fa-arrow-left me-2"></i>Indietro
                        </a>
                        <button type="submit" class="btn btn-primary mb-2">
                            <i class="fas fa-save me-2"></i>Salva
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
