<?php

$con = mysqli_connect('localhost', 'root', '', 'test');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

//   delete function   
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
    ?>


