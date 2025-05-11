<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Jobs\InsertGrade;
use Illuminate\Support\Facades\Log;

class ScoresTableSeeder extends Seeder
{
    public function run(): void {
        $path = base_path('database/seeders/diem_thi_thpt_2024.csv');
        if (!file_exists($path)) {
            throw new \Exception("File không tồn tại: $path");
        }
    
        $handle = fopen($path, 'r');
        if ($handle === false) {
            throw new \Exception("Không thể mở file CSV");
        }
    
        $header = fgetcsv($handle);
        $header = array_map('trim', $header);
    
        $batchSize = 1000; 
        $scores = [];
    
        while (($row = fgetcsv($handle)) !== false) {
            $row = array_map('trim', $row);
            $row = array_pad($row, count($header), null); 
            $data = array_combine($header, $row);
            
            if (!empty($data['sbd'])) {
                $scores[] = [
                    'sbd' => $data['sbd'],
                    'toan' => is_numeric($data['toan']) ? (float) $data['toan'] : null,
                    'ngu_van' => is_numeric($data['ngu_van']) ? (float) $data['ngu_van'] : null,
                    'ngoai_ngu' => is_numeric($data['ngoai_ngu']) ? (float) $data['ngoai_ngu'] : null,
                    'vat_li' => is_numeric($data['vat_li']) ? (float) $data['vat_li'] : null,
                    'hoa_hoc' => is_numeric($data['hoa_hoc']) ? (float) $data['hoa_hoc'] : null,
                    'sinh_hoc' => is_numeric($data['sinh_hoc']) ? (float) $data['sinh_hoc'] : null,
                    'lich_su' => is_numeric($data['lich_su']) ? (float) $data['lich_su'] : null,
                    'dia_li' => is_numeric($data['dia_li']) ? (float) $data['dia_li'] : null,
                    'gdcd' => is_numeric($data['gdcd']) ? (float) $data['gdcd'] : null,
                    'ma_ngoai_ngu' => $data['ma_ngoai_ngu'] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
    
            if (count($scores) >= $batchSize) {
                InsertGrade::dispatch($scores);
                $scores = [];
            }
        }
        if (count($scores) > 0) {
            InsertGrade::dispatch($scores);
        }
    
        fclose($handle);
    }
}
