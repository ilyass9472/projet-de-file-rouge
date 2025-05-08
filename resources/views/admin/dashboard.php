<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Admin Dashboard</title>
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --accent-color: #3498db;
            --background-color: #f5f7fa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        /* Add these animation keyframes to the existing CSS */
@keyframes slideIn {
    from {
        transform: translateX(-100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes scaleIn {
    from {
        transform: scale(0.8);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0px); }
}
@keyframes shake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
    20%, 40%, 60%, 80% { transform: translateX(5px); }
}


/* Update these existing styles with animations */
.sidebar {
    animation: slideIn 0.5s ease-out;
}

.card {
    animation: scaleIn 0.5s ease-out;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.menu li {
    position: relative;
    overflow: hidden;
}

.menu li::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: var(--accent-color);
    transition: width 0.3s ease;
}

.menu li:hover::after {
    width: 100%;
}

.menu li:hover i {
    transform: rotate(360deg);
}

.menu li i {
    transition: transform 0.5s ease;
}

/* Add loading animation */
.loading-bar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 3px;
    background: linear-gradient(to right, var(--accent-color), var(--primary-color));
    animation: loading 2s infinite;
}

@keyframes loading {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

/* Add notification badge animation */
.notification-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #e74c3c;
    color: white;
    border-radius: 50%;
    padding: 4px 8px;
    font-size: 12px;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.2); }
    100% { transform: scale(1); }
}

/* Add these new styles for enhanced animations */
.chart-container {
    animation: fadeIn 0.8s ease-out;
    transition: all 0.3s ease;
}

.chart-container:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.activity-table tr {
    animation: fadeIn 0.5s ease-out;
    transition: all 0.3s ease;
}

.activity-table tr:hover {
    background: #f8f9fa;
    transform: scale(1.01);
}

.status {
    position: relative;
    overflow: hidden;
}

.status::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: rgba(255,255,255,0.2);
    animation: shine 2s infinite;
}

