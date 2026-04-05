<form wire:submit="submit" class="space-y-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Form Columns --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- 1. Pilih Layanan & Paket --}}
            <div class="bg-white rounded-2xl shadow-sm border border-[#ede8e3] overflow-hidden">
                <div class="bg-[#3d2b1f] px-6 py-4">
                    <h3 class="text-white font-serif font-semibold text-lg flex items-center gap-2">
                        <span
                            class="bg-[#f0c27f] text-[#3d2b1f] w-6 h-6 rounded-full flex items-center justify-center text-xs">1</span>
                        Pilih Layanan & Paket
                    </h3>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-[#3d2b1f] mb-3">Pilih Layanan Utama</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($services as $service)
                                <label
                                    class="relative flex cursor-pointer rounded-xl border p-4 shadow-sm focus:outline-none transition-all duration-200 {{ $selectedService == $service->id ? 'border-[#3d2b1f] ring-2 ring-[#3d2b1f] ring-opacity-10 bg-[#fdfaf8]' : 'border-gray-200 hover:border-[#d4c9bb]' }}">
                                    <input type="radio" name="selectedService" wire:model.live="selectedService"
                                        value="{{ $service->id }}" class="sr-only" required>
                                    <span class="flex flex-1">
                                        <span class="flex flex-col">
                                            <span class="block text-sm font-bold text-[#3d2b1f]">{{ $service->name }}</span>
                                            <span class="mt-1 flex items-center text-xs text-[#7a6b5d]">
                                                {{ $service->category->name }}
                                            </span>
                                            <span class="mt-2 text-sm font-medium text-[#3d2b1f]">Mulai Rp
                                                {{ number_format($service->base_price, 0, ',', '.') }}</span>
                                        </span>
                                    </span>
                                    <svg class="h-5 w-5 text-[#3d2b1f] {{ $selectedService == $service->id ? '' : 'hidden' }}"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </label>
                            @endforeach
                        </div>
                        @error('selectedService') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    @if(count($availablePackages) > 0)
                        <div>
                            <label class="block text-sm font-medium text-[#3d2b1f] mb-3">Pilih Paket Spesifik
                                (Opsional)</label>
                            <div class="space-y-3">
                                @foreach($availablePackages as $pkg)
                                    <label
                                        class="relative flex cursor-pointer rounded-xl border p-4 shadow-sm focus:outline-none transition-all duration-200 {{ $selectedPackage == $pkg->id ? 'border-[#3d2b1f] ring-1 ring-[#3d2b1f] bg-[#fdfaf8]' : 'border-gray-200 hover:border-[#d4c9bb]' }}">
                                        <input type="radio" name="selectedPackage" wire:model.live="selectedPackage"
                                            value="{{ $pkg->id }}" class="sr-only">
                                        <span class="flex flex-1 items-center justify-between">
                                            <span class="flex flex-col">
                                                <span class="block text-sm font-bold text-[#3d2b1f]">{{ $pkg->name }}</span>
                                                <span class="mt-1 text-xs text-[#7a6b5d]">{{ $pkg->description }}</span>
                                            </span>
                                            <span class="text-sm font-bold text-[#3d2b1f]">Rp
                                                {{ number_format($pkg->price, 0, ',', '.') }}</span>
                                        </span>
                                    </label>
                                @endforeach
                                {{-- Opsi Tanpa Paket --}}
                                <label
                                    class="relative flex cursor-pointer rounded-xl border p-3 border-dashed border-gray-300 hover:border-[#d4c9bb] {{ $selectedPackage == null ? 'bg-[#f5f0eb] border-solid border-[#3d2b1f]' : '' }}">
                                    <input type="radio" name="selectedPackage" wire:model.live="selectedPackage" value=""
                                        class="sr-only">
                                    <span class="text-xs text-[#7a6b5d]">Lewati paket (Gunakan harga dasar layanan)</span>
                                </label>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- 2. Jadwal & Lokasi --}}
            <div class="bg-white rounded-2xl shadow-sm border border-[#ede8e3] overflow-hidden">
                <div class="bg-[#3d2b1f] px-6 py-4">
                    <h3 class="text-white font-serif font-semibold text-lg flex items-center gap-2">
                        <span
                            class="bg-[#f0c27f] text-[#3d2b1f] w-6 h-6 rounded-full flex items-center justify-center text-xs">2</span>
                        Jadwal & Lokasi
                    </h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="bookingDate" class="block text-sm font-semibold text-[#3d2b1f] mb-2">Tanggal</label>
                        <input type="date" id="bookingDate" wire:model="bookingDate" min="{{ date('Y-m-d') }}"
                            class="w-full rounded-xl border-[#e8ddd2] bg-[#fcfaf8] px-4 py-3 text-[#3d2b1f] focus:border-[#3d2b1f] focus:ring-4 focus:ring-[#3d2b1f]/5 transition-all text-sm"
                            required>
                        @error('bookingDate') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="bookingTime" class="block text-sm font-semibold text-[#3d2b1f] mb-2">Waktu</label>
                        <select id="bookingTime" wire:model="bookingTime"
                            class="w-full rounded-xl border-[#e8ddd2] bg-[#fcfaf8] px-4 py-3 text-[#3d2b1f] focus:border-[#3d2b1f] focus:ring-4 focus:ring-[#3d2b1f]/5 transition-all text-sm"
                            required>
                            <option value="">Pilih Waktu</option>
                            <option value="08:00">08:00 WIB</option>
                            <option value="09:00">09:00 WIB</option>
                            <option value="10:00">10:00 WIB</option>
                            <option value="11:00">11:00 WIB</option>
                            <option value="13:00">13:00 WIB</option>
                            <option value="14:00">14:00 WIB</option>
                            <option value="15:00">15:00 WIB</option>
                            <option value="16:00">16:00 WIB</option>
                            <option value="17:00">17:00 WIB</option>
                            <option value="19:00">19:00 WIB (Indoor/Studio Only)</option>
                        </select>
                        @error('bookingTime') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-[#3d2b1f] mb-3">Tipe Lokasi</label>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            <label class="cursor-pointer">
                                <input type="radio" name="locationType" wire:model.live="locationType" value="studio"
                                    class="sr-only peer" required>
                                <div
                                    class="border rounded-lg p-2 text-center text-xs peer-checked:bg-[#3d2b1f] peer-checked:text-white transition-colors">
                                    Studio</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="locationType" wire:model.live="locationType" value="outdoor"
                                    class="sr-only peer">
                                <div
                                    class="border rounded-lg p-2 text-center text-xs peer-checked:bg-[#3d2b1f] peer-checked:text-white transition-colors">
                                    Outdoor</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="locationType" wire:model.live="locationType" value="venue"
                                    class="sr-only peer">
                                <div
                                    class="border rounded-lg p-2 text-center text-xs peer-checked:bg-[#3d2b1f] peer-checked:text-white transition-colors">
                                    Venue</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="locationType" wire:model.live="locationType" value="custom"
                                    class="sr-only peer">
                                <div
                                    class="border rounded-lg p-2 text-center text-xs peer-checked:bg-[#3d2b1f] peer-checked:text-white transition-colors">
                                    Kustom</div>
                            </label>
                        </div>
                        @error('locationType') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    @if(in_array($locationType, ['venue', 'custom']))
                        <div class="md:col-span-2">
                            <label for="locationAddress" class="block text-sm font-semibold text-[#3d2b1f] mb-2">Alamat
                                Lengkap Lokasi</label>
                            <textarea id="locationAddress" wire:model="locationAddress" rows="2"
                                class="w-full rounded-xl border-[#e8ddd2] bg-[#fcfaf8] px-4 py-3 text-[#3d2b1f] focus:border-[#3d2b1f] focus:ring-4 focus:ring-[#3d2b1f]/5 transition-all text-sm"
                                placeholder="Sebutkan nama lokasi atau alamat lengkap..."></textarea>
                            @error('locationAddress') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>
                    @endif
                </div>
            </div>

            {{-- 3. Pilih Fotografer --}}
            <div class="bg-white rounded-2xl shadow-sm border border-[#ede8e3] overflow-hidden">
                <div class="bg-[#3d2b1f] px-6 py-4">
                    <h3 class="text-white font-serif font-semibold text-lg flex items-center gap-2">
                        <span
                            class="bg-[#f0c27f] text-[#3d2b1f] w-6 h-6 rounded-full flex items-center justify-center text-xs">3</span>
                        Pilih Fotografer
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($teamMembers as $member)
                            <label
                                class="relative flex cursor-pointer rounded-xl border p-4 shadow-sm focus:outline-none transition-all duration-200 {{ $selectedTeamMember == $member->id ? 'border-[#3d2b1f] ring-2 ring-[#3d2b1f] ring-opacity-10 bg-[#fdfaf8]' : 'border-gray-200 hover:border-[#d4c9bb]' }}">
                                <input type="radio" name="selectedTeamMember" wire:model.live="selectedTeamMember"
                                    value="{{ $member->id }}" class="sr-only">
                                <div class="flex items-center gap-3 w-full">
                                    <img src="{{ str_starts_with($member->image_url, 'http') ? $member->image_url : asset('storage/' . $member->image_url) }}"
                                        class="w-12 h-12 rounded-full object-cover">
                                    <div class="flex-1">
                                        <span class="block text-sm font-bold text-[#3d2b1f]">{{ $member->name }}</span>
                                        <span class="block text-xs text-[#7a6b5d]">{{ $member->role }}</span>
                                    </div>
                                    <svg class="h-5 w-5 text-[#3d2b1f] {{ $selectedTeamMember == $member->id ? '' : 'hidden' }}"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </label>
                        @endforeach
                        <label
                            class="relative flex cursor-pointer rounded-xl border p-4 shadow-sm focus:outline-none transition-all duration-200 {{ empty($selectedTeamMember) ? 'border-[#3d2b1f] ring-2 ring-[#3d2b1f] ring-opacity-10 bg-[#fdfaf8]' : 'border-gray-200 hover:border-[#d4c9bb]' }}">
                            <input type="radio" name="selectedTeamMember" wire:model.live="selectedTeamMember" value=""
                                class="sr-only">
                            <div class="flex items-center gap-3 w-full">
                                <div
                                    class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <span class="block text-sm font-bold text-[#3d2b1f]">Acak / Terserah</span>
                                    <span class="block text-xs text-[#7a6b5d]">Biarkan kami memilihkan fotografer
                                        terbaik</span>
                                </div>
                                <svg class="h-5 w-5 text-[#3d2b1f] {{ empty($selectedTeamMember) ? '' : 'hidden' }}"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            {{-- 4. Data Diri --}}
            <div class="bg-white rounded-2xl shadow-sm border border-[#ede8e3] overflow-hidden">
                <div class="bg-[#3d2b1f] px-6 py-4">
                    <h3 class="text-white font-serif font-semibold text-lg flex items-center gap-2">
                        <span
                            class="bg-[#f0c27f] text-[#3d2b1f] w-6 h-6 rounded-full flex items-center justify-center text-xs">4</span>
                        Informasi Kontak
                    </h3>
                </div>
                <div class="p-6 space-y-5">
                    <div>
                        <label for="clientName" class="block text-sm font-semibold text-[#3d2b1f] mb-2">Nama
                            Lengkap</label>
                        <input type="text" id="clientName" wire:model="clientName"
                            class="w-full rounded-xl border-[#e8ddd2] bg-[#fcfaf8] px-4 py-3 text-[#3d2b1f] focus:border-[#3d2b1f] focus:ring-4 focus:ring-[#3d2b1f]/5 transition-all text-sm"
                            placeholder="Masukkan nama lengkap Anda..." required>
                        @error('clientName') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="clientEmail"
                                class="block text-sm font-semibold text-[#3d2b1f] mb-2">Email</label>
                            <input type="email" id="clientEmail" wire:model="clientEmail"
                                class="w-full rounded-xl border-[#e8ddd2] bg-[#fcfaf8] px-4 py-3 text-[#3d2b1f] focus:border-[#3d2b1f] focus:ring-4 focus:ring-[#3d2b1f]/5 transition-all text-sm"
                                placeholder="contoh@email.com" required>
                            @error('clientEmail') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="clientPhone" class="block text-sm font-semibold text-[#3d2b1f] mb-2">Nomor
                                WhatsApp</label>
                            <input type="tel" id="clientPhone" wire:model="clientPhone" placeholder="08XXXXXXXXXX"
                                class="w-full rounded-xl border-[#e8ddd2] bg-[#fcfaf8] px-4 py-3 text-[#3d2b1f] focus:border-[#3d2b1f] focus:ring-4 focus:ring-[#3d2b1f]/5 transition-all text-sm"
                                required>
                            @error('clientPhone') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div>
                        <label for="notes" class="block text-sm font-semibold text-[#3d2b1f] mb-2">Catatan Tambahan
                            (Opsional)</label>
                        <textarea id="notes" wire:model="notes" rows="3"
                            class="w-full rounded-xl border-[#e8ddd2] bg-[#fcfaf8] px-4 py-3 text-[#3d2b1f] focus:border-[#3d2b1f] focus:ring-4 focus:ring-[#3d2b1f]/5 transition-all text-sm"
                            placeholder="Berikan instruksi khusus atau permintaan tema fotomu di sini..."></textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar: Summary --}}
        <div class="lg:col-span-1">
            <div class="sticky top-24 space-y-6">
                <div class="bg-white rounded-2xl shadow-md border border-[#ede8e3] overflow-hidden relative">
                    {{-- Loading overlay saat update state livewire --}}
                    <div wire:loading.delay
                        class="absolute inset-0 bg-white/50 backdrop-blur-sm z-10 flex items-center justify-center">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#3d2b1f]"></div>
                    </div>

                    <div class="bg-[#f0c27f] px-6 py-4">
                        <h3 class="text-[#3d2b1f] font-serif font-bold text-lg">Ringkasan Pesanan</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        @if($selectedServiceName)
                            <div class="space-y-4">
                                <div class="space-y-3">
                                    <div class="flex justify-between items-start">
                                        <span class="text-xs text-[#7a6b5d]">Layanan:</span>
                                        <span
                                            class="text-sm font-bold text-[#3d2b1f] text-right">{{ $selectedServiceName }}</span>
                                    </div>
                                    @if($selectedPackageName)
                                        <div class="flex justify-between items-start">
                                            <span class="text-xs text-[#7a6b5d]">Paket:</span>
                                            <span
                                                class="text-sm font-medium text-[#3d2b1f] text-right">{{ $selectedPackageName }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="pt-4 border-t border-[#f0ece7] space-y-4">
                                    <label class="block text-xs font-bold text-[#3d2b1f] uppercase tracking-widest">Metode Pembayaran</label>
                                    <div class="space-y-2">
                                        <label class="relative flex cursor-pointer items-center gap-3 p-3 rounded-xl border {{ $paymentType === 'full_payment' ? 'border-[#3d2b1f] bg-[#fdfaf8]' : 'border-gray-100 hover:border-[#d4c9bb]' }}">
                                            <input type="radio" wire:model.live="paymentType" value="full_payment" class="sr-only">
                                            <div class="w-4 h-4 rounded-full border-2 border-[#3d2b1f] flex items-center justify-center p-0.5">
                                                @if($paymentType === 'full_payment') <div class="w-full h-full rounded-full bg-[#3d2b1f]"></div> @endif
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-sm font-bold text-[#3d2b1f]">Bayar Lunas</p>
                                                <p class="text-[10px] text-[#7a6b5d]">Dapatkan prioritas penjadwalan</p>
                                            </div>
                                        </label>

                                        <label class="relative flex cursor-pointer items-center gap-3 p-3 rounded-xl border {{ $paymentType === 'down_payment' ? 'border-[#3d2b1f] bg-[#fdfaf8]' : 'border-gray-100 hover:border-[#d4c9bb]' }}">
                                            <input type="radio" wire:model.live="paymentType" value="down_payment" class="sr-only">
                                            <div class="w-4 h-4 rounded-full border-2 border-[#3d2b1f] flex items-center justify-center p-0.5">
                                                @if($paymentType === 'down_payment') <div class="w-full h-full rounded-full bg-[#3d2b1f]"></div> @endif
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-sm font-bold text-[#3d2b1f]">Down Payment (30%)</p>
                                                <p class="text-[10px] text-[#7a6b5d]">Kunci jadwal dengan DP</p>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div class="border-t border-dashed border-gray-200 pt-4">
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-xs text-[#7a6b5d]">Total Biaya</span>
                                        <span class="text-sm font-bold text-[#3d2b1f]">Rp {{ number_format($totalAmount, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-[#3d2b1f] font-bold">Harus Dibayar</span>
                                        <span class="text-2xl font-serif font-bold text-[#3d2b1f]">
                                            Rp {{ number_format($paymentType === 'down_payment' ? $totalAmount * 0.3 : $totalAmount, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="py-4 text-center">
                                <p class="text-sm text-[#9a8b7d] italic">Silakan pilih layanan untuk melihat estimasi biaya.
                                </p>
                            </div>
                        @endif

                        <button type="submit"
                            class="w-full bg-[#3d2b1f] text-white py-4 rounded-xl font-bold uppercase tracking-widest transition-all shadow-lg flex items-center justify-center gap-2 group {{ !$selectedServiceName ? 'opacity-50 cursor-not-allowed' : 'hover:bg-black active:scale-95' }}"
                            @if(!$selectedServiceName) disabled @endif>
                            <span wire:loading.remove wire:target="submit">Konfirmasi Pesanan</span>
                            <span wire:loading wire:target="submit">Memproses...</span>
                            <svg wire:loading.remove wire:target="submit"
                                class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                        <p class="text-[10px] text-center text-[#9a8b7d]">Dengan menekan tombol di atas, Anda menyetujui
                            Syarat & Ketentuan Swarattive.</p>
                    </div>
                </div>

                {{-- Info --}}
                <div class="bg-[#f5f0eb] rounded-2xl p-6 border border-[#e8ddd2]">
                    <h4 class="text-sm font-bold text-[#3d2b1f] mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Informasi Penting
                    </h4>
                    <ul class="text-xs text-[#7a6b5d] space-y-2 list-disc pl-4">
                        <li>Pembayaran uang muka (DP) minimal 30% diperlukan untuk konfirmasi jadwal.</li>
                        <li>Pembatalan < 3 hari sebelum sesi akan dikenakan biaya administrasi.</li>
                        <li>Hasil edit foto akan selesai dalam 7-14 hari kerja.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</form>