# 🎨 Dokumentasi UI/UX & Tampilan Aplikasi Buku Perjalanan

Dokumen ini menjelaskan detail desain, fitur interaktif, dan alur navigasi yang telah diimplementasikan untuk memberikan pengalaman pengguna yang modern dan profesional.

---

## 1. 🚀 Landing Page Premium (Halaman Utama)
Halaman utama dirancang untuk menarik minat pengguna baru dengan estetika *startup modern*.

### A. Navigasi Cerdas (Navbar)
- **Glassmorphism Effect**: Navbar memiliki efek transparan dan blur yang akan memadat (solid) saat pengguna melakukan scroll.
- **Navigasi Dinamis**: Sistem otomatis mengecek status login. Jika user sedang login, tombol "Masuk/Daftar" otomatis berubah menjadi **"Buka Dashboard"**.
- **Smooth Scrolling**: Link Fitur, Cerita, dan FAQ akan mengarahkan user ke bagian yang tepat dengan transisi gulir yang halus.

### B. Hero Section (Daya Tarik Utama)
- **Visual Resolusi Tinggi**: Menggunakan gambar lanskap pegunungan yang menginspirasi petualangan.
- **Efek Tilt/Rotate**: Gambar memiliki rotasi halus yang memberikan kesan kedalaman 3D.
- **Badge Interaktif**: Terdapat badge "Jurnal Perjalanan Digital #1" dengan animasi titik berkedip (ping animation).

### C. Konten Section
- **Fitur**: Grid berisi kartu interaktif yang menjelaskan fungsi kamera, lokasi, dan mood tracker.
- **Cerita (Story)**: Layout visual yang menjelaskan nilai emosional dari menyimpan kenangan.
- **FAQ (Accordion)**: Bagian tanya jawab interaktif untuk membantu user memahami aplikasi.
- **Statistik Komunitas**: Angka pencapaian (Negara, Catatan, Rating) untuk membangun kepercayaan.

---

## 2. 🔐 Autentikasi Modern (Login & Register)
Halaman pendaftaran dan masuk tidak lagi terasa kaku, melainkan selaras dengan desain landing page.

- **Brand Header**: Menggunakan gradien warna *Vibrant Blue* dan *Violet* yang mewah.
- **Tombol "Beranda" (Back to Home)**:
    - Terletak di pojok kiri atas kartu formulir.
    - Bergaya *Glassmorphism* (semi-transparan dengan efek blur).
    - Memiliki animasi **Hover Slide**: Ikon panah bergeser sedikit ke kiri saat disorot, meningkatkan kesan responsif.
- **Layout Terfokus**: Kartu di tengah layar untuk memastikan perhatian user tertuju pada formulir.

---

## 3. 🔄 Alur Navigasi & Logout
- **Logout ke Landing Page**: Berbeda dengan aplikasi standar yang mengarahkan ke login setelah keluar, aplikasi ini mengarahkan user kembali ke **Landing Page utama**. Hal ini bertujuan agar user bisa melihat kembali informasi aplikasi atau masuk dengan akun lain melalui pintu utama.
- **Global Auth Handling**: Semua header autentikasi dikelola secara otomatis di background, sehingga user tidak perlu memasukkan token berkali-kali selama masa aktif belum habis.

---

## 🛠️ Teknologi Antarmuka yang Digunakan
1. **Tailwind CSS**: Framework CSS utama untuk styling super cepat dan responsif.
2. **Lucide Icons**: Set ikon vektor minimalis dan elegan yang digunakan di seluruh aplikasi.
3. **Plus Jakarta Sans**: Font modern yang sering digunakan oleh brand teknologi global.
4. **Glassmorphism**: Teknik desain menggunakan transparansi dan *backdrop-blur* untuk kedalaman visual.
5. **Axios Interceptors**: Untuk menangani status login/logout di balik layar secara sinkron.

---

> **Catatan UX**: Seluruh elemen dirancang agar "Ringan" namun tetap terasa "Premium". Penggunaan ruang putih (white space) yang luas membantu mata user untuk tidak cepat lelah saat menjelajahi aplikasi.
