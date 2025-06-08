<?php

namespace Database\Seeders;

use App\Models\Cover;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cover::create([
            'judul_madrasah' => 'Madrasah Al Mas`udiyyah',
            'deskripsi_madrasah' => 'Sekolah kami memadukan kurikulum nasional dengan nilai-nilai keislaman yang luhur. Kami membimbing siswa untuk tidak hanya cerdas secara akademis, tetapi juga memiliki karakter yang kuat dan akhlak yang terpuji, siap menghadapi tantangan masa depan.',

            'judul_pondok' => 'Pondok Al Mas`udiyyah',
            'deskripsi_pondok' => 'Kami percaya bahwa pendidikan terbaik adalah yang menyeimbangkan kecerdasan intelektual, emosional, dan spiritual. Dengan lingkungan yang inklusif dan inspiratif, siswa kami tumbuh menjadi pribadi yang berintegritas tinggi dan peduli terhadap sesama.',

            'judul_smp' => 'SMP Al Mas`udiyyah',
            'deskripsi_smp' => 'Di sekolah kami, setiap anak didorong untuk menggali potensi terbaiknya dalam suasana yang penuh kasih, disiplin, dan rasa hormat. Melalui penguatan iman dan wawasan dunia, kami mencetak generasi yang siap menjadi pemimpin masa depan.'
        ]);

        $this->command->info('Seeder Cover Berhasil');
    }
}
