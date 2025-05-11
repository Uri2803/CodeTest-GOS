<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use PhpParser\Node\Stmt\Block;

class ScoreController extends Controller
{

    public function searchBySbd($sbd) {
        try {
            $score = Grade::where('sbd', $sbd)->first();
            $score->sbd = (string) $score->sbd;
            if (!$score) {
                return response()->json([
                    'success'=> false,
                    'message' => 'Không tìm thấy số báo danh',
                ], 404);
            }
            return response()->json([
                'message' => 'Tìm thấy kết quả',
                'success'=> true,
                'score' => $score
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success'=> false,
                'message' => 'Đã có lỗi xảy ra khi xử lý yêu cầu',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function scoreDistribution() {
        $subjects = ['toan', 'ngu_van', 'ngoai_ngu', 'lich_su', 'dia_li', 'gdcd'];
    
        $result = [];
    
        foreach ($subjects as $subject) {
            $result[$subject] = [
                '>=8' => Grade::where($subject, '>=', 8)->count(),
                '6-8' => Grade::where($subject, '>=', 6)->where($subject, '<', 8)->count(),
                '4-6' => Grade::where($subject, '>=', 4)->where($subject, '<', 6)->count(),
                '<4'  => Grade::where($subject, '<', 4)->count(),
            ];
        }
    
        return response()->json([
            'data' => $result
        ]);
    }


    public function topStudentsByBlock($block) {
        try {
            $blockSubjects = Grade::getBlockSubjects();

            if (!isset($blockSubjects[$block])) {
                return response()->json([
                    'error' => 'Invalid block',
                    'success'=> false,
                ], 400);
            }

            $students = Grade::topByBlock($block)->get();

            return response()->json([
                'success'=> true,
                'block' => $block,
                'subjects' => $blockSubjects[$block],
                'students' => $students
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success'=> false,
                'error' => 'Internal server error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
