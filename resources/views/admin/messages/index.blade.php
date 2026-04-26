@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-800">الرسائل</h1>
    <p class="text-slate-500">رسائل العملاء المرسلة من نموذج التواصل</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
    <table class="w-full text-right">
        <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 text-sm">
            <tr>
                <th class="px-6 py-3 font-medium">الاسم</th>
                <th class="px-6 py-3 font-medium">البريد الإلكتروني</th>
                <th class="px-6 py-3 font-medium">المناسبة</th>
                <th class="px-6 py-3 font-medium">التاريخ</th>
                <th class="px-6 py-3 font-medium">الحالة</th>
                <th class="px-6 py-3 font-medium text-center">إجراءات</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-sm">
            @forelse($messages as $msg)
            <tr class="hover:bg-slate-50 transition {{ !$msg->is_read ? 'bg-orange-50/30' : '' }}">
                <td class="px-6 py-4 font-bold text-slate-800">{{ $msg->name }}</td>
                <td class="px-6 py-4 text-slate-500">{{ $msg->email }}</td>
                <td class="px-6 py-4 text-slate-500">{{ $msg->occasion ?? '-' }}</td>
                <td class="px-6 py-4 text-slate-500" dir="ltr">{{ $msg->created_at->format('Y-m-d g:i A') }}</td>
                <td class="px-6 py-4">
                    @if($msg->is_read)
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-medium">مقروءة</span>
                    @else
                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-bold animate-pulse">جديدة</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center justify-center gap-2">
                        <a href="{{ route('admin.messages.show', $msg) }}" class="text-blue-500 hover:bg-blue-50 p-2 rounded transition" title="عرض التفاصيل">
                            <i data-lucide="eye" class="w-4 h-4"></i>
                        </a>
                        @if(!$msg->is_read)
                            <form action="{{ route('admin.messages.read', $msg) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-green-500 hover:bg-green-50 p-2 rounded transition" title="تحديد كمقروءة">
                                    <i data-lucide="check" class="w-4 h-4"></i>
                                </button>
                            </form>
                        @endif
                        <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:bg-red-50 p-2 rounded transition">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-8 text-center text-slate-500">لا توجد رسائل حالياً</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
