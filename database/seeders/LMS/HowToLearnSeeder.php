<?php

namespace Database\Seeders\LMS;

use App\Models\LMS\Course;
use App\Models\LMS\HowToLearn;
use Illuminate\Database\Seeder;

class HowToLearnSeeder extends Seeder
{
    public function run(): void
    {
        $guides = [
            [
                'title'       => 'Cara Memulai Belajar di Baricode',
                'description' => 'Panduan lengkap untuk memulai perjalanan belajarmu di platform Baricode.',
                'content'     => <<<'MD'
## Selamat Datang di Baricode!

Panduan ini akan membantumu memulai perjalanan belajar di platform Baricode dengan langkah-langkah yang terstruktur.

### Langkah 1: Setup Akun

Pastikan akun kamu sudah terverifikasi dan profil sudah dilengkapi.

- Foto profil yang jelas
- Bio singkat tentang dirimu
- Username yang mudah diingat

### Langkah 2: Pilih Jalur Belajar

> Tentukan tujuanmu terlebih dahulu sebelum memilih kursus.

Baricode menyediakan beberapa jalur belajar:

1. **Web Development** — HTML, CSS, JavaScript, PHP, Laravel
2. **Mobile Development** — Flutter, React Native
3. **DevOps** — Docker, CI/CD, Cloud

### Langkah 3: Ikuti Kursus Secara Berurutan

Setiap kursus dirancang secara berurutan. Jangan melewati materi yang belum kamu pahami.

```
Dasar → Menengah → Lanjutan → Project
```

### Langkah 4: Praktik Setiap Hari

Gunakan fitur **Daily Commit Tracker** untuk mencatat aktivitas belajarmu setiap hari.

### Tips Sukses

- Bergabunglah di komunitas Discord Baricode
- Jangan malu bertanya di forum diskusi
- Bagikan progres belajarmu di social media
MD,
                'is_active'   => true,
            ],
            [
                'title'       => 'Panduan Mengerjakan Quiz dan Evaluasi',
                'description' => 'Cara efektif mengerjakan quiz untuk memaksimalkan pemahaman materi.',
                'content'     => <<<'MD'
## Panduan Quiz Baricode

Quiz adalah salah satu cara terbaik untuk menguji pemahamanmu setelah belajar materi.

### Sebelum Mengerjakan Quiz

Pastikan kamu sudah:

- [ ] Membaca seluruh materi di kategori ini
- [ ] Mencoba contoh kode yang diberikan
- [ ] Membuat catatan poin-poin penting

### Cara Mengerjakan Quiz

1. **Baca soal dengan teliti** — Jangan terburu-buru
2. **Pilih jawaban terbaik** — Perhatikan setiap opsi
3. **Review jawabanmu** — Sebelum submit, periksa kembali

> **Catatan:** Kamu bisa mengulang quiz sebanyak yang kamu mau. Gunakan kesempatan ini untuk benar-benar memahami materi.

### Setelah Quiz

Jika skor belum memuaskan:

```
Skor < 60%  → Ulangi membaca materi
Skor 60-80% → Review bagian yang salah
Skor > 80%  → Lanjut ke materi berikutnya
```

### Manfaat Quiz

- Memperkuat ingatan jangka panjang
- Mengidentifikasi celah pemahaman
- Meningkatkan kepercayaan diri
MD,
                'is_active'   => true,
            ],
            [
                'title'       => 'Best Practices dalam Menulis Kode',
                'description' => 'Kebiasaan baik dalam menulis kode yang bersih, terstruktur, dan mudah dipahami.',
                'content'     => <<<'MD'
## Best Practices Menulis Kode

Menulis kode yang baik bukan hanya soal membuat program yang berjalan, tapi juga kode yang mudah dibaca dan dipelihara.

### Penamaan yang Deskriptif

```php
// Buruk
$x = getUserById(1);

// Baik
$user = getUserById(1);
$activeUser = findActiveUserById($userId);
```

### Prinsip DRY (Don't Repeat Yourself)

Hindari duplikasi kode. Jika kamu menulis hal yang sama lebih dari sekali, buat fungsi atau kelas.

```php
// Buruk
$tax1 = $price1 * 0.11;
$tax2 = $price2 * 0.11;

// Baik
function calculateTax(float $price): float
{
    return $price * 0.11;
}

$tax1 = calculateTax($price1);
$tax2 = calculateTax($price2);
```

### Komentar yang Bermakna

> Kode yang baik mendokumentasikan dirinya sendiri. Tambahkan komentar hanya untuk menjelaskan *mengapa*, bukan *apa*.

### Version Control dengan Git

Selalu commit perubahan kecil dengan pesan yang jelas:

```bash
git commit -m "feat: tambah validasi email di form registrasi"
git commit -m "fix: perbaiki bug kalkulasi pajak"
```
MD,
                'is_active'   => true,
            ],
        ];

        foreach ($guides as $guideData) {
            $guide = HowToLearn::create($guideData);

            // Attach ke beberapa course secara acak
            $courses = Course::inRandomOrder()->take(rand(1, 3))->get();
            $guide->courses()->attach($courses->pluck('id'));
        }

        // Buat 5 panduan tambahan dengan factory
        HowToLearn::factory()
            ->count(5)
            ->create()
            ->each(function (HowToLearn $guide) {
                $courses = Course::inRandomOrder()->take(rand(1, 2))->get();
                $guide->courses()->attach($courses->pluck('id'));
            });
    }
}
