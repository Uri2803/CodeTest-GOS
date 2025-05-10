<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;

class ScoreController extends Controller
{
    public function searchBySbd($sbd) {
        try {
            $score = Grade::where('sbd', $sbd)->first();
            if (!$score) {
                return response()->json([
                    'success'=> false,
                    'message' => 'Không tìm thấy số báo danh',
                ], 404);
            }
            return response()->json([
                'message' => 'Tìm thấy kết quả',
                'success'=> true,
                'data' => $score
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success'=> false,
                'message' => 'Đã có lỗi xảy ra khi xử lý yêu cầu',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
