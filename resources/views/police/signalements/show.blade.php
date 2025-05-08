@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Détails du signalement #{{ $signalement->id }}</h2>
            @if(auth()->user()->role === 'avocat' || auth()->user()->role === 'administrateur')
                <div>
                    <a href="{{ route('reports.pdf', $signalement->id) }}" target="_blank" class="btn btn-danger">
                        <i class="fas fa-file-pdf"></i> Exporter en PDF
                    </a>
                </div>
            @endif
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h3>Informations du signalement</h3>
                    <table class="table">
                        <tr>
                            <th>ID:</th>
                            <td>{{ $signalement->id }}</td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td>{{ $signalement->description }}</td>
                        </tr>
                        <tr>
                            <th>Date:</th>
                            <td>{{ $signalement->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Statut:</th>
                            <td>
                                <span class="badge bg-{{ 
                                    $signalement->statut == 'en_attente' ? 'warning' : 
                                    ($signalement->statut == 'en_cours' ? 'info' : 
                                    ($signalement->statut == 'traite' ? 'success' : 'danger')) 
                                }}">
                                    {{ $signalement->statut }}
                                </span>
                            </td>
                        </tr>
                    </table>

                    @if($signalement->localisation)
                    <h3>Localisation</h3>
                    <table class="table">
                        <tr>
                            <th>Adresse:</th>
                            <td>{{ $signalement->localisation->adresse }}</td>
                        </tr>
                        <tr>
                            <th>Ville:</th>
                            <td>{{ $signalement->localisation->ville }}</td>
                        </tr>
                    </table>
                    @endif
                    
                    @if($signalement->user)
                    <h3>Utilisateur</h3>
                    <table class="table">
                        <tr>
                            <th>Nom:</th>
                            <td>{{ $signalement->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $signalement->user->email }}</td>
                        </tr>
                    </table>
                    @endif
                </div>
                
                <div class="col-md-4">
                    <h3>Photos</h3>
                    @if($signalement->photos && $signalement->photos->count() > 0)
                        <div class="row">
                            @foreach($signalement->photos as $photo)
                            <div class="col-md-6 mb-3">
                                <img src="{{ asset('storage/' . $photo->path) }}" alt="Photo du signalement" class="img-fluid thumbnail">
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p>Aucune photo disponible</p>
                    @endif
                    
                    <div class="mt-4">
                        <h3>Actions</h3>
                        <div class="d-flex flex-column">
                            @if(auth()->user()->role === 'police')
                                <a href="{{ route('police.signalements.index') }}" class="btn btn-secondary mb-2">Retour à la liste</a>
                                
                                <form action="{{ route('police.signalements.update', $signalement->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group mb-3">
                                        <label for="statut">Changer le statut</label>
                                        <select name="statut" id="statut" class="form-control">
                                            <option value="en_attente" {{ $signalement->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                            <option value="en_cours" {{ $signalement->statut == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                            <option value="traite" {{ $signalement->statut == 'traite' ? 'selected' : '' }}>Traité</option>
                                            <option value="rejete" {{ $signalement->statut == 'rejete' ? 'selected' : '' }}>Rejeté</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Mettre à jour le statut</button>
                                </form>
                            @elseif(auth()->user()->role === 'avocat' || auth()->user()->role === 'administrateur')
                                <a href="{{ route('lawyer.cases.index') }}" class="btn btn-secondary mb-2">Retour à mes dossiers</a>
                                
                                @if(auth()->user()->role === 'avocat' && $signalement->dossier && $signalement->dossier->avocat_id === auth()->id() || auth()->user()->role === 'administrateur')
                                    <form action="{{ route('lawyer.cases.update-status', $signalement->id) }}" method="POST" class="mb-3">
                                        @csrf
                                        @method('PATCH')
                                        <div class="form-group mb-3">
                                            <label for="status">Changer le statut du dossier</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="open" {{ isset($signalement->dossier) && $signalement->dossier->status == 'open' ? 'selected' : '' }}>Ouvert</option>
                                                <option value="in_progress" {{ isset($signalement->dossier) && $signalement->dossier->status == 'in_progress' ? 'selected' : '' }}>En cours</option>
                                                <option value="suspended" {{ isset($signalement->dossier) && $signalement->dossier->status == 'suspended' ? 'selected' : '' }}>Suspendu</option>
                                                <option value="closed" {{ isset($signalement->dossier) && $signalement->dossier->status == 'closed' ? 'selected' : '' }}>Clôturé</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Mettre à jour le statut</button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            @if(auth()->user()->role === 'avocat' || auth()->user()->role === 'administrateur')
                <div class="row mt-4">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs" id="caseTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents" type="button" role="tab" aria-controls="documents" aria-selected="true">Documents Juridiques</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="notes-tab" data-bs-toggle="tab" data-bs-target="#notes" type="button" role="tab" aria-controls="notes" aria-selected="false">Notes</button>
                            </li>
                        </ul>
                        
                        <div class="tab-content p-3 border border-top-0 rounded-bottom" id="caseTabsContent">
                            <div class="tab-pane fade show active" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                                @if(auth()->user()->role === 'avocat' && $signalement->dossier && $signalement->dossier->avocat_id === auth()->id() || auth()->user()->role === 'administrateur')
                                    <form action="{{ route('lawyer.documents.upload', $signalement->id) }}" method="POST" enctype="multipart/form-data" class="mb-4">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="document" class="form-label">Ajouter un document</label>
                                            <input type="file" class="form-control" id="document" name="document" accept=".pdf,.doc,.docx,.txt">
                                            <div class="form-text">Formats acceptés: PDF, Word, Text</div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="document_title" class="form-label">Titre du document</label>
                                            <input type="text" class="form-control" id="document_title" name="document_title" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Télécharger</button>
                                    </form>
                                @endif
                                
                                <h4>Documents attachés</h4>
                                @if(isset($signalement->dossier) && $signalement->dossier->documents && $signalement->dossier->documents->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Titre</th>
                                                    <th>Type</th>
                                                    <th>Ajouté le</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($signalement->dossier->documents as $document)
                                                    <tr>
                                                        <td>{{ $document->title }}</td>
                                                        <td>{{ $document->type }}</td>
                                                        <td>{{ $document->created_at->format('d/m/Y H:i') }}</td>
                                                        <td>
                                                            <a href="{{ asset('storage/' . $document->path) }}" class="btn btn-sm btn-info" target="_blank">
                                                                <i class="fas fa-eye"></i> Voir
                                                            </a>
                                                            @if(auth()->user()->role === 'avocat' && $signalement->dossier->avocat_id === auth()->id() || auth()->user()->role === 'administrateur')
                                                                <form action="{{ route('lawyer.documents.delete', $document->id) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce document?')">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-muted">Aucun document disponible</p>
                                @endif
                            </div>
                            
                            <div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notes-tab">
                                @if(auth()->user()->role === 'avocat' && $signalement->dossier && $signalement->dossier->avocat_id === auth()->id() || auth()->user()->role === 'administrateur')
                                    <form action="{{ route('lawyer.notes.add', $signalement->id) }}" method="POST" class="mb-4">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="note_content" class="form-label">Ajouter une note</label>
                                            <textarea class="form-control" id="note_content" name="note_content" rows="3" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                    </form>
                                @endif
                                
                                <h4>Notes du dossier</h4>
                                @if(isset($signalement->dossier) && $signalement->dossier->notes && count($signalement->dossier->notes) > 0)
                                    <div class="list-group">
                                        @foreach($signalement->dossier->notes as $note)
                                            <div class="list-group-item">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">{{ $note->user->name }}</h5>
                                                    <small>{{ $note->created_at->format('d/m/Y H:i') }}</small>
                                                </div>
                                                <p class="mb-1">{{ $note->content }}</p>
                                                @if(auth()->user()->role === 'avocat' && $note->user_id === auth()->id() || auth()->user()->role === 'administrateur')
                                                    <div class="d-flex justify-content-end">
                                                        <form action="{{ route('lawyer.notes.delete', $note->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette note?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted">Aucune note disponible</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var triggerTabList = [].slice.call(document.querySelectorAll('#caseTabs a, #caseTabs button'))
        triggerTabList.forEach(function (triggerEl) {
            var tabTrigger = new bootstrap.Tab(triggerEl)
            triggerEl.addEventListener('click', function (event) {
                event.preventDefault()
                tabTrigger.show()
            })
        })
    });
</script>
@endpush
@endsection