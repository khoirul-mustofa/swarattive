@props(['teamMembers'])

<section class="py-20 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
            <div class="max-w-2xl">
                <h2 class="text-3xl md:text-5xl font-serif font-bold text-neutral-900 mb-4">Kenali Para <span class="text-amber-600 italic">Kreator</span> Kami</h2>
                <p class="text-neutral-500 text-lg">Tim profesional kami siap mengabadikan setiap momen spesial Anda dengan perspektif unik dan penuh dedikasi.</p>
            </div>
            <div class="w-16 h-16 border-t-4 border-r-4 border-amber-500 rounded-tr-3xl hidden md:block opacity-30"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
            @forelse($teamMembers as $member)
                <div class="group" x-data="{ hovered: false }" @mouseenter="hovered = true" @mouseleave="hovered = false">
                    <div class="relative mb-6 overflow-hidden aspect-square rounded-3xl">
                        @if($member->image_url)
                            <img src="{{ $member->image_url }}" alt="{{ $member->name }}" 
                                loading="lazy" decoding="async"
                                class="w-full h-full object-cover transition-all duration-700" :class="hovered ? 'scale-110 blur-[2px]' : 'scale-100'">
                        @else
                            <div class="w-full h-full bg-amber-50 flex items-center justify-center text-amber-200 text-5xl font-bold font-serif">
                                {{ substr($member->name, 0, 1) }}
                            </div>
                        @endif
                        
                        <div class="absolute inset-0 bg-amber-900/60 flex flex-col items-center justify-center p-6 text-center transition-all duration-500" :class="hovered ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'">
                            <p class="text-white text-sm leading-relaxed mb-6 font-light italic overflow-hidden line-clamp-4">
                                {{ $member->bio ?? 'Individu kreatif dengan dedikasi tinggi untuk memberikan hasil terbaik.' }}
                            </p>
                            @if($member->social_links)
                                <div class="flex space-x-4">
                                    @foreach($member->social_links as $platform => $url)
                                        <a href="{{ $url }}" class="w-8 h-8 rounded-full bg-white/20 hover:bg-white flex items-center justify-center text-white hover:text-amber-900 transition-all shadow-lg backdrop-blur-sm" target="_blank">
                                            <span class="sr-only">{{ ucfirst($platform) }}</span>
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12c0 4.418 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482C19.138 20.161 22 16.416 22 12c0-5.523-4.477-10-10-10z"/></svg>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-neutral-900 mb-1 tracking-tight">{{ $member->name }}</h4>
                        <p class="text-amber-600 font-bold text-xs uppercase tracking-widest">{{ $member->role }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center bg-neutral-50 rounded-3xl border-2 border-dashed border-neutral-200">
                    <p class="text-neutral-400">Belum ada anggota tim yang ditambahkan.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
