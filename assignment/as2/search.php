<!DOCTYPE html>
<html>
<head>
	<title>Search Results</title>
	<style>
		/* Define your CSS styles here */
		body {
			font-family: Arial, sans-serif;
			background-color: #f0f0f0;
		}
		h1 {
			color: #333;
			font-size: 24px;
		}
		table {
			border-collapse: collapse;
			margin: 20px 0;
			width: 100%;
		}
		th, td {
			padding: 10px;
			text-align: left;
			border-bottom: 1px solid #ccc;
		}
		th {
			background-color: #f2f2f2;
		}
	</style>
</head>
<body>


<form method="get" action="search.php" style="display: flex; align-items: center;">
    <input type="text" name="search" placeholder="Enter your search term" style="padding: 10px; font-size: 16px; border-radius: 5px; border: 1px solid #ccc;">
    <button type="submit" style="padding: 10px 20px; font-size: 16px; background-color: #4CAF50; color: #fff; border-radius: 5px; border: none; margin-left: 10px;">Search</button>
  </form>
  





	<?php
	// Get the user's search term
	$search_term = $_GET['search'];

	// Connect to the database
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "student";

	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	// Query the database for the user's search term
	$query = "SELECT p.*, a.*,c.*,ad.* FROM personal p
          LEFT JOIN academic a ON p.email = a.email
          LEFT JOIN course c ON p.email = c.email
          LEFT JOIN address ad ON p.email = ad.email
          WHERE p.first_name LIKE '%$search_term%' 
          OR p.last_name LIKE '%$search_term%' 
          OR p.gender LIKE '%$search_term%' 
          OR p.father_name LIKE '%$search_term%' 
          OR a.education_degree LIKE '%$search_term%'";
        
    $result = $conn->query($query);

	// display the results
	if ($result->num_rows > 0) {
		echo "<h1>Search Results:</h1>";
		echo "<table>";
		echo "<tr><th>First Name</th><th>Last Name</th><th>Gender</th><th>Father's Name</th><th>DoB</th><th>email</th><th>mobile</th>
        <th>citizenship</th><th>Education_degree</th>
        <th>college</th><th>university</th><th>field_of_specialisation</th><th>start_date</th>
        <th>completion_date</th><th>cgpa</th><th>course</th>
        <th>specialisation</th><th>tenure</th><th>scholarship_required</th><th>flat_number</th><th>street</th>
        <th>landmark</th><th>pincode</th><th>city</th><th>state</th><th>country</th></tr>";
	    while ($row = $result->fetch_assoc()) {
	        echo "<tr>";
	        echo "<td>" . $row['first_name'] . "</td>";
	        echo "<td>" . $row['last_name'] . "</td>";
	        echo "<td>" . $row['gender'] . "</td>";
            echo "<td>" . $row['father_name'] . "</td>";
	        echo "<td>" . $row['dob'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['mobile'] . "</td>";
            echo "<td>" . $row['citizenship'] . "</td>";
            echo "<td>" . $row['education_degree'] . "</td>";
            echo "<td>" . $row['college'] . "</td>";
            echo "<td>" . $row['university'] . "</td>";
            echo "<td>" . $row['field_of_specialisation'] . "</td>";
            echo "<td>" . $row['start_date'] . "</td>";
            echo "<td>" . $row['completion_date'] . "</td>";
            echo "<td>" . $row['cgpa'] . "</td>";
            echo "<td>" . $row['course'] . "</td>";
            echo "<td>" . $row['specialisation'] . "</td>";
            echo "<td>" . $row['tenure'] . "</td>";
            echo "<td>" . $row['scholarship_required'] . "</td>";
            echo "<td>" . $row['flat_number'] . "</td>";
            echo "<td>" . $row['street'] . "</td>";
            echo "<td>" . $row['landmark'] . "</td>";
            echo "<td>" . $row['pincode'] . "</td>";
            echo "<td>" . $row['city'] . "</td>";
            echo "<td>" . $row['state'] . "</td>";
            echo "<td>" . $row['country'] . "</td>";
          
           
	        echo "</tr>";
	    }
	    echo "</table>";
	} else {
	    echo "No results found.";
	}

	// Close the database connection
	$conn->close();
	?>
</body>
</html>
