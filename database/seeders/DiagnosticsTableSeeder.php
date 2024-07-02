<?php

namespace Database\Seeders;

use App\Models\Diagnostic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiagnosticsTableSeeder extends Seeder
{
    private $diagnostics = [
        [
            'title' => 'Ekstrakurikuler',
            'thumbnail' => 'ekstrakurikuler.jpg',
            'description' => 'Deskripsi Ekstrakurikuler',
            'link' => 'https://google.com'
        ],
        [
            'title' => 'Tes Gaya Belajar',
            'thumbnail' => 'tes-gaya-belajar.jpg',
            'description' => 'Deskripsi Tes Gaya Belajar',
            'link' => 'https://facebook.com'
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->diagnostics as $diagnostic) {
            Diagnostic::create($diagnostic);
        }
    }
}
