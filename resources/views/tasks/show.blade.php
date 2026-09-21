<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TaskManager - Chi tiết công việc</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

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

        .profile {
            display: flex;
            align-items: center;
            gap: 12px;
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

        /* CARD DETAIL */
        .card {
            max-width: 850px;

            background: white;

            border: 1px solid #e5e7eb;

            border-radius: 14px;

            padding: 32px;

            box-shadow: 0 3px 12px rgba(0,0,0,0.03);
        }

        .detail-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
            padding-bottom: 20px;
            border-bottom: 1px solid #f3f4f6;
            margin-bottom: 25px;
        }

        .detail-title {
            font-size: 22px;
            font-weight: bold;
            color: #111827;
            margin: 0 0 10px;

            line-height: 1.4;
        }

        .badges {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* STATUS BADGES */
        .status {
            display: inline-flex;
            align-items: center;
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
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

        /* PRIORITY BADGES */
        .priority-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 12px;
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

        /* SECTION DETAILS */
        .section-label {
            font-size: 14px;
            font-weight: bold;
            color: #374151;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-label i {
            color: #2563eb;
        }

        .description-box {
            background: #f9fafb;
            border: 1px solid #f3f4f6;
            border-radius: 10px;
            padding: 18px 20px;
            font-size: 14px;
            color: #374151;
            line-height: 1.6;
            white-space: pre-wrap;
            margin-bottom: 28px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-item {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 16px 18px;
        }

        .info-item-label {
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .info-item-value {
            font-size: 15px;
            font-weight: 600;
            color: #111827;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* BUTTONS */
        .buttons {
            display: flex;
            align-items: center;
            gap: 12px;
            padding-top: 24px;
            border-top: 1px solid #f3f4f6;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            padding: 11px 20px;

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

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(239,68,68,0.2);
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
            color: #111827;
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

            .info-grid {
                grid-template-columns: 1fr;
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

        /* CHECKLIST SECTION STYLES */
        .checklist-container {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
        }

        .checklist-progress-wrapper {
            margin-bottom: 20px;
        }

        .checklist-progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: bold;
            color: #1e293b;
        }

        .checklist-progress-bg {
            height: 10px;
            width: 100%;
            background: #f1f5f9;
            border-radius: 20px;
            overflow: hidden;
        }

        .checklist-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #2563eb, #3b82f6);
            border-radius: 20px;
            transition: width 0.4s ease;
        }

        .checklist-progress-bar.completed {
            background: linear-gradient(90deg, #10b981, #059669);
        }

        .checklist-add-form {
            display: flex;
            gap: 10px;
            margin-bottom: 18px;
        }

        .checklist-add-input {
            flex: 1;
            padding: 11px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
            transition: all 0.2s ease;
        }

        .checklist-add-input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        .checklist-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .checklist-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 16px;
            border: 1px solid #f1f5f9;
            background: #f8fafc;
            border-radius: 10px;
            transition: all 0.15s ease;
        }

        .checklist-item:hover {
            background: #ffffff;
            border-color: #e2e8f0;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03);
        }

        .checklist-item-left {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
            overflow: hidden;
        }

        .checklist-checkbox-btn {
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #cbd5e1;
            transition: color 0.15s ease;
        }

        .checklist-checkbox-btn:hover {
            color: #2563eb;
        }

        .checklist-checkbox-btn.checked {
            color: #10b981;
        }

        .checklist-title-text {
            font-size: 14px;
            color: #1e293b;
            font-weight: 500;
            word-break: break-word;
        }

        .checklist-title-text.completed {
            text-decoration: line-through;
            color: #94a3b8;
        }

        .checklist-item-actions {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-shrink: 0;
        }

        .checklist-action-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            background: #ffffff;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .checklist-action-btn.edit-btn:hover {
            background: #eff6ff;
            color: #2563eb;
        }

        .checklist-action-btn.delete-btn:hover {
            background: #fef2f2;
            color: #ef4444;
        }

        .checklist-edit-input {
            width: 100%;
            padding: 7px 12px;
            border: 1px solid #2563eb;
            border-radius: 7px;
            font-size: 14px;
            outline: none;
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

            <a href="/tasks" class="active">
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

        <!-- TOPBAR -->
        <div class="topbar">

            <div class="page-header">
                <h1>
                    Chi tiết công việc
                </h1>
                <p>
                    Xem thông tin đầy đủ và tiến độ thực hiện công việc.
                </p>
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

        <!-- CARD -->
        <div class="card">

            <div class="detail-header">
                <div>
                    <h2 class="detail-title">
                        {{ $task->title }}
                    </h2>

                    <div class="badges">
                        @if($task->status == 'Hoàn thành')
                            <span class="status completed">
                                <i class="fa-solid fa-circle-check" style="margin-right: 4px;"></i> Hoàn thành
                            </span>
                        @elseif($task->status == 'Đang làm')
                            <span class="status doing">
                                <i class="fa-solid fa-spinner" style="margin-right: 4px;"></i> Đang làm
                            </span>
                        @else
                            <span class="status pending">
                                <i class="fa-regular fa-clock" style="margin-right: 4px;"></i> Chưa làm
                            </span>
                        @endif

                        @if($task->priority == 'Cao')
                            <span class="priority-badge priority-high">
                                <i class="fa-solid fa-circle" style="font-size: 6px;"></i> Mức ưu tiên: Cao
                            </span>
                        @elseif($task->priority == 'Trung bình')
                            <span class="priority-badge priority-medium">
                                <i class="fa-solid fa-circle" style="font-size: 6px;"></i> Mức ưu tiên: Trung bình
                            </span>
                        @else
                            <span class="priority-badge priority-low">
                                <i class="fa-solid fa-circle" style="font-size: 6px;"></i> Mức ưu tiên: Thấp
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- DESCRIPTION -->
            <div class="section-label">
                <i class="fa-solid fa-align-left"></i>
                Mô tả công việc
            </div>

            <div class="description-box">
                {{ $task->description ?? 'Không có mô tả chi tiết cho công việc này.' }}
            </div>

            <!-- INFO GRID -->
            <div class="info-grid">

                <div class="info-item">
                    <div class="info-item-label">
                        Hạn hoàn thành
                    </div>
                    <div class="info-item-value">
                        @if($task->deadline)
                            @php
                                $deadline = \Carbon\Carbon::parse($task->deadline);
                                $today = \Carbon\Carbon::today();
                            @endphp

                            @if($task->status !== 'Hoàn thành' && $deadline->lt($today))
                                <span style="color: #ef4444; display: inline-flex; align-items: center; gap: 6px;">
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                    {{ $deadline->format('d/m/Y') }} (Quá hạn)
                                </span>
                            @elseif($task->status !== 'Hoàn thành' && $deadline->isToday())
                                <span style="color: #d97706; display: inline-flex; align-items: center; gap: 6px;">
                                    <i class="fa-regular fa-clock"></i>
                                    Hôm nay ({{ $deadline->format('d/m/Y') }})
                                </span>
                            @else
                                <span style="display: inline-flex; align-items: center; gap: 6px;">
                                    <i class="fa-regular fa-calendar-check" style="color: #2563eb;"></i>
                                    {{ $deadline->format('d/m/Y') }}
                                </span>
                            @endif
                        @else
                            <span style="color: #9ca3af; font-weight: normal;">
                                Chưa đặt hạn hoàn thành
                            </span>
                        @endif
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-item-label">
                        Thời gian tạo
                    </div>
                    <div class="info-item-value">
                        <i class="fa-regular fa-clock" style="color: #6b7280;"></i>
                        {{ $task->created_at->format('d/m/Y H:i') }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-item-label">
                        Cập nhật lần cuối
                    </div>
                    <div class="info-item-value">
                        <i class="fa-solid fa-rotate" style="color: #6b7280;"></i>
                        {{ $task->updated_at->format('d/m/Y H:i') }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-item-label">
                        Người tạo
                    </div>
                    <div class="info-item-value">
                        <i class="fa-regular fa-user" style="color: #2563eb;"></i>
                        {{ Auth::user()->name }}
                    </div>
                </div>

            </div>

            <!-- CHECKLIST SECTION -->
            <div class="section-label" style="margin-top: 28px;">
                <i class="fa-solid fa-list-check"></i>
                Tiến độ & Checklist
            </div>

            @php
                $totalChecklists = count($task->checklists ?? []);
                $completedChecklists = $task->checklists ? $task->checklists->where('is_completed', true)->count() : 0;
                $checklistPercent = $totalChecklists > 0 ? round(($completedChecklists / $totalChecklists) * 100) : 0;
            @endphp

            <div class="checklist-container">
                <!-- PROGRESS BAR -->
                <div class="checklist-progress-wrapper">
                    <div class="checklist-progress-header">
                        <span>
                            <i class="fa-solid fa-chart-line" style="color: #2563eb; margin-right: 6px;"></i>
                            Tiến độ hoàn thành
                        </span>
                        <span style="color: #2563eb;">
                            {{ $completedChecklists }}/{{ $totalChecklists }} mục ({{ $checklistPercent }}%)
                        </span>
                    </div>
                    <div class="checklist-progress-bg">
                        <div class="checklist-progress-bar {{ $checklistPercent == 100 ? 'completed' : '' }}" style="width: {{ $checklistPercent }}%;"></div>
                    </div>
                </div>

                <!-- ADD CHECKLIST ITEM FORM -->
                <form action="/tasks/{{ $task->id }}/checklists" method="POST" class="checklist-add-form">
                    @csrf
                    <input type="text" name="title" class="checklist-add-input" placeholder="Nhập mục công việc mới (ví dụ: Chuẩn bị tài liệu...)" required maxlength="255">
                    <button type="submit" class="btn btn-primary" style="padding: 10px 18px; border-radius: 10px; font-size: 13px;">
                        <i class="fa-solid fa-plus"></i>
                        Thêm
                    </button>
                </form>

                <!-- CHECKLIST ITEMS LIST -->
                <div class="checklist-list">
                    @if($totalChecklists > 0)
                        @foreach($task->checklists as $item)
                            <div class="checklist-item">
                                <div class="checklist-item-left">
                                    <form action="/tasks/{{ $task->id }}/checklists/{{ $item->id }}/toggle" method="POST" style="margin: 0;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="checklist-checkbox-btn {{ $item->is_completed ? 'checked' : '' }}" title="{{ $item->is_completed ? 'Đánh dấu chưa hoàn thành' : 'Đánh dấu đã hoàn thành' }}">
                                            @if($item->is_completed)
                                                <i class="fa-solid fa-square-check"></i>
                                            @else
                                                <i class="fa-regular fa-square"></i>
                                            @endif
                                        </button>
                                    </form>

                                    <!-- VIEW TITLE -->
                                    <span id="checklist-view-{{ $item->id }}" class="checklist-title-text {{ $item->is_completed ? 'completed' : '' }}">
                                        {{ $item->title }}
                                    </span>

                                    <!-- INLINE EDIT FORM (HIDDEN BY DEFAULT) -->
                                    <form id="checklist-edit-form-{{ $item->id }}" action="/tasks/{{ $task->id }}/checklists/{{ $item->id }}" method="POST" style="display: none; flex: 1; align-items: center; gap: 8px; margin: 0;">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="title" value="{{ $item->title }}" class="checklist-edit-input" required maxlength="255">
                                        <button type="submit" class="btn btn-primary" style="padding: 6px 12px; font-size: 12px; border-radius: 7px;">
                                            Lưu
                                        </button>
                                        <button type="button" onclick="cancelEditChecklist({{ $item->id }})" class="btn btn-secondary" style="padding: 6px 10px; font-size: 12px; border-radius: 7px;">
                                            Hủy
                                        </button>
                                    </form>
                                </div>

                                <div class="checklist-item-actions" id="checklist-actions-{{ $item->id }}">
                                    <button type="button" class="checklist-action-btn edit-btn" onclick="showEditChecklist({{ $item->id }})" title="Chỉnh sửa">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>

                                    <form action="/tasks/{{ $task->id }}/checklists/{{ $item->id }}" method="POST" style="margin: 0;" onsubmit="return confirm('Bạn có chắc muốn xóa mục checklist này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="checklist-action-btn delete-btn" title="Xóa">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div style="text-align: center; padding: 20px 10px; color: #94a3b8; font-size: 13px;">
                            <i class="fa-regular fa-square-check" style="font-size: 24px; color: #cbd5e1; display: block; margin-bottom: 6px;"></i>
                            Chưa có mục checklist nào. Hãy thêm các công việc nhỏ cần làm!
                        </div>
                    @endif
                </div>
            </div>

            <!-- ATTACHMENTS SECTION -->
            <div class="section-label" style="margin-top: 28px;">
                <i class="fa-solid fa-paperclip"></i>
                File đính kèm ({{ count($task->attachments ?? []) }})
            </div>

            <div style="margin-bottom: 30px;">
                @if($task->attachments && count($task->attachments) > 0)
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 14px;">
                        @foreach($task->attachments as $file)
                            @php
                                $ext = strtolower(pathinfo($file->original_name, PATHINFO_EXTENSION));
                                $icon = 'fa-file-lines';
                                $iconColor = '#2563eb';
                                $bgColor = '#eff6ff';

                                if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
                                    $icon = 'fa-file-image';
                                    $iconColor = '#7c3aed';
                                    $bgColor = '#f5f3ff';
                                } elseif ($ext == 'pdf') {
                                    $icon = 'fa-file-pdf';
                                    $iconColor = '#dc2626';
                                    $bgColor = '#fef2f2';
                                } elseif (in_array($ext, ['doc', 'docx'])) {
                                    $icon = 'fa-file-word';
                                    $iconColor = '#2563eb';
                                    $bgColor = '#eff6ff';
                                } elseif (in_array($ext, ['xls', 'xlsx'])) {
                                    $icon = 'fa-file-excel';
                                    $iconColor = '#16a34a';
                                    $bgColor = '#f0fdf4';
                                }
                            @endphp

                            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px 16px; display: flex; align-items: center; justify-content: space-between; gap: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.02); transition: all 0.2s ease;">
                                <div style="display: flex; align-items: center; gap: 12px; overflow: hidden;">
                                    <div style="width: 40px; height: 40px; border-radius: 10px; background: {{ $bgColor }}; color: {{ $iconColor }}; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;">
                                        <i class="fa-solid {{ $icon }}"></i>
                                    </div>
                                    <div style="overflow: hidden;">
                                        <div style="font-size: 13px; font-weight: bold; color: #1e293b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $file->original_name }}">
                                            {{ $file->original_name }}
                                        </div>
                                        <div style="font-size: 11px; color: #64748b; margin-top: 2px;">
                                            {{ round($file->file_size / 1024, 1) }} KB — {{ $file->created_at->format('d/m/Y') }}
                                        </div>
                                    </div>
                                </div>

                                <div style="display: flex; align-items: center; gap: 6px; flex-shrink: 0;">
                                    <a href="/tasks/{{ $task->id }}/attachments/{{ $file->id }}/download" style="width: 32px; height: 32px; border-radius: 8px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 13px; transition: 0.2s;" title="Tải xuống">
                                        <i class="fa-solid fa-download"></i>
                                    </a>

                                    <form action="/tasks/{{ $task->id }}/attachments/{{ $file->id }}" method="POST" style="margin: 0;" onsubmit="return confirm('Bạn có chắc muốn xóa file đính kèm này không?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="width: 32px; height: 32px; border-radius: 8px; background: #fef2f2; color: #ef4444; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 13px; transition: 0.2s;" title="Xóa file">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="background: #ffffff; border: 1px dashed #cbd5e1; border-radius: 12px; padding: 24px; text-align: center; color: #94a3b8; font-size: 14px;">
                        <i class="fa-regular fa-folder-open" style="font-size: 24px; color: #cbd5e1; display: block; margin-bottom: 6px;"></i>
                        Chưa có file đính kèm nào cho công việc này.
                    </div>
                @endif
            </div>

            <!-- BUTTONS -->
            <div class="buttons">
                <a href="/tasks/{{ $task->id }}/edit" class="btn btn-primary">
                    <i class="fa-solid fa-pen"></i>
                    Sửa công việc
                </a>

                <form action="/tasks/{{ $task->id }}"
                      method="POST"
                      style="margin: 0;"
                      onsubmit="return confirm('Bạn có chắc muốn xóa công việc này không?');">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        <i class="fa-solid fa-trash"></i>
                        Xóa công việc
                    </button>
                </form>

                <a href="/tasks" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i>
                    Quay lại
                </a>
            </div>

        </div>

    </main>

    <script>
        function showEditChecklist(id) {
            document.getElementById('checklist-view-' + id).style.display = 'none';
            document.getElementById('checklist-actions-' + id).style.display = 'none';
            document.getElementById('checklist-edit-form-' + id).style.display = 'flex';
        }

        function cancelEditChecklist(id) {
            document.getElementById('checklist-view-' + id).style.display = 'inline';
            document.getElementById('checklist-actions-' + id).style.display = 'flex';
            document.getElementById('checklist-edit-form-' + id).style.display = 'none';
        }
    </script>
</body>
</html>
