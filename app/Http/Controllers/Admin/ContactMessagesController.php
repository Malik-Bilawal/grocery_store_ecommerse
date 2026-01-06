<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Http\Controllers\Controller;

class ContactMessagesController extends Controller
{
    public function index(){

        $messages = ContactMessage::all();
        return view('admin.contact', compact('messages'));
    }



public function destroy($id)
{
    $message = ContactMessage::findOrFail($id);
    $message->delete();

    return redirect()->back()->with('success', 'Message deleted successfully.');
}
}
