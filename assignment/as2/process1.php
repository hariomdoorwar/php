
<?php

    $flat_number = ($_POST['flat_number']);
    $street = ($_POST['street']) ;
    $landmark = ($_POST['landmark']) ;
    $pincode = ($_POST['pincode']) ;
    $city = ($_POST['city']) ;
    $state = ($_POST['state']) ;
    $country = ($_POST['country']) ;
    $email = ($_POST['email']) ;
    

    // database details
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "student";

    // creating a connection
    $con = mysqli_connect($host, $username, $password, $dbname)or die ("Sorry we failed to connect: ". mysqli_connect_error());

        $sql = "INSERT INTO address (email, flat_number, street, landmark, pincode, city, state, country) 
        VALUES ('$email', '$flat_number', '$street', '$landmark', '$pincode', '$city', '$state', '$country')";
        $result = mysqli_query($con,$sql) ;


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


