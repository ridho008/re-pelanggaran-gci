<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypesViolationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Model\TypesViolations::create([
        //     'name_violation' => ''
        // ]);

        $violantions = [
            [
                'name_violation' => 'Mencuri',
                'sum_points' => 15,
                'created_at' => new \DateTime,
            ],
            [
                'name_violation' => 'Membuang Sampah Sembarang',
                'sum_points' => 5,
                'created_at' => new \DateTime,
            ],
            [
                'name_violation' => 'Tidak Meletakan Barang Pada Tempatnya',
                'sum_points' => 5,
                'created_at' => new \DateTime,
            ],
            [
                'name_violation' => 'Parkir Sembarangan',
                'sum_points' => 3,
                'created_at' => new \DateTime,
            ],
        ];

        \DB::table('types_violations')->insert($violantions);
    }
}
