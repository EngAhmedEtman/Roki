@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-800">الإعدادات</h1>
    <p class="text-slate-500">إعدادات الموقع والتواصل</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 max-w-4xl">
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- القسم الأول: إعدادات عامة -->
        <h2 class="text-lg font-bold text-slate-800 mb-4 pb-2 border-b border-slate-100">إعدادات عامة</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1.5 flex items-center gap-2">
                    <i data-lucide="image" class="w-4 h-4 text-brand-dark"></i> لوجو الموقع
                </label>
                @if(!empty($settings['site_logo']))
                    <div class="mb-2 p-2 bg-slate-50 border border-slate-200 rounded-lg inline-block">
                        <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Logo" class="h-8 object-contain">
                    </div>
                @endif
                <input type="file" name="site_logo" accept="image/*"
                    class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-600 hover:file:bg-orange-100 transition">
                @error('site_logo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <h2 class="text-lg font-bold text-slate-800 mb-4 pb-2 border-b border-slate-100">معلومات التواصل</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1.5 flex items-center gap-2">
                    <i data-lucide="mail" class="w-4 h-4 text-brand-dark"></i> البريد الإلكتروني
                </label>
                <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}"
                    placeholder="مثال: info@example.com" dir="ltr"
                    class="w-full border border-slate-200 rounded-lg px-4 py-2.5 bg-slate-50 focus:outline-none focus:border-brand-orange transition text-sm">
                @error('contact_email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1.5 flex items-center gap-2">
                    <i data-lucide="link" class="w-4 h-4 text-brand-dark"></i> رابط إرسال السكرين شوت (الصفحة)
                </label>
                <input type="url" name="contact_page_url" value="{{ old('contact_page_url', $settings['contact_page_url'] ?? '') }}"
                    placeholder="https://facebook.com/..." dir="ltr"
                    class="w-full border border-slate-200 rounded-lg px-4 py-2.5 bg-slate-50 focus:outline-none focus:border-brand-orange transition text-sm">
                @error('contact_page_url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                <p class="text-[10px] text-gray-400 mt-1">الرابط الذي يتم التوجيه إليه عند الضغط على "الصفحة" في التصميمات.</p>
            </div>
        </div>

        <!-- القسم الثاني: الواتساب -->
        <h2 class="text-lg font-bold text-slate-800 mb-4 pb-2 border-b border-slate-100">إعدادات الواتساب</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1.5 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    رقم الواتساب
                </label>
                <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number'] ?? '') }}"
                    placeholder="مثال: 201234567890" dir="ltr"
                    class="w-full border border-slate-200 rounded-lg px-4 py-2.5 bg-slate-50 focus:outline-none focus:border-green-500 transition text-sm">
                @error('whatsapp_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1.5">الرسالة التلقائية</label>
                <input type="text" name="whatsapp_message" value="{{ old('whatsapp_message', $settings['whatsapp_message'] ?? '') }}"
                    placeholder="مرحباً، أريد الاستفسار عن..."
                    class="w-full border border-slate-200 rounded-lg px-4 py-2.5 bg-slate-50 focus:outline-none focus:border-orange-500 transition text-sm">
                @error('whatsapp_message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- القسم الثالث: السوشيال ميديا -->
        <h2 class="text-lg font-bold text-slate-800 mb-4 pb-2 border-b border-slate-100">السوشيال ميديا (تظهر في الفوتر)</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1.5 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-pink-500" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    انستجرام
                </label>
                <input type="url" name="social_instagram" value="{{ old('social_instagram', $settings['social_instagram'] ?? '') }}"
                    placeholder="https://instagram.com/..." dir="ltr"
                    class="w-full border border-slate-200 rounded-lg px-4 py-2.5 bg-slate-50 focus:outline-none focus:border-brand-orange transition text-sm">
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1.5 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    فيسبوك
                </label>
                <input type="url" name="social_facebook" value="{{ old('social_facebook', $settings['social_facebook'] ?? '') }}"
                    placeholder="https://facebook.com/..." dir="ltr"
                    class="w-full border border-slate-200 rounded-lg px-4 py-2.5 bg-slate-50 focus:outline-none focus:border-brand-orange transition text-sm">
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1.5 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-black" viewBox="0 0 24 24" fill="currentColor"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93v7.2c0 1.63-.31 3.26-1.14 4.67-1.16 1.98-3.08 3.39-5.32 3.84-2.51.52-5.18-.04-7.14-1.61-1.78-1.43-2.88-3.48-2.98-5.74-.1-2.28 1-4.48 2.8-5.9 1.83-1.44 4.2-1.95 6.42-1.5.17.03.35.08.52.12v4.06c-1.3-.23-2.65-.05-3.8.61-1.1.63-1.89 1.7-2.11 2.94-.23 1.25.1 2.56.9 3.49.9.96 2.25 1.45 3.55 1.34 1.33-.12 2.53-.88 3.16-2.03.55-1 .82-2.15.82-3.3v-16.3z"/></svg>
                    تيك توك
                </label>
                <input type="url" name="social_tiktok" value="{{ old('social_tiktok', $settings['social_tiktok'] ?? '') }}"
                    placeholder="https://tiktok.com/@..." dir="ltr"
                    class="w-full border border-slate-200 rounded-lg px-4 py-2.5 bg-slate-50 focus:outline-none focus:border-brand-orange transition text-sm">
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1.5 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-800" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    منصة X
                </label>
                <input type="url" name="social_x" value="{{ old('social_x', $settings['social_x'] ?? '') }}"
                    placeholder="https://x.com/..." dir="ltr"
                    class="w-full border border-slate-200 rounded-lg px-4 py-2.5 bg-slate-50 focus:outline-none focus:border-brand-orange transition text-sm">
            </div>
        </div>

        <div class="flex justify-end pt-4 border-t border-slate-100">
            <button type="submit" class="bg-orange-500 text-white px-8 py-3 rounded-lg font-bold hover:bg-orange-600 transition flex items-center gap-2">
                <i data-lucide="save" class="w-4 h-4"></i>
                حفظ الإعدادات
            </button>
        </div>
    </form>
</div>
@endsection
