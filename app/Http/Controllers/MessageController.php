<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function index()
    {
        return view("message/index")->with(["users" => User::all()]);
    }

    public function store(Request $request, Message $message)
    {
        $message->fill($request->all())->save();
        return redirect(route("messages.show", $message->reciever_id));
    }

    public function show($user_id)
    {
        // 送信者が自分で受信者がA、送信者がAで受信者が自分のデータを昇順で取得
        $messages = Message::where([["sender_id", auth()->id()], ["reciever_id", $user_id]])
            ->orWhere([["sender_id", $user_id], ["reciever_id", auth()->id()]])
            ->orderBy("created_at", "asc")->get();

        return view("message/show")->with(["reciever_id" => $user_id, "messages" => $messages]);
    }
}
