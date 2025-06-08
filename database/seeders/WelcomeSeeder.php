<?php

namespace Database\Seeders;

use App\Models\Welcome;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WelcomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Welcome::create([
            'title1' => 'Menjadi Generasi Berkarakter, Berilmu, dan Berakhlak Mulia',
            'description1' => 'Sekolah kami memadukan kurikulum nasional dengan nilai-nilai keislaman yang luhur. Kami membimbing siswa untuk tidak hanya cerdas secara akademis, tetapi juga memiliki karakter yang kuat dan akhlak yang terpuji, siap menghadapi tantangan masa depan.',
            'title2' => 'Pendidikan Holistik: Ilmu Pengetahuan dan Spiritualitas',
            'description2' => 'Kami percaya bahwa pendidikan terbaik adalah yang menyeimbangkan kecerdasan intelektual, emosional, dan spiritual. Dengan lingkungan yang inklusif dan inspiratif, siswa kami tumbuh menjadi pribadi yang berintegritas tinggi dan peduli terhadap sesama.',
            'title3' => 'Membangun Masa Depan Gemilang Bersama Nilai-Nilai Keimanan',
            'description3' => 'Di sekolah kami, setiap anak didorong untuk menggali potensi terbaiknya dalam suasana yang penuh kasih, disiplin, dan rasa hormat. Melalui penguatan iman dan wawasan dunia, kami mencetak generasi yang siap menjadi pemimpin masa depan.'
        ]);
        $this->command->info('Seeder Welcome Berhasil');
    }
}