@keyframes shine {
    to {
        left: 100%;
    }
}


        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background: var(--primary-color);
            color: white;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .sidebar .logo {
            display: flex;
            align-items: center;
            font-size: 24px;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--secondary-color);
        }

        .sidebar .logo i {
            margin-right: 10px;
        }

        .sidebar .menu {
            list-style: none;
        }

        .sidebar .menu li {
            padding: 15px 10px;
            margin-bottom: 5px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            border-radius: 5px;
        }

        .sidebar .menu li i {
            margin-right: 10px;
            width: 20px;
        }

        .sidebar .menu li:hover {
            background: var(--secondary-color);
        }

        .sidebar .menu li.active {
            background: var(--accent-color);
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            background: var(--background-color);
            overflow-y: auto;
        }

        .header {
            background: white;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Dashboard Grid */
        .dashboard {
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            margin-bottom: 10px;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card p {
            font-size: 24px;
            color: var(--secondary-color);
        }

        /* Charts Section */
        .charts-grid {
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 20px;
        }

        .chart-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* Table Styles */
        .recent-activity {
            margin: 20px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .activity-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .activity-table th,
        .activity-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .activity-table th {
            background: #f8f9fa;
            color: var(--primary-color);
        }

        .status {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
        }

        .status.completed { background: #e1f7e1; color: #2ecc71; }
        .status.pending { background: #fff3e0; color: #f39c12; }
        .status.cancelled { background: #ffe5e5; color: #e74c3c; }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }
            .sidebar .logo span,
            .sidebar .menu span {
                display: none;
            }
            .charts-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <i class="fas fa-shield-alt"></i>
                <span>AdminPro</span>
            </div>
            <ul class="menu">
                <li class="active"><i class="fas fa-home"></i> <span>Dashboard</span></li>
                <li><i class="fas fa-users"></i> <a href="{{ route('admin.users') }}">Users</a></li>
                <li><i class="fas fa-users"></i> <span>Users</span></li>
                <li><i class="fas fa-chart-bar"></i> <span>Analytics</span></li>
                <li><i class="fas fa-shopping-cart"></i> <span>Orders</span></li>
                <li><i class="fas fa-box"></i> <span>Products</span></li>
                <li><i class="fas fa-cog"></i> <span>Settings</span></li>
            </ul>
        </div>
        <div class="main-content">
            <div class="header">
                <h2>Dashboard Overview</h2>
                <div class="user-info">
                    <i class="fas fa-bell"></i>
                    <img src="https://via.placeholder.com/40" alt="Admin">
                    <span>John Doe</span>
                </div>
            </div>
            <div class="dashboard">
                <div class="card">
                    <h3><i class="fas fa-users"></i> Total Users</h3>
                    <p>1,234</p>
                </div>
                <div class="card">
                    <h3><i class="fas fa-dollar-sign"></i> Revenue</h3>
                    <p>$45,678</p>
                </div>
                <div class="card">
                    <h3><i class="fas fa-shopping-cart"></i> Orders</h3>
                    <p>892</p>
                </div>
                <div class="card">
                    <h3><i class="fas fa-box"></i> Products</h3>
                    <p>156</p>
                </div>
            </div>
            <div class="charts-grid">
                <div class="chart-container">
                    <h3>Sales Analytics</h3>
                    <canvas id="salesChart"></canvas>
                </div>
                <div class="chart-container">
                    <h3>User Growth</h3>
                    <canvas id="userChart"></canvas>
                </div>
            </div>
            <div class="recent-activity">
                <h3>Recent Activity</h3>
                <table class="activity-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#12345</td>
                            <td>John Smith</td>
                            <td>Product A</td>
                            <td>$99.99</td>
                            <td><span class="status completed">Completed</span></td>
                        </tr>
                        <tr>
                            <td>#12346</td>
                            <td>Jane Doe</td>
                            <td>Product B</td>
                            <td>$149.99</td>
                            <td><span class="status pending">Pending</span></td>
                        </tr>
                        <tr>
                            <td>#12347</td>
                            <td>Bob Johnson</td>
                            <td>Product C</td>
                            <td>$199.99</td>
                            <td><span class="status cancelled">Cancelled</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Initialize Charts
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const userCtx = document.getElementById('userChart').getContext('2d');

        // Sales Chart
        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Sales',
                    data: [12, 19, 3, 5, 2, 3],
                    borderColor: '#3498db',
                    tension: 0.4,
                    fill: true,
                    backgroundColor: 'rgba(52, 152, 219, 0.1)'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });

        // User Growth Chart
        new Chart(userCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'New Users',
                    data: [65, 59, 80, 81, 56, 55],
                    backgroundColor: '#2ecc71'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });

        // Add active class to menu items
        document.querySelectorAll('.menu li').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.menu li').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Simulate real-time updates
        function updateRandomCard() {
            const cards = document.querySelectorAll('.card p');
            const randomCard = cards[Math.floor(Math.random() * cards.length)];
            const currentValue = parseInt(randomCard.textContent.replace(/[^0-9]/g, ''));
            const newValue = currentValue + Math.floor(Math.random() * 10) - 5;
            randomCard.textContent = randomCard.textContent.includes('$') ? 
                `$${newValue.toLocaleString()}` : 
                newValue.toLocaleString();
        }

        setInterval(updateRandomCard, 3000);
    </script>
    <script>
        // Add this to your existing JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Animate cards sequentially
    const cards = document.querySelectorAll('.card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        setTimeout(() => {
            card.style.animation = `scaleIn 0.5s ease-out forwards`;
        }, index * 100);
    });

    // Animate chart containers
    const charts = document.querySelectorAll('.chart-container');
    charts.forEach((chart, index) => {
        chart.style.opacity = '0';
        setTimeout(() => {
            chart.style.animation = `fadeIn 0.5s ease-out forwards`;
        }, 500 + index * 200);
    });

    // Add hover effect for menu items
    const menuItems = document.querySelectorAll('.menu li');
    menuItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(10px)';
        });
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });

    // Add notification animation
    const notificationBell = document.querySelector('.fa-bell');
    notificationBell.innerHTML += '<span class="notification-badge">3</span>';
    notificationBell.addEventListener('click', function() {
        this.style.animation = 'shake 0.5s ease-in-out';
        setTimeout(() => {
            this.style.animation = '';
        }, 500);
    });

    // Add loading bar
    const loadingBar = document.createElement('div');
    loadingBar.className = 'loading-bar';
    document.body.appendChild(loadingBar);

    // Animate table rows sequentially
    const tableRows = document.querySelectorAll('.activity-table tbody tr');
    tableRows.forEach((row, index) => {
        row.style.opacity = '0';
        setTimeout(() => {
            row.style.animation = `fadeIn 0.5s ease-out forwards`;
        }, 1000 + index * 200);
    });
});
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
// Add smooth scrolling animation
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Add dynamic counter animation for cards
function animateValue(obj, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        obj.innerHTML = Math.floor(progress * (end - start) + start);
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

// Update card values with animation
function updateCardWithAnimation(card) {
    const currentValue = parseInt(card.textContent.replace(/[^0-9]/g, ''));
    const newValue = currentValue + Math.floor(Math.random() * 10) - 5;
    animateValue(card, currentValue, newValue, 1000);
}

// Replace the existing updateRandomCard function
function updateRandomCard() {
    const cards = document.querySelectorAll('.card p');
    const randomCard = cards[Math.floor(Math.random() * cards.length)];
    updateCardWithAnimation(randomCard);
}

    </script>
</body>
</html>
