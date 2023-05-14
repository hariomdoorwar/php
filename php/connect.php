
<?php
    // getting all values from the HTML form
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $full = $_POST['full'];
        $father = $_POST['father'];
        $DoB = $_POST['DoB'];
        $Department = $_POST['Department'];
        $Course = $_POST['Course'];
        $status = $_POST['status'];
        $Email = $_POST['Email'];
    

    // database details
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";

    // creating a connection
    $con = mysqli_connect($host, $username, $password, $dbname)or die ("Sorry we failed to connect: ". mysqli_connect_error());
    $check=mysqli_query($con,"select * from student_details where Email ='$Email'");
    $checkrows=mysqli_num_rows($check);
    
    // to ensure that the connection is made
   
        if($checkrows>0){
            echo "Email already exists";
        }
        else{


        $sql = "INSERT INTO student_details (Full_name,Father_name,DoB,Email,department,course,status)
        VALUES ('$full', '$father', '$DoB','$Email', '$Department','$Course','$status')";
        $result = mysqli_query($con,$sql);

        if($result){
            echo '<strong>Success!</strong> Your entry has been submitted successfully!';
            echo "<script>
            window.location.href='data.php'; 
          </script>";
          }
          else{
              echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);  
          }
        }
    }
      
?>
