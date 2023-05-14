<html>
<head>
    <title>Form Example</title>
</head>
<body>

<link rel="stylesheet" href="css.css">
<form method="POST" action="course.php">

<h1>Academic Details</h1>
<label>Education Degree</label>
<select name="education_degree" required>
    <option value="">Select</option>
    <option value="btech" <?= $education_degree === 'btech' ? 'selected' : '' ?>>B.Tech</option>
    <option value="mtech" <?= $education_degree === 'mtech' ? 'selected' : '' ?>>M.Tech</option>
    <option value="mba" <?= $education_degree === 'mba' ? 'selected' : '' ?>>MBA</option>
</select>

<label>College</label>
<input type="text" name="college" value="<?= $college ?>" required>

<label>University</label>
<input type="text" name="university" value="<?= $university ?>" required>

<label>Field Of Specialisation</label>
<input type="text" name="field_of_specialisation" value="<?= $field_of_specialisation ?>" required>

<label>Start Date</label>
<input type="date" name="start_date" value="<?= $start_date ?>" required>

<label>Completion Date</label>
<input type="date" name="completion_date" value="<?= $completion_date ?>" required>

<label>CGPA</label>
<input type="number" name="cgpa" value="<?= $cgpa ?>" step="0.01" required>

<?php
// getting email value from previous form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $email = ($_POST['email']) ;
}
?>

<!-- add hidden input field with email value -->
<input type="hidden" name="email" value="<?= $email ?>" required>

<br><br>
<button type="submit" name="submit">next</button>

</form>
</body>
</html>


<!-- // ---------------------------------------------------------------------------------------------------// -->


  <?php
 
    $first_name = ($_POST['first_name']) ;
    $last_name = ($_POST['last_name']);
    $gender = ($_POST['gender']);
    $father_name = ($_POST['father_name']) ;
    $dob = ($_POST['dob']) ;
    $citizenship = ($_POST['citizenship']) ;
    $email = ($_POST['email']) ;
    $mobile = ($_POST['mobile']) ;
    

    // database details
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "student";

    // creating a connection
    $con = mysqli_connect($host, $username, $password, $dbname)or die ("Sorry we failed to connect: ". mysqli_connect_error());
   
    
    // to ensure that the connection is made
   
        $sql = "INSERT INTO personal (first_name,last_name,gender,father_name,dob,citizenship,email,mobile)
        VALUES ('$first_name','$last_name','$gender','$father_name','$dob','$citizenship','$email','$mobile')";

        $result = mysqli_query($con,$sql);



        if($result){
            echo "<div class='thank-you-message'>Thank you for submitting!</div>";          
          }
          else{
              echo "The record was not inserted successfully because of this error ---> ". mysqli_error($con);  
          }
                
?>








