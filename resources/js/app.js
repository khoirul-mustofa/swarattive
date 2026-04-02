import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Navbar Mobile
// document.addEventListener('DOMContentLoaded', () => {
//     const btn = document.getElementById('menuBtn')
//     const menu = document.getElementById('mobileMenu')

//     if (!btn || !menu) return

//     btn.addEventListener('click', () => {
//         menu.classList.toggle('hidden')
//     })

//     // ✅ Tutup saat klik link
//     document.querySelectorAll('#mobileMenu a').forEach(link => {
//         link.addEventListener('click', () => {
//             menu.classList.add('hidden')
//         })
//     })

//     // ✅ Tutup saat klik di luar
//     document.addEventListener('click', (e) => {
//         if (!menu.contains(e.target) && !btn.contains(e.target)) {
//             menu.classList.add('hidden')
//         }
//     })
// })