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
            'description1' => 'Sekolah kami memadukan kurikulum nasional dengan nilai-nilai keislaman yang luhur.',
            'title2' => 'Pendidikan Holistik: Ilmu Pengetahuan dan Spiritualitas',
            'description2' => 'Kami percaya bahwa pendidikan terbaik adalah yang menyeimbangkan kecerdasan intelektual, emosional, dan spiritual.',
            'title3' => 'Membangun Masa Depan Gemilang Bersama Nilai-Nilai Keimanan',
            'description3' => 'Di sekolah kami, setiap anak didorong untuk menggali potensi terbaiknya dalam suasana yang penuh kasih.'
        ]);
        $this->command->info('Seeder Welcome Berhasil');
    }
}
