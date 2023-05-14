<!DOCTYPE html>
<html>
<head>
	<title>Employee Details</title>
</head>
<body>
	<form method="POST">
		<input type="submit" name="data" value="data"/>
	</form>

	<?php
	if(isset($_POST['data'])) {
		$url = "https://dummy.restapiexample.com/api/v1/employees";
		$data = file_get_contents($url);
		$employees = json_decode($data, true)['data'];
	?>

	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Salary</th>
				<th>Age</th>
				<th>Profile Image</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($employees as $employee) { ?>
				<tr>
					<td><?php echo $employee['id']; ?></td>
					<td><?php echo $employee['employee_name']; ?></td>
					<td><?php echo $employee['employee_salary']; ?></td>
					<td><?php echo $employee['employee_age']; ?></td>
					<td><?php echo $employee['profile_image']; ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	
	<?php } ?>
	
</body>
</html>
