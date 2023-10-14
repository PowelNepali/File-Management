<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correctAnswers = array("2", "1", "4", "3", "1");

    
    $totalScore = 0;

    include 'config.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $user_id = $_GET['id'];
    $exam_id = $_GET['examid'];

    if (!empty($exam_id) && !empty($user_id)) {
        $check_query = $conn->prepare("SELECT user_id FROM exam_results WHERE ex_id = ? AND user_id = ?");
        $check_query->bind_param("ii", $exam_id, $user_id);
        $check_query->execute();
        $check_result = $check_query->get_result();

        if ($check_result->num_rows > 0) {
            echo "You have already taken this exam. You cannot take it again.";
        } else {
            $insert_query = $conn->prepare("INSERT INTO exam_results(ex_id, user_id, score) VALUES (?, ?, ?)");
            $insert_query->bind_param("iii", $exam_id, $user_id, $totalScore);

            if ($insert_query->execute()) {
                echo "Exam results stored successfully!";
            } else {
                echo "Error: " . $conn->error;
            }

            $insert_query->close();
        }
    } else {
        echo "Invalid exam or user ID.";
    }

    $conn->close(); 
} else {
    echo "Invalid request. Please submit the form from the student page.";
}

function calculateTotalScore($submittedAnswers, $correctAnswers, $questionScores) {
    $totalScore = 0;

    foreach ($correctAnswers as $i => $correctAnswer) {
        if (isset($submittedAnswers["question_$i"]) && in_array($correctAnswer, $submittedAnswers["question_$i"])) {
        }
    }
    print_r($totalScore);

    return $totalScore;
} 
?>
