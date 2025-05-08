<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Accident Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f5f5f5;
        }
        .report-id {
            font-size: 16px;
            font-weight: bold;
            color: #444;
        }
        .date {
            font-size: 11px;
            color: #666;
        }
        h1 {
            font-size: 18px;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        h2 {
            font-size: 14px;
            background-color: #eaeaea;
            padding: 5px 10px;
            margin-top: 20px;
            margin-bottom: 10px;
            border-left: 4px solid #1a73e8;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: left;
            padding: 8px;
        }
        td {
            padding: 8px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            font-size: 10px;
            color: #777;
        }
        .photo-gallery {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -5px;
        }
        .photo-item {
            width: 170px;
            margin: 5px;
            border: 1px solid #ddd;
        }
        .photo-item img {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="report-id">{{ $reportId }}</div>
        <div class="date">Generated on: {{ $date }}</div>
    </div>
    
    <h1>ACCIDENT REPORT</h1>
    
    <h2>1. GENERAL INFORMATION</h2>
    <table>
        <tr>
            <th width="30%">Date of Accident</th>
            <td>{{ $accident->accident_date->format('Y-m-d') }}</td>
        </tr>
        <tr>
            <th>Time of Accident</th>
            <td>{{ $accident->accident_time }}</td>
        </tr>
        <tr>
            <th>Location</th>
            <td>
                @if ($signalement->point)
                    Latitude: {{ $signalement->point->x }}, Longitude: {{ $signalement->point->y }}
                @else
                    Not specified
                @endif
            </td>
        </tr>
        <tr>
            <th>Road Type</th>
            <td>{{ $accident->road_type }}</td>
        </tr>
        <tr>
            <th>Road Condition</th>
            <td>{{ $accident->road_condition }}</td>
        </tr>
        <tr>
            <th>Weather Conditions</th>
            <td>{{ $accident->weather_condition }}</td>
        </tr>
        <tr>
            <th>Lighting</th>
            <td>{{ $accident->lighting }}</td>
        </tr>
    </table>
    
    <h2>2. VEHICLE INFORMATION</h2>
    <table>
        <tr>
            <th>Number of Vehicles Involved</th>
            <td>{{ $vehicles->count() }}</td>
        </tr>
    </table>
    
    @foreach ($vehicles as $index => $vehicle)
    <h3>Vehicle {{ $index + 1 }}</h3>
    <table>
        <tr>
            <th width="30%">Type</th>
            <td>{{ $vehicle->type }}</td>
        </tr>
        <tr>
            <th>Approximate Speed</th>
            <td>{{ $vehicle->approximate_speed }} km/h</td>
        </tr>
        <tr>
            <th>Direction of Travel</th>
            <td>{{ $vehicle->direction }}</td>
        </tr>
        <tr>
            <th>Position</th>
            <td>Latitude: {{ $vehicle->position_latitude }}, Longitude: {{ $vehicle->position_longitude }}</td>
        </tr>
        <tr>
            <th>Driver Condition</th>
            <td>{{ $vehicle->driver_condition }}</td>
        </tr>
    </table>
    @endforeach
    
    @if ($accident->victims && $accident->victims->count() > 0)
    <h2>3. VICTIM INFORMATION</h2>
    <table>
        <tr>
            <th>Total Number of Victims</th>
            <td>{{ $accident->victims->count() }}</td>
        </tr>
    </table>
    
    @foreach ($accident->victims as $index => $victim)
    <h3>Victim {{ $index + 1 }}</h3>
    <table>
        <tr>
            <th width="30%">Role</th>
            <td>{{ $victim->role }}</td>
        </tr>
        <tr>
            <th>Injury Type</th>
            <td>{{ $victim->injury_type }}</td>
        </tr>
        @if($victim->age)
        <tr>
            <th>Age</th>
            <td>{{ $victim->age }}</td>
        </tr>
        @endif
        @if($victim->gender)
        <tr>
            <th>Gender</th>
            <td>{{ $victim->gender }}</td>
        </tr>
        @endif
        @if($victim->additional_notes)
        <tr>
            <th>Additional Notes</th>
            <td>{{ $victim->additional_notes }}</td>
        </tr>
        @endif
    </table>
    @endforeach
    @endif
    
    @if ($accident->additional_notes)
    <h2>{{ $accident->victims && $accident->victims->count() > 0 ? '4' : '3' }}. ADDITIONAL NOTES</h2>
    <div style="padding: 10px; border: 1px solid #ddd; background-color: #fafafa; margin-bottom: 20px;">
        {{ $accident->additional_notes }}
    </div>
    @endif
    
    @if ($accident->photos)
    <h2>{{ $accident->victims && $accident->victims->count() > 0 ? '5' : '4' }}. ACCIDENT PHOTOS</h2>
    <div class="photo-gallery">
        @foreach ($accident->getPhotosArray() as $photo)
            <div class="photo-item">
                <img src="{{ public_path('storage/'.$photo) }}" alt="Accident Photo">
            </div>
        @endforeach
    </div>
    @endif
    
    <div class="footer">
        <p>This report is meant for official use and reference in MATLAB simulations. This document is confidential.</p>
        <p>Report ID: {{ $reportId }} | Generated: {{ $date }}</p>
    </div>
</body>
</html>