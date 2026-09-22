<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TaskManager - Sửa công việc</title>

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

        .page-header {
            margin-bottom: 25px;
        }

        .page-header h1 {
            margin: 0 0 7px;

            font-size: 27px;
        }

        .page-header p {
            margin: 0;

            color: #6b7280;

            font-size: 14px;
        }

        /* CARD FORM */
        .card {
            max-width: 800px;

            background: white;

            border: 1px solid #e5e7eb;

            border-radius: 14px;

            padding: 32px;

            box-shadow: 0 3px 12px rgba(0,0,0,0.03);
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 22px;
        }

        label {
            display: flex;
            align-items: center;
            gap: 8px;

            margin-bottom: 8px;

            font-size: 14px;
            font-weight: bold;
            color: #374151;
        }

        label i {
            color: #2563eb;
            font-size: 13px;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 9px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #1f2937;
            background: #ffffff;
            outline: none;
            transition: all 0.2s ease;
        }

        textarea {
            min-height: 130px;
            resize: vertical;
        }

        input[type="text"]:focus,
        textarea:focus,
        select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
        }

        .error {
            margin-top: 6px;
            color: #dc2626;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .buttons {
            display: flex;
            gap: 12px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #f3f4f6;
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

        @media (max-width: 850px) {
            .form-grid {
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

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <div class="page-header" style="margin-bottom: 0;">
                <h1>
                    Sửa công việc
                </h1>
                <p>
                    Cập nhật thông tin công việc của bạn.
                </p>
            </div>
            <button type="button" class="dark-mode-toggle" id="darkModeToggle">
                <i class="fa-solid fa-moon"></i>
                <span class="toggle-text">Giao diện tối</span>
            </button>
        </div>

        <div class="card">

            <form action="/tasks/{{ $task->id }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">
                        <i class="fa-solid fa-pen"></i>
                        Tên công việc <span style="color: #dc2626;">*</span>
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $task->title) }}"
                        placeholder="Nhập tên công việc..."
                    >

                    @error('title')
                        <div class="error">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">
                        <i class="fa-solid fa-align-left"></i>
                        Mô tả công việc
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        placeholder="Nhập mô tả chi tiết công việc..."
                    >{{ old('description', $task->description) }}</textarea>

                    @error('description')
                        <div class="error">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-grid">

                    <div class="form-group" style="margin-bottom: 0;">
                        <label for="status">
                            <i class="fa-solid fa-list-progress"></i>
                            Trạng thái
                        </label>

                        <select id="status" name="status">
                            <option value="Chưa làm"
                                {{ old('status', $task->status) == 'Chưa làm' ? 'selected' : '' }}>
                                Chưa làm
                            </option>
                            <option value="Đang làm"
                                {{ old('status', $task->status) == 'Đang làm' ? 'selected' : '' }}>
                                Đang làm
                            </option>
                            <option value="Hoàn thành"
                                {{ old('status', $task->status) == 'Hoàn thành' ? 'selected' : '' }}>
                                Hoàn thành
                            </option>
                        </select>
                    </div>

                    <div class="form-group" style="margin-bottom: 0;">
                        <label for="priority">
                            <i class="fa-solid fa-layer-group"></i>
                            Mức độ ưu tiên
                        </label>

                        <select id="priority" name="priority">
                            <option value="Thấp"
                                {{ old('priority', $task->priority) == 'Thấp' ? 'selected' : '' }}>
                                Thấp
                            </option>
                            <option value="Trung bình"
                                {{ old('priority', $task->priority) == 'Trung bình' ? 'selected' : '' }}>
                                Trung bình
                            </option>
                            <option value="Cao"
                                {{ old('priority', $task->priority) == 'Cao' ? 'selected' : '' }}>
                                Cao
                            </option>
                        </select>
                    </div>

                    <div class="form-group" style="margin-bottom: 0;">
                        <label for="deadline">
                            <i class="fa-regular fa-calendar-days"></i>
                            Hạn hoàn thành
                        </label>

                        <input
                            type="text"
                            id="deadline"
                            name="deadline"
                            placeholder="dd/mm/yyyy"
                            maxlength="10"
                            value="{{ old('deadline', $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('d/m/Y') : '') }}"
                        >
                    </div>

                </div>

                <!-- ATTACHMENTS LIST & UPLOAD -->
                <div class="form-group" style="margin-top: 22px;">
                    <label for="attachments">
                        <i class="fa-solid fa-paperclip"></i>
                        File đính kèm
                    </label>

                    @if($task->attachments && count($task->attachments) > 0)
                        <div style="margin-bottom: 14px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px 16px;">
                            <strong style="font-size: 13px; color: #475569; display: block; margin-bottom: 8px;">File hiện có:</strong>
                            <div style="display: flex; flex-direction: column; gap: 8px;">
                                @foreach($task->attachments as $file)
                                    <div style="display: flex; align-items: center; justify-content: space-between; background: #ffffff; padding: 8px 12px; border-radius: 8px; border: 1px solid #e5e7eb;">
                                        <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: #1e293b;">
                                            <i class="fa-solid fa-file-lines" style="color: #2563eb;"></i>
                                            <span>{{ $file->original_name }}</span>
                                            <span style="color: #94a3b8; font-size: 11px;">({{ round($file->file_size / 1024, 1) }} KB)</span>
                                        </div>
                                        <a href="/tasks/{{ $task->id }}/attachments/{{ $file->id }}/download" style="color: #2563eb; text-decoration: none; font-size: 12px; font-weight: bold;">
                                            <i class="fa-solid fa-download"></i> Tải
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <input
                        type="file"
                        id="attachments"
                        name="attachments[]"
                        multiple
                        accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png"
                    >
                    <small style="display: block; margin-top: 6px; color: #6b7280; font-size: 12px;">
                        Tải thêm file (Hỗ trợ: PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG - Tối đa 5MB/file).
                    </small>

                    @error('attachments')
                        <div class="error">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            {{ $message }}
                        </div>
                    @enderror
                    @error('attachments.*')
                        <div class="error">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <script>
                document.getElementById('deadline').addEventListener('input', function (e) {
                    let input = this;
                    let cursor = input.selectionStart;
                    let oldValue = input.value;

                    let value = input.value.replace(/\D/g, '');

                    if (value.length > 2 && value.length <= 4) {
                        value = value.slice(0, 2) + '/' + value.slice(2);
                    } 
                    else if (value.length > 4) {
                        value = value.slice(0, 2) + '/' + value.slice(2, 4) + '/' + value.slice(4, 8);
                    }

                    input.value = value;

                    let difference = value.length - oldValue.length;
                    input.setSelectionRange(cursor + difference, cursor + difference);
                });
                </script>

                <div class="buttons">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Lưu thay đổi
                    </button>

                    <a href="/tasks" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i>
                        Quay lại
                    </a>
                </div>

            </form>

        </div>

    </main>

</body>
</html>