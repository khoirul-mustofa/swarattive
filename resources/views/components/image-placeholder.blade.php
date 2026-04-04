<div {{ $attributes->merge(['class' => 'relative flex items-center justify-center bg-neutral-100 dark:bg-neutral-800 overflow-hidden']) }}>
    <!-- Shimmer Effect -->
    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 dark:via-neutral-700/20 to-transparent -translate-x-full animate-[shimmer_2s_infinite] pointer-events-none"></div>

    <div class="relative flex flex-col items-center justify-center space-y-2 opacity-20 group-hover:opacity-30 transition-opacity">
        <!-- Thin Camera Icon (SVG) -->
        <svg class="w-12 h-12 text-neutral-400 dark:text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <span class="text-xs font-medium tracking-widest uppercase text-neutral-500 dark:text-neutral-400">Image Unavailable</span>
    </div>

    <style>
        @keyframes shimmer {
            100% {
                transform: translateX(100%);
            }
        }
    </style>
</div>
