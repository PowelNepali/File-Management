<?php
	require 'config.php';

	if(isset($_GET['msg']))
	{
		if($_GET['msg']==1)
		{
			echo "Result Publish Successfully.";
		}
		elseif($_GET['msg']==2)
		{
			echo "Result was already Publish.";
		}
		else{
			echo "Error";
		}
	}

	function id_to_user($data,$index)
	{
		require 'config.php';
		$user_id = $data[$index];
		$sql = "SELECT * FROM user_form WHERE id = $user_id";
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

	$results = [];
	$result_query = "SELECT * FROM exam_results";
    $result = $conn->query($result_query);
    if(mysqli_num_rows($result)>0)
    {
    	while($rows = mysqli_fetch_assoc($result))
    		array_push($results,$rows);
    }

    
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Publish Result</title>
	<style>
		
body, h1, table {
    margin: 0;
    padding: 0;
}


body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
}

h1 {
    text-align: center;
    background-color: #333;
    color: #fff;
    padding: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #333;
    color: #fff;
}

a {
    text-decoration: none;
    background-color: #007BFF;
    color: #fff;
    padding: 5px 10px;
    border-radius: 5px;
    display: inline-block;
}

a:hover {
    background-color: #0056b3;
}

	</style>
</head>
<body>
	<h1 align="center"> Result</h1>

	<table>
		<tr>
			<th>SN.</th>
			<th>Name</th>
			<th>Course</th>
			<th>Exam Name</th>
			<th>Score</th>
			<th>Action</th>
		</tr>
	<?php 
		foreach ($results as $key => $result) {?>

			
				<tr>
					<td>
						<?php
							echo $key+1;
						?>
					</td>

					<td>
						<?php
						$users = id_to_user($result, 'user_id');
                        if (isset($users['name'])) {
                        echo $users['name'];
                       } else {
                         echo "Name not found";
                       }

						?>
					</td>
					<td>
						<?php
							$exams = id_to_course($result,'ex_id');
							echo $exams['course_name'];
						?>
					</td>
					<td>
						<?php
							$exams = id_to_course($result,'ex_id');
							echo $exams['ex_title'];
						?>
					</td>
					<td>
						<?php
							echo $result['score'];
						?>
					</td> 
					<td>
						
						<a href="publish.php?user_id=<?php echo $result['user_id'] ?>&result_id=<?php echo $result['result_id'] ?>&ex_id=<?php echo $result['ex_id'] ?>&score=<?php echo $result['score'] ?>&total_questions=<?php echo $result['total_questions'] ?>">Publish</a>
					</td>

				</tr>
			
	<?php		
		}
	 ?>
	 </table>
</body>
</html>