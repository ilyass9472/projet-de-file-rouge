<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rapport de dossier #{{ $signalement->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .reference {
            font-size: 18px;
            color: #666;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th {
            text-align: left;
            padding: 8px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            width: 30%;
        }
        td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
            font-size: 12px;
            color: #666;
        }
        .note {
            background-color: #f9f9f9;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
        }
        .note-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-size: 13px;
        }
        .note-author {
            font-weight: bold;
        }
        .note-date {
            color: #666;
        }
        .document-list {
            list-style-type: none;
            padding: 0;
        }
        .document-list li {
            padding: 5px 0;
            border-bottom: 1px dotted #eee;
        }
        .status {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 14px;
        }
        .status-open { background-color: #d1f7c4; }
        .status-in-progress { background-color: #c4e0f7; }
        .status-suspended { background-color: #f7f3c4; }
        .status-closed { background-color: #e9e9e9; }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">ACCIDENT REPORT</div>
        <div class="reference">
            Dossier: DOSSIER-{{ str_pad($signalement->dossier->id ?? '?', 5, '0', STR_PAD_LEFT) }} | 
            Signalement: #{{ $signalement->id }}
        </div>
    </div>

    <div class="section">
        <div class="section-title">Informations générales</div>
        <table>
            <tr>
                <th>Date de création</th>
                <td>{{ $signalement->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <th>Statut du dossier</th>
                <td>
                    @if(isset($signalement->dossier))
                        <span class="status status-{{ $signalement->dossier->status }}">
                            {{ $signalement->dossier->getStatusLabel() }}
                        </span>
                    @else
                        Non assigné
                    @endif
                </td>
            </tr>
            <tr>
                <th>Date d'ouverture</th>
                <td>{{ isset($signalement->dossier) ? $signalement->dossier->date_ouverture->format('d/m/Y') : '-' }}</td>
            </tr>
            <tr>
                <th>Date de clôture</th>
                <td>
                    {{ isset($signalement->dossier) && $signalement->dossier->date_cloture ? $signalement->dossier->date_cloture->format('d/m/Y') : '-' }}
                </td>
            </tr>
            <tr>
                <th>Avocat assigné</th>
                <td>
                    @if(isset($signalement->dossier) && isset($signalement->dossier->avocat))
                        {{ $signalement->dossier->avocat->name }}
                    @else
                        Non assigné
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Détails de l'accident</div>
        @if($signalement->accident)
            <table>
                <tr>
                    <th>Type d'accident</th>
                    <td>{{ $signalement->accident->type }}</td>
                </tr>
                <tr>
                    <th>Date de l'accident</th>
                    <td>{{ $signalement->accident->accident_date->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <th>Heure</th>
                    <td>{{ $signalement->accident->accident_time }}</td>
                </tr>
                <tr>
                    <th>Type de route</th>
                    <td>{{ $signalement->accident->road_type }}</td>
                </tr>
                <tr>
                    <th>Conditions météorologiques</th>
                    <td>{{ $signalement->accident->weather_condition }}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{ $signalement->description }}</td>
                </tr>
            </table>

            @if($signalement->localisation)
                <div class="section-title">Localisation</div>
                <table>
                    <tr>
                        <th>Adresse</th>
                        <td>{{ $signalement->localisation->adresse }}</td>
                    </tr>
                    <tr>
                        <th>Ville</th>
                        <td>{{ $signalement->localisation->ville }}</td>
                    </tr>
                    <tr>
                        <th>Coordonnées</th>
                        <td>{{ $signalement->localisation->latitude }}, {{ $signalement->localisation->longitude }}</td>
                    </tr>
                </table>
            @endif

            @if($signalement->accident->vehicles && count($signalement->accident->vehicles) > 0)
                <div class="section-title">Véhicules impliqués</div>
                @foreach($signalement->accident->vehicles as $index => $vehicle)
                    <p><strong>Véhicule {{ $index + 1 }}</strong></p>
                    <table>
                        <tr>
                            <th>Marque / Modèle</th>
                            <td>{{ $vehicle->brand }} {{ $vehicle->model }}</td>
                        </tr>
                        <tr>
                            <th>Plaque d'immatriculation</th>
                            <td>{{ $vehicle->license_plate }}</td>
                        </tr>
                        <tr>
                            <th>Dommages</th>
                            <td>{{ $vehicle->damage_description }}</td>
                        </tr>
                    </table>
                @endforeach
            @endif

            @if($signalement->accident->victims && count($signalement->accident->victims) > 0)
                <div class="section-title">Victimes</div>
                @foreach($signalement->accident->victims as $index => $victim)
                    <p><strong>Victime {{ $index + 1 }}</strong></p>
                    <table>
                        <tr>
                            <th>Rôle</th>
                            <td>{{ $victim->role }}</td>
                        </tr>
                        <tr>
                            <th>Type de blessure</th>
                            <td>{{ $victim->injury_type }}</td>
                        </tr>
                        <tr>
                            <th>Âge</th>
                            <td>{{ $victim->age }}</td>
                        </tr>
                        <tr>
                            <th>Genre</th>
                            <td>{{ $victim->gender }}</td>
                        </tr>
                    </table>
                @endforeach
            @endif
        @else
            <p>Aucune information d'accident disponible.</p>
        @endif
    </div>

    @if(isset($signalement->dossier))
        @if(isset($signalement->dossier->documents) && count($signalement->dossier->documents) > 0)
            <div class="section">
                <div class="section-title">Documents joints ({{ count($signalement->dossier->documents) }})</div>
                <ul class="document-list">
                    @foreach($signalement->dossier->documents as $document)
                        <li>
                            <strong>{{ $document->title }}</strong> - 
                            {{ strtoupper($document->type) }} - 
                            Ajouté le {{ $document->created_at->format('d/m/Y') }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(isset($signalement->dossier->notes) && count($signalement->dossier->notes) > 0)
            <div class="section">
                <div class="section-title">Notes du dossier ({{ count($signalement->dossier->notes) }})</div>
                @foreach($signalement->dossier->notes as $note)
                    <div class="note">
                        <div class="note-header">
                            <span class="note-author">{{ $note->user->name }}</span>
                            <span class="note-date">{{ $note->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="note-content">{{ $note->content }}</div>
                    </div>
                @endforeach
            </div>
        @endif

        @if(isset($signalement->dossier->historique) && !empty($signalement->dossier->historique))
            <div class="section">
                <div class="section-title">Historique du statut</div>
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Ancien statut</th>
                        <th>Nouveau statut</th>
                        <th>Utilisateur</th>
                    </tr>
                    @foreach($signalement->dossier->getHistoriqueArray() as $entry)
                        <tr>
                            <td>{{ date('d/m/Y H:i', strtotime($entry['date'])) }}</td>
                            <td>{{ isset($entry['old_status']) ? ucfirst($entry['old_status']) : '-' }}</td>
                            <td>{{ isset($entry['new_status']) ? ucfirst($entry['new_status']) : '-' }}</td>
                            <td>{{ isset($entry['user_name']) ? $entry['user_name'] : '-' }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endif
    @endif

    <div class="footer">
        <p>Rapport généré le {{ now()->format('d/m/Y à H:i') }} par {{ Auth::user()->name }}</p>
        <p>Ce document est confidentiel et destiné uniquement aux personnes autorisées.</p>
    </div>
</body>
</html>