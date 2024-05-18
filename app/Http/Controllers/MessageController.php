<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use DB;
class MessageController extends Controller
{
    public function index(){
        return view('frontend.message');
    }
    public function sendMessage(Request $request){
        DB::table('messages')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return back()->with('success', 'Message Sent!');
    }
    public function viewMessages(){
        $messages = DB::table('messages')->orderBy("created_at","desc")->paginate(5);
        return view('auth.viewMessages',['messages'=>$messages]);
    }
    public function deleteMessages($id){
        $msg = Message::find($id);
        $msg->delete();
        return redirect()->route("admin.messages")->with("success","Category Removed Successfully!");
    }
}
