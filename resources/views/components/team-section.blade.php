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
                                            @php
                                                $platform = strtolower($platform);
                                                $path = match($platform) {
                                                    'instagram' => 'M7.75 2h8.5a5.75 5.75 0 015.75 5.75v8.5a5.75 5.75 0 01-5.75 5.75h-8.5a5.75 5.75 0 01-5.75-5.75v-8.5A5.75 5.75 0 017.75 2zm8.47 1.5H7.75A4.25 4.25 0 003.5 7.75v8.5a4.25 4.25 0 004.25 4.25h8.5a4.25 4.25 0 004.25-4.25v-8.5a4.25 4.25 0 00-4.25-4.25zM12 7a5 5 0 110 10 5 5 0 010-10zm0 1.5a3.5 3.5 0 100 7 3.5 3.5 0 000-7zm4.75-.25a.75.75 0 110-1.5.75.75 0 010 1.5z',
                                                    'facebook' => 'M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z',
                                                    'linkedin' => 'M19 3a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h14m-.5 15.5v-5.3a2.7 2.7 0 00-2.7-2.7c-1.2 0-2 .7-2.3 1.2v-1h-2.8v7.8h2.8v-4.1c0-.4.3-.8.8-.8s.8.4.8.8v4.1h2.7M7 18.5v-7.8H4.2v7.8H7M5.6 9.5a1.5 1.5 0 100-3.1 1.5 1.5 0 000 3.1z',
                                                    'twitter', 'x' => 'M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231 5.451-6.231zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77z',
                                                    default => 'M12 2C6.477 2 2 6.477 2 12c0 4.418 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482C19.138 20.161 22 16.416 22 12c0-5.523-4.477-10-10-10z'
                                                };
                                            @endphp
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="{{ $path }}"/>
                                            </svg>
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
