<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Design;
use App\Models\ContactMessage;

use App\Models\Analytics;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $designsCount = Design::count();
        $activeDesignsCount = Design::where('is_active', true)->count();
        $messagesCount = ContactMessage::count();
        $unreadMessagesCount = ContactMessage::where('is_read', false)->count();
        
        $activeUsers = Analytics::where('updated_at', '>=', now()->subMinutes(5))
            ->distinct('session_id')
            ->count('session_id');

        $topDesigns = Design::orderByDesc('views')->take(5)->get();

        $topSections = Analytics::where('event', 'section_view')
            ->select('value', DB::raw('count(*) as total'))
            ->groupBy('value')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        $recentMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact('designsCount', 'activeDesignsCount', 'messagesCount', 'unreadMessagesCount', 'activeUsers', 'topDesigns', 'topSections', 'recentMessages'));
    }
}
