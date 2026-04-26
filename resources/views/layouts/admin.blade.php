<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>لوحة التحكم | Designs</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Tajawal', sans-serif; background-color: #f8fafc; }

        /* Toast Notification */
        #toast-container {
            position: fixed;
            top: 1.5rem;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            min-width: 320px;
            max-width: 90vw;
            pointer-events: none;
        }
        .toast {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 1.25rem;
            border-radius: 0.75rem;
            background: white;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12), 0 2px 8px rgba(0,0,0,0.08);
            font-size: 0.9rem;
            font-weight: 600;
            pointer-events: all;
            animation: slideDown 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border-right: 4px solid;
        }
        .toast.success  { border-color: #22c55e; color: #166534; background: #f0fdf4; }
        .toast.error    { border-color: #ef4444; color: #991b1b; background: #fef2f2; }
        .toast.warning  { border-color: #f59e0b; color: #92400e; background: #fffbeb; }
        .toast.info     { border-color: #3b82f6; color: #1e40af; background: #eff6ff; }
        .toast-icon { flex-shrink: 0; width: 1.25rem; height: 1.25rem; }
        .toast-close { margin-right: auto; cursor: pointer; opacity: 0.5; hover: opacity-100; margin-left: 1rem; flex-shrink: 0; }
        .toast.dismissing {
            animation: slideUp 0.3s ease-in forwards;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideUp {
            from { opacity: 1; transform: translateY(0); }
            to   { opacity: 0; transform: translateY(-20px); }
        }

        /* Field error style */
        .field-error { 
            font-size: 0.78rem; 
            color: #dc2626; 
            margin-top: 0.35rem; 
            display: flex; 
            align-items: center; 
            gap: 0.3rem; 
        }
        input.has-error, textarea.has-error, select.has-error {
            border-color: #fca5a5 !important;
            background-color: #fff5f5 !important;
        }
    </style>
</head>
<body class="text-slate-800 antialiased flex h-screen overflow-hidden">

    <!-- Toast Notification Container -->
    <div id="toast-container"></div>

    <!-- Hidden fields for PHP-side flash messages (picked up by JS) -->
    @if(session('success'))
        <div id="flash-success" data-message="{{ session('success') }}" class="hidden"></div>
    @endif
    @if(session('error'))
        <div id="flash-error" data-message="{{ session('error') }}" class="hidden"></div>
    @endif
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="flash-validation-item hidden" data-message="{{ $error }}"></div>
        @endforeach
    @endif

    <!-- Sidebar -->
    <aside class="w-64 bg-slate-900 text-white flex flex-col hidden md:flex flex-shrink-0">
        <div class="h-16 flex items-center justify-center border-b border-slate-800 px-4">
            <span class="text-lg font-bold text-white">🎨 لوحة تحكم Designs</span>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-orange-500 text-white font-bold' : 'text-slate-300 hover:bg-slate-800' }} transition">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                الرئيسية
            </a>
            <a href="{{ route('admin.designs.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.designs.*') ? 'bg-orange-500 text-white font-bold' : 'text-slate-300 hover:bg-slate-800' }} transition">
                <i data-lucide="image" class="w-5 h-5"></i>
                التصميمات
            </a>
            <a href="{{ route('admin.messages.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.messages.*') ? 'bg-orange-500 text-white font-bold' : 'text-slate-300 hover:bg-slate-800' }} transition relative">
                <i data-lucide="mail" class="w-5 h-5"></i>
                الرسائل
                @php
                    $unread = \App\Models\ContactMessage::where('is_read', false)->count();
                @endphp
                @if($unread > 0)
                    <span class="absolute left-4 top-2.5 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">{{ $unread }}</span>
                @endif
            </a>
            <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.settings') ? 'bg-orange-500 text-white font-bold' : 'text-slate-300 hover:bg-slate-800' }} transition">
                <i data-lucide="settings" class="w-5 h-5"></i>
                الإعدادات
            </a>
            <div class="border-t border-slate-700 pt-4 mt-4 space-y-2">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white transition text-sm">
                    <i data-lucide="external-link" class="w-4 h-4"></i>
                    زيارة الموقع
                </a>
                <form method="POST" action="{{ route('logout') }}" id="logout-form-sidebar">
                    @csrf
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-400 hover:bg-red-900/20 hover:text-red-400 transition text-sm">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        تسجيل الخروج
                    </a>
                </form>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden min-w-0">
        <!-- Header -->
        <header class="h-16 bg-white shadow-sm flex items-center justify-between px-6 z-10 flex-shrink-0">
            <div class="md:hidden flex items-center">
                <button class="text-slate-600 focus:outline-none">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
            </div>
            <div class="hidden md:block"></div>
            <div class="flex items-center gap-3">
                <div class="text-left ml-4">
                    <p class="text-sm font-bold text-slate-800">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-500">{{ auth()->user()->email }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="flex">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition text-sm font-bold">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        <span>تسجيل خروج</span>
                    </button>
                </form>
                <div class="w-9 h-9 bg-gradient-to-br from-orange-400 to-orange-600 text-white rounded-full flex items-center justify-center font-bold text-sm shadow">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
            </div>
        </header>

        <!-- Content scrollable -->
        <div class="flex-1 overflow-auto p-6 lg:p-8">
            @yield('content')
        </div>
    </main>

    <script>
        lucide.createIcons();

        // Mobile Sidebar Toggle
        const menuBtn = document.querySelector('header button');
        const sidebar = document.querySelector('aside');
        
        if (menuBtn && sidebar) {
            menuBtn.addEventListener('click', () => {
                sidebar.classList.toggle('hidden');
                sidebar.classList.toggle('fixed');
                sidebar.classList.toggle('inset-0');
                sidebar.classList.toggle('z-50');
            });
        }

        // =====================
        // Toast Notification System
        // =====================
        function showToast(message, type = 'success', duration = 5000) {
            const icons = {
                success: 'check-circle',
                error:   'x-circle',
                warning: 'alert-triangle',
                info:    'info'
            };

            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;

            toast.innerHTML = `
                <i data-lucide="${icons[type]}" class="toast-icon"></i>
                <span class="flex-1">${message}</span>
                <button class="toast-close" onclick="dismissToast(this.parentElement)">
                    <i data-lucide="x" style="width:16px;height:16px;"></i>
                </button>
            `;

            container.appendChild(toast);
            lucide.createIcons({ nodes: [toast] });

            // Auto dismiss
            if (duration > 0) {
                setTimeout(() => dismissToast(toast), duration);
            }
        }

        function dismissToast(toast) {
            if (!toast || toast.classList.contains('dismissing')) return;
            toast.classList.add('dismissing');
            setTimeout(() => toast.remove(), 300);
        }

        // Show PHP flash messages on page load
        document.addEventListener('DOMContentLoaded', function () {
            const successEl = document.getElementById('flash-success');
            const errorEl   = document.getElementById('flash-error');

            if (successEl) showToast(successEl.dataset.message, 'success');
            if (errorEl)   showToast(errorEl.dataset.message,   'error');

            // Show each validation error separately
            document.querySelectorAll('.flash-validation-item').forEach(el => {
                showToast(el.dataset.message, 'error');
            });
        });

        // Expose globally so views can use it
        window.showToast = showToast;
    </script>
    @stack('scripts')
</body>
</html>
