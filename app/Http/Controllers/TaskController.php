<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskAttachment;
use App\Models\TaskChecklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class TaskController extends Controller
{
    // Hiển thị danh sách công việc
    public function index(Request $request)
    {
        $query = auth()->user()->tasks();

        // Tìm kiếm theo tên công việc
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

// Lọc theo mức độ ưu tiên
if ($request->filled('priority')) {
    $query->where('priority', $request->priority);
}

if ($request->filled('deadline')) {

    if ($request->deadline === 'today') {

        $query->whereDate('deadline', today());

    } elseif ($request->deadline === 'upcoming') {

        $query->whereBetween('deadline', [
            today(),
            today()->addDays(7)
        ]);

    } elseif ($request->deadline === 'overdue') {

        $query->whereDate('deadline', '<', today())
              ->where('status', '!=', 'Hoàn thành');
    }
}

        $overdueCount = auth()->user()->tasks()
            ->whereDate('deadline', '<', today())
            ->where('status', '!=', 'Hoàn thành')
            ->count();

        $upcomingCount = auth()->user()->tasks()
            ->whereBetween('deadline', [today(), today()->addDays(7)])
            ->where('status', '!=', 'Hoàn thành')
            ->count();

        // Xử lý sắp xếp công việc
        if ($request->filled('sort')) {
            if ($request->sort === 'deadline_asc') {
                $query->orderByRaw('CASE WHEN deadline IS NULL THEN 1 ELSE 0 END, deadline ASC')->orderBy('id', 'desc');
            } elseif ($request->sort === 'priority_desc') {
                $query->orderByRaw("CASE priority WHEN 'Cao' THEN 1 WHEN 'Trung bình' THEN 2 WHEN 'Thấp' THEN 3 ELSE 4 END ASC")->orderBy('id', 'desc');
            } else {
                $query->latest();
            }
        } else {
            $query->latest();
        }

        $tasks = $query->paginate(10)->withQueryString();

        return view('tasks.index', compact('tasks', 'overdueCount', 'upcomingCount'));
    }

    // Hiển thị form thêm công việc
    public function create()
    {
        return view('tasks.create');
    }

    // Lưu công việc vào database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Chưa làm,Đang làm,Hoàn thành',
            'priority' => 'required|in:Thấp,Trung bình,Cao',
            'deadline' => 'nullable|date_format:d/m/Y',
            'attachments.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:5120',
        ], [
            'attachments.*.mimes' => 'File đính kèm chỉ chấp nhận định dạng: PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG.',
            'attachments.*.max' => 'Dung lượng mỗi file đính kèm không được vượt quá 5MB.',
        ]);

        $task = auth()->user()->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'priority' => $request->priority,
            'deadline' => $request->deadline
                ? Carbon::createFromFormat('d/m/Y', $request->deadline)->format('Y-m-d')
                : null,
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                if ($file->isValid()) {
                    $path = $file->store('attachments', 'public');
                    $task->attachments()->create([
                        'original_name' => $file->getClientOriginalName(),
                        'file_path' => $path,
                        'file_size' => $file->getSize(),
                        'mime_type' => $file->getClientMimeType(),
                    ]);
                }
            }
        }

        return redirect('/tasks')->with('success', 'Thêm công việc thành công!');
    }

    // Hiển thị chi tiết công việc
    public function show(Task $task)
    {
        abort_unless($task->user_id === auth()->id(), 403);
        $task->load(['attachments', 'checklists']);

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        abort_unless($task->user_id === auth()->id(), 403);
        $task->load('attachments');

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        abort_unless($task->user_id === auth()->id(), 403);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Chưa làm,Đang làm,Hoàn thành',
            'priority' => 'required|in:Thấp,Trung bình,Cao',
            'deadline' => 'nullable|date_format:d/m/Y',
            'attachments.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:5120',
        ], [
            'attachments.*.mimes' => 'File đính kèm chỉ chấp nhận định dạng: PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG.',
            'attachments.*.max' => 'Dung lượng mỗi file đính kèm không được vượt quá 5MB.',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'priority' => $request->priority,
            'deadline' => $request->deadline
                ? Carbon::createFromFormat('d/m/Y', $request->deadline)->format('Y-m-d')
                : null,
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                if ($file->isValid()) {
                    $path = $file->store('attachments', 'public');
                    $task->attachments()->create([
                        'original_name' => $file->getClientOriginalName(),
                        'file_path' => $path,
                        'file_size' => $file->getSize(),
                        'mime_type' => $file->getClientMimeType(),
                    ]);
                }
            }
        }

        return redirect('/tasks')->with('success', 'Cập nhật công việc thành công!');
    }

    public function updateStatus(Request $request, Task $task)
    {
        abort_unless($task->user_id === auth()->id(), 403);

        $request->validate([
            'status' => 'required|in:Chưa làm,Đang làm,Hoàn thành',
        ]);

        $task->update([
            'status' => $request->status,
        ]);

        $request->session()->flash('success', 'Cập nhật trạng thái công việc thành công!');

        return redirect()->back();
    }

    public function destroy(Task $task)
    {
        abort_unless($task->user_id === auth()->id(), 403);

        foreach ($task->attachments as $attachment) {
            if (Storage::disk('public')->exists($attachment->file_path)) {
                Storage::disk('public')->delete($attachment->file_path);
            }
        }

        $task->delete();

        return redirect('/tasks')->with('success', 'Xóa công việc thành công!');
    }

    public function downloadAttachment(Task $task, TaskAttachment $attachment)
    {
        abort_unless($task->user_id === auth()->id() && $attachment->task_id === $task->id, 403);

        if (!Storage::disk('public')->exists($attachment->file_path)) {
            abort(404, 'File không tồn tại trên hệ thống.');
        }

        return Storage::disk('public')->download($attachment->file_path, $attachment->original_name);
    }

    public function destroyAttachment(Task $task, TaskAttachment $attachment)
    {
        abort_unless($task->user_id === auth()->id() && $attachment->task_id === $task->id, 403);

        if (Storage::disk('public')->exists($attachment->file_path)) {
            Storage::disk('public')->delete($attachment->file_path);
        }

        $attachment->delete();

        return redirect()->back()->with('success', 'Xóa file đính kèm thành công!');
    }

    // Task Checklist Methods
    public function storeChecklist(Request $request, Task $task)
    {
        abort_unless($task->user_id === auth()->id(), 403);

        $request->validate([
            'title' => 'required|string|max:255',
        ], [
            'title.required' => 'Vui lòng nhập tên mục checklist.',
            'title.max' => 'Tên mục checklist không được vượt quá 255 ký tự.',
        ]);

        $task->checklists()->create([
            'title' => trim($request->title),
            'is_completed' => false,
        ]);

        return redirect()->back()->with('success', 'Thêm mục checklist thành công!');
    }

    public function updateChecklist(Request $request, Task $task, TaskChecklist $checklist)
    {
        abort_unless($task->user_id === auth()->id() && $checklist->task_id === $task->id, 403);

        $request->validate([
            'title' => 'required|string|max:255',
        ], [
            'title.required' => 'Vui lòng nhập tên mục checklist.',
            'title.max' => 'Tên mục checklist không được vượt quá 255 ký tự.',
        ]);

        $checklist->update([
            'title' => trim($request->title),
        ]);

        return redirect()->back()->with('success', 'Cập nhật mục checklist thành công!');
    }

    public function toggleChecklist(Task $task, TaskChecklist $checklist)
    {
        abort_unless($task->user_id === auth()->id() && $checklist->task_id === $task->id, 403);

        $checklist->update([
            'is_completed' => !$checklist->is_completed,
        ]);

        $statusText = $checklist->is_completed ? 'Đã hoàn thành mục checklist!' : 'Đã bỏ hoàn thành mục checklist!';

        return redirect()->back()->with('success', $statusText);
    }

    public function destroyChecklist(Task $task, TaskChecklist $checklist)
    {
        abort_unless($task->user_id === auth()->id() && $checklist->task_id === $task->id, 403);

        $checklist->delete();

        return redirect()->back()->with('success', 'Xóa mục checklist thành công!');
    }
}