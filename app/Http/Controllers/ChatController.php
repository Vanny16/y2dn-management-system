<?php
// app/Http/Controllers/DatabaseController.php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function allChats()
    {
        $user = auth()->user();
    }

    public function sendChat(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'recipient_id_2' => 'required',
            'message' => 'required|string',
        ]);

        dd($request->input('recipient_id_2'));
        DB::table('chats')
            ->insert([
                'cht_from' => $user->id,
                'cht_to' => $request->recipient_id,
                'cht_message' => $request->message,
                'cht_date' => DB::RAW('CURRENT_TIMESTAMP')
            ]);

        // // Create a new chat message
        // $chat = new Chat();
        // $chat->cht_from = auth()->id();
        // $chat->cht_to = $request->input('recipient_id');
        // $chat->cht_message = $request->input('message');
        // $chat->save();

        // Fetch the updated conversation data based on the recipient ID
        $recipientId = $request->recipient_id;
        $conversation = DB::table('chats')
            ->where(function ($query) use ($recipientId) {
                $query->where('cht_from', auth()->id())->where('cht_to', $recipientId);
            })
            ->orWhere(function ($query) use ($recipientId) {
                $query->where('cht_from', $recipientId)->where('cht_to', auth()->id());
            })
            ->orderBy('cht_date')
            ->get();

        // Return the conversation data as JSON response
        return response()->json($conversation);
    }

    public function loadConversation(Request $request)
    {
        // $user = auth()->user();

        // DB::table('chats')
        //     ->insert([
        //         'cht_from' => $user->id,
        //         // 'cht_to' => $user->id,
        //         // 'cht_message' => $message,
        //         'cht_date' => DB::RAW('CURRENT_TIMESTAMP')
        //     ]);

        // $userId = $user->id;

        $recipientId = $request->input('recipient_id');
        // dd($recipientId);
        // // Fetch conversation data from the database based on the recipient ID
        $conversation = DB::table('chats')
            ->where(function ($query) use ($recipientId) {
                $query->where('cht_from', auth()->id())->where('cht_to', $recipientId);
            })
            ->orWhere(function ($query) use ($recipientId) {
                $query->where('cht_from', $recipientId)->where('cht_to', auth()->id());
            })
            ->orderBy('cht_date')
            ->get();
        // $conversation = DB::table('chats')
        // ->where('cht_from', auth()->id())
        // ->orWhere('cht_to', auth()->id())
        // ->orderBy('cht_date')
        // ->get();

        // $latestMessageIds = DB::table('chats')
        //     ->select(DB::raw('GREATEST(cht_from, cht_to) as user1'), DB::raw('LEAST(cht_from, cht_to) as user2'), DB::raw('MAX(cht_id) as last_msg_id'))
        //     ->where('cht_deleted', 0)
        //     ->where(function ($q) use ($userId) {
        //         $q->where('cht_from', $userId)->orWhere('cht_to', $userId);
        //     })
        //     ->groupBy(DB::raw('GREATEST(cht_from, cht_to)'), DB::raw('LEAST(cht_from, cht_to)'))
        //     ->pluck('last_msg_id');

        // $recentChats = DB::table('chats as c')
        //     ->join('users', function ($join) use ($userId) {
        //         $join->on('users.id', '=', DB::raw("CASE WHEN c.cht_from = $userId THEN c.cht_to ELSE c.cht_from END"));
        //     })
        //     ->whereIn('c.cht_id', $latestMessageIds)
        //     ->select('c.cht_id', 'c.cht_from', 'c.cht_to', 'c.cht_message', 'c.cht_date', 'users.first_name', 'users.middle_name', 'users.last_name')
        //     ->orderBy('c.cht_date', 'desc')
        //     ->limit(3)
        //     ->get();

        // Return the conversation data as HTML
        // return view('partials.conversation', compact('conversation'));

        // $conversation = DB::table('chats')->take(5)->get();

        // $responseData = [
        //     'conversation' => $conversation,
        //     'recipient_id' => $recipientId
        // ];
        return response()->json($conversation);
        // return response()->json(['status' => 'success', 'message' => 'Route hit successfully']);
        // return view('profile', [
        //     'user' => $user,
        //     'chats' => $recentChats,
        //     'conversation' => $conversation
        // ])->render();
    }

    public function deleteMessage(Request $request)
    {
        $user = auth()->user();

        // DB::table('chats')
        //     ->insert([
        //         'cht_from' => $user->id,
        //         // 'cht_to' => $user->id,
        //         // 'cht_message' => $message,
        //         'cht_date' => DB::RAW('CURRENT_TIMESTAMP')
        //     ]);
    }

    public function deleteChat(Request $request)
    {
        $user = auth()->user();

        // DB::table('chats')
        //     ->insert([
        //         'cht_from' => $user->id,
        //         // 'cht_to' => $user->id,
        //         // 'cht_message' => $message,
        //         'cht_date' => DB::RAW('CURRENT_TIMESTAMP')
        //     ]);
    }
}
