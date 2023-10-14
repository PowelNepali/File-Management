<?php
	require 'config.php';
	$user_id = $_GET['user_id'];


	function id_to_result($data,$index)
	{
		require 'config.php';
		$user_id = $data[$index];
		$sql = "SELECT * FROM exam_results WHERE result_id = $user_id";
		$user_data = $conn->query($sql);
		if(mysqli_num_rows($user_data)>0)
		{
			$data = mysqli_fetch_assoc($user_data);
		}
		return $data;
	}

	function id_to_course($data,$index)
	{
		require 'config.php';
		$ex_id = $data[$index];
		$sql = "SELECT * FROM examinfo_tbl WHERE ex_id = $ex_id";
		$exam_data = $conn->query($sql);
		if(mysqli_num_rows($exam_data)>0)
		{
			$data = mysqli_fetch_assoc($exam_data);
		}
		return $data;
	}

	function result($data,$index,$total)
	{
		$total_questions = $data[$total];
		$score = $data[$index];

		if($score <=100 && $score >= 40)
		{
			$status = "Pass";
		}
		else
		{
			$status = "Fail";
		}
		return $status;
	}


	$result_data = [];
	$result_sql = "SELECT * FROM publish_tbl WHERE user_id = $user_id";
	$result = mysqli_query($conn,$result_sql);

	if(mysqli_num_rows($result)>0)
	{
		while($row = mysqli_fetch_assoc($result))
			array_push($result_data,$row);
	}
	else
	{
		header('location:select_course.php?msg=4');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Results</title>
	<style>
body, h1, table {
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background: linear-gradient(to bottom, #4388D7, #1B528D);
    text-align: center;
    color: #000;
    padding: 20px;
}

h1 {
    background-color: #f76b6a;
    color: #fff;
    padding: 20px;
    margin: 0;
}

table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 10px;
    text-align: center;
    color: #000; 
}

th {
    background-color: #f76b6a;
    color: #fff;
}

td:nth-child(5) {
    font-weight: bold;
    text-align: center;
}

td.pass {
    background: linear-gradient(to bottom, #7ed56f, #3da845); 
    color: #000; 

td.fail {
    background: linear-gradient(to bottom, #ff7e79, #ff382c); 
    color: #000; 

	</style>
</head>
<body>
	<h1>Results</h1>
	<table>
		
		<tr>	
			<th>S.N.</th>
			<th>Course Name</th>
			<th>Exam Name</th>
			<th>Score</th>
			<th>Status</th>
			
		</tr>
		<?php foreach($result_data as $key => $publish)
		{
		?>
		<tr>
			<td>
				<?php echo $key+1; ?>
			</td>
					<td>
						<?php
							$exams = id_to_course($publish,'ex_id');
							echo $exams['course_name'];
						?>
					</td>
					<td>
						<?php
							$exams = id_to_course($publish,'ex_id');
							echo $exams['ex_title'];
						?>
					</td>

					<td>
						<?php
							echo $publish['score'];
						?>
					</td>
					<td>
						<?php
							$result = result($publish,'score','total_questions');
							echo $result;
						?>
					</td>
		</tr>

		<?php
		}
		?>



	</table>

</body>
</html>