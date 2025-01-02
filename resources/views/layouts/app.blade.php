<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

    <style>
        .navbar {
            background-color: #1a1a1a !important;
            padding: 0.5rem 1rem;
        }
        
        .navbar-brand {
            color: #fff !important;
            font-size: 1.2rem;
            padding: 0;
            margin-right: 3rem;
        }
        
        .nav-link {
            color: #fff !important;
            padding: 1rem 1.2rem !important;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            color: #007bff !important;
        }
        
        .nav-link.active {
            color: #007bff !important;
            font-weight: 500;
        }
        
        .btn-logout {
            background: transparent;
            border: 1px solid #dc3545;
            color: #dc3545 !important;
            padding: 0.4rem 1rem;
            border-radius: 4px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        
        .btn-logout:hover {
            background: #dc3545;
            color: #fff !important;
        }

        .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.1);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%28155, 155, 155, 0.5%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }

        @media (max-width: 991.98px) {
            .nav-link {
                padding: 0.8rem 0 !important;
            }
            
            .btn-logout {
                margin-top: 1rem;
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('Home') }}">
                <i class="fas fa-water"></i> Aero Galon
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item {{ Request::is('transactions*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('transactions.index') }}">
                            <i class="fas fa-exchange-alt"></i> Transactions
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('customers*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('customers.index') }}">
                            <i class="fas fa-users"></i> Customers
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('penggajian*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('penggajian.index') }}">
                            <i class="fas fa-money-bill-wave"></i> Salary
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('datapegawai*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('datapegawai.index') }}">
                            <i class="fas fa-user-tie"></i> Employee
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('absensi*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('absensi.index') }}">
                            <i class="fas fa-clipboard-list"></i> Absensi
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('edit-harga-galon*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('edit-harga-galon.index') }}">
                            <i class="fas fa-money-bill-wave"></i> Harga Galon
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-logout">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>
