@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <div class="flex items-center gap-4 mb-2">
        <a href="{{ route('admin.designs.index') }}" class="text-slate-400 hover:text-slate-600">
            <i data-lucide="arrow-right" class="w-5 h-5"></i>
        </a>
        <h1 class="text-2xl font-bold text-slate-800">تعديل التصميم</h1>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 max-w-2xl">
    <form action="{{ route('admin.designs.update', $design) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div class="mb-6">
            <label class="block text-sm font-medium text-slate-700 mb-2">
                عنوان التصميم <span class="text-red-500">*</span>
            </label>
            <input
                type="text"
                name="title"
                value="{{ old('title', $design->title) }}"
                class="w-full border rounded-lg px-4 py-2.5 focus:outline-none focus:border-orange-500 transition bg-slate-50 {{ $errors->has('title') ? 'border-red-400 bg-red-50' : 'border-slate-200' }}"
            >
            @error('title')
                <p class="field-error mt-1">
                    <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Subtitle --}}
        <div class="mb-6">
            <label class="block text-sm font-medium text-slate-700 mb-2">وصف قصير</label>
            <input
                type="text"
                name="subtitle"
                value="{{ old('subtitle', $design->subtitle) }}"
                class="w-full border rounded-lg px-4 py-2.5 focus:outline-none focus:border-orange-500 transition bg-slate-50 {{ $errors->has('subtitle') ? 'border-red-400 bg-red-50' : 'border-slate-200' }}"
                placeholder="مثال: تصميم كلاسيكي راقي"
            >
            @error('subtitle')
                <p class="field-error mt-1">
                    <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Image --}}
        <div class="mb-6">
            <label class="block text-sm font-medium text-slate-700 mb-2">صورة التصميم</label>

            @if($design->image)
                <div class="mb-4 p-3 bg-slate-50 rounded-xl border border-slate-200 flex items-start gap-4">
                    <img src="{{ Storage::url($design->image) }}" class="h-24 w-20 object-cover rounded-lg shadow-sm flex-shrink-0">
                    <div>
                        <p class="text-sm font-semibold text-slate-700 mb-1">الصورة الحالية</p>
                        <p class="text-xs text-slate-500">ارفع صورة جديدة لاستبدالها، أو اتركها كما هي</p>
                    </div>
                </div>
            @endif

            {{-- Drop Zone --}}
            <div id="drop-zone"
                class="relative border-2 border-dashed rounded-xl p-6 text-center cursor-pointer transition-all
                       {{ $errors->has('image') ? 'border-red-400 bg-red-50' : 'border-slate-200 hover:border-orange-400 bg-slate-50' }}">
                <input type="file" id="image-input" name="image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                <div id="drop-placeholder">
                    <i data-lucide="upload-cloud" class="w-10 h-10 mx-auto text-slate-400 mb-2"></i>
                    <p class="text-sm font-medium text-slate-600">اسحب صورة جديدة هنا أو انقر للاختيار</p>
                    <p class="text-xs text-slate-400 mt-1">PNG, JPG, WEBP — الحجم الأقصى 5MB (سيتم ضغطها تلقائياً)</p>
                </div>
                <div id="image-preview" class="hidden">
                    <img id="preview-img" src="" alt="معاينة" class="max-h-48 mx-auto rounded-lg shadow">
                    <p id="preview-name" class="text-xs text-slate-500 mt-2"></p>
                    <button type="button" onclick="clearImage()" class="mt-2 text-xs text-red-500 hover:text-red-700 font-medium flex items-center gap-1 mx-auto">
                        <i data-lucide="x" class="w-3 h-3"></i> إزالة الاختيار
                    </button>
                </div>
            </div>

            @error('image')
                <p class="field-error mt-2">
                    <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Admin-only Notes & Link --}}
        <div class="mb-6 bg-amber-50 border border-amber-200 rounded-xl p-4 space-y-4">
            <p class="text-xs font-bold text-amber-700 flex items-center gap-1.5">
                <i data-lucide="lock" class="w-3.5 h-3.5"></i>
                حقول خاصة بالأدمن — لا تظهر للعملاء
            </p>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">ملاحظة</label>
                <textarea name="notes" rows="2" placeholder="ملاحظات خاصة عن هذا التصميم..."
                    class="w-full border border-amber-200 rounded-lg px-4 py-2.5 bg-white focus:outline-none focus:border-orange-500 transition resize-none">{{ old('notes', $design->notes) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">رابط مرجعي</label>
                <input type="url" name="link" value="{{ old('link', $design->link) }}"
                    placeholder="https://..." dir="ltr"
                    class="w-full border border-amber-200 rounded-lg px-4 py-2.5 bg-white focus:outline-none focus:border-orange-500 transition">
                @error('link')
                    <p class="field-error mt-1"><i data-lucide="alert-circle" class="w-3.5 h-3.5"></i> {{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- is_active --}}
        <div class="mb-8">
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" name="is_active" value="1"
                    {{ old('is_active', $design->is_active) ? 'checked' : '' }}
                    class="w-5 h-5 text-orange-500 rounded border-slate-300 focus:ring-orange-500">
                <span class="text-slate-700 font-medium">تفعيل وعرض في الصفحة الرئيسية</span>
            </label>
        </div>

        <div class="flex gap-4">
            <button type="submit"
                class="bg-orange-500 text-white px-6 py-2.5 rounded-lg font-bold hover:bg-orange-600 transition flex items-center gap-2">
                <i data-lucide="save" class="w-4 h-4"></i>
                تحديث التصميم
            </button>
            <a href="{{ route('admin.designs.index') }}"
                class="bg-slate-100 text-slate-600 px-6 py-2.5 rounded-lg font-bold hover:bg-slate-200 transition">
                إلغاء
            </a>
        </div>
    </form>
</div>

@push('scripts')
<script>
    const input   = document.getElementById('image-input');
    const preview = document.getElementById('image-preview');
    const holder  = document.getElementById('drop-placeholder');
    const img     = document.getElementById('preview-img');
    const name    = document.getElementById('preview-name');

    input.addEventListener('change', function () {
        showPreview(this.files[0]);
    });

    function showPreview(file) {
        if (!file) return;
        const maxMB  = 5;
        const allowed = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];

        if (!allowed.includes(file.type)) {
            showToast('نوع الملف غير مسموح به. يُسمح فقط بـ JPG, PNG, WEBP', 'error');
            clearImage(); return;
        }
        if (file.size > maxMB * 1024 * 1024) {
            showToast(`حجم الصورة كبير جداً (${(file.size / 1024 / 1024).toFixed(1)} MB). الحد الأقصى ${maxMB} MB`, 'warning');
            clearImage(); return;
        }

        const reader = new FileReader();
        reader.onload = e => {
            img.src = e.target.result;
            name.textContent = file.name + ' (' + (file.size / 1024).toFixed(0) + ' KB)';
            preview.classList.remove('hidden');
            holder.classList.add('hidden');
            lucide.createIcons({ nodes: [preview] });
            showToast('سيتم ضغط الصورة وتحويلها إلى WebP تلقائياً عند الحفظ 🗜️', 'info', 4000);
        };
        reader.readAsDataURL(file);
    }

    function clearImage() {
        input.value = '';
        img.src = '';
        preview.classList.add('hidden');
        holder.classList.remove('hidden');
    }

    const zone = document.getElementById('drop-zone');
    zone.addEventListener('dragover', e => { e.preventDefault(); zone.classList.add('border-orange-400','bg-orange-50'); });
    zone.addEventListener('dragleave', ()  => { zone.classList.remove('border-orange-400','bg-orange-50'); });
    zone.addEventListener('drop', e => {
        e.preventDefault();
        zone.classList.remove('border-orange-400','bg-orange-50');
        if (e.dataTransfer.files.length) {
            input.files = e.dataTransfer.files;
            showPreview(e.dataTransfer.files[0]);
        }
    });
</script>
@endpush
@endsection
