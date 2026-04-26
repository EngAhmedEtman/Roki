@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-800">الرئيسية</h1>
    <p class="text-slate-500">نظرة عامة على نشاط الموقع</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-6 border border-slate-100 flex items-center gap-4">
        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center">
            <i data-lucide="image" class="w-6 h-6"></i>
        </div>
        <div>
            <p class="text-sm text-slate-500 font-medium">إجمالي التصميمات</p>
            <h3 class="text-2xl font-bold text-slate-800">{{ $designsCount }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 border border-slate-100 flex items-center gap-4">
        <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-lg flex items-center justify-center">
            <i data-lucide="mail" class="w-6 h-6"></i>
        </div>
        <div>
            <p class="text-sm text-slate-500 font-medium">إجمالي الرسائل</p>
            <h3 class="text-2xl font-bold text-slate-800">{{ $messagesCount }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 border border-slate-100 flex items-center gap-4">
        <div class="w-12 h-12 bg-red-50 text-red-600 rounded-lg flex items-center justify-center">
            <i data-lucide="bell" class="w-6 h-6"></i>
        </div>
        <div>
            <p class="text-sm text-slate-500 font-medium">رسائل غير مقروءة</p>
            <h3 class="text-2xl font-bold text-slate-800">{{ $unreadMessagesCount }}</h3>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
        <h2 class="font-bold text-slate-800">أحدث الرسائل</h2>
        <a href="{{ route('admin.messages.index') }}" class="text-sm text-orange-600 hover:text-orange-700 font-medium">عرض الكل</a>
    </div>
    <div class="p-0">
        <table class="w-full text-right">
            <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 text-sm">
                <tr>
                    <th class="px-6 py-3 font-medium">الاسم</th>
                    <th class="px-6 py-3 font-medium">المناسبة</th>
                    <th class="px-6 py-3 font-medium">التاريخ</th>
                    <th class="px-6 py-3 font-medium">الحالة</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($recentMessages as $msg)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4 font-medium text-slate-800">{{ $msg->name }}</td>
                    <td class="px-6 py-4 text-slate-500">{{ $msg->occasion ?? '-' }}</td>
                    <td class="px-6 py-4 text-slate-500" dir="ltr">{{ $msg->created_at->format('Y-m-d') }}</td>
                    <td class="px-6 py-4">
                        @if($msg->is_read)
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">مقروءة</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-bold">جديدة</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-slate-500">لا توجد رسائل حالياً</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
