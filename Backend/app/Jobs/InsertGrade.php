<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Scores;
use Illuminate\Support\Facades\Log;


class InsertGrade implements ShouldQueue
{
    use Queueable;
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $scores;
    public function __construct(array $scores)
    {
        $this->scores = $scores;
    }
    public function handle(): void
    {
        try {
            Scores::insert($this->scores);
        } catch (\Exception $e) {
            echo "Error inserting grades: " . $e->getMessage() . "\n";
            Log::error("Error inserting grades: " . $e->getMessage());
        }
    }
}
