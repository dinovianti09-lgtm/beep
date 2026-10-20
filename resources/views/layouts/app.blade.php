<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Akademik')</title>
    <!-- Font Google & Bootstrap Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #faf5ff; color: #1e1b4b; display: flex; min-height: 100vh; }
        
        /* SIDEBAR TEMA UNGU ELEGAN */
        .sidebar { width: 260px; background: #2e1065; color: #ddd6fe; display: flex; flex-direction: column; padding: 24px 16px; flex-shrink: 0; }
        .brand { display: flex; align-items: center; gap: 12px; color: #ffffff; font-weight: 700; font-size: 18px; margin-bottom: 32px; padding: 0 12px; }
        .brand-icon { width: 36px; height: 36px; background: #7c3aed; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; }
        
        .menu-list { list-style: none; display: flex; flex-direction: column; gap: 6px; }
        .menu-item a { display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 10px; color: #c4b5fd; text-decoration: none; font-size: 14px; font-weight: 500; transition: all 0.2s; }
        .menu-item a:hover { background: #4c1d95; color: #ffffff; }
        .menu-item.active a { background: #7c3aed; color: #ffffff; font-weight: 600; }
        .menu-item i { font-size: 18px; }

        .logout-btn { margin-top: auto; padding-top: 16px; border-top: 1px solid #4c1d95; }
        .logout-btn a { color: #fca5a5; display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 10px; text-decoration: none; font-size: 14px; font-weight: 500; }
        .logout-btn a:hover { background: rgba(239, 68, 68, 0.15); color: #f87171; }

        /* MAIN CONTENT */
        .main-content { flex: 1; padding: 32px 40px; overflow-y: auto; }
        
        /* HEADER */
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; }
        .header-title h1 { font-size: 26px; font-weight: 700; color: #2e1065; }
        .header-title p { font-size: 14px; color: #6b21a8; margin-top: 4px; }
        
        .user-profile { display: flex; align-items: center; gap: 12px; }
        .avatar { width: 42px; height: 42px; background: #7c3aed; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 16px; }
        .user-info { text-align: right; }
        .user-name { font-weight: 600; font-size: 14px; color: #2e1065; }
        .user-role { font-size: 12px; color: #6b21a8; }

        /* KARTU & TABEL UNIVERSAL */
        .section-card { background: #ffffff; border-radius: 16px; border: 1px solid #f3e8ff; padding: 24px; box-shadow: 0 2px 4px rgba(46, 16, 101, 0.03); }
        .action-bar { display: flex; justify-content: flex-end; margin-bottom: 24px; }
        .btn-action-primary { display: inline-flex; align-items: center; gap: 8px; background: #7c3aed; color: white; padding: 10px 20px; border-radius: 10px; text-decoration: none; font-size: 14px; font-weight: 600; transition: all 0.2s; box-shadow: 0 2px 4px rgba(124, 58, 237, 0.2); }
        .btn-action-primary:hover { background: #6d28d9; transform: translateY(-1px); }

        .table { width: 100%; border-collapse: collapse; text-align: left; }
        .table th { font-size: 12px; font-weight: 700; color: #6b21a8; text-transform: uppercase; padding: 14px 16px; border-bottom: 1px solid #f3e8ff; }
        .table td { padding: 16px; font-size: 14px; border-bottom: 1px solid #faf5ff; color: #1e1b4b; vertical-align: middle; }
        
        .badge { display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px; border-radius: 9999px; font-size: 12px; font-weight: 600; }
        .badge-class { background: #f3e8ff; color: #6b21a8; }

        .btn-icon { border: none; background: transparent; cursor: pointer; padding: 6px 8px; border-radius: 6px; font-size: 16px; transition: all 0.2s; }
        .btn-edit { color: #d97706; }
        .btn-edit:hover { background: #fef3c7; }
        .btn-delete { color: #dc2626; }
        .btn-delete:hover { background: #fee2e2; }

        /* DESAIN FORMULIR */
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 14px; font-weight: 600; color: #2e1065; margin-bottom: 8px; }
        .form-control { width: 100%; padding: 12px 16px; border: 1px solid #e9d5ff; border-radius: 10px; font-size: 14px; font-family: inherit; color: #1e1b4b; background: #fcfaff; transition: all 0.2s; }
        .form-control:focus { outline: none; border-color: #7c3aed; background: #ffffff; box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1); }
    </style>
</head>
<body>

    <!-- SIDEBAR UTAMA -->
    <aside class="sidebar">
        <div class="brand">
            <div class="brand-icon"><i class="bi bi-mortarboard-fill"></i></div>
            <span>Sistem Akademik</span>
        </div>

        <ul class="menu-list">
            <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}"><i class="bi bi-grid-1x2-fill"></i> Beranda</a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
                <a href="{{ route('admin.siswa.index') }}"><i class="bi bi-people-fill"></i> Data Siswa</a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.guru.*') ? 'active' : '' }}">
                <a href="{{ route('admin.guru.index') }}"><i class="bi bi-person-badge-fill"></i> Data Guru</a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.mapel.*') ? 'active' : '' }}">
                <a href="{{ route('admin.mapel.index') }}"><i class="bi bi-book-half"></i> Mata Pelajaran</a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}">
                <a href="{{ route('admin.kelas.index') }}"><i class="bi bi-door-open-fill"></i> Data Kelas</a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.rapor.*') ? 'active' : '' }}">
                <a href="{{ route('admin.rapor.index') }}"><i class="bi bi-file-earmark-text-fill"></i> Periode Rapor</a>
            </li>
            <li class="menu-item logout-btn">
                <form action="{{ route('logout') }}" method="POST" id="logout-form">@csrf</form>
                <a href="#" onclick="document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </a>
            </li>
        </ul>
    </aside>

    <!-- KONTEN UTAMA -->
    <main class="main-content">
        <header class="header">
            <div class="header-title">
                <h1>@yield('page_title')</h1>
                <p>@yield('page_description')</p>
            </div>
            <div class="user-profile">
                <div class="user-info">
                    <div class="user-name">Administrator</div>
                    <div class="user-role">Admin Utama</div>
                </div>
                <div class="avatar">A</div>
            </div>
        </header>

        <!-- Tempat isi konten tiap halaman -->
        @yield('content')
    </main>

</body>
</html>