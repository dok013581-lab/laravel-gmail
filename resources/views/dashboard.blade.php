<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TaskManager - Dashboard</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="{{ asset('js/dark-mode.js') }}"></script>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

            background: #ffffff;
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

            margin-bottom: 35px;
        }

        .welcome h1 {
            margin: 0 0 6px;

            font-size: 26px;
        }

        .welcome p {
            margin: 0;

            color: #6b7280;

            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .quick-create-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding: 10px 18px;

            background: #2563eb;
            color: white;

            border-radius: 9px;

            text-decoration: none;

            font-size: 14px;
            font-weight: bold;

            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(37,99,235,0.2);
        }

        .quick-create-btn:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
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

        .profile-info {
            text-align: right;
        }

        .profile-info strong {
            display: block;
            font-size: 14px;
        }

        .profile-info span {
            color: #9ca3af;
            font-size: 12px;
        }

        /* STATISTICS */
        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 18px;
            color: #111827;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;

            border: 1px solid #e5e7eb;
            border-radius: 14px;

            padding: 22px;

            display: flex;
            justify-content: space-between;
            align-items: center;

            box-shadow: 0 3px 12px rgba(0,0,0,0.03);
            transition: all 0.25s ease;
            text-decoration: none;
            color: inherit;
            cursor: pointer;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(37,99,235,0.12);
            border-color: #bfdbfe;
        }

        .stat-info p {
            margin: 0 0 8px;
            color: #6b7280;
            font-size: 13px;
        }

        .stat-info h2 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eff6ff;
            color: #2563eb;
            font-size: 18px;
        }

        .stat-icon.icon-overdue {
            background: #fef2f2;
            color: #ef4444;
        }

        .stat-icon.icon-upcoming {
            background: #fff7ed;
            color: #f59e0b;
        }

        .stat-icon.icon-pending {
            background: #fff7ed;
            color: #ea580c;
        }

        .stat-icon.icon-doing {
            background: #eff6ff;
            color: #2563eb;
        }

        .stat-icon.icon-completed {
            background: #ecfdf5;
            color: #059669;
        }

        /* DASHBOARD WIDGET TABS */
        .widget-tabs-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .dashboard-tab-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background: #f8fafc;
            color: #4b5563;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .dashboard-tab-btn:hover {
            background: #f0f5ff;
            color: #2563eb;
            border-color: #bfdbfe;
        }

        .dashboard-tab-btn.active {
            background: #2563eb;
            color: #ffffff;
            border-color: #2563eb;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.25);
        }

        .tab-count-pill {
            font-size: 11px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 10px;
            background: #e2e8f0;
            color: #334155;
        }

        .tab-count-pill.alert {
            background: #fef2f2;
            color: #ef4444;
        }

        .tab-count-pill.warning {
            background: #fff7ed;
            color: #d97706;
        }

        .dashboard-tab-btn.active .tab-count-pill {
            background: rgba(255, 255, 255, 0.25) !important;
            color: #ffffff !important;
        }

        html[data-theme="dark"] .dashboard-tab-btn {
            background: #0f172a;
            border-color: #334155;
            color: #94a3b8;
        }

        html[data-theme="dark"] .dashboard-tab-btn:hover {
            background: #1e293b;
            color: #60a5fa;
            border-color: #475569;
        }

        html[data-theme="dark"] .dashboard-tab-btn.active {
            background: #2563eb;
            color: #ffffff;
            border-color: #2563eb;
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

        /* TOAST NOTIFICATION */
        .toast-container {
            position: fixed;
            top: 25px;
            right: 25px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 300px;
            max-width: 420px;
            padding: 14px 18px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
            border-left: 5px solid #10b981;
            animation: slideIn 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            transition: all 0.3s ease;
        }

        .toast-icon {
            font-size: 20px;
            color: #10b981;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toast-content {
            flex: 1;
            font-size: 14px;
            font-weight: 500;
            color: #1f2937;
        }

        .toast-close {
            background: transparent;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            font-size: 14px;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toast-close:hover {
            color: #374151;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(100%); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes fadeOut {
            from { opacity: 1; transform: translateX(0); }
            to { opacity: 0; transform: translateX(100%); }
        }

        /* CHARTS SECTION */
        .charts-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .chart-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.03);
            transition: all 0.25s ease;
        }

        .chart-card:hover {
            box-shadow: 0 8px 24px rgba(0,0,0,0.06);
        }

        .chart-card h3 {
            margin: 0 0 18px;
            font-size: 16px;
            font-weight: 700;
            color: #111827;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .chart-container {
            position: relative;
            height: 260px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* TASK SECTION */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 20px;
        }

        .card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.03);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .card-header h3 {
            margin: 0;
            font-size: 17px;
        }

        .view-all {
            color: #2563eb;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.2s ease;
        }

        .view-all:hover {
            text-decoration: underline;
            color: #1d4ed8;
        }

        /* TASK ITEM */
        .task {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #f3f4f6;
            transition: background 0.15s ease;
        }

        .task:last-child {
            border-bottom: none;
        }

        .task-check {
            width: 38px;
            height: 38px;
            border-radius: 9px;
            background: #f0f5ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 14px;
            flex-shrink: 0;
        }

        .task-info {
            flex: 1;
        }

        .task-info strong {
            display: block;
            font-size: 14px;
            color: #111827;
            margin-bottom: 5px;
        }

        .task-info strong a {
            color: inherit;
            text-decoration: none;
            transition: color 0.15s ease;
        }

        .task-info strong a:hover {
            color: #2563eb;
        }

        .task-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #6b7280;
            font-size: 12px;
            flex-wrap: wrap;
        }

        .priority-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 2px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
        }

        .priority-badge.priority-high {
            background: #fef2f2;
            color: #dc2626;
        }

        .priority-badge.priority-medium {
            background: #fff7ed;
            color: #ea580c;
        }

        .priority-badge.priority-low {
            background: #eff6ff;
            color: #2563eb;
        }

        .status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .status.pending {
            background: #fff7ed;
            color: #ea580c;
        }

        .status.doing {
            background: #eff6ff;
            color: #2563eb;
        }

        .status.completed {
            background: #ecfdf5;
            color: #059669;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-left: 12px;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            font-size: 12px;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .view-btn {
            background: #f0fdf4;
            color: #16a34a;
        }

        .view-btn:hover {
            background: #dcfce7;
        }

        /* QUICK ACTION SIDE PANEL */
        .quick-action h3 {
            margin-top: 0;
            font-size: 17px;
        }

        .quick-action p {
            color: #6b7280;
            font-size: 13px;
            line-height: 1.6;
        }

        .add-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background: #2563eb;
            color: white;
            border-radius: 9px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            transition: 0.2s;
        }

        .add-btn:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .empty {
            text-align: center;
            padding: 50px 20px;
            color: #9ca3af;
        }

        .empty i {
            font-size: 40px;
            margin-bottom: 12px;
        }

        .empty p {
            margin: 0;
        }

        @media (max-width: 1100px) {
            .stats {
                grid-template-columns: repeat(2, 1fr);
            }
            .charts-grid {
                grid-template-columns: 1fr;
            }
            .content-grid {
                grid-template-columns: 1fr;
            }
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

            .profile-info {
                display: none;
            }

            .stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/dark-mode.css') }}">
</head>

<body>

    @if(session('success'))
        <div class="toast-container" id="toastContainer">
            <div class="toast">
                <div class="toast-icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div class="toast-content">
                    {{ session('success') }}
                </div>
                <button type="button" class="toast-close" onclick="closeToast(this)">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>
        <script>
            function closeToast(btn) {
                const toast = btn.closest('.toast');
                toast.style.animation = 'fadeOut 0.3s forwards';
                setTimeout(() => toast.remove(), 300);
            }
            setTimeout(() => {
                const toast = document.querySelector('.toast');
                if (toast) {
                    toast.style.animation = 'fadeOut 0.3s forwards';
                    setTimeout(() => toast.remove(), 300);
                }
            }, 4000);
        </script>
    @endif

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
            <a href="/dashboard" class="active">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>

            <a href="/tasks">
                <i class="fa-solid fa-list-check"></i>
                <span>Công việc</span>
            </a>

            <a href="/profile">
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

        <!-- HEADER -->
        <div class="topbar">

            <div class="welcome">
                <h1>
                    Xin chào, {{ Auth::user()->name }} 👋
                </h1>
                <p>
                    <i class="fa-regular fa-calendar" style="color: #2563eb;"></i>
                    Hôm nay: {{ \Carbon\Carbon::now()->format('d/m/Y') }} — Tổng quan công việc của bạn.
                </p>
            </div>

            <div class="topbar-actions">
                <button type="button" class="dark-mode-toggle" id="darkModeToggle">
                    <i class="fa-solid fa-moon"></i>
                    <span class="toggle-text">Giao diện tối</span>
                </button>

                <a href="/tasks/create" class="quick-create-btn">
                    <i class="fa-solid fa-plus"></i>
                    Thêm công việc
                </a>

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

                <div class="profile">
                    <div class="profile-info">
                        <strong>
                            {{ Auth::user()->name }}
                        </strong>
                        <span>
                            {{ Auth::user()->email }}
                        </span>
                    </div>

                    <div class="avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </div>
            </div>

        </div>

        <!-- STATISTICS -->
        <div class="section-title">
            Tổng quan công việc
        </div>

        <div class="stats">

            <a href="/tasks" class="stat-card" title="Xem tất cả công việc">
                <div class="stat-info">
                    <p>Tổng công việc</p>
                    <h2>
                        {{ $totalTasks }}
                    </h2>
                </div>
                <div class="stat-icon">
                    <i class="fa-solid fa-list-check"></i>
                </div>
            </a>

            <a href="/tasks?status={{ urlencode('Chưa làm') }}" class="stat-card" title="Xem danh sách công việc chưa làm">
                <div class="stat-info">
                    <p>Chưa làm</p>
                    <h2>
                        {{ $pendingTasks }}
                    </h2>
                </div>
                <div class="stat-icon icon-pending">
                    <i class="fa-regular fa-clock"></i>
                </div>
            </a>

            <a href="/tasks?status={{ urlencode('Đang làm') }}" class="stat-card" title="Xem danh sách công việc đang làm">
                <div class="stat-info">
                    <p>Đang làm</p>
                    <h2>
                        {{ $doingTasks }}
                    </h2>
                </div>
                <div class="stat-icon icon-doing">
                    <i class="fa-solid fa-spinner"></i>
                </div>
            </a>

            <a href="/tasks?status={{ urlencode('Hoàn thành') }}" class="stat-card" title="Xem danh sách công việc đã hoàn thành">
                <div class="stat-info">
                    <p>Hoàn thành</p>
                    <h2>
                        {{ $completedTasks }}
                    </h2>
                </div>
                <div class="stat-icon icon-completed">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
            </a>

            <a href="/tasks?deadline=overdue" class="stat-card" title="Xem danh sách công việc quá hạn">
                <div class="stat-info">
                    <p>Công việc quá hạn</p>
                    <h2>
                        {{ $overdueTasks }}
                    </h2>
                </div>
                <div class="stat-icon icon-overdue">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
            </a>

            <a href="/tasks?deadline=upcoming" class="stat-card" title="Xem danh sách công việc sắp đến hạn trong 7 ngày">
                <div class="stat-info">
                    <p>Công việc sắp đến hạn</p>
                    <h2>
                        {{ $upcomingTasks }}
                    </h2>
                </div>
                <div class="stat-icon icon-upcoming">
                    <i class="fa-solid fa-hourglass-half"></i>
                </div>
            </a>

        </div>

        <!-- CHARTS -->
        <div class="section-title" style="margin-top: 10px;">
            Thống kê biểu đồ (Bấm để xem danh sách tương ứng)
        </div>

        <div class="charts-grid">
            <div class="chart-card">
                <h3>
                    <i class="fa-solid fa-chart-pie" style="color: #2563eb;"></i>
                    Phân bố theo trạng thái
                </h3>
                <div class="chart-container">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>

            <div class="chart-card">
                <h3>
                    <i class="fa-solid fa-chart-bar" style="color: #ea580c;"></i>
                    Phân bố theo mức độ ưu tiên
                </h3>
                <div class="chart-container">
                    <canvas id="priorityChart"></canvas>
                </div>
            </div>
        </div>

        <!-- CONTENT & TASK WIDGETS -->
        <div class="content-grid">

            <!-- TASK WIDGET CARD -->
            <div class="card">

                @php
                    $defaultTab = ($overdueTasks > 0) ? 'overdue' : (($upcomingTasks > 0) ? 'upcoming' : 'recent');
                @endphp

                <div class="card-header">
                    <div class="widget-tabs-wrapper">
                        <button type="button" class="dashboard-tab-btn {{ $defaultTab == 'overdue' ? 'active' : '' }}" id="tabBtnOverdue" onclick="switchDashboardTab('overdue')">
                            <i class="fa-solid fa-triangle-exclamation" style="color: #ef4444;"></i>
                            <span>Quá hạn</span>
                            <span class="tab-count-pill alert">{{ $overdueTasks }}</span>
                        </button>

                        <button type="button" class="dashboard-tab-btn {{ $defaultTab == 'upcoming' ? 'active' : '' }}" id="tabBtnUpcoming" onclick="switchDashboardTab('upcoming')">
                            <i class="fa-solid fa-hourglass-half" style="color: #f59e0b;"></i>
                            <span>Sắp đến hạn</span>
                            <span class="tab-count-pill warning">{{ $upcomingTasks }}</span>
                        </button>

                        <button type="button" class="dashboard-tab-btn {{ $defaultTab == 'recent' ? 'active' : '' }}" id="tabBtnRecent" onclick="switchDashboardTab('recent')">
                            <i class="fa-solid fa-clock-rotate-left" style="color: #2563eb;"></i>
                            <span>Gần đây</span>
                            <span class="tab-count-pill info">{{ $recentTasks->count() }}</span>
                        </button>
                    </div>

                    <a href="/tasks?deadline=overdue" id="dashboardViewAllBtn" class="view-all">
                        Xem tất cả <i class="fa-solid fa-arrow-right" style="font-size: 11px;"></i>
                    </a>
                </div>

                <!-- WIDGET 1: OVERDUE TASKS LIST -->
                <div id="widgetOverdueList" class="widget-task-content" style="display: {{ $defaultTab == 'overdue' ? 'block' : 'none' }};">
                    @if(isset($overdueTasksList) && $overdueTasksList->count() > 0)
                        @foreach($overdueTasksList as $task)
                            <div class="task">
                                <div class="task-check" style="background: #fef2f2; color: #ef4444;">
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                </div>

                                <div class="task-info">
                                    <strong>
                                        <a href="/tasks/{{ $task->id }}">{{ $task->title }}</a>
                                    </strong>

                                    <div class="task-meta">
                                        @if($task->priority == 'Cao')
                                            <span class="priority-badge priority-high">
                                                <i class="fa-solid fa-circle" style="font-size: 6px;"></i> Cao
                                            </span>
                                        @elseif($task->priority == 'Trung bình')
                                            <span class="priority-badge priority-medium">
                                                <i class="fa-solid fa-circle" style="font-size: 6px;"></i> Trung bình
                                            </span>
                                        @else
                                            <span class="priority-badge priority-low">
                                                <i class="fa-solid fa-circle" style="font-size: 6px;"></i> Thấp
                                            </span>
                                        @endif

                                        @if($task->deadline)
                                            <span style="color: #ef4444; font-weight: 600;">
                                                <i class="fa-regular fa-calendar-times"></i>
                                                Quá hạn: {{ \Carbon\Carbon::parse($task->deadline)->format('d/m/Y') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                @if($task->status == 'Đang làm')
                                    <span class="status doing">Đang làm</span>
                                @else
                                    <span class="status pending">Chưa làm</span>
                                @endif

                                <div class="actions">
                                    <a href="/tasks/{{ $task->id }}" class="action-btn view-btn" title="Xem chi tiết">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="empty">
                            <i class="fa-regular fa-circle-check" style="color: #10b981;"></i>
                            <p>Tuyệt vời! Bạn không có công việc nào bị quá hạn.</p>
                        </div>
                    @endif
                </div>

                <!-- WIDGET 2: UPCOMING TASKS LIST -->
                <div id="widgetUpcomingList" class="widget-task-content" style="display: {{ $defaultTab == 'upcoming' ? 'block' : 'none' }};">
                    @if(isset($upcomingTasksList) && $upcomingTasksList->count() > 0)
                        @foreach($upcomingTasksList as $task)
                            <div class="task">
                                <div class="task-check" style="background: #fff7ed; color: #f59e0b;">
                                    <i class="fa-regular fa-clock"></i>
                                </div>

                                <div class="task-info">
                                    <strong>
                                        <a href="/tasks/{{ $task->id }}">{{ $task->title }}</a>
                                    </strong>

                                    <div class="task-meta">
                                        @if($task->priority == 'Cao')
                                            <span class="priority-badge priority-high">
                                                <i class="fa-solid fa-circle" style="font-size: 6px;"></i> Cao
                                            </span>
                                        @elseif($task->priority == 'Trung bình')
                                            <span class="priority-badge priority-medium">
                                                <i class="fa-solid fa-circle" style="font-size: 6px;"></i> Trung bình
                                            </span>
                                        @else
                                            <span class="priority-badge priority-low">
                                                <i class="fa-solid fa-circle" style="font-size: 6px;"></i> Thấp
                                            </span>
                                        @endif

                                        @if($task->deadline)
                                            @php $dl = \Carbon\Carbon::parse($task->deadline); @endphp
                                            <span style="color: #d97706; font-weight: 600;">
                                                <i class="fa-regular fa-calendar"></i>
                                                Hạn: {{ $dl->isToday() ? 'Hôm nay' : $dl->format('d/m/Y') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                @if($task->status == 'Đang làm')
                                    <span class="status doing">Đang làm</span>
                                @else
                                    <span class="status pending">Chưa làm</span>
                                @endif

                                <div class="actions">
                                    <a href="/tasks/{{ $task->id }}" class="action-btn view-btn" title="Xem chi tiết">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="empty">
                            <i class="fa-regular fa-folder-open"></i>
                            <p>Không có công việc nào sắp đến hạn trong 7 ngày tới.</p>
                        </div>
                    @endif
                </div>

                <!-- WIDGET 3: RECENT TASKS LIST -->
                <div id="widgetRecentList" class="widget-task-content" style="display: {{ $defaultTab == 'recent' ? 'block' : 'none' }};">
                    @if($recentTasks->count() > 0)
                        @foreach($recentTasks as $task)
                            <div class="task">
                                <div class="task-check">
                                    @if($task->status == 'Hoàn thành')
                                        <i class="fa-solid fa-check"></i>
                                    @elseif($task->status == 'Đang làm')
                                        <i class="fa-solid fa-spinner"></i>
                                    @else
                                        <i class="fa-regular fa-clock"></i>
                                    @endif
                                </div>

                                <div class="task-info">
                                    <strong>
                                        <a href="/tasks/{{ $task->id }}">{{ $task->title }}</a>
                                    </strong>

                                    <div class="task-meta">
                                        <span>
                                            <i class="fa-regular fa-clock"></i>
                                            {{ $task->created_at->format('d/m/Y H:i') }}
                                        </span>

                                        @if($task->priority == 'Cao')
                                            <span class="priority-badge priority-high">
                                                <i class="fa-solid fa-circle" style="font-size: 6px;"></i> Cao
                                            </span>
                                        @elseif($task->priority == 'Trung bình')
                                            <span class="priority-badge priority-medium">
                                                <i class="fa-solid fa-circle" style="font-size: 6px;"></i> Trung bình
                                            </span>
                                        @else
                                            <span class="priority-badge priority-low">
                                                <i class="fa-solid fa-circle" style="font-size: 6px;"></i> Thấp
                                            </span>
                                        @endif

                                        @if($task->deadline)
                                            <span>
                                                <i class="fa-regular fa-calendar-check"></i>
                                                Hạn: {{ \Carbon\Carbon::parse($task->deadline)->format('d/m/Y') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                @if($task->status == 'Hoàn thành')
                                    <span class="status completed">Hoàn thành</span>
                                @elseif($task->status == 'Đang làm')
                                    <span class="status doing">Đang làm</span>
                                @else
                                    <span class="status pending">Chưa làm</span>
                                @endif

                                <div class="actions">
                                    <a href="/tasks/{{ $task->id }}" class="action-btn view-btn" title="Xem chi tiết">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="empty">
                            <i class="fa-regular fa-folder-open"></i>
                            <p>Bạn chưa có công việc nào.</p>
                        </div>
                    @endif
                </div>

            </div>

            <!-- QUICK ACTION -->
            <div class="card quick-action">
                <h3>
                    Tạo công việc
                </h3>

                <p>
                    Thêm công việc mới để quản lý tiến độ và thời gian hoàn thành hiệu quả hơn.
                </p>

                <a href="/tasks/create" class="add-btn">
                    <i class="fa-solid fa-plus"></i>
                    Thêm công việc
                </a>
            </div>

        </div>

    </main>

    <script>
        function switchDashboardTab(tabName) {
            const btnOverdue = document.getElementById('tabBtnOverdue');
            const btnUpcoming = document.getElementById('tabBtnUpcoming');
            const btnRecent = document.getElementById('tabBtnRecent');

            const listOverdue = document.getElementById('widgetOverdueList');
            const listUpcoming = document.getElementById('widgetUpcomingList');
            const listRecent = document.getElementById('widgetRecentList');

            const viewAllBtn = document.getElementById('dashboardViewAllBtn');

            [btnOverdue, btnUpcoming, btnRecent].forEach(b => b && b.classList.remove('active'));
            [listOverdue, listUpcoming, listRecent].forEach(l => l && (l.style.display = 'none'));

            if (tabName === 'overdue') {
                if (btnOverdue) btnOverdue.classList.add('active');
                if (listOverdue) listOverdue.style.display = 'block';
                if (viewAllBtn) viewAllBtn.href = '/tasks?deadline=overdue';
            } else if (tabName === 'upcoming') {
                if (btnUpcoming) btnUpcoming.classList.add('active');
                if (listUpcoming) listUpcoming.style.display = 'block';
                if (viewAllBtn) viewAllBtn.href = '/tasks?deadline=upcoming';
            } else {
                if (btnRecent) btnRecent.classList.add('active');
                if (listRecent) listRecent.style.display = 'block';
                if (viewAllBtn) viewAllBtn.href = '/tasks';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
            const textColor = isDark ? '#cbd5e1' : '#64748b';
            const gridColor = isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.05)';

            // Initialize default viewAll button link
            switchDashboardTab('{{ $defaultTab }}');

            // Chart 1: Status Distribution (Doughnut Chart)
            const ctxStatus = document.getElementById('statusChart').getContext('2d');
            const statusChart = new Chart(ctxStatus, {
                type: 'doughnut',
                data: {
                    labels: ['Chưa làm', 'Đang làm', 'Hoàn thành'],
                    datasets: [{
                        data: [{{ $pendingTasks }}, {{ $doingTasks }}, {{ $completedTasks }}],
                        backgroundColor: ['#ea580c', '#2563eb', '#059669'],
                        borderWidth: 2,
                        borderColor: isDark ? '#1e293b' : '#ffffff',
                        hoverOffset: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    onHover: (event, chartElement) => {
                        event.native.target.style.cursor = chartElement.length ? 'pointer' : 'default';
                    },
                    onClick: (event, elements) => {
                        if (elements.length > 0) {
                            const index = elements[0].index;
                            const statusMap = ['Chưa làm', 'Đang làm', 'Hoàn thành'];
                            if (statusMap[index]) {
                                window.location.href = `/tasks?status=${encodeURIComponent(statusMap[index])}`;
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: textColor,
                                padding: 16,
                                font: { family: 'Arial', size: 13 }
                            }
                        }
                    },
                    cutout: '65%'
                }
            });

            // Chart 2: Priority Distribution (Bar Chart)
            const ctxPriority = document.getElementById('priorityChart').getContext('2d');
            const priorityChart = new Chart(ctxPriority, {
                type: 'bar',
                data: {
                    labels: ['Thấp', 'Trung bình', 'Cao'],
                    datasets: [{
                        label: 'Số lượng công việc',
                        data: [{{ $lowPriorityTasks }}, {{ $mediumPriorityTasks }}, {{ $highPriorityTasks }}],
                        backgroundColor: ['#eff6ff', '#fff7ed', '#fef2f2'],
                        borderColor: ['#2563eb', '#ea580c', '#dc2626'],
                        borderWidth: 2,
                        borderRadius: 8,
                        barThickness: 36
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    onHover: (event, chartElement) => {
                        event.native.target.style.cursor = chartElement.length ? 'pointer' : 'default';
                    },
                    onClick: (event, elements) => {
                        if (elements.length > 0) {
                            const index = elements[0].index;
                            const priorityMap = ['Thấp', 'Trung bình', 'Cao'];
                            if (priorityMap[index]) {
                                window.location.href = `/tasks?priority=${encodeURIComponent(priorityMap[index])}`;
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: textColor,
                                stepSize: 1,
                                font: { family: 'Arial', size: 12 }
                            },
                            grid: { color: gridColor }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: textColor, font: { family: 'Arial', size: 13, weight: 'bold' } }
                        }
                    }
                }
            });

            window.myCharts = {
                status: statusChart,
                priority: priorityChart
            };
        });

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