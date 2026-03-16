<div
    class="p-8 flex flex-col sm:flex-row gap-6 items-start hover:bg-zinc-50/50 transition-colors {{ $task->status === 'completed' ? 'opacity-50' : '' }}">
    <form method="POST" action="{{ route('premium.action-plan.update', $task->id) }}" class="mt-1">
        @csrf
        @method('PATCH')
        @if(isset($selectedEvaluationId))
        <input type="hidden" name="evaluation_id" value="{{ $selectedEvaluationId }}">
        @endif
        <button type="submit"
            class="flex-shrink-0 w-6 h-6 border-2 flex items-center justify-center transition-colors focus:outline-none {{ $task->status === 'completed' ? 'border-zinc-900 bg-zinc-900' : 'border-zinc-300 hover:border-zinc-500' }}">
            @if($task->status === 'completed')
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
            </svg>
            @endif
        </button>
    </form>

    <div class="flex-grow">
        <div class="flex items-center gap-3 mb-2">
            <span
                class="px-2.5 py-1 text-[10px] font-semibold tracking-widest uppercase border border-zinc-200 text-zinc-500 bg-white">
                {{ $task->category }}
            </span>
            @if($task->status === 'completed')
            <span class="text-xs font-medium text-zinc-500">✓ Diselesaikan</span>
            @endif
        </div>
        <h5
            class="text-lg font-medium text-zinc-900 mb-2 {{ $task->status === 'completed' ? 'line-through text-zinc-400' : '' }}">
            {{ $task->title }}
        </h5>
        <p
            class="text-sm text-zinc-500 leading-relaxed {{ $task->status === 'completed' ? 'line-through text-zinc-400' : '' }}">
            {{ $task->description }}
        </p>
    </div>
</div>
