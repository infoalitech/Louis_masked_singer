<?php
$rounds = [
    ["id" => 1, "masked_video" => "https://www.youtube.com/watch?v=_ZNwiTAZA0o&list=RD_ZNwiTAZA0o&start_radio=1", "correct_answer" => "Banana"],
    ["id" => 2, "masked_video" => "https://www.youtube.com/watch?v=BfOwGCgmTe0&list=RD_ZNwiTAZA0o&index=11", "correct_answer" => "Fox"],
    // Add more rounds
];

$roundAnswers = [
    ["round_id" => 1, "answers" => ["Banana", "Fox", "Lion", "Watermelon"]],
    ["round_id" => 2, "answers" => ["Fox", "Sunflower", "Robot", "Tree"]],
    // Add more round answers
];

$combinedRounds = [];

foreach ($rounds as $round) {
    $roundId = $round['id'];
    $answers = [];

    foreach ($roundAnswers as $answer) {
        if ($answer['round_id'] === $roundId) {
            $answers = $answer['answers'];
            break;
        }
    }

    $combinedRounds[] = [
        "id" => $round['id'],
        "masked_video" => $round['masked_video'],
        "correct_answer" => $round['correct_answer'],
        "answers" => $answers,
    ];
}

header("Content-Type: application/json");
echo json_encode($combinedRounds);
?>
