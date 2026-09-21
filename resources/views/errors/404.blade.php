<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Không tìm thấy trang | TaskManager</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f8fafc, #eff6ff);
            color: #1e2937;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .error-card {
            background: #ffffff;
            width: 100%;
            max-width: 520px;
            border-radius: 24px;
            padding: 45px 35px;
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.08);
            border: 1px solid #e2e8f0;
            text-align: center;
            animation: fadeIn 0.4s ease-out;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 30px;
            text-decoration: none;
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
            font-size: 18px;
        }

        .task-text {
            color: #111827;
        }

        .manager-text {
            color: #2563eb;
        }

        .icon-wrapper {
            width: 90px;
            height: 90px;
            margin: 0 auto 24px;
            background: #eff6ff;
            color: #2563eb;
            border: 1px solid #dbeafe;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.12);
        }

        .error-badge {
            display: inline-block;
            background: #eff6ff;
            color: #2563eb;
            font-size: 13px;
            font-weight: 700;
            padding: 5px 14px;
            border-radius: 20px;
            margin-bottom: 12px;
            letter-spacing: 0.5px;
        }

        h1 {
            font-size: 26px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 12px;
        }

        p {
            color: #64748b;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 32px;
        }

        .btn-group {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 13px 22px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: #2563eb;
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.25);
        }

        .btn-primary:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.35);
        }

        .btn-secondary {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #cbd5e1;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
            color: #1e293b;
            transform: translateY(-2px);
        }

        .footer-note {
            margin-top: 35px;
            font-size: 12px;
            color: #94a3b8;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 480px) {
            .error-card {
                padding: 35px 20px;
            }

            .btn-group {
                flex-direction: column;
                width: 100%;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <div class="error-card">
        <a href="/" class="brand">
            <div class="logo-icon">
                <i class="fa-solid fa-check"></i>
            </div>
            <div>
                <span class="task-text">Task</span><span class="manager-text">Manager</span>
            </div>
        </a>

        <div class="icon-wrapper">
            <i class="fa-solid fa-compass"></i>
        </div>

        <span class="error-badge">404 NOT FOUND</span>

        <h1>Trang không tồn tại</h1>

        <p>
            Đường dẫn bạn đang tìm kiếm không tồn tại, đã bị xóa hoặc có địa chỉ truy cập không chính xác.
        </p>

        <div class="btn-group">
            <a href="/" class="btn btn-primary">
                <i class="fa-solid fa-house"></i>
                Quay về Trang chủ
            </a>
            <a href="/tasks" class="btn btn-secondary">
                <i class="fa-solid fa-list-check"></i>
                Danh sách công việc
            </a>
        </div>

        <div class="footer-note">
            © 2026 TaskManager. All rights reserved.
        </div>
    </div>

</body>
</html>
