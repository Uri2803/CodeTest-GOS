<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = 'grades';
    protected $primaryKey = 'sbd';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'sbd',
        'toan',
        'ngu_van',
        'ngoai_ngu',
        'vat_li',
        'hoa_hoc',
        'sinh_hoc',
        'lich_su',
        'dia_li',
        'gdcd',
        'ma_ngoai_ngu',
    ];

    protected static $blockSubjects = [
        'A' => ['toan', 'vat_li', 'hoa_hoc'],
        'B' => ['toan', 'hoa_hoc', 'sinh_hoc'],
        'C' => ['ngu_van', 'lich_su', 'dia_li'],
        'D' => ['toan', 'ngu_van', 'ngoai_ngu'],
    ];

    public function scopeTopByBlock($query, $block, $limit = 10)
    {
        if (!isset(self::$blockSubjects[$block])) {
            throw new \InvalidArgumentException("Invalid block: $block");
        }

        $subjects = self::$blockSubjects[$block];
        $sumExpression = implode(' + ', $subjects) . ' as total_score';

        return $query->select('*')
                     ->selectRaw($sumExpression)
                     ->orderByDesc('total_score')
                     ->limit($limit);
    }

    public static function getBlockSubjects() {
        return self::$blockSubjects;
    }
}
