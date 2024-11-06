<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chatroom;
use App\Models\Message;
class ChatroomController extends Controller
{
    public function createChatroom(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'max_members' => 'required|integer|min:2',
    ]);
    $chatroom = Chatroom::create($request->only('name', 'max_members'));

    return response()->json($chatroom, 201);
}
public function listChatrooms()
{
    return response()->json(Chatroom::withCount('users')->get());
}
public function enterChatroom(Request $request, $id)
{
    $chatroom = Chatroom::findOrFail($id);

    if ($chatroom->users()->count() >= $chatroom->max_members) {
        return response()->json(['error' => 'Chatroom is full'], 403);
    }

    $chatroom->users()->attach($request->user()->id);

    return response()->json(['message' => 'Joined chatroom']);
}
public function leaveChatroom(Request $request, $id)
{
    $chatroom = Chatroom::findOrFail($id);
    $chatroom->users()->detach($request->user()->id);

    return response()->json(['message' => 'Left chatroom']);
}
public function sendMessage(Request $request, $id)
{
    $request->validate([
        'message' => 'nullable|string',
        'attachment' => 'nullable|file'
    ]);

    $chatroom = Chatroom::findOrFail($id);

    $attachmentPath = null;
    if ($request->hasFile('attachment')) {
        $attachmentPath = $request->file('attachment')->store('attachments');
    }

    $message = $chatroom->messages()->create([
        'user_id' => $request->user()->id,
        'message' => $request->message,
        'attachment_path' => $attachmentPath
    ]);

    broadcast(new MessageSent($chatroom, $message))->toOthers();

    return response()->json($message, 201);
}
public function listMessages($id)
{
    $messages = Message::where('chatroom_id', $id)->with('user')->paginate(20);

    return response()->json($messages);
}
}
