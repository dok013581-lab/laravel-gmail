<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TaskManager - Quản lý công việc</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="{{ asset('js/dark-mode.js') }}"></script>

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

        /* HERO BANNER SECTION */
        .hero-section {
            padding: 40px 8%;
            background: transparent;
        }

        .hero-banner {
            position: relative;
            max-width: 1240px;
            margin: 0 auto;
            background: linear-gradient(135deg, #eff6ff 0%, #e0e7ff 50%, #f0f9ff 100%);
            border: 1px solid #c7d2fe;
            border-radius: 28px;
            padding: 50px 45px;
            display: grid;
            grid-template-columns: 45% 55%;
            gap: 40px;
            align-items: center;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(37, 99, 235, 0.08);
        }

        .hero-banner-glow-1 {
            position: absolute;
            top: -60px;
            left: -60px;
            width: 280px;
            height: 280px;
            background: #3b82f6;
            opacity: 0.15;
            filter: blur(70px);
            border-radius: 50%;
            pointer-events: none;
        }

        .hero-banner-glow-2 {
            position: absolute;
            bottom: -60px;
            right: -60px;
            width: 320px;
            height: 320px;
            background: #8b5cf6;
            opacity: 0.15;
            filter: blur(80px);
            border-radius: 50%;
            pointer-events: none;
        }

        .hero-left {
            position: relative;
            z-index: 2;
            text-align: left;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #dbeafe;
            color: #1d4ed8;
            padding: 5px 12px;
            border-radius: 16px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 18px;
            box-shadow: 0 1px 4px rgba(37, 99, 235, 0.08);
        }

        .hero-left h1 {
            font-family: Arial, sans-serif;
            font-size: 54px;
            line-height: 1.08;
            letter-spacing: -1px;
            margin-bottom: 20px;
        }

        .hero-left h1 .title-line-1 {
            display: block;
            font-weight: 700;
            color: #0f172a;
        }

        .hero-left h1 .title-line-2 {
            display: block;
            font-weight: 800;
            color: #2563eb;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-left p {
            font-size: 17px;
            line-height: 1.6;
            color: #475569;
            margin-bottom: 32px;
            max-width: 480px;
        }

        .hero-buttons {
            display: flex;
            gap: 14px;
            align-items: center;
            flex-wrap: wrap;
        }

        .primary-btn,
        .secondary-btn {
            padding: 14px 24px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
        }

        .primary-btn {
            background: #2563eb;
            color: white;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.25);
            transition: all 0.2s ease;
        }

        .primary-btn:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
        }

        .secondary-btn {
            background: white;
            color: #334155;
            border: 1px solid #cbd5e1;
            transition: all 0.2s ease;
        }

        .secondary-btn:hover {
            background: #f8fafc;
            border-color: #94a3b8;
            transform: translateY(-2px);
        }

        .google-btn {
            width: 100%;
            max-width: 320px;
            height: 52px;

            position: relative;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 0 20px;

            background: #2563eb;
            color: white;

            border: 1px solid #2563eb;
            border-radius: 10px;

            font-size: 16px;
            font-weight: bold;

            text-decoration: none;

            transition: all 0.25s ease;
        }

        .google-btn:hover {
            background: #1d4ed8;
            border-color: #1d4ed8;
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.25);
            transform: translateY(-2px);
        }

        .google-icon {
            width: 20px;
            height: 20px;
        }

        .google-icon-circle {
            width: 36px;
            height: 36px;

            background: white;
            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            position: absolute;
            left: 8px;
        }

        /* Mockup Card Container */
        .hero-right {
            position: relative;
            z-index: 2;
            width: 100%;
        }

        .mockup-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.12), 0 4px 12px rgba(15, 23, 42, 0.04);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .mockup-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 25px 50px rgba(15, 23, 42, 0.16), 0 6px 16px rgba(15, 23, 42, 0.06);
        }

        /* Mockup Header */
        .mockup-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 16px;
            margin-bottom: 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .mockup-dots {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .mockup-dots .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .dot-red { background: #ef4444; }
        .dot-yellow { background: #f59e0b; }
        .dot-green { background: #10b981; }

        .mockup-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 700;
            color: #334155;
        }

        .mockup-live-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 700;
            color: #10b981;
            background: #ecfdf5;
            padding: 3px 8px;
            border-radius: 10px;
        }

        .mockup-live-badge i {
            font-size: 7px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { opacity: 0.4; }
            50% { opacity: 1; }
            100% { opacity: 0.4; }
        }

        /* Mockup Stats Grid */
        .mockup-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 20px;
        }

        .mockup-stat-item {
            background: #f8fafc;
            border: 1px solid #f1f5f9;
            border-radius: 12px;
            padding: 12px 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .mockup-stat-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }

        .icon-blue { background: #eff6ff; color: #2563eb; }
        .icon-amber { background: #fff7ed; color: #ea580c; }
        .icon-emerald { background: #ecfdf5; color: #10b981; }

        .mockup-stat-info {
            display: flex;
            flex-direction: column;
            text-align: left;
        }

        .mockup-stat-label {
            font-size: 11px;
            color: #64748b;
            font-weight: 600;
            white-space: nowrap;
        }

        .mockup-stat-val {
            font-size: 16px;
            font-weight: 800;
            color: #0f172a;
        }

        /* Mockup Progress Section & Mini Chart */
        .mockup-progress-section {
            background: #f8fafc;
            border: 1px solid #f1f5f9;
            border-radius: 14px;
            padding: 16px;
            margin-bottom: 20px;
        }

        .mockup-progress-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 12px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 10px;
        }

        .mockup-progress-title {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #475569;
        }

        .mockup-progress-pct {
            color: #2563eb;
            font-weight: 800;
        }

        .mockup-progress-track {
            height: 8px;
            background: #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 16px;
        }

        .mockup-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #2563eb 0%, #10b981 100%);
            border-radius: 10px;
        }

        .mockup-chart-visual {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            height: 48px;
            gap: 8px;
            padding-top: 8px;
            border-top: 1px dashed #e2e8f0;
        }

        .mockup-chart-bar {
            flex: 1;
            background: #cbd5e1;
            border-radius: 4px 4px 0 0;
            transition: height 0.3s ease, background 0.3s ease;
        }

        .mockup-chart-bar.active,
        .mockup-chart-bar:hover {
            background: #2563eb;
        }

        /* Mockup Task Items */
        .mockup-tasks-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .mockup-task-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 14px;
            background: #ffffff;
            border: 1px solid #f1f5f9;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .mockup-task-item:hover {
            background: #f8fafc;
            border-color: #e2e8f0;
        }

        .mockup-task-left {
            display: flex;
            align-items: center;
            gap: 10px;
            text-align: left;
        }

        .mockup-checkbox {
            width: 18px;
            height: 18px;
            border-radius: 5px;
            border: 2px solid #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: white;
            flex-shrink: 0;
        }

        .mockup-checkbox.checked {
            background: #10b981;
            border-color: #10b981;
        }

        .mockup-task-name {
            font-size: 13px;
            font-weight: 600;
            color: #1e293b;
        }

        .mockup-task-name.completed {
            text-decoration: line-through;
            color: #94a3b8;
        }

        .mockup-task-badges {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .mockup-badge {
            font-size: 11px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 6px;
        }

        .badge-done { background: #ecfdf5; color: #047857; }
        .badge-doing { background: #eff6ff; color: #1d4ed8; }
        .badge-todo { background: #f1f5f9; color: #64748b; }
        .badge-high { background: #fef2f2; color: #b91c1c; }
        .badge-medium { background: #fff7ed; color: #c2410c; }

        /* FEATURES */
        .features {
            padding: 80px 8%;
            background: transparent;
            text-align: center;
        }

        .features-container {
            max-width: 1240px;
            margin: 0 auto;
        }

        .features-title {
             font-family: Arial, sans-serif;
            font-size: 32px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }

        .features-subtitle {
            font-size: 16px;
            color: #64748b;
            margin-bottom: 50px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.5;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            align-items: stretch;
        }

        .feature-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 30px 28px;
            text-align: left;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
            border-color: #cbd5e1;
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            background: #eff6ff;
            color: #2563eb;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 20px;
            transition: background 0.25s ease;
            flex-shrink: 0;
        }

        .feature-card:hover .feature-icon {
            background: #dbeafe;
        }

        .feature-card h3 {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 10px;
            line-height: 1.3;
        }

        .feature-card p {
            font-size: 14.5px;
            line-height: 1.6;
            color: #64748b;
            margin: 0;
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
        @media (max-width: 1024px) {
            .hero-section {
                padding: 30px 4%;
            }

            .hero-banner {
                grid-template-columns: 1fr;
                gap: 35px;
                padding: 40px 30px;
                text-align: center;
            }

            .hero-left {
                text-align: center;
            }

            .hero-left h1 {
                font-size: 44px;
            }

            .hero-left p {
                margin: 0 auto 30px auto;
            }

            .hero-buttons {
                justify-content: center;
            }

            .feature-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }

            .nav-links {
                gap: 12px;
            }
        }

        @media (max-width: 640px) {
            .hero-section {
                padding: 20px 3%;
            }

            .hero-banner {
                padding: 28px 18px;
                border-radius: 20px;
            }

            .hero-left h1 {
                font-size: 36px;
                letter-spacing: -0.5px;
            }

            .hero-left p {
                font-size: 15px;
            }

            .mockup-card {
                padding: 16px;
            }

            .mockup-stats {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .features {
                padding: 50px 4%;
            }

            .features-title {
                font-size: 26px;
            }

            .features-subtitle {
                font-size: 14px;
                margin-bottom: 35px;
            }

            .feature-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .feature-card {
                padding: 24px;
                border-radius: 18px;
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
        }

        /* NOTIFICATION CENTER (Home) */
        .notif-container {
            position: relative;
            display: inline-block;
        }

        .notif-bell-btn {
            position: relative;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #111827;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.2s ease;
            outline: none;
        }

        .notif-bell-btn:hover {
            background: rgba(255, 255, 255, 0.25);
        }
        .dark-mode .notif-bell-btn {
            color: #ffffff;
        }

        .notif-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: #ef4444;
            color: #ffffff;
            font-size: 10px;
            font-weight: 800;
            padding: 2px 5px;
            border-radius: 10px;
            min-width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #ffffff;
        }

        .notif-dropdown {
            position: absolute;
            top: 48px;
            right: 0;
            width: 340px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(15, 23, 42, 0.15);
            border: 1px solid #e2e8f0;
            z-index: 9999;
            display: none;
            overflow: hidden;
        }

        .notif-dropdown.show {
            display: block;
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
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .notif-count-pill {
            background: #2563eb;
            color: #ffffff;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 10px;
        }

        .notif-list {
            max-height: 300px;
            overflow-y: auto;
        }

        .notif-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 18px;
            border-bottom: 1px solid #f8fafc;
            text-decoration: none;
            color: #1e293b;
            transition: background 0.15s ease;
        }

        .notif-item:hover {
            background: #f8fafc;
        }

        .notif-icon-circle {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
            background: #f1f5f9;
            color: #64748b;
        }

        .notif-item.overdue .notif-icon-circle {
            background: #fef2f2;
            color: #ef4444;
        }

        .notif-item.upcoming .notif-icon-circle {
            background: #fff7ed;
            color: #f59e0b;
        }

        .notif-info {
            flex: 1;
            min-width: 0;
        }

        .notif-title {
            font-size: 13px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 3px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
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
            display: block;
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
        /* TOAST NOTIFICATION */
.toast-container {
    position: fixed;
    top: 25px;
    right: 25px;
    z-index: 99999;
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
    animation: slideIn 0.35s ease forwards;
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
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeOut {
    from {
        opacity: 1;
        transform: translateX(0);
    }
    to {
        opacity: 0;
        transform: translateX(30px);
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

            <a href="{{ Route::has('home') ? route('home') : '/' }}">Trang chủ</a>

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

    <button type="button" class="dark-mode-toggle" id="darkModeToggle" style="margin-left: 10px;">
        <i class="fa-solid fa-moon"></i>
        <span class="toggle-text">Giao diện tối</span>
    </button>

    <a href="/logout" class="logout-btn">
        <i class="fa-solid fa-right-from-bracket"></i>
        Đăng xuất
    </a>

@else

    <button type="button" class="dark-mode-toggle" id="darkModeToggle" style="margin-left: 10px;">
        <i class="fa-solid fa-moon"></i>
        <span class="toggle-text">Giao diện tối</span>
    </button>

    <a href="/login" class="login-btn">
        Đăng nhập
    </a>

@endauth

</nav>

    </header>


    <!-- HERO BANNER SECTION -->
    <section class="hero-section">
        <div class="hero-banner">
            <!-- Decorative Glow Backgrounds -->
            <div class="hero-banner-glow-1"></div>
            <div class="hero-banner-glow-2"></div>

            <!-- Left Content -->
            <div class="hero-left">
                <span class="hero-badge">
                    <i class="fa-solid fa-layer-group"></i>
                    TASK MANAGEMENT
                </span>

                @auth
                    <h1>
                        Xin chào,
                        <span>{{ Auth::user()->name }}</span> 👋
                    </h1>

                    <p>
                        Chào mừng bạn quay trở lại TaskManager.
                        Hãy tiếp tục quản lý công việc và theo dõi tiến độ của bạn.
                    </p>

                    <div class="hero-buttons">
                        <a href="/tasks" class="primary-btn">
                            <i class="fa-solid fa-list-check"></i>
                            Quản lý công việc
                        </a>

                        <a href="/dashboard" class="secondary-btn">
                            <i class="fa-solid fa-chart-line"></i>
                            Xem tổng quan
                        </a>
                    </div>
                @else
                    <h1>
                        <span class="title-line-1">Quản lý công việc</span>
                        <span class="title-line-2">thông minh hơn.</span>
                    </h1>

                    <p>
                        Tập trung công việc, theo dõi tiến độ và kiểm soát deadline trong một nơi.
                    </p>

                    <div class="hero-buttons">
                        <a href="/login" class="google-btn">
                            <span class="google-icon-circle">
                                <svg class="google-icon" viewBox="0 0 24 24">
                                    <path fill="#4285F4" d="M21.35 12.27c0-.79-.07-1.55-.23-2.27H12v4.3h5.24a4.48 4.48 0 0 1-1.94 2.94v2.45h3.14c1.84-1.69 2.91-4.18 2.91-7.42z"/>
                                    <path fill="#34A853" d="M12 21.5c2.63 0 4.84-.87 6.45-2.36l-3.14-2.45c-.87.58-1.98.92-3.31.92-2.54 0-4.69-1.72-5.46-4.03H3.3v2.53A9.74 9.74 0 0 0 12 21.5z"/>
                                    <path fill="#FBBC05" d="M6.54 13.58A5.85 5.85 0 0 1 6.23 12c0-.55.11-1.08.31-1.58V7.89H3.3A9.75 9.75 0 0 0 2.25 12c0 1.57.38 3.06 1.05 4.11l3.24-2.53z"/>
                                    <path fill="#EA4335" d="M12 6.39c1.43 0 2.72.49 3.73 1.46l2.8-2.8C16.84 3.5 14.63 2.5 12 2.5a9.74 9.74 0 0 0-8.7 5.39l3.24 2.53C7.31 8.11 9.46 6.39 12 6.39z"/>
                                </svg>
                            </span>
                            Đăng nhập bằng Google
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Right Dashboard Mockup -->
            <div class="hero-right">
                <div class="mockup-card">
                    <!-- Mockup Header -->
                    <div class="mockup-header">
                        <div class="mockup-dots">
                            <span class="dot dot-red"></span>
                            <span class="dot dot-yellow"></span>
                            <span class="dot dot-green"></span>
                        </div>
                        <div class="mockup-title">
                            <i class="fa-solid fa-chart-pie" style="color: #2563eb;"></i>
                            <span>Dashboard</span>
                        </div>
                        <span class="mockup-live-badge"><i class="fa-solid fa-circle"></i> Live Demo</span>
                    </div>

                    <!-- Mockup Stats Grid -->
                    <div class="mockup-stats">
                        <div class="mockup-stat-item">
                            <div class="mockup-stat-icon icon-blue">
                                <i class="fa-solid fa-list-check"></i>
                            </div>
                            <div class="mockup-stat-info">
                                <span class="mockup-stat-label">Tổng công việc</span>
                                <span class="mockup-stat-val">12</span>
                            </div>
                        </div>

                        <div class="mockup-stat-item">
                            <div class="mockup-stat-icon icon-amber">
                                <i class="fa-solid fa-spinner"></i>
                            </div>
                            <div class="mockup-stat-info">
                                <span class="mockup-stat-label">Đang làm</span>
                                <span class="mockup-stat-val">4</span>
                            </div>
                        </div>

                        <div class="mockup-stat-item">
                            <div class="mockup-stat-icon icon-emerald">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <div class="mockup-stat-info">
                                <span class="mockup-stat-label">Hoàn thành</span>
                                <span class="mockup-stat-val">8</span>
                            </div>
                        </div>
                    </div>

                    <!-- Mockup Progress Section & Mini Chart -->
                    <div class="mockup-progress-section">
                        <div class="mockup-progress-header">
                            <span class="mockup-progress-title">
                                <i class="fa-solid fa-bars-progress"></i> Tiến độ hoàn thành
                            </span>
                            <span class="mockup-progress-pct">67%</span>
                        </div>
                        <div class="mockup-progress-track">
                            <div class="mockup-progress-fill" style="width: 67%;"></div>
                        </div>

                        <div class="mockup-chart-visual">
                            <span class="mockup-chart-bar" style="height: 45%;" title="Thứ 2"></span>
                            <span class="mockup-chart-bar" style="height: 70%;" title="Thứ 3"></span>
                            <span class="mockup-chart-bar" style="height: 55%;" title="Thứ 4"></span>
                            <span class="mockup-chart-bar" style="height: 90%;" title="Thứ 5"></span>
                            <span class="mockup-chart-bar active" style="height: 100%;" title="Thứ 6"></span>
                            <span class="mockup-chart-bar" style="height: 60%;" title="Thứ 7"></span>
                        </div>
                    </div>

                    <!-- Mockup Tasks List -->
                    <div class="mockup-tasks-list">
                        <div class="mockup-task-item">
                            <div class="mockup-task-left">
                                <div class="mockup-checkbox checked">
                                    <i class="fa-solid fa-check"></i>
                                </div>
                                <span class="mockup-task-name completed">Thiết kế giao diện Dashboard</span>
                            </div>
                            <div class="mockup-task-badges">
                                <span class="mockup-badge badge-high">Cao</span>
                                <span class="mockup-badge badge-done">Hoàn thành</span>
                            </div>
                        </div>

                        <div class="mockup-task-item">
                            <div class="mockup-task-left">
                                <div class="mockup-checkbox"></div>
                                <span class="mockup-task-name">Cập nhật tài liệu API v2</span>
                            </div>
                            <div class="mockup-task-badges">
                                <span class="mockup-badge badge-medium">Vừa</span>
                                <span class="mockup-badge badge-doing">Đang làm</span>
                            </div>
                        </div>

                        <div class="mockup-task-item">
                            <div class="mockup-task-left">
                                <div class="mockup-checkbox"></div>
                                <span class="mockup-task-name">Kiểm thử giao diện Kanban</span>
                            </div>
                            <div class="mockup-task-badges">
                                <span class="mockup-badge badge-todo">Chưa làm</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- FEATURES -->
    <section class="features" id="features">
        <div class="features-container">
            <h2 class="features-title">Mọi thứ bạn cần để quản lý công việc</h2>
            <p class="features-subtitle">
                Đơn giản, trực quan và phù hợp cho công việc hằng ngày.
            </p>

            <div class="feature-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <h3>Quản lý công việc</h3>
                    <p>
                        Tạo, chỉnh sửa, phân loại và theo dõi công việc dễ dàng.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa-solid fa-chart-pie"></i>
                    </div>
                    <h3>Dashboard trực quan</h3>
                    <p>
                        Theo dõi tiến độ, trạng thái, mức độ ưu tiên và deadline.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa-solid fa-table-columns"></i>
                    </div>
                    <h3>Kanban Board</h3>
                    <p>
                        Kéo thả công việc giữa các trạng thái một cách trực quan.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa-solid fa-square-check"></i>
                    </div>
                    <h3>Checklist</h3>
                    <p>
                        Chia nhỏ công việc thành các bước và theo dõi tiến độ hoàn thành.
                    </p>
                </div>
            </div>
        </div>
    </section>


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