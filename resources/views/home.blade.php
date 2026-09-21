<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TaskManager - Quản lý công việc</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f8fafc;
            color: #1e293b;
        }

        /* HEADER */
        .navbar {
            height: 72px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 8%;
            border-bottom: 1px solid #e2e8f0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 22px;
            font-weight: bold;
        }

        .logo-icon {
            width: 38px;
            height: 38px;
            background: #2563eb;
            color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .task-text {
            color: #111827;
        }

        .manager-text {
            color: #2563eb;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .nav-links a {
            text-decoration: none;
            color: #475569;
            font-size: 15px;
        }

        .nav-links a:hover {
            color: #2563eb;
        }

        .login-btn {
            background: #2563eb;
            color: white !important;
            padding: 11px 20px;
            border-radius: 8px;
        }

/* USER ACCOUNT */

.user-account {
    display: flex;
    align-items: center;
    gap: 12px;
}

.user-avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #2563eb;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 15px;
}

.user-info {
    display: flex;
    flex-direction: column;
    line-height: 1.3;
}

.user-name {
    font-size: 14px;
    font-weight: bold;
    color: #1e293b;
}

.user-email {
    font-size: 11px;
    color: #64748b;
}

.logout-btn {
    background: #f1f5f9;
    color: #475569 !important;
    padding: 10px 15px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 14px;
    font-weight: bold;
}

