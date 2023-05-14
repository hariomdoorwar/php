
<?php
    // getting all values from the HTML form
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
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
    

    // database details
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "student";

    // creating a connection
    $con = mysqli_connect($host, $username, $password, $dbname)or die ("Sorry we failed to connect: ". mysqli_connect_error());
    $check=mysqli_query($con,"select * from personal where email ='$email'");
    $checkrows=mysqli_num_rows($check);
    
    // to ensure that the connection is made
   
        if($checkrows>0){
            echo "Email already exists";
        }
        else{


        $sql = "INSERT INTO personal (first_name,last_name,gender,father_name,dob,citizenship,email,mobile)
        VALUES ('$first_name','$last_name','$gender','$father_name','$dob','$citizenship','$email','$mobile')";

        $result = mysqli_query($con,$sql);

        $sql = "INSERT INTO academic (email, education_degree, college, university, field_of_specialisation, start_date, completion_date, cgpa) 
        VALUES ('$email', '$education_degree', '$college', '$university', '$field_of_specialisation', '$start_date', '$completion_date', '$cgpa')";

        $result = mysqli_query($con,$sql);

        $sql = "INSERT INTO address (email, flat_number, street, landmark, pincode, city, state, country) 
        VALUES ('$email', '$flat_number', '$street', '$landmark', '$pincode', '$city', '$state', '$country')";
        $result = mysqli_query($con,$sql) ;


        $sql = "INSERT INTO course (email, course, specialisation, tenure, scholarship_required) 
        VALUES ('$email', '$course', '$specialisation', '$tenure', '$scholarship_required')";
        $result = mysqli_query($con,$sql) ;
    }


        if($result){
            echo "<div class='thank-you-message'>Thank you for submitting!</div>";          }
          else{
              echo "The record was not inserted successfully because of this error ---> ". mysqli_error($con);  
          }
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


