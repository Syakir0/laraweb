# 🏫 **LAPORAN PROYEK SISTEM INFORMASI DATA DOSEN**

**(RESTful API Berbasis Laravel 11)**

---

## 📘 **KATA PENGANTAR**

Puji syukur kehadirat Allah SWT atas limpahan rahmat dan karunia-Nya sehingga penulis dapat menyelesaikan proyek *Sistem Informasi Data Dosen* ini tepat pada waktunya.
Proyek ini dikembangkan menggunakan framework **Laravel 11** dengan pendekatan **RESTful API**, sebagai bentuk penerapan konsep pemrograman berbasis layanan (*service-oriented architecture*).

Aplikasi ini diharapkan dapat menjadi solusi bagi pengelolaan data dosen di lingkungan perguruan tinggi secara **efisien, terstruktur, dan mudah diintegrasikan** dengan sistem lain seperti aplikasi mobile dan sistem akademik kampus.

---

## 📑 **DAFTAR ISI**

1. **Pendahuluan**
2. **Rumusan Masalah dan Tujuan**
3. **Metodologi Pengembangan**
4. **Analisis dan Perancangan Sistem**
5. **Implementasi Sistem**
6. **Pengujian API**
7. **Kesimpulan dan Saran**
8. **Lampiran (Contoh JSON dan Hasil Postman)**

---

## 🧭 **1. PENDAHULUAN**

### 1.1 Latar Belakang

Seiring dengan kemajuan teknologi informasi, kebutuhan akan sistem manajemen data akademik yang terintegrasi semakin meningkat.
Salah satu aspek penting dalam sistem akademik adalah pengelolaan **data dosen**, yang meliputi informasi pribadi, pangkat akademik, serta bidang keahlian yang ditekuni.

Pengelolaan data secara manual menggunakan spreadsheet atau dokumen konvensional rentan terhadap kesalahan, redundansi data, dan kesulitan dalam sinkronisasi antar bagian.
Untuk mengatasi permasalahan tersebut, dikembangkanlah aplikasi **REST API Laravel** yang menyediakan layanan terstandarisasi untuk pengelolaan data dosen.

---

## 🎯 **2. RUMUSAN MASALAH DAN TUJUAN**

### 2.1 Rumusan Masalah

1. Bagaimana membangun sistem backend yang mampu menyimpan dan mengelola data dosen secara efisien?
2. Bagaimana menerapkan konsep *relational database* dengan relasi antar tabel (pangkat, bidang keahlian, dosen)?
3. Bagaimana merancang API yang aman, modular, dan mudah diintegrasikan?

### 2.2 Tujuan

1. Membangun **RESTful API** untuk manajemen data dosen berbasis Laravel.
2. Mengimplementasikan fitur CRUD untuk entitas **pangkat**, **kelompok bidang keahlian**, dan **dosen**.
3. Menyediakan dokumentasi endpoint yang mudah diuji menggunakan **Postman**.

---

## 🧩 **3. METODOLOGI PENGEMBANGAN**

Proyek ini dikembangkan menggunakan pendekatan **Model-View-Controller (MVC)** dengan tahapan sebagai berikut:

| Tahap            | Deskripsi                                                                             |
| ---------------- | ------------------------------------------------------------------------------------- |
| **Analisis**     | Menentukan kebutuhan data dan relasi antar entitas (pangkat, bidang keahlian, dosen). |
| **Perancangan**  | Mendesain struktur database dan arsitektur API.                                       |
| **Implementasi** | Menggunakan Laravel 11 dan MySQL untuk pengembangan API.                              |
| **Pengujian**    | Menggunakan Postman untuk uji endpoint dan validasi response JSON.                    |

---

## 🧱 **4. ANALISIS DAN PERANCANGAN SISTEM**

### 4.1 Diagram Relasi (ERD)

```
+-------------+          +------------------------------+
|   Pangkats  |          | Kelompok_Bidang_Keahlians    |
|-------------|          |------------------------------|
| id          |          | id                           |
| nama_pangkat|          | nama_kelompok                |
| golongan    |          | deskripsi                    |
| ruang       |          +------------------------------+
| keterangan  |
+------+------+                |
       |                        |
       |                        |
       |                        |
       +----------+-------------+
                  |
                  v
            +-------------+
            |   Dosens    |
            |-------------|
            | id          |
            | nip         |
            | nama        |
            | email       |
            | pangkat_id  |
            | kelompok_bidang_keahlian_id |
            | nomor_hp    |
            | alamat      |
            +-------------+
```

---

## ⚙️ **5. IMPLEMENTASI SISTEM**

### 5.1 Teknologi yang Digunakan

| Komponen          | Teknologi       |
| ----------------- | --------------- |
| Framework Backend | Laravel 11      |
| Bahasa            | PHP 8.3         |
| Database          | MySQL           |
| Autentikasi       | JWT Token       |
| Server            | Apache / Docker |
| API Testing       | Postman         |

### 5.2 Struktur Direktori Utama

