
<?php
ini_set("display_errors", 1);

$conn = mysqli_connect('localhost', 'root', '', 'test');
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
  
}

if(isset($_POST['delete']))
{
  $id1 = mysqli_real_escape_string($con, $_POST['delete']);
  
  $query = "DELETE FROM student_details WHERE Email = '$id1'";
  $result = $con->query($query);
  
  
  if ($result) {
    // $_SESSION['message'] = "Student Deleted Successfully";
    echo "<script>
    alert('Student Deleted Successfully');
    window.location.href='data.php'; 
    </script>";
    
  } else {
    echo "Error deleting entry: " . $mysqli->error;
  }
}


if(isset($_POST['submit']))
{
  $id1=$_POST['Email']; 
  $full = $_POST['full'];
  $father = $_POST['father'];
  $DoB = $_POST['DoB'];
  $Department = $_POST['Department'];
  $Course = $_POST['Course'];
  $status = $_POST['status'];
  
  $insertquery="UPDATE student_details SET Full_name='$full', Father_name='$father', DoB='$DoB', department=
        '$Department', course='$Course', status='$status' WHERE Email='$id1' ";

$res=mysqli_query($conn,$insertquery);
if($res)
{
  ?>
            <script>
              alert("data inserted");
              window.location.href='data.php'; 
              </script>
                <?php

}else{
  ?>
            <script>
              alert("data not inserted");
              </script>
            <?php

}
} 


// $old_data = $arrdata['status'];
$old_data = ['active', 'inactive'];

if(isset($_GET['Email'])){
$id=$_GET['Email'];

$showquery="SELECT * from student_details WHERE email='$id'";
$showdata= mysqli_query($conn,$showquery);
$arrdata=mysqli_fetch_array($showdata);





}
?>


<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML Form</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    
    <div>
      <h2>Student Details </h2>
    </div>

    <!-- <form action="conn.php" method="POST"> -->
<form method="post" action="connect.php">

<label>Full Name : </label><br>
<input type="text" name="full" placeholder="full name" value="<?php echo $arrdata['Full_name'];?>" /> <br>              

<label>Father Name : </label> </br>
<input type="text" name="father" placeholder="Father Name" value="<?php echo $arrdata['Father_name'];?>" /><br>

<label>DoB : </label><br>
<input type="date" name="DoB" placeholder="DoB" value="<?php echo $arrdata['DoB'];?>" /> <br>

<label>E-mail : </label><br>
<input type="email" name="Email" placeholder="E-mail" value="<?php echo $arrdata['Email'];?>" /> <br>

<label>Department : </label><br>
<input type="text" name="Department" placeholder="Department" value="<?php echo $arrdata['department'];?>" /> <br>

<label>Course : </label><br>
<input type="text" name="Course" placeholder="Course" value="<?php echo $arrdata['course'];?>" /> <br>

<label for="Status">Status:</label>
<select name="status" id="status">
  <option value="active" <?php if ($arrdata['status'] == 'active') { echo 'selected'; } ?>>Active</option>
  <option value="inactive" <?php if ($arrdata['status'] == 'inactive') { echo 'selected'; } ?>>inactive</option>
</select><br>

<input type="hidden" name="Email" value="<?php echo $id; ?>" />
<input type="submit" name="submit" value="Update" /> <input type="reset" value="Reset" />

</form>
</body>
</html>
