@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">التصميمات</h1>
        <p class="text-slate-500 text-sm">إدارة تصاميم بطاقات المناسبات</p>
    </div>
    <button onclick="openAddModal()" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2.5 rounded-lg font-bold flex items-center gap-2 transition shadow-sm">
        <i data-lucide="plus" class="w-4 h-4"></i>
        إضافة تصميم
    </button>
</div>

{{-- Search Bar --}}
<div class="mb-6 relative">
    <span class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400">
        <i data-lucide="search" class="w-4 h-4"></i>
    </span>
    <input type="text" id="search-input" placeholder="ابحث عن تصميم..."
        class="w-full max-w-sm border border-slate-200 bg-white rounded-lg pr-10 pl-4 py-2.5 text-sm focus:outline-none focus:border-orange-400 transition">
</div>

{{-- Table --}}
<div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
    <table class="w-full text-right" id="designs-table">
        <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 text-sm">
            <tr>
                <th class="px-5 py-3 font-medium">الصورة</th>
                <th class="px-5 py-3 font-medium">العنوان</th>
                <th class="px-5 py-3 font-medium">الوصف</th>
                <th class="px-5 py-3 font-medium">ملاحظات (Admin)</th>
                <th class="px-5 py-3 font-medium">الحالة</th>
                <th class="px-5 py-3 font-medium text-center">إجراءات</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-sm" id="designs-body">
            @forelse($designs as $design)
            <tr class="hover:bg-slate-50 transition design-row" data-title="{{ strtolower($design->title) }} {{ strtolower($design->subtitle) }}">
                <td class="px-5 py-3">
                    @if($design->image)
                        <img src="{{ Storage::url($design->image) }}" class="w-10 h-14 object-cover rounded shadow-sm">
                    @else
                        <div class="w-10 h-14 bg-slate-100 rounded flex items-center justify-center text-slate-300">
                            <i data-lucide="image" class="w-5 h-5"></i>
                        </div>
                    @endif
                </td>
                <td class="px-5 py-3 font-bold text-slate-800">{{ $design->title }}</td>
                <td class="px-5 py-3 text-slate-500">{{ $design->subtitle ?? '-' }}</td>
                <td class="px-5 py-3 max-w-xs">
                    @if($design->notes || $design->link)
                        <div class="flex flex-col gap-1">
                            @if($design->notes)
                                <span class="text-xs text-amber-700 bg-amber-50 px-2 py-1 rounded border border-amber-200 line-clamp-2">
                                    📝 {{ $design->notes }}
                                </span>
                            @endif
                            @if($design->link)
                                <a href="{{ $design->link }}" target="_blank" class="text-xs text-blue-600 hover:underline flex items-center gap-1 truncate">
                                    <i data-lucide="link" class="w-3 h-3 flex-shrink-0"></i>
                                    {{ $design->link }}
                                </a>
                            @endif
                        </div>
                    @else
                        <span class="text-slate-300">-</span>
                    @endif
                </td>
                <td class="px-5 py-3">
                    @if($design->is_active)
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-bold">مفعّل</span>
                    @else
                        <span class="bg-slate-100 text-slate-500 px-2 py-1 rounded-full text-xs">معطّل</span>
                    @endif
                </td>
                <td class="px-5 py-3">
                    <div class="flex items-center justify-center gap-1">
                        <button onclick='openEditModal(@json($design))' class="text-blue-500 hover:bg-blue-50 p-2 rounded-lg transition" title="تعديل">
                            <i data-lucide="edit-2" class="w-4 h-4"></i>
                        </button>
                        <form action="{{ route('admin.designs.destroy', $design) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا التصميم؟')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:bg-red-50 p-2 rounded-lg transition" title="حذف">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr id="empty-row">
                <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                    <i data-lucide="image-off" class="w-10 h-10 mx-auto mb-3 opacity-30"></i>
                    <p>لا توجد تصميمات بعد. أضف أول تصميم!</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div id="no-results" class="hidden px-6 py-8 text-center text-slate-400 text-sm">لا توجد نتائج مطابقة للبحث</div>
</div>

