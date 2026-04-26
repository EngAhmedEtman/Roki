@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <div class="flex items-center gap-4 mb-2">
        <a href="{{ route('admin.messages.index') }}" class="text-slate-400 hover:text-slate-600">
            <i data-lucide="arrow-right" class="w-5 h-5"></i>
        </a>
        <h1 class="text-2xl font-bold text-slate-800">تفاصيل الرسالة</h1>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 max-w-2xl">
    <div class="flex justify-between items-start mb-6 pb-6 border-b border-slate-100">
        <div>
            <h2 class="text-xl font-bold text-slate-800 mb-1">{{ $message->name }}</h2>
            <div class="text-slate-500 flex items-center gap-2 text-sm">
                <i data-lucide="mail" class="w-4 h-4"></i>
                <a href="mailto:{{ $message->email }}" class="hover:text-blue-500 transition">{{ $message->email }}</a>
            </div>
        </div>
        <div class="text-left">
            <span class="text-slate-400 text-sm" dir="ltr">{{ $message->created_at->format('Y-m-d g:i A') }}</span>
        </div>
    </div>

    @if($message->occasion)
        <div class="mb-6">
            <span class="text-sm text-slate-500 block mb-1">نوع المناسبة:</span>
            <span class="bg-orange-50 text-orange-700 px-3 py-1 rounded-full text-sm font-medium">{{ $message->occasion }}</span>
        </div>
    @endif

    <div class="mb-8">
        <span class="text-sm text-slate-500 block mb-3">نص الرسالة:</span>
        <div class="bg-slate-50 border border-slate-100 rounded-lg p-5 text-slate-700 leading-relaxed whitespace-pre-wrap">
            {{ $message->message }}
        </div>
    </div>

    <div class="flex gap-4 border-t border-slate-100 pt-6">
        <a href="mailto:{{ $message->email }}" class="bg-blue-500 text-white px-6 py-2.5 rounded-lg font-bold hover:bg-blue-600 transition flex items-center gap-2">
            <i data-lucide="reply" class="w-4 h-4"></i>
            رد عبر البريد
        </a>
        
        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-50 text-red-600 px-6 py-2.5 rounded-lg font-bold hover:bg-red-100 transition flex items-center gap-2">
                <i data-lucide="trash-2" class="w-4 h-4"></i>
                حذف الرسالة
            </button>
        </form>
    </div>
</div>
@endsection
