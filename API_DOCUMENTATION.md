# 📔 Dokumentasi API Buku Perjalanan (API Travel Diary)

Dokumentasi ini berisi daftar lengkap endpoint API, parameter yang dibutuhkan, dan contoh respon untuk aplikasi Buku Perjalanan berbasis Laravel + JWT.

**Base URL:** `http://localhost:8000/api`  
**Auth Type:** Bearer Token (JWT)

---

## 🔐 Autentikasi (Auth)

### 1. Registrasi Akun
Mendaftarkan pengguna baru ke sistem.
- **URL:** `/auth/register`
- **Method:** `POST`
- **Body (JSON):**
  - `name` (string, required)
  - `email` (string, required, unique)
  - `password` (string, required, min:8)
  - `password_confirmation` (string, required)

**cURL:**
```bash
curl -X POST http://localhost:8000/api/auth/register \
     -H "Content-Type: application/json" \
     -d '{
           "name": "Budi Santoso",
           "email": "budi@example.com",
           "password": "password123",
           "password_confirmation": "password123"
         }'
```

---

### 2. Login
Mendapatkan token akses untuk mengakses endpoint yang diproteksi.
- **URL:** `/auth/login`
- **Method:** `POST`
- **Body (JSON):**
  - `email` (string, required)
  - `password` (string, required)

**cURL:**
```bash
curl -X POST http://localhost:8000/api/auth/login \
     -H "Content-Type: application/json" \
     -d '{
           "email": "budi@example.com",
           "password": "password123"
         }'
```

---

### 3. Profil Saya (Me)
Mendapatkan informasi detail pengguna yang sedang login.
- **URL:** `/auth/me`
- **Method:** `GET`
- **Auth:** `Bearer Token`

**cURL:**
```bash
curl -X GET http://localhost:8000/api/auth/me \
     -H "Authorization: Bearer <your_token_here>"
```

---

## ✈️ Catatan Perjalanan (Travel Notes)

### 4. Daftar Catatan Perjalanan
Mendapatkan semua catatan perjalanan (dipaginasi).
- **URL:** `/travel-notes`
- **Method:** `GET`
- **Auth:** `Bearer Token`

**cURL:**
```bash
curl -X GET http://localhost:8000/api/travel-notes \
     -H "Authorization: Bearer <your_token_here>"
```

---

### 5. Tambah Catatan Baru
Membuat catatan perjalanan dengan dukungan unggah foto.
- **URL:** `/travel-notes`
- **Method:** `POST`
- **Auth:** `Bearer Token`
- **Body (Form-Data):**
  - `title`, `location`, `country`, `date`, `experience`, `mood` (required)
  - `photo` (file, optional)

**cURL:**
```bash
curl -X POST http://localhost:8000/api/travel-notes \
     -H "Authorization: Bearer <your_token_here>" \
     -F "title=Liburan ke Bali" \
     -F "location=Ubud" \
     -F "country=Indonesia" \
     -F "date=2024-05-20" \
     -F "experience=Pemandangan sawah sangat asri..." \
     -F "mood=happy" \
     -F "photo=@/path/to/your/image.jpg"

---

### 5.1. Tambah Catatan Baru (Base64)
Sama seperti endpoint #5, namun foto dikirim sebagai string Base64 dalam JSON. Memudahkan integrasi mobile/frontend murni.
- **URL:** `/travel-notes/base64`
- **Method:** `POST`
- **Auth:** `Bearer Token`
- **Body (JSON):**
  - `title`, `location`, `country`, `date`, `experience`, `mood` (required)
  - `photo` (string Base64, optional). Contoh format: `data:image/png;base64,...`

**cURL:**
```bash
curl -X POST http://localhost:8000/api/travel-notes/base64 \
     -H "Authorization: Bearer <your_token_here>" \
     -H "Content-Type: application/json" \
     -d '{
           "title": "Liburan Berbasis Base64",
           "location": "Jakarta",
           "country": "Indonesia",
           "date": "2024-06-01",
           "experience": "Mencoba upload tanpa multipart...",
           "mood": "relaxed",
           "photo": "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8/5+hHgAHggJ/PchI7wAAAABJRU5ErkJggg=="
         }'
```
```

---

### 6. Update Catatan Perjalanan
Memperbarui data catatan. Gunakan **Method Spoofing** jika mengunggah foto baru.
- **URL:** `/travel-notes/{id}`
- **Method:** `POST` (dengan `_method=PUT`) atau `PUT` murni (hanya teks)
- **Auth:** `Bearer Token`

**cURL (Multipart/Form-Data):**
```bash
curl -X POST http://localhost:8000/api/travel-notes/1 \
     -H "Authorization: Bearer <your_token_here>" \
     -F "_method=PUT" \
     -F "title=Judul Baru" \
     -F "mood=relaxed"
```

---

### 7. Hapus Catatan Perjalanan
Menghapus catatan perjalanan permanen (hanya oleh pemilik).
- **URL:** `/travel-notes/{id}`
- **Method:** `DELETE`
- **Auth:** `Bearer Token`

**cURL:**
```bash
curl -X DELETE http://localhost:8000/api/travel-notes/1 \
     -H "Authorization: Bearer <your_token_here>"
```

---

## 💬 Komentar (Comments)

### 8. Tambah Komentar
Menambahkan komentar pada suatu catatan perjalanan.
- **URL:** `/travel-notes/{travel_note_id}/comments`
- **Method:** `POST`
- **Auth:** `Bearer Token`
- **Body (JSON):**
  - `author` (string, required)
  - `comment_text` (string, required)

**cURL:**
```bash
curl -X POST http://localhost:8000/api/travel-notes/1/comments \
     -H "Authorization: Bearer <your_token_here>" \
     -H "Content-Type: application/json" \
     -d '{
           "author": "Andi",
           "comment_text": "Keren sekali fotonya!"
         }'
```

---

### 9. Hapus Komentar
Menghapus komentar tertentu (hanya oleh pemilik catatan perjalanan).
- **URL:** `/comments/{id}`
- **Method:** `DELETE`
- **Auth:** `Bearer Token`

**cURL:**
```bash
curl -X DELETE http://localhost:8000/api/comments/1 \
     -H "Authorization: Bearer <your_token_here>"
```

---

## 📋 Struktur Respon Sukses (Contoh)
```json
{
    "message": "Operasi berhasil!",
    "data": {
        "id": 1,
        "title": "Catatan Pertama",
        "user_id": 5,
        "created_at": "2024-04-13T...Z"
    }
}
```

## ❌ Respon Error (422 Unprocessable Entity)
```json
{
    "email": ["Email sudah terdaftar."],
    "password": ["Kata sandi minimal 8 karakter."]
}
```
