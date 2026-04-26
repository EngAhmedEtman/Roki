<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Designs - تصميم بطاقات مناسبات</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&family=Playfair+Display:ital,wght@1,600&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Tajawal', 'sans-serif'],
                            serif: ['Playfair Display', 'serif'],
                        },
                        colors: {
                            brand: {
                                dark: '#0F172A',
                                orange: '#E07A5F',
                                light: '#FAF9F6',
                                text: '#334155'
                            }
                        }
                    }
                }
            }
        </script>
    @endif
    <style>
        body { font-family: 'Tajawal', sans-serif; }
        .font-cursive { font-family: 'Playfair Display', serif; }
        .hero-bg { background: linear-gradient(180deg, #FFFFFF 0%, #FAF9F6 100%); }
    </style>
</head>
<body class="bg-brand-light text-brand-text antialiased">

    <!-- Navbar -->
    <nav class="bg-white sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex flex-col items-center">
                    @if(!empty($settings['site_logo']))
                        <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Logo" class="h-10 object-contain mb-1">
                    @else
                        <span class="font-cursive text-3xl text-brand-dark italic">Designs</span>
                    @endif
                    <span class="text-[10px] text-gray-500 font-medium">تصميم بطاقات مناسبات</span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8 space-x-reverse items-center">
                    <a href="#" class="text-brand-orange font-bold">الرئيسية</a>
                    <a href="#designs" class="text-gray-600 hover:text-brand-dark transition font-medium">التصميمات</a>
                    <a href="#features" class="text-gray-600 hover:text-brand-dark transition font-medium">مميزاتنا</a>
                    <a href="#about" class="text-gray-600 hover:text-brand-dark transition font-medium">عني</a>
                    <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}?text={{ urlencode($settings['whatsapp_message'] ?? 'مرحباً') }}" target="_blank" class="text-gray-600 hover:text-brand-dark transition font-medium">تواصل معي</a>
                </div>

                <!-- CTA Button -->
                <div class="hidden md:block">
                    <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}?text={{ urlencode($settings['whatsapp_message'] ?? 'مرحباً، أريد الاستفسار عن تصميم مخصص') }}" target="_blank" 
                       class="bg-brand-dark text-white px-6 py-2.5 rounded-lg flex items-center gap-2 hover:bg-gray-800 transition shadow-md font-medium">
                        <i data-lucide="pen-tool" class="w-4 h-4"></i>
                        اطلب تصميمك الآن
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-brand-dark hover:text-brand-orange focus:outline-none transition">
                        <i data-lucide="menu" class="w-7 h-7"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu (Hidden by default) -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 shadow-lg absolute w-full left-0">
            <div class="px-4 pt-4 pb-6 space-y-2 flex flex-col">
                <a href="#" class="block px-4 py-3 text-brand-orange font-bold rounded-xl bg-orange-50">الرئيسية</a>
                <a href="#designs" class="block px-4 py-3 text-gray-600 hover:text-brand-orange hover:bg-gray-50 font-medium rounded-xl transition">التصميمات</a>
                <a href="#features" class="block px-4 py-3 text-gray-600 hover:text-brand-orange hover:bg-gray-50 font-medium rounded-xl transition">مميزاتنا</a>
                <a href="#about" class="block px-4 py-3 text-gray-600 hover:text-brand-orange hover:bg-gray-50 font-medium rounded-xl transition">عني</a>
                <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}?text={{ urlencode($settings['whatsapp_message'] ?? 'مرحباً') }}" target="_blank" class="block px-4 py-3 text-gray-600 hover:text-brand-orange hover:bg-gray-50 font-medium rounded-xl transition">تواصل معي</a>
                
                <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}?text={{ urlencode($settings['whatsapp_message'] ?? 'مرحباً، أريد الاستفسار عن تصميم مخصص') }}" target="_blank" 
                   class="mt-2 block w-full bg-brand-dark text-white px-6 py-3.5 rounded-xl text-center flex justify-center items-center gap-2 hover:bg-gray-800 transition font-medium shadow-md">
                    <i data-lucide="pen-tool" class="w-5 h-5"></i>
                    اطلب تصميمك الآن
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-bg py-16 lg:py-24 overflow-hidden relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="flex flex-col-reverse lg:flex-row items-center gap-12 lg:gap-20">
                
                <!-- Text Content -->
                <div class="w-full lg:w-1/2 flex flex-col items-start text-right">
                    <div class="flex items-center gap-2 text-brand-orange font-medium mb-4">
                        <i data-lucide="leaf" class="w-4 h-4"></i>
                        <span>تصميم بطاقات مناسبات راقية</span>
                    </div>
                    
                    <h1 class="text-4xl lg:text-6xl font-bold text-brand-dark leading-tight mb-4">
                        تصميم يعكس <br>
                        <span class="text-brand-orange">لحظاتك الجميلة</span>
                    </h1>
                    
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed max-w-lg">
                        بطاقات دعوة، كتب كتاب، زفاف، خطوبة، تهنئة - تصاميم فريدة تناسب ذوقك ومناسبتك
                    </p>
                    
                    <div class="flex flex-col sm:flex-row items-center gap-4 mb-12 w-full sm:w-auto">
                        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '201234567890' }}?text={{ urlencode('مرحباً، أريد الاستفسار عن تصميم مخصص') }}" target="_blank" 
                           class="w-full sm:w-auto bg-green-500 hover:bg-green-600 active:bg-green-700 text-white px-8 py-3.5 rounded-xl flex items-center justify-center gap-3 transition shadow-lg shadow-green-200 text-lg font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            اطلب تصميمك الآن
                        </a>
                        
                        <a href="#designs" class="w-full sm:w-auto bg-white text-brand-dark border-2 border-gray-100 hover:border-brand-orange hover:text-brand-orange px-8 py-3.5 rounded-xl flex items-center justify-center gap-2 transition text-lg font-bold shadow-sm">
                            <i data-lucide="image" class="w-5 h-5"></i>
                            عرض التصاميم
                        </a>
                    </div>

                    <!-- Mini Features -->
                    <div class="flex flex-wrap items-center gap-6 lg:gap-10 border-t border-gray-200 pt-8 w-full">
                        <div class="flex flex-col items-center gap-2">
                            <div class="bg-white p-3 rounded-full shadow-sm text-gray-600">
                                <i data-lucide="heart" class="w-6 h-6"></i>
                            </div>
                            <span class="font-medium text-brand-dark text-sm">جودة عالية</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <div class="bg-white p-3 rounded-full shadow-sm text-gray-600">
                                <i data-lucide="award" class="w-6 h-6"></i>
                            </div>
                            <span class="font-medium text-brand-dark text-sm">تصاميم احترافية</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <div class="bg-white p-3 rounded-full shadow-sm text-gray-600">
                                <i data-lucide="clock" class="w-6 h-6"></i>
                            </div>
                            <span class="font-medium text-brand-dark text-sm">تسليم سريع</span>
                        </div>
                    </div>
                </div>

                <!-- Image -->
                <div class="w-full lg:w-1/2 relative">
                    <div class="relative z-10 bg-white p-4 rounded-2xl shadow-xl transform rotate-2 hover:rotate-0 transition duration-500">
                        <img src="{{ asset('images/hero.png') }}" alt="Invitation Card Design" class="w-full h-auto rounded-xl object-cover">
                    </div>
                    <!-- Decorative blob/shape behind image -->
                    <div class="absolute -top-10 -left-10 w-64 h-64 bg-orange-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 z-0"></div>
                    <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 z-0"></div>
                </div>

            </div>
        </div>
    </section>

    <!-- Distinctive Designs Section -->
    <section id="designs" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="flex items-center justify-center gap-2 text-brand-orange mb-2">
                    <i data-lucide="sparkles" class="w-5 h-5"></i>
                    <h2 class="text-3xl font-bold text-brand-dark">تصميمات مميزة</h2>
                </div>
                <p class="text-gray-500">مجموعة من تصاميم بطاقات المناسبات المختلفة — انقر على أي تصميم لمعاينته</p>
            </div>

            <!-- Grid -->
            <div id="designs-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 lg:gap-6">
                @forelse($designs as $design)
                @php $imgUrl = $design->image ? Storage::url($design->image) : null; @endphp
                <!-- Card (clickable) -->
                <div onclick="openCardModal('{{ addslashes($design->title) }}','{{ addslashes($design->subtitle ?? '') }}','{{ $imgUrl }}')"
                    class="bg-brand-light rounded-xl p-3 shadow-sm hover:shadow-lg transition-all group border border-gray-100 cursor-pointer hover:-translate-y-1 duration-300">
                    <div class="relative overflow-hidden rounded-lg mb-3 aspect-[9/16] bg-slate-100">
                        @if($imgUrl)
                            <img src="{{ $imgUrl }}" alt="{{ $design->title }}" class="w-full h-full object-cover object-top group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-400 text-xs">بدون صورة</div>
                        @endif
                        <!-- Overlay on hover -->
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition duration-300 flex items-center justify-center">
                            <span class="opacity-0 group-hover:opacity-100 transition bg-white/90 text-brand-dark text-xs font-bold px-3 py-1.5 rounded-full flex items-center gap-1.5 shadow-sm">
                                <i data-lucide="zoom-in" class="w-3.5 h-3.5"></i>
                                معاينة
                            </span>
                        </div>
                    </div>
                    <div class="text-center pb-1">
                        <h3 class="font-bold text-brand-dark text-sm mb-0.5">{{ $design->title }}</h3>
                        <p class="text-xs text-gray-500">{{ $design->subtitle }}</p>
                    </div>
                </div>
                @empty
                <div class="col-span-2 md:col-span-3 lg:col-span-5 text-center text-gray-500 py-12">
                    لا توجد تصميمات مضافة حالياً.
                </div>
                @endforelse
            </div>

            <div class="text-center mt-12" id="load-more-container">
                @if($designs->hasMorePages())
                    <button id="load-more-btn" data-page="1" class="border border-brand-orange text-brand-orange px-8 py-2.5 rounded-lg hover:bg-brand-orange hover:text-white transition font-bold text-sm inline-flex items-center gap-2">
                        <span id="load-more-text">عرض المزيد من التصاميم</span>
                        <i data-lucide="chevron-down" id="load-more-icon" class="w-4 h-4"></i>
                    </button>
                @endif
            </div>
        </div>
    </section>

    <!-- ===== CARD PREVIEW MODAL ===== -->
    <div id="card-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-3 sm:p-6">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/65 backdrop-blur-sm" onclick="closeCardModal()"></div>

        <!-- Modal Box: centered, max width, compact design -->
        <div id="card-modal-box"
             class="relative bg-white rounded-2xl shadow-2xl z-10
                    w-full max-w-sm flex flex-col overflow-hidden">

            <!-- Close -->
            <button onclick="closeCardModal()"
                class="absolute top-2.5 left-2.5 z-20 bg-black/40 hover:bg-black/60 backdrop-blur-sm
                       text-white p-2 rounded-full shadow transition">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>

            <!-- Image Container: Displays the entire image -->
            <div class="bg-slate-100 relative flex items-center justify-center p-3">
                <img id="modal-card-img" src="" alt="" class="max-w-full object-contain drop-shadow-md rounded" style="max-height: 68vh;">
                <div id="modal-no-img" class="hidden absolute inset-0 flex flex-col items-center justify-center gap-2 text-slate-400 p-8">
                    <i data-lucide="image-off" class="w-10 h-10"></i>
                    <span class="text-sm">لا توجد صورة</span>
                </div>
            </div>

            <!-- Info + Buttons (Mobile: Row, Desktop: Col) -->
            <div class="bg-white p-3 sm:p-5 border-t border-slate-100 flex-shrink-0">
                <div class="flex flex-row sm:flex-col items-center sm:items-stretch justify-between gap-3 sm:gap-4 mb-2 sm:mb-0">
                    <!-- Title & Subtitle -->
                    <div class="text-right sm:text-center flex-1 min-w-0">
                        <h3 id="modal-card-title" class="text-sm sm:text-lg font-bold text-brand-dark truncate sm:whitespace-normal leading-tight"></h3>
                        <p id="modal-card-subtitle" class="text-[11px] sm:text-sm text-gray-500 truncate sm:whitespace-normal mt-0.5 sm:mt-1"></p>
                    </div>

                    <!-- WhatsApp Button -->
                    <a id="modal-wa-btn" href="#" target="_blank"
                        class="flex-shrink-0 sm:w-full bg-green-500 hover:bg-green-600 active:bg-green-700
                               text-white font-bold py-2 sm:py-3 px-4 rounded-xl
                               flex items-center justify-center gap-1.5 sm:gap-2.5
                               transition shadow-sm sm:shadow-md sm:shadow-green-200 text-xs sm:text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5"
                             fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        <span class="sm:hidden">الطلب</span>
                        <span class="hidden sm:inline">اضغط الآن للطلب</span>
                    </a>
                </div>

                <!-- Hint -->
                <p class="text-center text-[10px] sm:text-xs text-gray-400 leading-none sm:leading-relaxed mt-1 sm:mt-3">
                    📸 أو خدها اسكرين وابعتها علي
                    <a href="{{ $settings['contact_page_url'] ?? '#contact' }}" target="_blank"
                       class="text-brand-orange font-medium underline underline-offset-2">الصفحة</a>
                </p>
            </div>
        </div>
    </div>

    <style>
        #card-modal-box {
            transform: scale(0.88);
            opacity: 0;
            transition: transform .3s cubic-bezier(0.175, 0.885, 0.32, 1.275),
                        opacity .25s ease;
        }
        #card-modal.flex #card-modal-box {
            transform: scale(1);
            opacity: 1;
        }
    </style>

    <script>
        const waNumber  = "{{ $settings['whatsapp_number'] ?? '201234567890' }}";
        const waBaseMsg = "{{ $settings['whatsapp_message'] ?? 'مرحباً، أريد الاستفسار عن تصميم' }}";

        function openCardModal(title, subtitle, imgUrl) {
            const modal   = document.getElementById('card-modal');
            const imgEl   = document.getElementById('modal-card-img');
            const noImgEl = document.getElementById('modal-no-img');

            document.getElementById('modal-card-title').textContent    = title;
            document.getElementById('modal-card-subtitle').textContent = subtitle;

            if (imgUrl) {
                imgEl.src = imgUrl;
                imgEl.classList.remove('hidden');
                noImgEl.classList.add('hidden');
            } else {
                imgEl.classList.add('hidden');
                noImgEl.classList.remove('hidden');
            }

            const msg = encodeURIComponent(
                waBaseMsg + ':\n*' + title + '*\n' + (subtitle || '') +
                '\n\nرابط التصميم: ' + (imgUrl || '')
            );
            document.getElementById('modal-wa-btn').href = 'https://wa.me/' + waNumber + '?text=' + msg;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
            lucide.createIcons();
        }

        function closeCardModal() {
            const modal = document.getElementById('card-modal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', e => { if (e.key === 'Escape') closeCardModal(); });

        // Load More Logic
        const loadMoreBtn = document.getElementById('load-more-btn');
        if(loadMoreBtn) {
            loadMoreBtn.addEventListener('click', function() {
                const btn = this;
                const page = parseInt(btn.getAttribute('data-page')) + 1;
                const icon = document.getElementById('load-more-icon');
                const text = document.getElementById('load-more-text');
                
                // Loading state
                icon.classList.remove('lucide-chevron-down');
                icon.classList.add('lucide-loader-2', 'animate-spin');
                btn.disabled = true;

                fetch(`/?page=${page}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const grid = document.getElementById('designs-grid');
                    
                    data.designs.forEach(design => {
                        const imgUrl = design.img_url;
                        const safeTitle = design.title.replace(/'/g, "\\'");
                        const safeSubtitle = (design.subtitle || '').replace(/'/g, "\\'");
                        
                        const imgHtml = imgUrl 
                            ? `<img src="${imgUrl}" alt="${design.title}" class="w-full h-full object-cover object-top group-hover:scale-105 transition duration-500">`
                            : `<div class="w-full h-full flex items-center justify-center text-slate-400 text-xs">بدون صورة</div>`;

                        const cardHtml = `
                            <div onclick="openCardModal('${safeTitle}', '${safeSubtitle}', '${imgUrl || ''}')"
                                class="bg-brand-light rounded-xl p-3 shadow-sm hover:shadow-lg transition-all group border border-gray-100 cursor-pointer hover:-translate-y-1 duration-300">
                                <div class="relative overflow-hidden rounded-lg mb-3 aspect-[9/16] bg-slate-100">
                                    ${imgHtml}
                                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition duration-300 flex items-center justify-center">
                                        <span class="opacity-0 group-hover:opacity-100 transition bg-white/90 text-brand-dark text-xs font-bold px-3 py-1.5 rounded-full flex items-center gap-1.5 shadow-sm">
                                            <i data-lucide="zoom-in" class="w-3.5 h-3.5"></i>
                                            معاينة
                                        </span>
                                    </div>
                                </div>
                                <div class="text-center pb-1">
                                    <h3 class="font-bold text-brand-dark text-sm mb-0.5">${design.title}</h3>
                                    <p class="text-xs text-gray-500">${design.subtitle || ''}</p>
                                </div>
                            </div>
                        `;
                        grid.insertAdjacentHTML('beforeend', cardHtml);
                    });

                    lucide.createIcons();
                    btn.setAttribute('data-page', page);

                    if(!data.has_more) {
                        document.getElementById('load-more-container').remove();
                    } else {
                        icon.classList.remove('lucide-loader-2', 'animate-spin');
                        icon.classList.add('lucide-chevron-down');
                        btn.disabled = false;
                    }
                })
                .catch(err => {
                    console.error('Error loading more designs:', err);
                    icon.classList.remove('lucide-loader-2', 'animate-spin');
                    icon.classList.add('lucide-chevron-down');
                    btn.disabled = false;
                });
            });
        }
    </script>





    <!-- Why Choose Me -->
    <section id="features" class="py-20 bg-brand-light">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="flex items-center justify-center gap-2 text-brand-orange mb-2">
                    <i data-lucide="star" class="w-5 h-5"></i>
                    <h2 class="text-3xl font-bold text-brand-dark">لماذا تختارني؟</h2>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature 1 -->
                <div class="flex items-start gap-4">
                    <div class="bg-white p-4 rounded-full shadow-sm text-brand-dark">
                        <i data-lucide="headphones" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-brand-dark mb-1 text-lg">دعم متواصل</h3>
                        <p class="text-sm text-gray-500">متابعة وتعديل حتى الرضا التام</p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="flex items-start gap-4">
                    <div class="bg-white p-4 rounded-full shadow-sm text-brand-dark">
                        <i data-lucide="paintbrush-2" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-brand-dark mb-1 text-lg">تصميم مخصص</h3>
                        <p class="text-sm text-gray-500">تصميم فريد يعكس شخصيتك ومناسبتك</p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="flex items-start gap-4">
                    <div class="bg-white p-4 rounded-full shadow-sm text-brand-dark">
                        <i data-lucide="clock-4" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-brand-dark mb-1 text-lg">سرعة في الإنجاز</h3>
                        <p class="text-sm text-gray-500">تسليم في الوقت المتفق عليه</p>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="flex items-start gap-4">
                    <div class="bg-white p-4 rounded-full shadow-sm text-brand-dark">
                        <i data-lucide="shield-check" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-brand-dark mb-1 text-lg">جودة عالية</h3>
                        <p class="text-sm text-gray-500">تصاميم احترافية بدقة عالية</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA & Social Links Section -->
    <section id="contact" class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Call to action Banner -->
            <div class="relative rounded-2xl overflow-hidden shadow-lg min-h-[300px] flex items-center justify-center text-center p-8 mb-16">
                <!-- BG Image -->
                <div class="absolute inset-0">
                    <img src="{{ asset('images/card1.png') }}" alt="Background" class="w-full h-full object-cover opacity-40">
                    <div class="absolute inset-0 bg-brand-light/80 backdrop-blur-sm"></div>
                </div>
                <!-- Content -->
                <div class="relative z-10 flex flex-col items-center">
                    <h3 class="text-3xl font-bold text-brand-dark mb-6 leading-relaxed">
                        ابدأ الآن واجعل <br>
                        مناسبتك أكثر تميزاً
                    </h3>
                    <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '201234567890' }}?text={{ urlencode('مرحباً، أريد الاستفسار عن تصميم مخصص') }}" target="_blank" 
                       class="bg-green-500 hover:bg-green-600 active:bg-green-700 text-white px-8 py-4 rounded-xl flex items-center justify-center gap-3 transition font-bold shadow-lg shadow-green-200 text-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        اطلب تصميمك الآن
                    </a>
                </div>
            </div>

            <!-- Social Links (Icons Only) -->
            <div class="flex flex-col items-center justify-center gap-6">
                <h4 class="text-xl font-bold text-slate-700">تابعنا وتواصل معنا</h4>
                <div class="flex flex-wrap items-center justify-center gap-4">
                    
                    <!-- WhatsApp -->
                    @if(!empty($settings['whatsapp_number']))
                    <a href="https://wa.me/{{ $settings['whatsapp_number'] }}?text={{ urlencode('مرحباً') }}" target="_blank" 
                       class="w-14 h-14 bg-green-50 text-green-600 hover:bg-green-500 hover:text-white rounded-full flex items-center justify-center transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-1"
                       title="واتساب">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </a>
                    @endif

                    <!-- Instagram -->
                    @if(!empty($settings['social_instagram']))
                    <a href="{{ $settings['social_instagram'] }}" target="_blank" 
                       class="w-14 h-14 bg-pink-50 text-pink-600 hover:bg-pink-600 hover:text-white rounded-full flex items-center justify-center transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-1"
                       title="انستجرام">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    @endif

                    <!-- Facebook -->
                    @if(!empty($settings['social_facebook']))
                    <a href="{{ $settings['social_facebook'] }}" target="_blank" 
                       class="w-14 h-14 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white rounded-full flex items-center justify-center transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-1"
                       title="فيسبوك">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    @endif

                    <!-- TikTok -->
                    @if(!empty($settings['social_tiktok']))
                    <a href="{{ $settings['social_tiktok'] }}" target="_blank" 
                       class="w-14 h-14 bg-gray-100 text-gray-800 hover:bg-black hover:text-white rounded-full flex items-center justify-center transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-1"
                       title="تيك توك">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93v7.2c0 1.63-.31 3.26-1.14 4.67-1.16 1.98-3.08 3.39-5.32 3.84-2.51.52-5.18-.04-7.14-1.61-1.78-1.43-2.88-3.48-2.98-5.74-.1-2.28 1-4.48 2.8-5.9 1.83-1.44 4.2-1.95 6.42-1.5.17.03.35.08.52.12v4.06c-1.3-.23-2.65-.05-3.8.61-1.1.63-1.89 1.7-2.11 2.94-.23 1.25.1 2.56.9 3.49.9.96 2.25 1.45 3.55 1.34 1.33-.12 2.53-.88 3.16-2.03.55-1 .82-2.15.82-3.3v-16.3z"/></svg>
                    </a>
                    @endif

                    <!-- X (Twitter) -->
                    @if(!empty($settings['social_x']))
                    <a href="{{ $settings['social_x'] }}" target="_blank" 
                       class="w-14 h-14 bg-slate-100 text-slate-800 hover:bg-slate-800 hover:text-white rounded-full flex items-center justify-center transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-1"
                       title="منصة X">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white py-8 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500 font-medium">
            جميع الحقوق محفوظة 2024 &copy;
        </div>
    </footer>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Mobile Menu Toggle Logic
        document.addEventListener('DOMContentLoaded', () => {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });

                // Close menu when clicking any link inside it
                const mobileLinks = mobileMenu.querySelectorAll('a');
                mobileLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        mobileMenu.classList.add('hidden');
                    });
                });
            }
        });
    </script>
</body>
</html>
