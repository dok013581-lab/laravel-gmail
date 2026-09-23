<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TaskManager - Công việc</title>

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

        .page-title h1 {
            margin: 0 0 6px;
            font-size: 26px;
        }

        .page-title p {
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
        .avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            display: block;
        }

        /* CARD & TOOLBAR */
        .card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.03);
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .search-filter {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            flex: 1;
        }

        .search-box {
            position: relative;
            display: flex;
            align-items: center;
            min-width: 240px;
            flex: 1;
        }

        .search-box i {
            position: absolute;
            left: 14px;
            color: #9ca3af;
            font-size: 14px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 14px 10px 38px;
            border: 1px solid #d1d5db;
            border-radius: 9px;
            font-size: 14px;
            outline: none;
            transition: all 0.2s ease;
        }

        .search-box input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
        }

        select.filter {
            padding: 10px 14px;
            border: 1px solid #d1d5db;
            border-radius: 9px;
            font-size: 14px;
            background: white;
            color: #374151;
            outline: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        select.filter:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
        }

        button.filter-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 18px;
            border: 1px solid #2563eb;
            border-radius: 9px;
            background: #2563eb;
            color: white;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        button.filter-btn:hover {
            background: #1d4ed8;
            border-color: #1d4ed8;
        }

        .reset-filter-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 14px;
            border-radius: 9px;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            color: #6b7280;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            transition: all 0.2s ease;
        }

        .reset-filter-btn:hover {
            background: #fee2e2;
            border-color: #fca5a5;
            color: #ef4444;
        }

        .add-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: #2563eb;
            color: white;
            border-radius: 9px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(37,99,235,0.2);
            white-space: nowrap;
        }

        .add-btn:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        /* TABLE */
        .table-wrapper {
            overflow-x: auto;
            border: 1px solid #e5e7eb;
            border-radius: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 14px;
        }

        thead tr {
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            padding: 14px 16px;
            font-weight: 600;
            color: #4b5563;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tbody tr {
            border-bottom: 1px solid #f3f4f6;
            transition: background 0.15s ease;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #f9fafb;
        }

        td {
            padding: 16px;
            vertical-align: middle;
        }

        .task-title {
            font-weight: bold;
            color: #111827;
            margin-bottom: 3px;
        }

        .description {
            color: #6b7280;
            font-size: 13px;
            max-width: 280px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* STATUS BADGES */
        .status {
            display: inline-flex;
            align-items: center;
            padding: 5px 12px;
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

        /* QUICK STATUS SELECT */
        .quick-status-select {
            display: inline-flex;
            align-items: center;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            border: 1px solid transparent;
            cursor: pointer;
            outline: none;
            transition: all 0.2s ease;
        }

        .quick-status-select.pending {
            background: #fff7ed;
            color: #ea580c;
            border-color: #fed7aa;
        }

        .quick-status-select.doing {
            background: #eff6ff;
            color: #2563eb;
            border-color: #bfdbfe;
        }

        .quick-status-select.completed {
            background: #ecfdf5;
            color: #059669;
            border-color: #a7f3d0;
        }

        .quick-status-select:hover {
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        /* PRIORITY BADGES */
        .priority-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
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

        /* DEADLINE */
        .deadline-column {
            text-align: center !important;
        }

        .deadline-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .deadline-badge.overdue {
            background: #fef2f2;
            color: #ef4444;
        }

        .deadline-badge.today {
            background: #fff7ed;
            color: #d97706;
        }

        .deadline-badge.normal {
            color: #374151;
            font-weight: normal;
        }

        .deadline-date {
            display: block;
            text-align: center;
            margin-top: 3px;
            color: #6b7280;
            font-size: 11px;
        }

        /* ACTIONS */
        .actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .action-btn {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            font-size: 13px;
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

        .edit-btn {
            background: #eff6ff;
            color: #2563eb;
        }

        .edit-btn:hover {
            background: #dbeafe;
        }

        .delete-btn {
            background: #fff1f2;
            color: #ef4444;
        }

        .delete-btn:hover {
            background: #ffe4e6;
        }

        /* PAGINATION STYLING */
        .pagination-wrapper {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #f3f4f6;
        }

        nav[role="navigation"] {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
            width: 100%;
        }

        .pagination-info {
            font-size: 13px;
            color: #6b7280;
        }

        .pagination-links {
            display: flex;
            align-items: center;
            gap: 4px;
            flex-wrap: wrap;
        }

        nav[role="navigation"] span.relative,
        nav[role="navigation"] a.relative {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 14px;
            margin: 0 2px;
            font-size: 13px;
            font-weight: 600;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background: #ffffff;
            color: #374151;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        nav[role="navigation"] a.relative:hover {
            background: #f0f5ff;
            border-color: #bfdbfe;
            color: #2563eb;
        }

        nav[role="navigation"] span[aria-current="page"] span {
            background: #2563eb !important;
            color: #ffffff !important;
            border-color: #2563eb !important;
        }

        nav[role="navigation"] span[aria-disabled="true"] span {
            color: #9ca3af !important;
            background: #f9fafb !important;
            cursor: not-allowed;
        }

        /* ALERT WARNING BANNERS */
        .alerts-wrapper {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 22px;
        }

        .alert-banner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 18px;
            border-radius: 11px;
            font-size: 14px;
            border: 1px solid transparent;
            transition: all 0.2s ease;
        }

        .alert-banner-info {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
        }

        .alert-banner-info i {
            font-size: 18px;
        }

        .alert-banner.alert-danger {
            background: #fef2f2;
            border-color: #fca5a5;
            color: #991b1b;
        }

        .alert-banner.alert-danger i {
            color: #ef4444;
        }

        .alert-banner.alert-warning {
            background: #fff7ed;
            border-color: #fed7aa;
            color: #9a3412;
        }

        .alert-banner.alert-warning i {
            color: #f59e0b;
        }

        .alert-action-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: bold;
            text-decoration: none;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .alert-danger .alert-action-btn {
            background: #ef4444;
            color: #ffffff;
        }

        .alert-danger .alert-action-btn:hover {
            background: #dc2626;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
        }

        .alert-warning .alert-action-btn {
            background: #f59e0b;
            color: #ffffff;
        }

        .alert-warning .alert-action-btn:hover {
            background: #d97706;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.25);
        }

        /* EMPTY STATE */
        .empty {
            text-align: center;
            padding: 60px 20px;
            color: #9ca3af;
        }

        .empty i {
            font-size: 45px;
            margin-bottom: 15px;
            color: #cbd5e1;
        }

        .empty p {
            margin: 0;
            font-size: 15px;
            color: #64748b;
        }

        .empty-cta-btn {
            display: inline-flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            flex-wrap: nowrap;
            white-space: nowrap;
            gap: 10px;
            height: 48px;
            width: 230px;
            background: #2563eb;
            color: #ffffff;
            border-radius: 11px;
            text-decoration: none;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
            margin-top: 20px;
            line-height: 1;
            padding: 0 16px;
            box-sizing: border-box;
        }

        .empty-cta-btn:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.2);
        }

        .empty-cta-btn:active {
            transform: translateY(0);
        }

        .empty-cta-icon,
        .empty-cta-text,
        .empty-cta-arrow {
            margin: 0 !important;
            padding: 0 !important;
            vertical-align: middle !important;
            line-height: 1 !important;
            box-sizing: border-box;
        }

        .empty-cta-icon {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 16px !important;
            height: 16px !important;
            font-size: 14px !important;
            color: #ffffff !important;
            flex-shrink: 0;
        }

        .empty-cta-icon i {
            margin: 0 !important;
            padding: 0 !important;
            vertical-align: middle !important;
            line-height: 1 !important;
            font-size: 14px !important;
            color: #ffffff !important;
            display: inline-block !important;
        }

        .empty-cta-text {
            display: inline-block !important;
            font-size: 15px !important;
            font-weight: 600 !important;
            color: #ffffff !important;
            line-height: 1 !important;
            white-space: nowrap !important;
        }

        .empty-cta-arrow {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 16px !important;
            height: 16px !important;
            font-size: 13px !important;
            color: #ffffff !important;
            flex-shrink: 0;
        }

        .empty-cta-arrow i {
            margin: 0 !important;
            padding: 0 !important;
            vertical-align: middle !important;
            line-height: 1 !important;
            font-size: 13px !important;
            color: #ffffff !important;
            display: inline-block !important;
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
            min-width: 320px;
            max-width: 450px;
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

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .toolbar {
                flex-direction: column;
                align-items: stretch;
            }

            .search-filter {
                width: 100%;
            }

            .search-box {
                max-width: none;
            }

            .add-btn {
                justify-content: center;
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

            .search-filter {
                flex-direction: column;
            }

            .search-box,
            select.filter,
            button.filter-btn,
            .reset-filter-btn {
                width: 100%;
            }
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/dark-mode.css') }}">
</head>

<body>

    @if(session('error'))
        <div class="toast-container" id="toastContainer">
            <div class="toast toast-error">
                <div class="toast-icon">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>
                <div class="toast-content">
                    {{ session('error') }}
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
    @elseif(session('success'))
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

        <!-- HEADER -->
        <div class="topbar">

            <div class="page-title">
                <h1>
                    Công việc
                </h1>
                <p>
                    Quản lý và theo dõi tất cả công việc của bạn.
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
                        @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar">
                        @else
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <!-- CARD -->
        <div class="card">

            @if(($overdueCount ?? 0) > 0 || ($upcomingCount ?? 0) > 0)
                <div class="alerts-wrapper">
                    @if(($overdueCount ?? 0) > 0)
                        <div class="alert-banner alert-danger">
                            <div class="alert-banner-info">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                                <span>
                                    <strong>Cảnh báo quá hạn:</strong> Bạn có <strong>{{ $overdueCount }}</strong> công việc đã quá hạn cần xử lý ngay!
                                </span>
                            </div>
                            <a href="/tasks?deadline=overdue" class="alert-action-btn">
                                Xem công việc quá hạn
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    @endif

                    @if(($upcomingCount ?? 0) > 0)
                        <div class="alert-banner alert-warning">
                            <div class="alert-banner-info">
                                <i class="fa-regular fa-clock"></i>
                                <span>
                                    <strong>Nhắc nhở sắp đến hạn:</strong> Bạn có <strong>{{ $upcomingCount }}</strong> công việc sắp đến hạn trong 7 ngày tới.
                                </span>
                            </div>
                            <a href="/tasks?deadline=upcoming" class="alert-action-btn">
                                Xem công việc sắp đến hạn
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    @endif
                </div>
            @endif

            <!-- TOOLBAR -->
            <form method="GET" action="/tasks">

                <div class="toolbar">

                    <div class="search-filter">

                        <div class="search-box">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Tìm kiếm công việc..."
                            >
                        </div>

                        <select name="status" class="filter">
                            <option value="">
                                Tất cả trạng thái
                            </option>
                            <option value="Chưa làm" {{ request('status') == 'Chưa làm' ? 'selected' : '' }}>
                                Chưa làm
                            </option>
                            <option value="Đang làm" {{ request('status') == 'Đang làm' ? 'selected' : '' }}>
                                Đang làm
                            </option>
                            <option value="Hoàn thành" {{ request('status') == 'Hoàn thành' ? 'selected' : '' }}>
                                Hoàn thành
                            </option>
                        </select>

                        <select name="priority" class="filter">
                            <option value="">
                                Tất cả mức độ
                            </option>
                            <option value="Thấp" {{ request('priority') == 'Thấp' ? 'selected' : '' }}>
                                Thấp
                            </option>
                            <option value="Trung bình" {{ request('priority') == 'Trung bình' ? 'selected' : '' }}>
                                Trung bình
                            </option>
                            <option value="Cao" {{ request('priority') == 'Cao' ? 'selected' : '' }}>
                                Cao
                            </option>
                        </select>

                        <select name="deadline" class="filter">
                            <option value="">
                                Tất cả hạn
                            </option>
                            <option value="today" {{ request('deadline') == 'today' ? 'selected' : '' }}>
                                Hôm nay
                            </option>
                            <option value="upcoming" {{ request('deadline') == 'upcoming' ? 'selected' : '' }}>
                                7 ngày tới
                            </option>
                            <option value="overdue" {{ request('deadline') == 'overdue' ? 'selected' : '' }}>
                                Quá hạn
                            </option>
                        </select>

                        <select name="sort" class="filter">
                            <option value="">
                                Sắp xếp: Hạn gần nhất
                            </option>
                            <option value="deadline_asc" {{ request('sort') == 'deadline_asc' ? 'selected' : '' }}>
                                Hạn hoàn thành gần nhất
                            </option>
                            <option value="priority_desc" {{ request('sort') == 'priority_desc' ? 'selected' : '' }}>
                                Ưu tiên: Cao → Thấp
                            </option>
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>
                                Mới nhất
                            </option>
                        </select>

                        <button type="submit" class="filter-btn">
                            <i class="fa-solid fa-filter"></i>
                            Lọc
                        </button>

                        @if(request('search') || request('status') || request('priority') || request('deadline') || request('sort'))
                            <a href="/tasks" class="reset-filter-btn" title="Xóa tất cả bộ lọc">
                                <i class="fa-solid fa-rotate-left"></i>
                                Xóa lọc
                            </a>
                        @endif

                    </div>

                    <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                        <div class="view-switcher-group">
                            <button type="button" class="view-switch-btn" id="btnViewList" onclick="switchTaskView('list')" title="Xem dạng danh sách">
                                <i class="fa-solid fa-list-ul"></i>
                                <span>Danh sách</span>
                            </button>
                            <button type="button" class="view-switch-btn" id="btnViewKanban" onclick="switchTaskView('kanban')" title="Xem dạng bảng Kanban">
                                <i class="fa-solid fa-table-columns"></i>
                                <span>Kanban</span>
                            </button>
                        </div>

                        <a href="/tasks/create" class="add-btn" style="margin-top: 0;">
                            <i class="fa-solid fa-plus"></i>
                            Thêm công việc
                        </a>
                    </div>

                </div>

            </form>

            <!-- LIST VIEW -->
            <div id="taskListView">
                @if($tasks->count() > 0)

                    <div class="table-wrapper">

                        <table>
                            <thead>
                                <tr>
                                    <th>Công việc</th>
                                    <th>Mô tả</th>
                                    <th>Trạng thái</th>
                                    <th>Ưu tiên</th>
                                    <th class="deadline-column">Hạn hoàn thành</th>
                                    <th>Ngày tạo</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($tasks as $task)

                                    <tr data-task-id="{{ $task->id }}">
                                        <td>
                                            <div class="task-title">
                                                {{ $task->title }}
                                            </div>
                                        </td>

                                        <td>
                                            <div class="description" title="{{ $task->description }}">
                                                {{ $task->description ?? 'Không có mô tả' }}
                                            </div>
                                        </td>

                                        <td>
                                            <form action="/tasks/{{ $task->id }}/status" method="POST" style="margin: 0;">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" class="quick-status-select {{ $task->status == 'Hoàn thành' ? 'completed' : ($task->status == 'Đang làm' ? 'doing' : 'pending') }}" onchange="this.form.submit()" title="Bấm để đổi trạng thái nhanh">
                                                    <option value="Chưa làm" {{ $task->status == 'Chưa làm' ? 'selected' : '' }}>Chưa làm</option>
                                                    <option value="Đang làm" {{ $task->status == 'Đang làm' ? 'selected' : '' }}>Đang làm</option>
                                                    <option value="Hoàn thành" {{ $task->status == 'Hoàn thành' ? 'selected' : '' }}>Hoàn thành</option>
                                                </select>
                                            </form>
                                        </td>

                                        <td>
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
                                        </td>

                                        <td class="deadline-column">
                                            @if($task->deadline)
                                                @php
                                                    $deadline = \Carbon\Carbon::parse($task->deadline);
                                                    $today = \Carbon\Carbon::today();
                                                @endphp

                                                @if($task->status !== 'Hoàn thành' && $deadline->lt($today))
                                                    <span class="deadline-badge overdue">
                                                        <i class="fa-solid fa-triangle-exclamation"></i>
                                                        Quá hạn
                                                    </span>
                                                    <span class="deadline-date">
                                                        {{ $deadline->format('d/m/Y') }}
                                                    </span>
                                                @elseif($task->status !== 'Hoàn thành' && $deadline->isToday())
                                                    <span class="deadline-badge today">
                                                        <i class="fa-regular fa-clock"></i>
                                                        Hôm nay
                                                    </span>
                                                    <span class="deadline-date">
                                                        {{ $deadline->format('d/m/Y') }}
                                                    </span>
                                                @else
                                                    <span class="deadline-badge normal">
                                                        {{ $deadline->format('d/m/Y') }}
                                                    </span>
                                                @endif
                                            @else
                                                <span class="deadline-badge normal" style="color: #9ca3af;">
                                                    Chưa đặt
                                                </span>
                                            @endif
                                        </td>

                                        <td style="color: #6b7280; font-size: 13px;">
                                            {{ $task->created_at->format('d/m/Y') }}
                                        </td>

                                        <td>
                                            <div class="actions">
                                                <a href="/tasks/{{ $task->id }}"
                                                   class="action-btn view-btn"
                                                   title="Xem chi tiết">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>

                                                <a href="/tasks/{{ $task->id }}/edit"
                                                   class="action-btn edit-btn"
                                                   title="Sửa công việc">
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>

                                                <form action="/tasks/{{ $task->id }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Bạn có chắc muốn xóa công việc này không?');">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="action-btn delete-btn"
                                                            title="Xóa công việc">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>

                        </table>

                    </div>

                    @if($tasks->hasPages())
                        <div class="pagination-wrapper">
                            {{ $tasks->links() }}
                        </div>
                    @endif

                @else

                    <div class="empty">
                        <i class="fa-regular fa-folder-open"></i>
                        <p>
                            Không tìm thấy công việc nào.
                        </p>
                        @if(request('search') || request('status') || request('priority') || request('deadline'))
                            <a href="/tasks" class="reset-filter-btn" style="margin-top: 15px; display: inline-flex;">
                                <i class="fa-solid fa-rotate-left"></i> Xóa bộ lọc tìm kiếm
                            </a>
                        @else
                            <a href="/tasks/create" class="empty-cta-btn">
                                <span class="empty-cta-icon"><i class="fa-solid fa-plus"></i></span>
                                <span class="empty-cta-text">Thêm công việc ngay</span>
                                <span class="empty-cta-arrow"><i class="fa-solid fa-arrow-right"></i></span>
                            </a>
                        @endif
                    </div>

                @endif
            </div>

            <!-- KANBAN VIEW -->
            <div id="taskKanbanView" style="display: none;">
                @if(isset($kanbanTasks) && $kanbanTasks->count() > 0)
                    @php
                        $pendingKanban = $kanbanTasks->where('status', 'Chưa làm');
                        $doingKanban = $kanbanTasks->where('status', 'Đang làm');
                        $completedKanban = $kanbanTasks->where('status', 'Hoàn thành');
                    @endphp

                    <div class="kanban-board-container">
                        <!-- CỘT: CHƯA LÀM -->
                        <div class="kanban-column">
                            <div class="kanban-column-header">
                                <div class="kanban-column-title">
                                    <i class="fa-regular fa-circle" style="color: #ea580c;"></i>
                                    <span>Chưa làm</span>
                                </div>
                                <span class="kanban-column-count">{{ $pendingKanban->count() }}</span>
                            </div>
                            <div class="kanban-column-body" data-status="Chưa làm">
                                @foreach($pendingKanban as $task)
                                    <div class="kanban-card" draggable="true" data-task-id="{{ $task->id }}" data-status="{{ $task->status }}">
                                        <div class="kanban-card-meta">
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
                                                @php
                                                    $deadline = \Carbon\Carbon::parse($task->deadline);
                                                    $today = \Carbon\Carbon::today();
                                                @endphp
                                                @if($task->status !== 'Hoàn thành' && $deadline->lt($today))
                                                    <span class="deadline-badge overdue" title="Hạn: {{ $deadline->format('d/m/Y') }}">
                                                        <i class="fa-solid fa-triangle-exclamation"></i>
                                                        {{ $deadline->format('d/m/Y') }}
                                                    </span>
                                                @elseif($task->status !== 'Hoàn thành' && $deadline->isToday())
                                                    <span class="deadline-badge today" title="Hạn: {{ $deadline->format('d/m/Y') }}">
                                                        <i class="fa-regular fa-clock"></i>
                                                        Hôm nay
                                                    </span>
                                                @else
                                                    <span class="deadline-badge normal" title="Hạn: {{ $deadline->format('d/m/Y') }}">
                                                        <i class="fa-regular fa-calendar"></i>
                                                        {{ $deadline->format('d/m/Y') }}
                                                    </span>
                                                @endif
                                            @endif
                                        </div>

                                        <a href="/tasks/{{ $task->id }}" class="kanban-card-title">
                                            {{ $task->title }}
                                        </a>

                                        @if(($task->checklists->count() > 0) || ($task->attachments->count() > 0))
                                            <div class="kanban-card-badges">
                                                @if($task->checklists->count() > 0)
                                                    @php
                                                        $completedChecklists = $task->checklists->where('is_completed', true)->count();
                                                        $totalChecklists = $task->checklists->count();
                                                    @endphp
                                                    <div class="kanban-card-badge-item" title="Checklist: {{ $completedChecklists }}/{{ $totalChecklists }} hoàn thành">
                                                        <i class="fa-regular fa-square-check"></i>
                                                        <span>{{ $completedChecklists }}/{{ $totalChecklists }}</span>
                                                    </div>
                                                @endif

                                                @if($task->attachments->count() > 0)
                                                    <div class="kanban-card-badge-item" title="File đính kèm: {{ $task->attachments->count() }} file">
                                                        <i class="fa-solid fa-paperclip"></i>
                                                        <span>{{ $task->attachments->count() }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- CỘT: ĐANG LÀM -->
                        <div class="kanban-column">
                            <div class="kanban-column-header">
                                <div class="kanban-column-title">
                                    <i class="fa-solid fa-spinner" style="color: #2563eb;"></i>
                                    <span>Đang làm</span>
                                </div>
                                <span class="kanban-column-count">{{ $doingKanban->count() }}</span>
                            </div>
                            <div class="kanban-column-body" data-status="Đang làm">
                                @foreach($doingKanban as $task)
                                    <div class="kanban-card" draggable="true" data-task-id="{{ $task->id }}" data-status="{{ $task->status }}">
                                        <div class="kanban-card-meta">
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
                                                @php
                                                    $deadline = \Carbon\Carbon::parse($task->deadline);
                                                    $today = \Carbon\Carbon::today();
                                                @endphp
                                                @if($task->status !== 'Hoàn thành' && $deadline->lt($today))
                                                    <span class="deadline-badge overdue" title="Hạn: {{ $deadline->format('d/m/Y') }}">
                                                        <i class="fa-solid fa-triangle-exclamation"></i>
                                                        {{ $deadline->format('d/m/Y') }}
                                                    </span>
                                                @elseif($task->status !== 'Hoàn thành' && $deadline->isToday())
                                                    <span class="deadline-badge today" title="Hạn: {{ $deadline->format('d/m/Y') }}">
                                                        <i class="fa-regular fa-clock"></i>
                                                        Hôm nay
                                                    </span>
                                                @else
                                                    <span class="deadline-badge normal" title="Hạn: {{ $deadline->format('d/m/Y') }}">
                                                        <i class="fa-regular fa-calendar"></i>
                                                        {{ $deadline->format('d/m/Y') }}
                                                    </span>
                                                @endif
                                            @endif
                                        </div>

                                        <a href="/tasks/{{ $task->id }}" class="kanban-card-title">
                                            {{ $task->title }}
                                        </a>

                                        @if(($task->checklists->count() > 0) || ($task->attachments->count() > 0))
                                            <div class="kanban-card-badges">
                                                @if($task->checklists->count() > 0)
                                                    @php
                                                        $completedChecklists = $task->checklists->where('is_completed', true)->count();
                                                        $totalChecklists = $task->checklists->count();
                                                    @endphp
                                                    <div class="kanban-card-badge-item" title="Checklist: {{ $completedChecklists }}/{{ $totalChecklists }} hoàn thành">
                                                        <i class="fa-regular fa-square-check"></i>
                                                        <span>{{ $completedChecklists }}/{{ $totalChecklists }}</span>
                                                    </div>
                                                @endif

                                                @if($task->attachments->count() > 0)
                                                    <div class="kanban-card-badge-item" title="File đính kèm: {{ $task->attachments->count() }} file">
                                                        <i class="fa-solid fa-paperclip"></i>
                                                        <span>{{ $task->attachments->count() }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- CỘT: HOÀN THÀNH -->
                        <div class="kanban-column">
                            <div class="kanban-column-header">
                                <div class="kanban-column-title">
                                    <i class="fa-regular fa-circle-check" style="color: #059669;"></i>
                                    <span>Hoàn thành</span>
                                </div>
                                <span class="kanban-column-count">{{ $completedKanban->count() }}</span>
                            </div>
                            <div class="kanban-column-body" data-status="Hoàn thành">
                                @foreach($completedKanban as $task)
                                    <div class="kanban-card" draggable="true" data-task-id="{{ $task->id }}" data-status="{{ $task->status }}">
                                        <div class="kanban-card-meta">
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
                                                @php
                                                    $deadline = \Carbon\Carbon::parse($task->deadline);
                                                    $today = \Carbon\Carbon::today();
                                                @endphp
                                                @if($task->status !== 'Hoàn thành' && $deadline->lt($today))
                                                    <span class="deadline-badge overdue" title="Hạn: {{ $deadline->format('d/m/Y') }}">
                                                        <i class="fa-solid fa-triangle-exclamation"></i>
                                                        {{ $deadline->format('d/m/Y') }}
                                                    </span>
                                                @elseif($task->status !== 'Hoàn thành' && $deadline->isToday())
                                                    <span class="deadline-badge today" title="Hạn: {{ $deadline->format('d/m/Y') }}">
                                                        <i class="fa-regular fa-clock"></i>
                                                        Hôm nay
                                                    </span>
                                                @else
                                                    <span class="deadline-badge normal" title="Hạn: {{ $deadline->format('d/m/Y') }}">
                                                        <i class="fa-regular fa-calendar"></i>
                                                        {{ $deadline->format('d/m/Y') }}
                                                    </span>
                                                @endif
                                            @endif
                                        </div>

                                        <a href="/tasks/{{ $task->id }}" class="kanban-card-title">
                                            {{ $task->title }}
                                        </a>

                                        @if(($task->checklists->count() > 0) || ($task->attachments->count() > 0))
                                            <div class="kanban-card-badges">
                                                @if($task->checklists->count() > 0)
                                                    @php
                                                        $completedChecklists = $task->checklists->where('is_completed', true)->count();
                                                        $totalChecklists = $task->checklists->count();
                                                    @endphp
                                                    <div class="kanban-card-badge-item" title="Checklist: {{ $completedChecklists }}/{{ $totalChecklists }} hoàn thành">
                                                        <i class="fa-regular fa-square-check"></i>
                                                        <span>{{ $completedChecklists }}/{{ $totalChecklists }}</span>
                                                    </div>
                                                @endif

                                                @if($task->attachments->count() > 0)
                                                    <div class="kanban-card-badge-item" title="File đính kèm: {{ $task->attachments->count() }} file">
                                                        <i class="fa-solid fa-paperclip"></i>
                                                        <span>{{ $task->attachments->count() }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <div class="empty">
                        <i class="fa-regular fa-folder-open"></i>
                        <p>
                            Không tìm thấy công việc nào.
                        </p>
                        @if(request('search') || request('status') || request('priority') || request('deadline'))
                            <a href="/tasks" class="reset-filter-btn" style="margin-top: 15px; display: inline-flex;">
                                <i class="fa-solid fa-rotate-left"></i> Xóa bộ lọc tìm kiếm
                            </a>
                        @else
                            <a href="/tasks/create" class="empty-cta-btn">
                                <span class="empty-cta-icon"><i class="fa-solid fa-plus"></i></span>
                                <span class="empty-cta-text">Thêm công việc ngay</span>
                                <span class="empty-cta-arrow"><i class="fa-solid fa-arrow-right"></i></span>
                            </a>
                        @endif
                    </div>
                @endif
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

        // View Mode Switcher logic
        function getSavedViewMode() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('view')) {
                return urlParams.get('view');
            }
            return localStorage.getItem('task_view_mode') || 'list';
        }

        function switchTaskView(mode) {
            const listView = document.getElementById('taskListView');
            const kanbanView = document.getElementById('taskKanbanView');
            const btnList = document.getElementById('btnViewList');
            const btnKanban = document.getElementById('btnViewKanban');

            if (mode === 'kanban') {
                if (listView) listView.style.display = 'none';
                if (kanbanView) kanbanView.style.display = 'block';
                if (btnList) btnList.classList.remove('active');
                if (btnKanban) btnKanban.classList.add('active');
                localStorage.setItem('task_view_mode', 'kanban');
            } else {
                if (kanbanView) kanbanView.style.display = 'none';
                if (listView) listView.style.display = 'block';
                if (btnKanban) btnKanban.classList.remove('active');
                if (btnList) btnList.classList.add('active');
                localStorage.setItem('task_view_mode', 'list');
            }
        }

        // Dynamic Toast Notification helper
        function showDynamicToast(message, type = 'success') {
            let container = document.getElementById('toastContainer');
            if (!container) {
                container = document.createElement('div');
                container.id = 'toastContainer';
                container.className = 'toast-container';
                document.body.appendChild(container);
            }

            const toast = document.createElement('div');
            toast.className = `toast ${type === 'error' ? 'toast-error' : ''}`;
            toast.innerHTML = `
                <div class="toast-icon">
                    <i class="fa-solid ${type === 'error' ? 'fa-circle-exclamation' : 'fa-circle-check'}"></i>
                </div>
                <div class="toast-content">${message}</div>
                <button type="button" class="toast-close" onclick="closeToast(this)">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            `;
            container.appendChild(toast);

            setTimeout(() => {
                toast.style.animation = 'fadeOut 0.3s forwards';
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }

        function updateKanbanCounts() {
            document.querySelectorAll('.kanban-column-body').forEach(colBody => {
                const count = colBody.querySelectorAll('.kanban-card').length;
                const countEl = colBody.closest('.kanban-column').querySelector('.kanban-column-count');
                if (countEl) countEl.textContent = count;
            });
        }

        // HTML5 Drag and Drop Handlers for Kanban Board
        document.addEventListener('DOMContentLoaded', function () {
            // Restore saved view mode
            const initialMode = getSavedViewMode();
            switchTaskView(initialMode);

            const cards = document.querySelectorAll('.kanban-card');
            const columns = document.querySelectorAll('.kanban-column-body');

            let draggedCard = null;
            let sourceStatus = null;

            cards.forEach(card => {
                card.addEventListener('dragstart', function(e) {
                    draggedCard = this;
                    sourceStatus = this.getAttribute('data-status');
                    this.classList.add('dragging');
                    e.dataTransfer.effectAllowed = 'move';
                    e.dataTransfer.setData('text/plain', this.getAttribute('data-task-id'));
                });

                card.addEventListener('dragend', function() {
                    this.classList.remove('dragging');
                    draggedCard = null;
                    sourceStatus = null;
                    columns.forEach(col => col.classList.remove('drag-over'));
                });
            });

            columns.forEach(column => {
                column.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    e.dataTransfer.dropEffect = 'move';
                    this.classList.add('drag-over');
                });

                column.addEventListener('dragleave', function(e) {
                    if (!this.contains(e.relatedTarget)) {
                        this.classList.remove('drag-over');
                    }
                });

                column.addEventListener('drop', async function(e) {
                    e.preventDefault();
                    this.classList.remove('drag-over');

                    if (!draggedCard) return;

                    const targetStatus = this.getAttribute('data-status');
                    if (targetStatus === sourceStatus) return;

                    const taskId = draggedCard.getAttribute('data-task-id');
                    const targetColumnBody = this;
                    const originalColumnBody = draggedCard.parentElement;

                    // Optimistic UI update
                    targetColumnBody.appendChild(draggedCard);
                    draggedCard.setAttribute('data-status', targetStatus);
                    updateKanbanCounts();

                    // Sync List View status select if table row exists
                    const listRow = document.querySelector(`tr[data-task-id="${taskId}"]`);
                    if (listRow) {
                        const statusSelect = listRow.querySelector('.quick-status-select');
                        if (statusSelect) {
                            statusSelect.value = targetStatus;
                            statusSelect.className = 'quick-status-select ' + (targetStatus === 'Hoàn thành' ? 'completed' : (targetStatus === 'Đang làm' ? 'doing' : 'pending'));
                        }
                    }

                    const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
                    const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

                    try {
                        const response = await fetch(`/tasks/${taskId}/status`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ status: targetStatus })
                        });

                        const data = await response.json();

                        if (response.ok && data.success) {
                            showDynamicToast(data.message || 'Cập nhật trạng thái công việc thành công!', 'success');
                        } else {
                            // Revert on failure or authorization error
                            originalColumnBody.appendChild(draggedCard);
                            draggedCard.setAttribute('data-status', sourceStatus);
                            updateKanbanCounts();
                            if (listRow) {
                                const statusSelect = listRow.querySelector('.quick-status-select');
                                if (statusSelect) {
                                    statusSelect.value = sourceStatus;
                                    statusSelect.className = 'quick-status-select ' + (sourceStatus === 'Hoàn thành' ? 'completed' : (sourceStatus === 'Đang làm' ? 'doing' : 'pending'));
                                }
                            }
                            showDynamicToast(data.message || 'Không thể cập nhật trạng thái!', 'error');
                        }
                    } catch (err) {
                        // Revert on network error
                        originalColumnBody.appendChild(draggedCard);
                        draggedCard.setAttribute('data-status', sourceStatus);
                        updateKanbanCounts();
                        if (listRow) {
                            const statusSelect = listRow.querySelector('.quick-status-select');
                            if (statusSelect) {
                                statusSelect.value = sourceStatus;
                                statusSelect.className = 'quick-status-select ' + (sourceStatus === 'Hoàn thành' ? 'completed' : (sourceStatus === 'Đang làm' ? 'doing' : 'pending'));
                            }
                        }
                        showDynamicToast('Lỗi kết nối mạng, vui lòng thử lại!', 'error');
                    }
                });
            });
        });
    </script>

</body>
</html>