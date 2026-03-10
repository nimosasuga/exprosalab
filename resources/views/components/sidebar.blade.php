<aside class="w-64 h-screen bg-white border-r border-slate-200 fixed left-0 top-0 overflow-y-auto shadow-sm">

    <div class="p-6 border-b border-slate-100">
        <h1 class="text-2xl font-black text-indigo-700 tracking-tighter flex items-center gap-2">
            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z">
                </path>
            </svg>
            Exprosa<span class="text-slate-800">Lab</span>
        </h1>
    </div>

    <nav class="p-4 space-y-1 text-slate-600 font-medium text-sm">

        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'hover:bg-slate-50 hover:text-slate-900' }}">
            Dashboard
        </a>

        <a href="{{ route('evaluation.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('evaluation.*') && !request()->routeIs('evaluation.result') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'hover:bg-slate-50 hover:text-slate-900' }}">
            Business Evaluation
        </a>

        <a href="{{ route('results.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('evaluation.result') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'hover:bg-slate-50 hover:text-slate-900' }}">
            Evaluation Results
        </a>

        <a href="{{ route('insights.index') }}"
            class="flex items-center justify-between px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('insights.*') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'hover:bg-slate-50 hover:text-slate-900' }}">
            <span class="flex items-center gap-3">Business Insights</span>
            @if(auth()->user()->role !== 'admin' && !auth()->user()->isPremium())
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                </path>
            </svg>
            @endif
        </a>

        <a href="{{ route('subscription.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('subscription.*') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'hover:bg-slate-50 hover:text-slate-900' }}">
            Subscription
        </a>

        @if(auth()->user()->role === 'admin')
        <div class="pt-6 pb-2 px-4 text-xs font-bold text-slate-400 uppercase tracking-wider">
            Admin Panel
        </div>

        <a href="{{ route('admin.users') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.users*') ? 'bg-slate-800 text-white font-bold shadow-md' : 'hover:bg-slate-100 hover:text-slate-900' }}">
            User Management
        </a>

        <a href="{{ route('admin.questions.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.questions*') ? 'bg-slate-800 text-white font-bold shadow-md' : 'hover:bg-slate-100 hover:text-slate-900' }}">
            Question Management
        </a>

        <a href="{{ route('admin.analytics') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.analytics') ? 'bg-slate-800 text-white font-bold shadow-md' : 'hover:bg-slate-100 hover:text-slate-900' }}">
            Platform Analytics
        </a>
        @endif

    </nav>

</aside>
