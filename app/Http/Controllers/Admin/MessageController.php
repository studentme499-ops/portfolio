<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $items = Message::query()
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->when($request->q, fn ($q) => $q->where(fn ($w) => $w->where('name', 'like', "%{$request->q}%")->orWhere('email', 'like', "%{$request->q}%")->orWhere('subject', 'like', "%{$request->q}%")))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.messages.index', ['items' => $items]);
    }

    public function show(Message $message)
    {
        if ($message->status === 'unread') {
            $message->update(['status' => 'read', 'read_at' => now()]);
        }

        return view('admin.messages.show', ['item' => $message]);
    }

    public function update(Request $request, Message $message)
    {
        $validated = $request->validate([
            'status' => 'required|in:unread,read,replied,archived,spam',
            'reply' => 'nullable|string',
        ]);

        $message->update($validated);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Updated',
            'entity_type' => 'message',
            'entity_id' => $message->id,
            'description' => "Updated message to {$validated['status']}",
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.messages.show', $message)->with('status', 'Message updated.');
    }

    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')->with('status', 'Message deleted.');
    }
}