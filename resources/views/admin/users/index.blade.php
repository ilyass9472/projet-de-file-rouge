<!-- resources/views/admin/users/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Gestion des utilisateurs')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Gestion des utilisateurs</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item active">Utilisateurs</li>
    </ol>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-users me-1"></i>
            Liste des utilisateurs
        </div>
        <div class="card-body">
            <table id="usersTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Statut</th>
                        <th>Date d'inscription</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($utilisateurs as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->nom }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge {{ $user->role === 'administrateur' ? 'bg-danger' : ($user->role === 'avocat' ? 'bg-warning' : 'bg-info') }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td>
                                <div class="form-check form-switch d-flex justify-content-center">
                                    <form action="{{ route('admin.users.toggle-active', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm {{ $user->est_actif ? 'btn-success' : 'btn-secondary' }}" 
                                                data-bs-toggle="tooltip" title="{{ $user->est_actif ? 'Actif - Cliquez pour désactiver' : 'Inactif - Cliquez pour activer' }}">
                                            {{ $user->est_actif ? 'Actif' : 'Inactif' }}
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-info me-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $utilisateurs->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
            paging: false,
            info: false,
            language: {
                search: "Rechercher:",
                zeroRecords: "Aucun utilisateur trouvé",
                infoEmpty: "Aucun utilisateur disponible",
            }
        });
        
        // Initialiser les tooltips Bootstrap
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endsection