.logout-btn:hover {
    background: #e2e8f0;
}

        /* HERO */
        .hero {
            min-height: 560px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 70px 8%;
            gap: 50px;
            background: linear-gradient(135deg, #eff6ff, #ffffff);
        }

        .hero-content {
            max-width: 600px;
        }

        .hero-content .badge {
            display: inline-block;
            background: #dbeafe;
            color: #2563eb;
            padding: 8px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .hero h1 {
            font-size: 52px;
            line-height: 1.15;
            margin-bottom: 20px;
        }

        .hero h1 span {
            color: #2563eb;
        }

        .hero p {
            font-size: 18px;
            line-height: 1.7;
            color: #64748b;
            margin-bottom: 30px;
        }

        .hero-buttons {
            display: flex;
            gap: 15px;
        }

        .primary-btn,
        .secondary-btn {
            padding: 14px 22px;
            border-radius: 9px;
            text-decoration: none;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .primary-btn {
            background: #2563eb;
            color: white;
        }

        .secondary-btn {
            background: white;
            color: #334155;
            border: 1px solid #cbd5e1;
        }

        /* HERO CARD */
        .hero-card {
            width: 420px;
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.12);
        }

        .hero-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .hero-card-header h3 {
            font-size: 18px;
        }

        .task-item {
            padding: 15px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .task-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .task-check {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: #dbeafe;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .task-name {
            font-weight: bold;
            font-size: 14px;
        }

        .task-status {
            font-size: 11px;
            color: #16a34a;
            margin-top: 4px;
        }

        /* FEATURES */
        .features {
            padding: 70px 8%;
            background: white;
            text-align: center;
        }

        .features h2 {
            font-size: 32px;
            margin-bottom: 12px;
        }

        .features-subtitle {
            color: #64748b;
            margin-bottom: 40px;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .feature-card {
            padding: 30px;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            text-align: left;
            transition: 0.25s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            background: #dbeafe;
            color: #2563eb;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 18px;
        }

        .feature-card h3 {
            margin-bottom: 10px;
        }

        .feature-card p {
            color: #64748b;
            line-height: 1.6;
            font-size: 14px;
        }

        /* FOOTER */
        footer {
            background: #0f172a;
            color: #cbd5e1;
            text-align: center;
            padding: 25px;
            font-size: 14px;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .hero {
                flex-direction: column;
                text-align: center;
            }

            .hero-buttons {
                justify-content: center;
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }

            .nav-links {
                gap: 12px;
            }

            .hero-card {
                width: 100%;
                max-width: 420px;
            }
        }

        @media (max-width: 600px) {
            .navbar {
                padding: 0 5%;
            }

            .nav-links a:not(.login-btn) {
                display: none;
            }

            .hero {
                padding: 50px 5%;
            }

            .hero h1 {
                font-size: 38px;
            }

            .features {
                padding: 50px 5%;
            }
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

        .toast.toast-error {
            border-left-color: #ef4444;
        }

        .toast.toast-error .toast-icon {
            color: #ef4444;
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

        /* NOTIFICATION CENTER */
        .notif-container {
            position: relative;
            display: inline-block;
        }

        .notif-bell-btn {
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            color: #4b5563;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
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
            top: 50px;
            right: 0;
            width: 330px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(15, 23, 42, 0.15);
            border: 1px solid #e2e8f0;
            z-index: 9999;
            display: none;
            overflow: hidden;
            text-align: left;
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
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            background: #f8fafc;
        }

        .notif-header h3 {
            margin: 0;
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .notif-header .notif-count-pill {
            background: #eff6ff;
            color: #2563eb;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 9px;
            border-radius: 12px;
        }

        .notif-list {
            max-height: 300px;
            overflow-y: auto;
        }

        .notif-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 16px;
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
            width: 34px;
            height: 34px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
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
            padding: 30px 16px;
            text-align: center;
            color: #94a3b8;
        }

        .notif-empty i {
            font-size: 32px;
            color: #cbd5e1;
            margin-bottom: 6px;
        }

        .notif-empty p {
            margin: 0;
            font-size: 13px;
        }

        .notif-footer {
            padding: 10px;
            text-align: center;
            background: #f8fafc;
            border-top: 1px solid #f1f5f9;
        }

        .notif-footer a {
            font-size: 12px;
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
    </style>
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

    <!-- HEADER -->
    <header class="navbar">

        <div class="logo">
            <div class="logo-icon">
                <i class="fa-solid fa-check"></i>
            </div>

            <div>
                <span class="task-text">Task</span><span class="manager-text">Manager</span>
            </div>
        </div>

        <nav class="nav-links">

    <a href="/">Trang chủ</a>

    <a href="#features">Tính năng</a>

    @auth

    <a href="/dashboard">Tổng quan</a>

    <a href="/tasks">Công việc</a>

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

    <div class="user-account">

        <div class="user-avatar">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>

        <div class="user-info">
            <span class="user-name">
                {{ Auth::user()->name }}
            </span>

            <span class="user-email">
                {{ Auth::user()->email }}
            </span>
        </div>

    </div>

    <a href="/logout" class="logout-btn">
        <i class="fa-solid fa-right-from-bracket"></i>
        Đăng xuất
    </a>

@else

    <a href="/login" class="login-btn">
        Đăng nhập
    </a>

@endauth

</nav>

    </header>


    <!-- HERO -->
    <section class="hero">

        <div class="hero-content">

            <span class="badge">
                <i class="fa-solid fa-rocket"></i>
                Quản lý công việc thông minh
            </span>

            @auth

    <h1>
        Xin chào,
        <span>{{ Auth::user()->name }}</span> 👋
    </h1>

@else

    <h1>
        Làm việc hiệu quả hơn với
        <span>TaskManager</span>
    </h1>

@endauth

            @auth

    <p>
        Chào mừng bạn quay trở lại TaskManager.
        Hãy tiếp tục quản lý công việc và theo dõi tiến độ của bạn.
    </p>

@else

    <p>
        Quản lý công việc, theo dõi tiến độ và kiểm soát deadline
        trong một giao diện đơn giản, hiện đại và dễ sử dụng.
    </p>

@endauth

            <div class="hero-buttons">

                @auth

    <a href="/tasks" class="primary-btn">
        <i class="fa-solid fa-list-check"></i>
        Quản lý công việc
    </a>

    <a href="/dashboard" class="secondary-btn">
        <i class="fa-solid fa-chart-line"></i>
        Xem tổng quan
    </a>

@else

    <a href="/login" class="primary-btn">
        <i class="fa-brands fa-google"></i>
        Đăng nhập bằng Google
    </a>

    <a href="#features" class="secondary-btn">
        Xem tính năng
    </a>

@endauth

                <a href="#features" class="secondary-btn">
                    Xem tính năng
                </a>

            </div>

        </div>


        <!-- DEMO CARD -->
        <div class="hero-card">

            <div class="hero-card-header">
                <h3>Công việc hôm nay</h3>

                <i class="fa-solid fa-ellipsis"></i>
            </div>

            <div class="task-item">

                <div class="task-info">
                    <div class="task-check">
                        <i class="fa-solid fa-check"></i>
                    </div>

                    <div>
                        <div class="task-name">
                            Hoàn thành báo cáo
                        </div>

                        <div class="task-status">
                            Hoàn thành
                        </div>
                    </div>
                </div>

            </div>


            <div class="task-item">

                <div class="task-info">
                    <div class="task-check">
                        <i class="fa-solid fa-clock"></i>
                    </div>

                    <div>
                        <div class="task-name">
                            Làm giao diện website
                        </div>

                        <div class="task-status">
                            Đang làm
                        </div>
                    </div>
                </div>

            </div>


            <div class="task-item">

                <div class="task-info">
                    <div class="task-check">
                        <i class="fa-solid fa-calendar"></i>
                    </div>

                    <div>
                        <div class="task-name">
                            Chuẩn bị thuyết trình
                        </div>

                        <div class="task-status">
                            Chưa làm
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section>


    <!-- FEATURES -->
    <section class="features" id="features">

        <h2>Tất cả công việc trong một nơi</h2>

        <p class="features-subtitle">
            TaskManager giúp bạn tổ chức và theo dõi công việc dễ dàng hơn.
        </p>


        <div class="feature-grid">

            <div class="feature-card">

                <div class="feature-icon">
                    <i class="fa-solid fa-list-check"></i>
                </div>

                <h3>Quản lý công việc</h3>

                <p>
                    Thêm, chỉnh sửa, tìm kiếm và xóa công việc
                    một cách nhanh chóng.
                </p>

            </div>


            <div class="feature-card">

                <div class="feature-icon">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>

                <h3>Quản lý Deadline</h3>

                <p>
                    Theo dõi thời hạn hoàn thành và nhận biết
                    các công việc đã quá hạn.
                </p>

            </div>


            <div class="feature-card">

                <div class="feature-icon">
                    <i class="fa-solid fa-chart-line"></i>
                </div>

                <h3>Theo dõi tiến độ</h3>

                <p>
                    Phân loại công việc theo trạng thái và
                    mức độ ưu tiên để làm việc hiệu quả hơn.
                </p>

            </div>

        </div>

    </section>


    <!-- FOOTER -->
    </footer>

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