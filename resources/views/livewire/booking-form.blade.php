<form wire:submit="submit" class="space-y-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Form Columns --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- 1. Pilih Layanan & Paket --}}
            <div class="bg-white dark:bg-neutral-800 rounded-2xl shadow-sm border border-[#ede8e3] dark:border-neutral-700 overflow-hidden transition-colors">
                <div class="bg-[#3d2b1f] dark:bg-black px-6 py-4">
                    <h3 class="text-white font-serif font-semibold text-lg flex items-center gap-2">
                        <span
                            class="bg-[#f0c27f] text-[#3d2b1f] w-6 h-6 rounded-full flex items-center justify-center text-xs">1</span>
                        Pilih Layanan & Paket
                    </h3>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-[#3d2b1f] dark:text-gray-200 mb-3">Pilih Layanan Utama</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($services as $service)
                                <label
                                    class="relative flex cursor-pointer rounded-xl border p-4 shadow-sm focus:outline-none transition-all duration-200 {{ $selectedService == $service->id ? 'border-[#3d2b1f] dark:border-amber-500 ring-2 ring-[#3d2b1f] dark:ring-amber-500 ring-opacity-10 dark:ring-opacity-20 bg-[#fdfaf8] dark:bg-neutral-700/50' : 'border-gray-200 dark:border-neutral-700 hover:border-[#d4c9bb] dark:hover:border-neutral-600' }}">
                                    <input type="radio" name="selectedService" wire:model.live="selectedService"
                                        value="{{ $service->id }}" class="sr-only" required>
                                    <span class="flex flex-1">
                                        <span class="flex flex-col">
                                            <span class="block text-sm font-bold text-[#3d2b1f] dark:text-white">{{ $service->name }}</span>
                                            <span class="mt-1 flex items-center text-xs text-[#7a6b5d] dark:text-gray-400">
                                                {{ $service->category->name }}
                                            </span>
                                            <span class="mt-2 text-sm font-medium text-[#3d2b1f] dark:text-amber-400">Mulai Rp
                                                {{ number_format($service->base_price, 0, ',', '.') }}</span>
                                        </span>
                                    </span>
                                    <svg class="h-5 w-5 text-[#3d2b1f] dark:text-amber-500 {{ $selectedService == $service->id ? '' : 'hidden' }}"
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
                            <label class="block text-sm font-medium text-[#3d2b1f] dark:text-gray-200 mb-3">Pilih Paket Spesifik
                                (Opsional)</label>
                            <div class="space-y-3">
                                @foreach($availablePackages as $pkg)
                                    <label
                                        class="relative flex cursor-pointer rounded-xl border p-4 shadow-sm focus:outline-none transition-all duration-200 {{ $selectedPackage == $pkg->id ? 'border-[#3d2b1f] dark:border-amber-500 ring-1 ring-[#3d2b1f] dark:ring-amber-500 bg-[#fdfaf8] dark:bg-neutral-700/50' : 'border-gray-200 dark:border-neutral-700 hover:border-[#d4c9bb] dark:hover:border-neutral-600' }}">
                                        <input type="radio" name="selectedPackage" wire:model.live="selectedPackage"
                                            value="{{ $pkg->id }}" class="sr-only">
                                        <span class="flex flex-1 items-center justify-between">
                                            <span class="flex flex-col">
                                                <span class="block text-sm font-bold text-[#3d2b1f] dark:text-white">{{ $pkg->name }}</span>
                                                <span class="mt-1 text-xs text-[#7a6b5d] dark:text-gray-400">{{ $pkg->description }}</span>
                                            </span>
                                            <span class="text-sm font-bold text-[#3d2b1f] dark:text-amber-400">Rp
                                                {{ number_format($pkg->price, 0, ',', '.') }}</span>
                                        </span>
                                    </label>
                                @endforeach
                                {{-- Opsi Tanpa Paket --}}
                                <label
                                    class="relative flex cursor-pointer rounded-xl border p-3 border-dashed border-gray-300 dark:border-neutral-600 hover:border-[#d4c9bb] dark:hover:border-neutral-500 {{ $selectedPackage == null ? 'bg-[#f5f0eb] dark:bg-neutral-700/30 border-solid border-[#3d2b1f] dark:border-amber-500' : '' }}">
                                    <input type="radio" name="selectedPackage" wire:model.live="selectedPackage" value=""
                                        class="sr-only">
                                    <span class="text-xs text-[#7a6b5d] dark:text-gray-400 text-center w-full">Lewati paket (Gunakan harga dasar layanan)</span>
                                </label>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- 2. Jadwal & Lokasi --}}
            <div class="bg-white dark:bg-neutral-800 rounded-2xl shadow-sm border border-[#ede8e3] dark:border-neutral-700 overflow-hidden transition-colors">
                <div class="bg-[#3d2b1f] dark:bg-black px-6 py-4">
                    <h3 class="text-white font-serif font-semibold text-lg flex items-center gap-2">
                        <span
                            class="bg-[#f0c27f] text-[#3d2b1f] w-6 h-6 rounded-full flex items-center justify-center text-xs">2</span>
                        Jadwal & Lokasi
                    </h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="bookingDate" class="block text-sm font-semibold text-[#3d2b1f] dark:text-gray-200 mb-2">Tanggal</label>
                        <input type="date" id="bookingDate" wire:model="bookingDate" min="{{ date('Y-m-d') }}"
                            class="w-full rounded-xl border-[#e8ddd2] dark:border-neutral-700 bg-[#fcfaf8] dark:bg-neutral-900 px-4 py-3 text-[#3d2b1f] dark:text-white focus:border-[#3d2b1f] dark:focus:border-amber-500 focus:ring-4 focus:ring-[#3d2b1f]/5 transition-all text-sm"
                            required>
                        @error('bookingDate') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="bookingTime" class="block text-sm font-semibold text-[#3d2b1f] dark:text-gray-200 mb-2">Waktu</label>
                        <select id="bookingTime" wire:model="bookingTime"
                            class="w-full rounded-xl border-[#e8ddd2] dark:border-neutral-700 bg-[#fcfaf8] dark:bg-neutral-900 px-4 py-3 text-[#3d2b1f] dark:text-white focus:border-[#3d2b1f] dark:focus:border-amber-500 focus:ring-4 focus:ring-[#3d2b1f]/5 transition-all text-sm"
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
                        <label class="block text-sm font-medium text-[#3d2b1f] dark:text-gray-200 mb-3">Tipe Lokasi</label>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            <label class="cursor-pointer">
                                <input type="radio" name="locationType" wire:model.live="locationType" value="studio"
                                    class="sr-only peer" required>
                                <div
                                    class="border dark:border-neutral-700 rounded-lg p-2 text-center text-xs peer-checked:bg-[#3d2b1f] dark:peer-checked:bg-amber-600 peer-checked:text-white transition-colors dark:text-gray-300">
                                    Studio</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="locationType" wire:model.live="locationType" value="outdoor"
                                    class="sr-only peer">
                                <div
                                    class="border dark:border-neutral-700 rounded-lg p-2 text-center text-xs peer-checked:bg-[#3d2b1f] dark:peer-checked:bg-amber-600 peer-checked:text-white transition-colors dark:text-gray-300">
                                    Outdoor</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="locationType" wire:model.live="locationType" value="venue"
                                    class="sr-only peer">
                                <div
                                    class="border dark:border-neutral-700 rounded-lg p-2 text-center text-xs peer-checked:bg-[#3d2b1f] dark:peer-checked:bg-amber-600 peer-checked:text-white transition-colors dark:text-gray-300">
                                    Venue</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="locationType" wire:model.live="locationType" value="custom"
                                    class="sr-only peer">
                                <div
                                    class="border dark:border-neutral-700 rounded-lg p-2 text-center text-xs peer-checked:bg-[#3d2b1f] dark:peer-checked:bg-amber-600 peer-checked:text-white transition-colors dark:text-gray-300">
                                    Kustom</div>
                            </label>
                        </div>
                        @error('locationType') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    @if(in_array($locationType, ['venue', 'custom']))
                        <div class="md:col-span-2">
                            <label for="locationAddress" class="block text-sm font-semibold text-[#3d2b1f] dark:text-gray-200 mb-2">Alamat
                                Lengkap Lokasi</label>
                            <textarea id="locationAddress" wire:model="locationAddress" rows="2"
                                class="w-full rounded-xl border-[#e8ddd2] dark:border-neutral-700 bg-[#fcfaf8] dark:bg-neutral-900 px-4 py-3 text-[#3d2b1f] dark:text-white focus:border-[#3d2b1f] dark:focus:border-amber-500 focus:ring-4 focus:ring-[#3d2b1f]/5 transition-all text-sm"
                                placeholder="Sebutkan nama lokasi atau alamat lengkap..."></textarea>
                            @error('locationAddress') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>
                    @endif
                </div>
            </div>
            {{-- 3. Informasi Kontak --}}
            <div class="bg-white dark:bg-neutral-800 rounded-2xl shadow-sm border border-[#ede8e3] dark:border-neutral-700 overflow-hidden transition-colors">
                <div class="bg-[#3d2b1f] dark:bg-black px-6 py-4">
                    <h3 class="text-white font-serif font-semibold text-lg flex items-center gap-2">
                        <span
                            class="bg-[#f0c27f] text-[#3d2b1f] w-6 h-6 rounded-full flex items-center justify-center text-xs">3</span>
                        Informasi Kontak
                    </h3>
                </div>
                <div class="p-6 space-y-5">
                    <div>
                        <label for="clientName" class="block text-sm font-semibold text-[#3d2b1f] dark:text-gray-200 mb-2">Nama
                            Lengkap</label>
                        <input type="text" id="clientName" wire:model="clientName"
                            class="w-full rounded-xl border-[#e8ddd2] dark:border-neutral-700 bg-[#fcfaf8] dark:bg-neutral-900 px-4 py-3 text-[#3d2b1f] dark:text-white focus:border-[#3d2b1f] dark:focus:border-amber-500 focus:ring-4 focus:ring-[#3d2b1f]/5 transition-all text-sm"
                            placeholder="Masukkan nama lengkap Anda..." required>
                        @error('clientName') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="clientEmail"
                                class="block text-sm font-semibold text-[#3d2b1f] dark:text-gray-200 mb-2">Email</label>
                            <input type="email" id="clientEmail" wire:model="clientEmail"
                                class="w-full rounded-xl border-[#e8ddd2] dark:border-neutral-700 bg-[#fcfaf8] dark:bg-neutral-900 px-4 py-3 text-[#3d2b1f] dark:text-white focus:border-[#3d2b1f] dark:focus:border-amber-500 focus:ring-4 focus:ring-[#3d2b1f]/5 transition-all text-sm"
                                placeholder="contoh@email.com" required>
                            @error('clientEmail') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="clientPhone" class="block text-sm font-semibold text-[#3d2b1f] dark:text-gray-200 mb-2">Nomor
                                WhatsApp</label>
                            <input type="tel" id="clientPhone" wire:model="clientPhone" placeholder="08XXXXXXXXXX"
                                class="w-full rounded-xl border-[#e8ddd2] dark:border-neutral-700 bg-[#fcfaf8] dark:bg-neutral-900 px-4 py-3 text-[#3d2b1f] dark:text-white focus:border-[#3d2b1f] dark:focus:border-amber-500 focus:ring-4 focus:ring-[#3d2b1f]/5 transition-all text-sm"
                                required>
                            @error('clientPhone') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div>
                        <label for="notes" class="block text-sm font-semibold text-[#3d2b1f] dark:text-gray-200 mb-2">Catatan Tambahan
                            (Opsional)</label>
                        <textarea id="notes" wire:model="notes" rows="3"
                            class="w-full rounded-xl border-[#e8ddd2] dark:border-neutral-700 bg-[#fcfaf8] dark:bg-neutral-900 px-4 py-3 text-[#3d2b1f] dark:text-white focus:border-[#3d2b1f] dark:focus:border-amber-500 focus:ring-4 focus:ring-[#3d2b1f]/5 transition-all text-sm"
                            placeholder="Berikan instruksi khusus atau permintaan tema fotomu di sini..."></textarea>
                    </div>
                </div>
            </div>

            {{-- 4. Metode Pembayaran --}}
            <div class="bg-white dark:bg-neutral-800 rounded-2xl shadow-sm border border-[#ede8e3] dark:border-neutral-700 overflow-hidden transition-colors">
                <div class="bg-[#3d2b1f] dark:bg-black px-6 py-4">
                    <h3 class="text-white font-serif font-semibold text-lg flex items-center gap-2">
                        <span
                            class="bg-[#f0c27f] text-[#3d2b1f] w-6 h-6 rounded-full flex items-center justify-center text-xs">4</span>
                        Metode Pembayaran
                    </h3>
                </div>
                <div class="p-6">
                    <p class="text-xs text-[#7a6b5d] mb-4">Pilih metode pembayaran untuk melihat biaya administrasi yang berlaku.</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <label wire:key="pm-va" class="relative flex cursor-pointer rounded-xl border p-3 hover:bg-[#fdfaf8] transition-all {{ $paymentMethod === 'va' ? 'border-[#3d2b1f] bg-[#fdfaf8] ring-1 ring-[#3d2b1f]' : 'border-gray-200' }}">
                            <input type="radio" name="paymentMethod" wire:model.live="paymentMethod" value="va" class="sr-only">
                            <div class="flex items-center gap-3">
                                <div class="bg-blue-50 p-2 rounded-lg text-blue-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-[#3d2b1f]">Transfer Bank (VA)</p>
                                    <p class="text-[10px] text-[#7a6b5d]">Biaya: Rp 4.000</p>
                                </div>
                            </div>
                        </label>

                        <label wire:key="pm-cc" class="relative flex cursor-pointer rounded-xl border p-3 hover:bg-[#fdfaf8] transition-all {{ $paymentMethod === 'credit_card' ? 'border-[#3d2b1f] bg-[#fdfaf8] ring-1 ring-[#3d2b1f]' : 'border-gray-200' }}">
                            <input type="radio" name="paymentMethod" wire:model.live="paymentMethod" value="credit_card" class="sr-only">
                            <div class="flex items-center gap-3">
                                <div class="bg-purple-50 p-2 rounded-lg text-purple-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-[#3d2b1f]">Kartu Kredit</p>
                                    <p class="text-[10px] text-[#7a6b5d]">Biaya: 2.9% + Rp 2.000</p>
                                </div>
                            </div>
                        </label>

                        <label wire:key="pm-gopay" class="relative flex cursor-pointer rounded-xl border p-3 hover:bg-[#fdfaf8] transition-all {{ $paymentMethod === 'gopay' ? 'border-[#3d2b1f] bg-[#fdfaf8] ring-1 ring-[#3d2b1f]' : 'border-gray-200' }}">
                            <input type="radio" name="paymentMethod" wire:model.live="paymentMethod" value="gopay" class="sr-only">
                            <div class="flex items-center gap-3">
                                <div class="bg-cyan-50 p-2 rounded-lg text-cyan-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-[#3d2b1f]">GoPay / ShopeePay</p>
                                    <p class="text-[10px] text-[#7a6b5d]">Biaya: 2%</p>
                                </div>
                            </div>
                        </label>

                        <label wire:key="pm-qris" class="relative flex cursor-pointer rounded-xl border p-3 hover:bg-[#fdfaf8] transition-all {{ $paymentMethod === 'qris' ? 'border-[#3d2b1f] bg-[#fdfaf8] ring-1 ring-[#3d2b1f]' : 'border-gray-200' }}">
                            <input type="radio" name="paymentMethod" wire:model.live="paymentMethod" value="qris" class="sr-only">
                            <div class="flex items-center gap-3">
                                <div class="bg-red-50 p-2 rounded-lg text-red-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-[#3d2b1f]">QRIS (All Bank/Wallet)</p>
                                    <p class="text-[10px] text-[#7a6b5d]">Biaya: 0.7%</p>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar: Summary --}}
        <div class="lg:col-span-1">
            <div class="sticky top-24 space-y-6">
                <div class="bg-white dark:bg-neutral-800 rounded-2xl shadow-md border border-[#ede8e3] dark:border-neutral-700 overflow-hidden relative transition-colors">
                    {{-- Loading overlay saat update state livewire --}}
                    <div wire:loading.delay
                        class="absolute inset-0 bg-white/50 dark:bg-black/50 backdrop-blur-sm z-10 flex items-center justify-center">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#3d2b1f] dark:border-amber-500"></div>
                    </div>

                    <div class="bg-[#f0c27f] px-6 py-4">
                        <h3 class="text-[#3d2b1f] font-serif font-bold text-lg">Ringkasan Pesanan</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        @if($selectedServiceName)
                            <div class="space-y-4">
                                <div class="space-y-3">
                                    <div class="flex justify-between items-start">
                                        <span class="text-xs text-[#7a6b5d] dark:text-gray-400">Layanan:</span>
                                        <span
                                            class="text-sm font-bold text-[#3d2b1f] dark:text-gray-200 text-right">{{ $selectedServiceName }}</span>
                                    </div>
                                    @if($selectedPackageName)
                                        <div class="flex justify-between items-start">
                                            <span class="text-xs text-[#7a6b5d] dark:text-gray-400">Paket:</span>
                                            <span
                                                class="text-sm font-medium text-[#3d2b1f] dark:text-amber-400 text-right">{{ $selectedPackageName }}</span>
                                        </div>
                                    @endif
                                </div>



                                <div class="border-t border-dashed border-gray-200 dark:border-neutral-700 pt-4 space-y-2">
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-[#7a6b5d] dark:text-gray-400">Subtotal Pesanan</span>
                                        <span class="text-sm font-bold text-[#3d2b1f] dark:text-amber-400">Rp {{ number_format($totalAmount, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center gap-1">
                                            <span class="text-xs text-[#7a6b5d] dark:text-gray-400">Biaya Admin</span>
                                            <div class="group relative">
                                                <svg class="w-3 h-3 text-[#7a6b5d] dark:text-gray-500 cursor-help" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 w-48 p-2 bg-[#3d2b1f] dark:bg-black text-white text-[10px] rounded shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-20">
                                                    Biaya transaksi layanan Midtrans sesuai metode yang dipilih.
                                                </div>
                                            </div>
                                        </div>
                                        <span class="text-sm font-medium text-amber-600 dark:text-amber-500">+ Rp {{ number_format($adminFee, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between items-center pt-2 border-t border-gray-100 dark:border-neutral-700">
                                        <span class="text-sm text-[#3d2b1f] dark:text-gray-400 font-bold">Total Pembayaran</span>
                                        <span class="text-2xl font-serif font-bold text-[#3d2b1f] dark:text-white">
                                            Rp {{ number_format($grossAmount, 0, ',', '.') }}
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
                        <p class="text-[10px] text-center text-[#9a8b7d] dark:text-gray-500">Dengan menekan tombol di atas, Anda menyetujui
                            Syarat & Ketentuan Swarattive.</p>
                    </div>
                </div>

                {{-- Info --}}
                <div class="bg-[#f5f0eb] dark:bg-neutral-800 rounded-2xl p-6 border border-[#e8ddd2] dark:border-neutral-700 transition-colors">
                    <h4 class="text-sm font-bold text-[#3d2b1f] dark:text-amber-400 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Informasi Penting
                    </h4>
                    <ul class="text-xs text-[#7a6b5d] dark:text-gray-400 space-y-2 list-disc pl-4">
                        <li>Pembayaran wajib dilunaskan untuk mengonfirmasi jadwal.</li>
                        <li>Pembatalan < 3 hari sebelum sesi akan dikenakan biaya administrasi.</li>
                        <li>Hasil edit foto akan selesai dalam 7-14 hari kerja.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</form>