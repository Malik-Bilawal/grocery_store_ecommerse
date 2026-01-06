<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index(){
        return view('user.contact');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:120',
            'last_name'  => 'nullable|string|max:120',
            'email'      => 'nullable|email|max:255',
            'phone'      => 'nullable|string|max:30',
            'subject'    => 'nullable|string|max:255',
            'message'    => 'required|string',
        ]);
    
        $message = ContactMessage::create($data);
    
    
        return response()->json( 'Your message has been received. We will get back to you soon.');
    }
}
