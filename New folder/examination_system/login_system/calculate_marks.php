<?php
  @include 'config.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$exam_id = $_POST['exam_id'];
$total_marks = $_POST['total_marks'];

$student_answers = $_POST['answer'];
$correct_answers = [];

$sql = "SELECT eqt_id, ex_answer FROM examquestion_tbl WHERE ex_id = $exam_id";
$answer_result = $conn->query($sql);

while ($row = $answer_result->fetch_assoc()) {
    $correct_answers[$row['eqt_id']] = $row['ex_answer'];
}

$marks = 0;
foreach ($student_answers as $eqt_id => $student_answer) {
    if (isset($correct_answers[$eqt_id]) && $student_answer === $correct_answers[$eqt_id]) {
        $marks++;
    }
}

echo "You scored $marks out of $total_marks.";

$conn->close();
?>
