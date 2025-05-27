@extends('layouts.master')

@section('title', 'Elenco tipologie associabili')

@section('page')
    <div class="container my-5">
        <div class="card shadow-sm">
            <div
                class="card-header ms-background text-white d-flex justify-content-between align-items-center flex-wrap gap-3">
                <h2 class="mb-0"><i class="fas fa-tags me-2"></i>Tipologie attrazioni e attività</h2>
                <a href="{{ route('types.create') }}" class="btn btn-light">
                    <i class="fas fa-plus me-2"></i>Nuova tipologia
                </a>
            </div>
            <div class="card-body">
                @if ($types->isEmpty())
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>Nessuna tipologia presente
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="w-100">Nome tipologia</th>
                                    <th scope="col" class="text-end">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($types as $type)
                                    <tr>
                                        <td class="fw-medium">{{ $type->name }}</td>
                                        <td class="d-flex gap-2">
                                            <a href="{{ route('types.edit', $type->id) }}"
                                                class="btn btn-sm btn-warning me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#modal-{{ $type->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    {{-- modale per eliminazione --}}
                                    <div class="modal fade" id="modal-{{ $type->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title">
                                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                                        Conferma eliminazione
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Sei sicuro di voler eliminare la tipologia
                                                    <strong>{{ $type->name }}</strong>?
                                                    <div class="alert alert-warning mt-2 mb-0">
                                                        Questa azione non può essere annullata.
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        <i class="fas fa-times me-2"></i>Annulla
                                                    </button>
                                                    <form action="{{ route('types.destroy', $type->id) }}" method="POST">
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
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
