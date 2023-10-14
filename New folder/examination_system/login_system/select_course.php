<?php
include 'config.php';
session_start(); 
if(isset($_GET['msg']))
{
    if($_GET['msg']==1)
    {
        $message[] = "Times Out";
    }
    elseif ($_GET['msg']==2) {
        $message[] = "You have already taken this exam. You cannot take it again.";
    }
    elseif ($_GET['msg']==3) {
        $message[] = "Exam taken Successfully";
    }
    elseif ($_GET['msg']==4) {
        $message[] = "Your result was't publish yet.";
    }
}



$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;



if (isset($_POST['btnExam'])) {

    $course_name = $_POST['course'];
    $exam_query = "SELECT ex_id, ex_title, ex_time_limit FROM examinfo_tbl WHERE course_name = '$course_name'";
    $result = $conn->query($exam_query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $exam_id = $row['ex_id'];
    }


    // Ensure $exam_id and $user_id are valid and not empty
    if (!empty($exam_id) && !empty($user_id)) 
    {
        // Check if the user has already taken the exam
        $check_query = $conn->prepare("SELECT user_id FROM exam_results WHERE ex_id = ? AND user_id = ?");
        $check_query->bind_param("ii", $exam_id, $user_id);
        $check_query->execute();
        $check_result = $check_query->get_result();

        if ($check_result->num_rows > 0) {
            $message[] = "You have already taken this exam. You cannot take it again.";

        } else {
            header('Location: student_page.php?course=' . $course_name . '&id=' . $user_id);
            
        }
    }
}

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Select Course</title>
   <h2> <a href="logout.php">Logout</a></h2>
 <style>
            /* Reset default styles */
body, h1, select, form, input {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Basic styling for the page */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    text-align: center;
    padding: 20px;
}

h1 {
    background-color: #333;
    color: #fff;
    padding: 20px;
    margin-bottom: 20px;
}

form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

label {
    margin-bottom: 10px;
    font-weight: bold;
}

select {
    padding: 10px;
    width: 80%;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 20px;
}

input[type="submit"] {
    padding: 10px 20px;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #555;
}

/* Message styling */
.message {
    background-color: #ff3333;
    color: #fff;
    padding: 10px;
    margin: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.message i {
    cursor: pointer;
}

.message i:hover {
    color: #333;
}

/* Logout link styling */
a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
    padding: 10px;
    border: 1px solid #333;
    border-radius: 5px;
    margin-top: 20px;
    display: inline-block;
    transition: background-color 0.3s;
}

a:hover {
    background-color: #333;
    color: #fff;
}

    </style>
</head>
<body>
      <h1><marquee direction="right">Hello Student, please Select a Course</marquee></h1>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="courseSelect">Select a Exam:</label>
        <select id="courseSelect" name="course">
            <?php

            include 'config.php';

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $course_query = "SELECT DISTINCT course_name FROM examinfo_tbl";
            $result = $conn->query($course_query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $course_name = $row['course_name'];
                    echo "<option value=\"$course_name\">$course_name</option>";
                }
            } else {
                echo "<option value=\"\">No courses available</option>";
            }

            $conn->close(); 
            ?>
        </select> 
        <br>
        <input type="submit" value="Start Exam" name="btnExam">
    </form>
    <a href="view_result.php?user_id=<?php echo $user_id ?>" class="view-results-button">View Results</a>
</body>
</html>
