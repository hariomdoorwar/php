
<html>
    <head>
        <title>Form Example</title>
    </head>


    <body>
    <link rel="stylesheet" href="css.css">   

        <form method="POST" action="address.php">
          
            <h1>Course Details</h1>
            <label>Course</label>
            <input type="text" name="course" value="<?= $course ?>">

            <label>Specialisation</label>
            <input type="text" name="specialisation" value="<?= $specialisation ?>">

            <label>Tenure</label>
            <select name="tenure">
                <option value="">Select</option>
                <option value="2" <?= $tenure === '2' ? 'selected' : '' ?>>2 Years
                <option value="3" <?= $tenure === '3' ? 'selected' : '' ?>>3 Years</option>
            <option value="4" <?= $tenure === '4' ? 'selected' : '' ?>>4 Years</option>
        </select>

        <label>Scholarship Required?</label>
        <br>
        <input type="radio" name="scholarship_required" value="yes" <?= $scholarship_required === 'yes' ? 'checked' : '' ?>> Yes
        <input type="radio" name="scholarship_required" value="no" <?= $scholarship_required === 'no' ? 'checked' : '' ?>>No
        
        <?php
// getting email value from previous form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $email = ($_POST['email']) ;
}
?>

<!-- add hidden input field with email value -->
<input type="hidden" name="email" value="<?= $email ?>" required>

        <button type="submit" >Next</button>


   
</form>
</body>

</html>








<?php
    // getting all values from the HTML form
   
   

    // database details
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "student";

    // creating a connection
    $con = mysqli_connect($host, $username, $password, $dbname)or die ("Sorry we failed to connect: ". mysqli_connect_error());
   
    $first_name = ($_POST['first_name']) ;
    $last_name = ($_POST['last_name']);
    $gender = ($_POST['gender']);
    $father_name = ($_POST['father_name']) ;
    $dob = ($_POST['dob']) ;
    $citizenship = ($_POST['citizenship']) ;
    $email = ($_POST['email']) ;
    $mobile = ($_POST['mobile']) ;
    $education_degree = ($_POST['education_degree']) ;
    $college = ($_POST['college']);
    $university = ($_POST['university']) ;
    $field_of_specialisation = ($_POST['field_of_specialisation']);
    $start_date = ($_POST['start_date']) ;
    $completion_date = ($_POST['completion_date']) ;
    $cgpa = ($_POST['cgpa']);
    $course = ($_POST['course']) ;
    $specialisation = ($_POST['specialisation']) ;
    $tenure = ($_POST['tenure']) ;
    $scholarship_required = ($_POST['scholarship_required']) ;
    $flat_number = ($_POST['flat_number']);
    $street = ($_POST['street']) ;
    $landmark = ($_POST['landmark']) ;
    $pincode = ($_POST['pincode']) ;
    $city = ($_POST['city']) ;
    $state = ($_POST['state']) ;
    $country = ($_POST['country']) ;


    // to ensure that the connection is made
            $sql = "INSERT INTO academic (email,education_degree, college, university, field_of_specialisation, start_date, completion_date, cgpa) 
        VALUES ('$email','$education_degree', '$college', '$university', '$field_of_specialisation', '$start_date', '$completion_date', '$cgpa')";


    $result = mysqli_query($con,$sql);


if($result){
    echo "<div class='thank-you-message'>Thank you for submitting!</div>";          }
          else{
              echo "The record was not inserted successfully because of this error ---> ". mysqli_error($con);  
          }
    
    
      
?>
<style>
    .thank-you-message {
  font-size: 2em;
  font-weight: bold;
  color: #008000;
  text-align: center;
  margin-top: 20px;
}
</style>





