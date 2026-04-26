<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Design;
use App\Models\ContactMessage;

class AdminController extends Controller
{
    public function index()
    {
        $designsCount = Design::count();
        $messagesCount = ContactMessage::count();
        $unreadMessagesCount = ContactMessage::where('is_read', false)->count();
        
        $recentMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact('designsCount', 'messagesCount', 'unreadMessagesCount', 'recentMessages'));
    }
}