{{-- ====================== MODAL ====================== --}}
<div id="design-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal()"></div>

    {{-- Modal Box --}}
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto z-10">
        {{-- Header --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100 sticky top-0 bg-white rounded-t-2xl z-10">
            <h2 id="modal-title" class="text-lg font-bold text-slate-800">إضافة تصميم جديد</h2>
            <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600 hover:bg-slate-100 p-2 rounded-lg transition">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        {{-- Form --}}
        <form id="design-form" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
            @csrf
            <input type="hidden" name="_method" id="form-method" value="POST">

            {{-- Title --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">عنوان التصميم <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="field-title" required placeholder="مثال: دعوة زفاف"
                    class="w-full border border-slate-200 rounded-lg px-4 py-2.5 bg-slate-50 focus:outline-none focus:border-orange-500 transition text-sm">
            </div>

            {{-- Subtitle --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">وصف قصير</label>
                <input type="text" name="subtitle" id="field-subtitle" placeholder="مثال: تصميم كلاسيكي راقي"
                    class="w-full border border-slate-200 rounded-lg px-4 py-2.5 bg-slate-50 focus:outline-none focus:border-orange-500 transition text-sm">
            </div>

            {{-- Image Drop Zone --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">صورة التصميم</label>
                <div id="modal-current-img" class="hidden mb-3 p-3 bg-slate-50 border border-slate-200 rounded-xl flex items-center gap-4">
                    <img id="current-img-tag" src="" class="h-20 w-14 object-cover rounded-lg shadow-sm">
                    <div>
                        <p class="text-xs font-semibold text-slate-700 mb-0.5">الصورة الحالية</p>
                        <p class="text-xs text-slate-400">ارفع صورة جديدة لاستبدالها</p>
                    </div>
                </div>
                <div id="drop-zone"
                    class="relative border-2 border-dashed border-slate-200 hover:border-orange-400 rounded-xl p-5 text-center cursor-pointer transition-all bg-slate-50">
                    <input type="file" id="image-input" name="image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <div id="drop-placeholder">
                        <i data-lucide="upload-cloud" class="w-8 h-8 mx-auto text-slate-400 mb-1.5"></i>
                        <p class="text-sm font-medium text-slate-600">اسحب الصورة هنا أو انقر للاختيار</p>
                        <p class="text-xs text-slate-400 mt-1">PNG, JPG, WEBP — حتى 10MB (سيتم ضغطها تلقائياً)</p>
                    </div>
                    <div id="drop-preview" class="hidden">
                        <img id="preview-img" src="" class="max-h-40 mx-auto rounded-lg shadow mb-2">
                        <p id="preview-name" class="text-xs text-slate-500"></p>
                        <button type="button" onclick="clearImage(event)" class="mt-1 text-xs text-red-500 hover:text-red-700 font-medium">✕ إزالة الاختيار</button>
                    </div>
                </div>
            </div>

            {{-- Admin Notes --}}
            <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 space-y-3">
                <p class="text-xs font-bold text-amber-700 flex items-center gap-1.5">
                    <i data-lucide="lock" class="w-3.5 h-3.5"></i>
                    حقول خاصة بالأدمن — لا تظهر للعملاء
                </p>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">ملاحظة</label>
                    <textarea name="notes" id="field-notes" rows="2" placeholder="ملاحظات خاصة عن هذا التصميم..."
                        class="w-full border border-amber-200 rounded-lg px-4 py-2.5 bg-white focus:outline-none focus:border-orange-500 transition text-sm resize-none"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">رابط مرجعي</label>
                    <input type="url" name="link" id="field-link" placeholder="https://..."
                        class="w-full border border-amber-200 rounded-lg px-4 py-2.5 bg-white focus:outline-none focus:border-orange-500 transition text-sm" dir="ltr">
                </div>
            </div>

            {{-- is_active --}}
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" name="is_active" id="field-active" value="1" checked class="w-5 h-5 text-orange-500 rounded border-slate-300">
                <span class="text-sm font-medium text-slate-700">تفعيل وعرض في الصفحة الرئيسية</span>
            </label>

            {{-- Buttons --}}
            <div class="flex gap-3 pt-2 border-t border-slate-100">
                <button type="submit" class="bg-orange-500 text-white px-6 py-2.5 rounded-lg font-bold hover:bg-orange-600 transition flex items-center gap-2 text-sm">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    <span id="submit-btn-text">حفظ التصميم</span>
                </button>
                <button type="button" onclick="closeModal()" class="bg-slate-100 text-slate-600 px-6 py-2.5 rounded-lg font-bold hover:bg-slate-200 transition text-sm">إلغاء</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
const modal    = document.getElementById('design-modal');
const form     = document.getElementById('design-form');
const baseUrl  = "{{ route('admin.designs.index') }}";

function openAddModal() {
    document.getElementById('modal-title').textContent    = 'إضافة تصميم جديد';
    document.getElementById('submit-btn-text').textContent = 'حفظ التصميم';
    document.getElementById('form-method').value          = 'POST';
    form.action = "{{ route('admin.designs.store') }}";
    clearFormFields();
    document.getElementById('modal-current-img').classList.add('hidden');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function openEditModal(design) {
    document.getElementById('modal-title').textContent    = 'تعديل التصميم';
    document.getElementById('submit-btn-text').textContent = 'تحديث التصميم';
    document.getElementById('form-method').value          = 'PUT';
    form.action = baseUrl + '/' + design.id;

    document.getElementById('field-title').value    = design.title    || '';
    document.getElementById('field-subtitle').value = design.subtitle || '';
    document.getElementById('field-notes').value    = design.notes    || '';
    document.getElementById('field-link').value     = design.link     || '';
    document.getElementById('field-active').checked = design.is_active == 1;

    if (design.image) {
        document.getElementById('current-img-tag').src = '/storage/' + design.image;
        document.getElementById('modal-current-img').classList.remove('hidden');
    } else {
        document.getElementById('modal-current-img').classList.add('hidden');
    }

    clearImage(null);
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeModal() {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function clearFormFields() {
    form.reset();
    clearImage(null);
}

// Image preview
const imgInput  = document.getElementById('image-input');
const dropZone  = document.getElementById('drop-zone');
const dropPrev  = document.getElementById('drop-preview');
const dropHold  = document.getElementById('drop-placeholder');
const prevImg   = document.getElementById('preview-img');
const prevName  = document.getElementById('preview-name');

imgInput.addEventListener('change', () => handleFile(imgInput.files[0]));

function handleFile(file) {
    if (!file) return;
    const allowed = ['image/jpeg','image/png','image/jpg','image/webp'];
    if (!allowed.includes(file.type)) { showToast('نوع الملف غير مسموح. يُسمح بـ JPG, PNG, WEBP فقط', 'error'); return; }
    if (file.size > 10 * 1024 * 1024) { showToast('حجم الصورة يتجاوز 10MB', 'warning'); return; }
    const reader = new FileReader();
    reader.onload = e => {
        prevImg.src = e.target.result;
        prevName.textContent = file.name + ' (' + (file.size / 1024).toFixed(0) + ' KB)';
        dropPrev.classList.remove('hidden');
        dropHold.classList.add('hidden');
        showToast('سيتم ضغط الصورة تلقائياً عند الحفظ 🗜️', 'info', 3000);
    };
    reader.readAsDataURL(file);
}

function clearImage(e) {
    if (e) e.preventDefault();
    imgInput.value = '';
    prevImg.src    = '';
    dropPrev.classList.add('hidden');
    dropHold.classList.remove('hidden');
}

dropZone.addEventListener('dragover',  e => { e.preventDefault(); dropZone.classList.add('border-orange-400','bg-orange-50'); });
dropZone.addEventListener('dragleave', () => dropZone.classList.remove('border-orange-400','bg-orange-50'));
dropZone.addEventListener('drop', e => {
    e.preventDefault();
    dropZone.classList.remove('border-orange-400','bg-orange-50');
    if (e.dataTransfer.files.length) { imgInput.files = e.dataTransfer.files; handleFile(e.dataTransfer.files[0]); }
});

// Search
document.getElementById('search-input').addEventListener('input', function () {
    const q    = this.value.toLowerCase().trim();
    const rows = document.querySelectorAll('.design-row');
    let   vis  = 0;
    rows.forEach(row => {
        const match = row.dataset.title.includes(q);
        row.classList.toggle('hidden', !match);
        if (match) vis++;
    });
    document.getElementById('no-results').classList.toggle('hidden', vis > 0 || q === '');
});

// Close on Escape
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
</script>
@endpush
@endsection
