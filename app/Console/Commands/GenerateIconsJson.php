<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateIconsJson extends Command
{
    protected $signature = 'icons:generate {--style=solid}';
    protected $description = 'Generate icons.json from Font Awesome metadata/icons.json';
    public function handle()
    {
        $style = $this->option('style');
        $sourcePath = public_path('fontawesome/metadata/icons.json');
        $outputPath = public_path('icons.json');

        if (!File::exists($sourcePath)) {
            $this->error("File not found: $sourcePath");
            return Command::FAILURE;
        }

        $rawIcons = json_decode(File::get($sourcePath), true);
        $icons = [];

        foreach ($rawIcons as $icon => $data) {
            if (in_array($style, $data['styles'])) {
                $icons[] = "fa-$style fa-$icon";
            }
        }

        File::put($outputPath, json_encode($icons, JSON_PRETTY_PRINT));

        $this->info("Berhasil menulis " . count($icons) . " ikon ke $outputPath");

        return Command::SUCCESS;
    }
}
