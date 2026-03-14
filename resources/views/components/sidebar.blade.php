<div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity
    class="fixed inset-0 z-20 bg-slate-900/50 lg:hidden" style="display: none;">
</div>

<aside :class="sidebarOpen ? 'translate-x-0 w-64' : '-translate-x-full w-64 lg:w-0 lg:translate-x-0'"
    class="bg-slate-900 text-slate-300 flex flex-col transition-all duration-300 ease-in-out z-30 shadow-xl fixed lg:relative h-full overflow-hidden whitespace-nowrap">

    <div class="h-16 flex items-center px-6 border-b border-slate-800">
        <div class="flex items-center gap-3">
            <div
                class="w-8 h-8 shrink-0 bg-indigo-500 rounded-lg flex items-center justify-center text-white font-bold shadow-lg shadow-indigo-500/30">
                E
            </div>
            <span class="text-lg font-bold tracking-wide text-white">
                EXPROSA LAB
            </span>
        </div>
    </div>

    <nav class="flex-1 p-4 space-y-1.5 overflow-y-auto overflow-x-hidden text-sm font-medium">

        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-indigo-600/10 text-indigo-400' : 'hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                </path>
            </svg>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('evaluation.index') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('evaluation.*') && !request()->routeIs('evaluation.result') ? 'bg-indigo-600/10 text-indigo-400' : 'hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                </path>
            </svg>
            <span>Business Evaluation</span>
        </a>

        <a href="{{ route('results.index') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('evaluation.result') || request()->routeIs('results.index') ? 'bg-indigo-600/10 text-indigo-400' : 'hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
            </svg>
            <span>Evaluation Results</span>
        </a>

        <a href="{{ route('insights.index') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('insights.*') ? 'bg-indigo-600/10 text-indigo-400' : 'hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                </path>
            </svg>
            <span class="flex-1">Business Insights</span>
            @if(auth()->user()->role !== 'admin' && !auth()->user()->isPremium())
            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                </path>
            </svg>
            @endif
        </a>

        <a href="{{ route('premium.dashboard') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('premium.*') ? 'bg-indigo-600/10 text-indigo-400' : 'hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                </path>
            </svg>
            <span class="flex-1">Executive Dashboard</span>
            @if(auth()->user()->role !== 'admin' && !auth()->user()->isPremium())
            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                </path>
            </svg>
            @endif
        </a>

        <a href="{{ route('subscription.index') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('subscription.*') ? 'bg-indigo-600/10 text-indigo-400' : 'hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
            </svg>
            <span>Subscription</span>
        </a>

        @if(auth()->user()->role === 'admin')
        <div class="pt-8 pb-2">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 px-3">Administration</p>
        </div>

        <a href="{{ route('admin.users') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.users*') ? 'bg-indigo-600/10 text-indigo-400' : 'hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                </path>
            </svg>
            <span>User Management</span>
        </a>

        <a href="{{ route('admin.questions.index') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.questions*') ? 'bg-indigo-600/10 text-indigo-400' : 'hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                </path>
            </svg>
            <span>Question Management</span>
        </a>

        <a href="{{ route('admin.analytics') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.analytics') ? 'bg-indigo-600/10 text-indigo-400' : 'hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                </path>
            </svg>
            <span>Platform Analytics</span>
        </a>
        @endif
    </nav>
</aside>