```
app/
 ├─ Http/
 │   ├─ Controllers/
 │   │   ├─ Api/
 │   │   │   ├─ PangkatController.php
 │   │   │   ├─ KelompokBidangKeahlianController.php
 │   │   │   └─ DosenController.php
database/
 ├─ migrations/
 │   ├─ 2025_10_22_create_pangkats_table.php
 │   ├─ 2025_10_23_create_kelompok_bidang_keahlians_table.php
 │   ├─ 2025_10_24_create_dosens_table.php
routes/
 ├─ api.php
```

---

## 🌐 **6. PENGUJIAN API (POSTMAN)**

### 🔹 Endpoint 1 — Tambah Pangkat

**URL:** `/api/admin/pangkats`
**Method:** `POST`

**Request:**

```json
{
  "nama_pangkat": "Lektor Kepala",
  "golongan": "IV/B",
  "ruang": "B",
  "keterangan": "Jabatan akademik menengah tingkat lanjut"
}
```

**Response:**

```json
{
  "success": true,
  "message": "Data pangkat berhasil ditambahkan",
  "data": {
    "id": 1,
    "nama_pangkat": "Lektor Kepala",
    "golongan": "IV/B",
    "ruang": "B",
    "keterangan": "Jabatan akademik menengah tingkat lanjut"
  }
}
```

---

### 🔹 Endpoint 2 — Tambah Kelompok Bidang Keahlian

**URL:** `/api/admin/kelompok-bidang-keahlians`
**Method:** `POST`

**Request:**

```json
{
  "nama_kelompok": "Teknologi Rekayasa Jaringan Komputer",
  "deskripsi": "Fokus pada pengembangan sistem jaringan, keamanan, dan infrastruktur data."
}
```

**Response:**

```json
{
  "success": true,
  "message": "Data kelompok bidang keahlian berhasil ditambahkan",
  "data": {
    "id": 1,
    "nama_kelompok": "Teknologi Rekayasa Jaringan Komputer",
    "deskripsi": "Fokus pada pengembangan sistem jaringan, keamanan, dan infrastruktur data."
  }
}
```

---

### 🔹 Endpoint 3 — Tambah Dosen

**URL:** `/api/admin/dosens`
**Method:** `POST`

**Request:**

```json
{
  "nidn": "1234567890",
  "nip": "198765432109876543",
  "tmt": "2020-01-01",
  "nama_lengkap": "Dr. Ahmad Syakir, M.Kom",
  "pangkat_id": 1,
  "jenis_kelamin": true,
  "foto": "https://www.gravatar.com/avatar/ahmad_sy",
  "kelompok_bidang_keahlian_id": 1,
  "bidang_keilmuan": "Kecerdasan Buatan dan Machine Learning",
  "jabatan_fungsional": "lektor kepala",
  "status": "aktif",
  "user_id": 1,
  "program_studi_id": 1
}


```

**Response:**

```json
{
    "success": true,
    "message": "Data dosen berhasil ditambahkan",
    "data": {
        "nidn": "1234567890",
        "nip": "198765432109876543",
        "tmt": "2020-01-01",
        "nama_lengkap":  "Dr. Ahmad Syakir, M.Kom",
        "pangkat_id": 1,
        "jenis_kelamin": true,
        "foto": "https://www.gravatar.com/avatar/ahmad_sy",
        "kelompok_bidang_keahlian_id": 1,
        "bidang_keilmuan": "Kecerdasan Buatan dan Machine Learning",
        "jabatan_fungsional": "lektor kepala",
        "status": "aktif",
        "user_id": 1,
        "program_studi_id": 1,
        "updated_at": "2025-10-31T02:14:35.000000Z",
        "created_at": "2025-10-31T02:14:35.000000Z",
        "id": 1
    }
}
```

---

## 🧠 **7. KESIMPULAN DAN SARAN**

### 7.1 Kesimpulan

Dari hasil pengembangan dan pengujian yang dilakukan, diperoleh bahwa sistem **RESTful API Laravel** ini:

* Berhasil menyediakan layanan CRUD untuk entitas *pangkat*, *kelompok bidang keahlian*, dan *dosen*.
* Memiliki struktur relasional yang jelas antar tabel.
* Siap untuk diintegrasikan dengan aplikasi frontend (web maupun mobile).

### 7.2 Saran

1. Tambahkan **upload foto dosen** menggunakan Laravel Storage.
2. Implementasikan **pagination & search** di setiap endpoint.
3. Tambahkan **role-based access (admin/user)** untuk keamanan yang lebih baik.
4. Integrasikan dengan **frontend Vue.js / Flutter** agar menjadi aplikasi utuh.

---

## 📎 **8. LAMPIRAN**

### Contoh Struktur JSON (Gabungan Data Relasional)

```json
{
  "nama": "Dr. Ahmad Syakir, S.T., M.T.",
  "pangkat": {
    "nama_pangkat": "Lektor Kepala",
    "golongan": "IV/B"
  },
  "kelompok_bidang_keahlian": {
    "nama_kelompok": "Teknologi Rekayasa Jaringan Komputer"
  }
}
```

---

