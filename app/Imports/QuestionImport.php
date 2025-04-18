<?php

namespace App\Imports;

use App\Models\Question;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class QuestionImport implements ToCollection, WithHeadingRow
{
    protected $answers;
    protected $challenge_id;

    public function __construct($questionsFilePath, $answersFilePath, $challenge_id)
    {
        $this->challenge_id = $challenge_id;

        // Read and store answers from the provided file
        $this->answers = Excel::toArray(null, storage_path('app/' . $answersFilePath))[0];
        Log::info('Answers Data: ' . json_encode($this->answers));

        // Import questions
        Excel::import($this, storage_path('app/' . $questionsFilePath));
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            Log::info('Row Data: ' . json_encode($row));

            $questionText = $row['questiontext'] ?? null;

            if ($questionText === null) {
                Log::warning('Missing required fields in row: ' . json_encode($row));
                continue; // Skip rows with missing data
            }

            $answerData = $this->answers[$index + 1] ?? null; // Adjusting index if the answers file has a header row
            Log::info('Answer Data: ' . json_encode($answerData));

            if ($answerData) {
                Question::create([
                    'questionText' => $questionText,
                    'answer' => $answerData[0] ?? null, // Assuming answer is in the first column
                    'markAllocated' => $answerData[1] ?? null, // Assuming marks are in the second column
                    'challengeNo' => $this->challenge_id,
                ]);
            }
        }
    }
}
