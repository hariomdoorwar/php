<?php
// Establish a connection to the database
$conn = mysqli_connect('localhost', 'root', '', 'test');
// include "conn.php";

// Check if sorting parameter is set
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';

// Check if DOB interval filters have been submitted
$from_date = isset($_POST['from_date']) ? $_POST['from_date'] : '';
$to_date = isset($_POST['to_date']) ? $_POST['to_date'] : '';

// Query the database with sorting parameter and DOB filters
if (!empty($from_date) && !empty($to_date)) {
    $result = mysqli_query($conn, "SELECT * FROM student_details WHERE DoB BETWEEN '$from_date' AND '$to_date'");
} else {
    switch ($sort) {
        case 'full_name_asc':
            $result = mysqli_query($conn, 'SELECT * FROM student_details ORDER BY Full_name ASC');
            break;
        case 'full_name_desc':
            $result = mysqli_query($conn, 'SELECT * FROM student_details ORDER BY Full_name DESC');
            break;
        case 'father_name_asc':
            $result = mysqli_query($conn, 'SELECT * FROM student_details ORDER BY Father_name ASC');
            break;
        case 'father_name_desc':
            $result = mysqli_query($conn, 'SELECT * FROM student_details ORDER BY Father_name DESC');
            break;
        default:
            $result = mysqli_query($conn, 'SELECT * FROM student_details');
    }
}

// Display the data in an HTML table
echo '<form method="post">';
echo 'From Date: <input type="date" name="from_date">';
echo 'To Date: <input type="date" name="to_date">';
echo '<button type="submit">Filter</button>';
echo '</form>';
// Display the data in an HTML table
echo '<table>';
echo '<table border="1" style="width: 100%; height: 40%">';
echo '<tr>';
echo '<th>Full Name<a href="?sort=full_name_asc">▲</a>/<a href="?sort=full_name_desc">▼</a></th>';
echo '<th>Father Name<a href="?sort=father_name_asc"> ▲</a>/<a href="?sort=father_name_desc">▼</a></th>';
echo '<th>DoB </th>';
echo '<th>Email</th>';
echo '<th>Department </th>';
echo '<th>course </th>';
echo '<th>status </th>';
echo '<th>Modify </th>';
echo '</tr>';

echo "<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>";

while ($row = mysqli_fetch_assoc($result)) {

    if(strpos($row['status'],'inactive')!== false){
        echo '<tr class="high">';
    }
    else{
        echo '<tr>';
    }

    echo '<td>' . $row['Full_name'] . '</td>';
    echo '<td>' . $row['Father_name'] . '</td>';
    echo '<td>' . $row['DoB'] . '</td>';
    echo '<td>' . $row['Email'] .'</th>';
    echo '<td>' . $row['department'] . '</td>';
    echo '<td>' . $row['course'] . '</td>';
    echo '<td>' . $row['status'] . '</td>';
   
    echo '<td>';
    

    echo '<form action="update.php" method="GET">';
    echo '<button type="submit" name="Email" value="' . $row['Email'] . '"><i class="fas fa-edit" style="font-size:26px"></i></button>';
    echo '</form>';

    echo '<form action="delete.php" method="POST">';

    echo '<button type="submit" name="delete" value="' . $row['Email'] . '"><i class="far fa-trash-alt" style="font-size:26px"></i></button>';
    echo '</form>';
    echo '</td>';
    echo '</tr>';
}

echo '</table>';

// Close the database connection
mysqli_close($conn);
?>

<style>

  table {
  width: 100%;
  /* border-collapse: collapse; */
  font-size: 14px;
}

th {
  background-color: #4CAF50;
  color: white;
  font-weight: bold;
  text-align: left;
  padding: 8px;
}

tr {
  border-bottom: 1px solid #ddd;
}

tr.high {
  background-color: yellow;
}

td {
  padding: 0px;
}

button {
    background-color: #4CAF50;
    color: white;
    border: #e31a42;
    padding: 0px 7px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
}

button:hover {
  background-color: black;
}

button.delete {
  background-color: #f44336;
}

button.delete:hover {
  background-color: red;
}

.buttons {
  display: flex;
  flex-direction: row;
  justify-content: center;
  /* align-items: center; */
}

  
</style>
