<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;



class ChatController extends Controller
{
    
    public function index()
{
       
    $user = Auth::user();
    $otherUser = null;
    $messages = null;
    $users = [];

    if ($user->isPatient()) {
        $appointments = Appointment::where('patient_id', $user->user_id)->get();
        $doctorIds = $appointments->pluck('doctor_id')->unique();
        $users = User::whereIn('user_id', $doctorIds)
            ->where('role', 'doctor')
            ->get();
    } elseif ($user->isDoctor()) {
        $appointments = Appointment::where('doctor_id', $user->user_id)->get();
        $patientIds = $appointments->pluck('patient_id')->unique();
        $users = User::whereIn('user_id', $patientIds)
            ->where('role', 'patient')
            ->get();
    }

    return view('chat', compact('users', 'user', 'otherUser', 'messages'));
   
}


    public function sendMessage(Request $request)
    {
        $user = auth()->user();
        $receiverId = $request->input('receiver_id');
    
        $message = new Message();
        $message->user_id = $user->id;
        $message->receiver_id = $receiverId;
        $message->content = $request->input('message');
        $message->save();
    
        event(new MessageSent($message, $user));
    
        return response()->json(['success' => true]);
    }
        public function getMessages(Request $request)
    {
        $userId = $request->input('user_id');
        $messages = Message::where(function ($query) use ($userId) {
            $query->where('user_id', auth()->id())
                ->where('receiver_id', $userId)
                ->orWhere('user_id', $userId)
                ->where('receiver_id', auth()->id());
        })->orderBy('created_at', 'asc')->get();

        return response()->json(['success' => true, 'messages' => $messages]);
    }
}