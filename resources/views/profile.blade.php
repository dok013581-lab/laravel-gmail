<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TaskManager - Tài khoản của tôi</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="{{ asset('js/dark-mode.js') }}"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;

            width: 250px;
            height: 100vh;

            background: white;
            border-right: 1px solid #e5e7eb;

            padding: 25px 18px;

            display: flex;
            flex-direction: column;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;

            padding: 0 10px;
            margin-bottom: 40px;
        }

        .brand-icon {
            width: 42px;
            height: 42px;

            background: #2563eb;
            color: white;

            border-radius: 11px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 18px;
        }

        .brand-name {
            font-size: 21px;
            font-weight: bold;
        }

        .brand-name span {
            color: #2563eb;
        }

        .menu-title {
            font-size: 12px;
            color: #9ca3af;

            text-transform: uppercase;

            padding: 0 12px;
            margin-bottom: 10px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 13px;

            padding: 12px 14px;

            border-radius: 9px;

            color: #6b7280;

            text-decoration: none;

            font-size: 14px;

            transition: all 0.2s ease;
        }

        .menu a:hover {
            background: #f0f5ff;
            color: #2563eb;
        }

        .menu a.active {
            background: #2563eb;
            color: white;
            font-weight: bold;
        }

        .menu a i {
            width: 18px;
            text-align: center;
        }

        .sidebar-bottom {
            margin-top: auto;
        }

        .logout {
            display: flex;
            align-items: center;
            gap: 13px;

            padding: 12px 14px;

            border-radius: 9px;

            color: #ef4444;

            text-decoration: none;

            font-size: 14px;

            transition: all 0.2s ease;
        }

        .logout:hover {
            background: #fff1f2;
        }

        /* MAIN */
        .main {
            margin-left: 250px;

            min-height: 100vh;

            padding: 40px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 30px;
        }

        .page-header h1 {
            margin: 0 0 6px;
            font-size: 26px;
        }

        .page-header p {
            margin: 0;
            color: #6b7280;
            font-size: 14px;
        }

        .profile-widget {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .profile-widget-info {
            text-align: right;
        }

        .profile-widget-info strong {
            display: block;
            font-size: 14px;
        }

        .profile-widget-info span {
            color: #9ca3af;
            font-size: 12px;
        }

        .topbar-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #2563eb;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 15px;
        }
        .topbar-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            display: block;
        }

        /* NOTIFICATION CENTER */
        .notif-container {
            position: relative;
            display: inline-block;
        }

        .notif-bell-btn {
            position: relative;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            color: #4b5563;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.2s ease;
            outline: none;
        }

        .notif-bell-btn:hover {
            background: #f0f5ff;
            color: #2563eb;
            border-color: #bfdbfe;
        }

        .notif-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: #ef4444;
            color: #ffffff;
            font-size: 11px;
            font-weight: 800;
            padding: 2px 6px;
            border-radius: 10px;
            min-width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 6px rgba(239, 68, 68, 0.35);
            border: 2px solid #ffffff;
        }

        .notif-dropdown {
            position: absolute;
            top: 52px;
            right: 0;
            width: 340px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(15, 23, 42, 0.15);
            border: 1px solid #e2e8f0;
            z-index: 9999;
            display: none;
            overflow: hidden;
            animation: slideDownNotif 0.25s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .notif-dropdown.show {
            display: block;
        }

        @keyframes slideDownNotif {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .notif-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 18px;
            border-bottom: 1px solid #f1f5f9;
            background: #f8fafc;
        }

        .notif-header h3 {
            margin: 0;
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .notif-header .notif-count-pill {
            background: #eff6ff;
            color: #2563eb;
            font-size: 12px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 12px;
        }

        .notif-list {
            max-height: 320px;
            overflow-y: auto;
        }

        .notif-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 18px;
            border-bottom: 1px solid #f1f5f9;
            text-decoration: none;
            color: #334155;
            transition: background 0.15s ease;
        }

        .notif-item:last-child {
            border-bottom: none;
        }

        .notif-item:hover {
            background: #f8fafc;
        }

        .notif-icon-circle {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .notif-item.overdue .notif-icon-circle {
            background: #fef2f2;
            color: #ef4444;
        }

        .notif-item.upcoming .notif-icon-circle {
            background: #fff7ed;
            color: #ea580c;
        }

        .notif-info {
            flex: 1;
        }

        .notif-title {
            font-size: 13px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 3px;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .notif-subtext {
            font-size: 12px;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .notif-item.overdue .notif-subtext {
            color: #dc2626;
            font-weight: 600;
        }

        .notif-item.upcoming .notif-subtext {
            color: #d97706;
            font-weight: 600;
        }

        .notif-empty {
            padding: 35px 20px;
            text-align: center;
            color: #94a3b8;
        }

        .notif-empty i {
            font-size: 36px;
            color: #cbd5e1;
            margin-bottom: 8px;
        }

        .notif-empty p {
            margin: 0;
            font-size: 13px;
        }

        .notif-footer {
            padding: 12px;
            text-align: center;
            background: #f8fafc;
            border-top: 1px solid #f1f5f9;
        }

        .notif-footer a {
            font-size: 13px;
            font-weight: 700;
            color: #2563eb;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .notif-footer a:hover {
            text-decoration: underline;
        }

        /* PROFILE CARD */
        .profile-card {
            max-width: 800px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 36px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.03);
        }

        .profile-header {
            display: flex;
            flex-direction: row-reverse;
            align-items: center;
            gap: 24px;
            padding-bottom: 28px;
            border-bottom: 1px solid #f3f4f6;
            margin-bottom: 28px;
        }

        .big-avatar {
            width: 84px;
            height: 84px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: bold;
            box-shadow: 0 6px 18px rgba(37,99,235,0.25);
            flex-shrink: 0;
        }
        .big-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            display: block;
        }
        .choose-file-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 9px 14px;
    border-radius: 8px;
    background: #f3f4f6;
    color: #374151;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
}

.choose-file-btn:hover {
    background: #e5e7eb;
}
        .profile-user-info h2 {
            margin: 0 0 6px;
            font-size: 24px;
            color: #111827;
        }

        .profile-user-info p {
            margin: 0 0 8px;
            color: #6b7280;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .auth-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 20px;
            background: #eff6ff;
            color: #2563eb;
            font-size: 12px;
            font-weight: 600;
        }

        /* INFO GRID */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        .info-card {
            background: #f8fafc;
            border: 1px solid #f1f5f9;
            border-radius: 12px;
            padding: 20px;
            transition: all 0.2s ease;
        }

        .info-card:hover {
            background: #ffffff;
            border-color: #cbd5e1;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        }

        .info-card-label {
            font-size: 12px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .info-card-label i {
            color: #2563eb;
        }

        .info-card-value {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
        }

        /* BUTTONS */
        .action-buttons {
            display: flex;
            align-items: center;
            gap: 14px;
            padding-top: 24px;
            border-top: 1px solid #f3f4f6;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            padding: 12px 22px;

            border-radius: 9px;
            border: none;

            text-decoration: none;

            font-size: 14px;
            font-weight: bold;

            cursor: pointer;

            transition: all 0.2s ease;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37,99,235,0.2);
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
            color: #111827;
        }

        .btn-danger {
            background: #fff1f2;
            color: #ef4444;
            border: 1px solid #fecdd3;
        }

        .btn-danger:hover {
            background: #ffe4e6;
            color: #dc2626;
        }

        @media (max-width: 700px) {
            .sidebar {
                width: 70px;
                padding: 20px 10px;
            }

            .brand-name,
            .menu-title,
            .menu span,
            .logout span {
                display: none;
            }

            .brand {
                justify-content: center;
                padding: 0;
            }

            .menu a,
            .logout {
                justify-content: center;
            }

            .main {
                margin-left: 70px;
                padding: 25px 20px;
            }

            .profile-widget-info {
                display: none;
            }

            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/dark-mode.css') }}">
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="brand">
            <div class="brand-icon">
                <i class="fa-solid fa-check"></i>
            </div>
            <div class="brand-name">
                Task<span>Manager</span>
            </div>
        </div>

        <div class="menu-title">
            Menu
        </div>

        <nav class="menu">
            <a href="/dashboard">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>

            <a href="/tasks">
                <i class="fa-solid fa-list-check"></i>
                <span>Công việc</span>
            </a>

            <a href="/profile" class="active">
                <i class="fa-solid fa-user"></i>
                <span>Tài khoản</span>
            </a>
        </nav>

        <div class="sidebar-bottom">
            <a href="/logout" class="logout">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Đăng xuất</span>
            </a>
        </div>

    </aside>

    <!-- MAIN -->
    <main class="main">

        <!-- TOPBAR -->
        <div class="topbar">

            <div class="page-header">
                <h1>
                    Tài khoản của tôi
                </h1>
                <p>
                    Quản lý thông tin tài khoản cá nhân và số liệu công việc.
                </p>
            </div>

            <div class="topbar-actions" style="display: flex; align-items: center; gap: 16px;">
                <button type="button" class="dark-mode-toggle" id="darkModeToggle">
                    <i class="fa-solid fa-moon"></i>
                    <span class="toggle-text">Giao diện tối</span>
                </button>

                <!-- NOTIFICATION CENTER -->
                <div class="notif-container">
                    <button type="button" class="notif-bell-btn" id="notifBellBtn" onclick="toggleNotifDropdown(event)" title="Thông báo công việc">
                        <i class="fa-regular fa-bell"></i>
                        @if(($notifCount ?? 0) > 0)
                            <span class="notif-badge">{{ $notifCount }}</span>
                        @endif
                    </button>

                    <div class="notif-dropdown" id="notifDropdown">
                        <div class="notif-header">
                            <h3>
                                <i class="fa-solid fa-bell" style="color: #2563eb;"></i>
                                Thông báo
                            </h3>
                            <span class="notif-count-pill">{{ $notifCount ?? 0 }} mới</span>
                        </div>

                        <div class="notif-list">
                            @if(($notifCount ?? 0) == 0)
                                <div class="notif-empty">
                                    <i class="fa-regular fa-circle-check"></i>
                                    <p>Không có thông báo mới nào!</p>
                                </div>
                            @else
                                @if(isset($notifOverdue) && count($notifOverdue) > 0)
                                    @foreach($notifOverdue as $task)
                                        <a href="/tasks?deadline=overdue" class="notif-item overdue">
                                            <div class="notif-icon-circle">
                                                <i class="fa-solid fa-triangle-exclamation"></i>
                                            </div>
                                            <div class="notif-info">
                                                <div class="notif-title">{{ $task->title }}</div>
                                                <div class="notif-subtext">
                                                    <i class="fa-solid fa-circle" style="font-size: 6px;"></i>
                                                    Quá hạn: {{ \Carbon\Carbon::parse($task->deadline)->format('d/m/Y') }}
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @endif

                                @if(isset($notifUpcoming) && count($notifUpcoming) > 0)
                                    @foreach($notifUpcoming as $task)
                                        <a href="/tasks?deadline=upcoming" class="notif-item upcoming">
                                            <div class="notif-icon-circle">
                                                <i class="fa-regular fa-clock"></i>
                                            </div>
                                            <div class="notif-info">
                                                <div class="notif-title">{{ $task->title }}</div>
                                                <div class="notif-subtext">
                                                    <i class="fa-solid fa-circle" style="font-size: 6px;"></i>
                                                    Sắp đến hạn: {{ \Carbon\Carbon::parse($task->deadline)->format('d/m/Y') }}
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @endif
                            @endif
                        </div>

                        <div class="notif-footer">
                            <a href="/tasks">
                                Xem tất cả công việc
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="profile-widget">
                    <div class="profile-widget-info">
                        <strong>
                            {{ Auth::user()->name }}
                        </strong>
                        <span>
                            {{ Auth::user()->email }}
                        </span>
                    </div>

                    <div class="topbar-avatar">
                        @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar">
                        @else
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <!-- PROFILE CARD -->
        <div class="profile-card">

            <div class="profile-header">
                <div class="big-avatar">
                @if(Auth::user()->avatar)
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar">
                @else
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                @endif
            </div>
            <form action="{{ url('/profile/avatar') }}" method="POST" enctype="multipart/form-data" style="margin-top: 15px; transform: translateX(0px);">
             @csrf

    <label for="avatarInput" class="choose-file-btn">
        Cập nhật ảnh đại diện
    </label>

    <input
        type="file"
        id="avatarInput"
        name="avatar"
        accept=".jpg,.jpeg,.png,.webp"
        required
        onchange="this.form.submit()"
        style="display: none;"
    >
            </form>

                <div class="profile-user-info" style="transform: translateX(-210px);">
    <h2>{{ Auth::user()->name }}</h2>
                    <p>
                        <i class="fa-regular fa-envelope"></i>
                        {{ Auth::user()->email }}
                    </p>
                    <span class="auth-badge">
                        <i class="fa-solid fa-shield-halved"></i>
                        Đã xác thực tài khoản Google
                    </span>
                </div>
            </div>

            <!-- INFO GRID -->
            <div class="info-grid">

                <div class="info-card">
                    <div class="info-card-label">
                        <i class="fa-regular fa-user"></i>
                        Họ và tên
                    </div>
                    <div class="info-card-value">
                        {{ Auth::user()->name }}
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-card-label">
                        <i class="fa-regular fa-envelope"></i>
                        Địa chỉ Email
                    </div>
                    <div class="info-card-value" style="font-size: 16px; word-break: break-all;">
                        {{ Auth::user()->email }}
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-card-label">
                        <i class="fa-regular fa-calendar-check"></i>
                        Ngày tham gia
                    </div>
                    <div class="info-card-value">
                        {{ Auth::user()->created_at ? Auth::user()->created_at->format('d/m/Y H:i') : 'N/A' }}
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-card-label">
                        <i class="fa-solid fa-list-check"></i>
                        Tổng số công việc
                    </div>
                    <div class="info-card-value" style="color: #2563eb;">
                        {{ $totalTasks }} công việc
                    </div>
                </div>

                <div class="info-card" style="grid-column: span 2;">
                    <div class="info-card-label">
                        <i class="fa-solid fa-circle-check"></i>
                        Công việc đã hoàn thành
                    </div>
                    <div class="info-card-value" style="color: #059669;">
                        {{ $completedTasks }} / {{ $totalTasks }} công việc
                    </div>
                </div>

            </div>

            <!-- ACTIONS -->
            <div class="action-buttons">
                <a href="/tasks" class="btn btn-primary">
                    <i class="fa-solid fa-list-check"></i>
                    Quản lý công việc
                </a>

                <a href="/dashboard" class="btn btn-secondary">
                    <i class="fa-solid fa-house"></i>
                    Trang tổng quan
                </a>

                <a href="/logout" class="btn btn-danger">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Đăng xuất
                </a>
            </div>

        </div>

    </main>

    <script>
        function toggleNotifDropdown(e) {
            e.stopPropagation();
            const dropdown = document.getElementById('notifDropdown');
            if (dropdown) {
                dropdown.classList.toggle('show');
            }
        }

        document.addEventListener('click', function (e) {
            const container = document.querySelector('.notif-container');
            const dropdown = document.getElementById('notifDropdown');
            if (dropdown && container && !container.contains(e.target)) {
                dropdown.classList.remove('show');
            }
        });
    </script>

</body>
</html>
