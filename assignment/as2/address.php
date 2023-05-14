
<html>
    <head>
        <title>Form Example</title>
    </head>
    <body>
    <link rel="stylesheet" href="css.css">
    <script type= "text/javascript" src = "countries2.js"></script>

        <form method="POST" action="process1.php">
        <h1>Address Information</h1>
        <label>Flat/House/Wing Number</label>
        <input type="text" name="flat_number" value="<?= $flat_number ?>">

        <label>Street/Locality/Area</label>
        <input type="text" name="street" value="<?= $street ?>">

        <label>Landmark</label>
        <input type="text" name="landmark" value="<?= $landmark ?>">

        <label>Pincode</label>
        <input type="text" name="pincode" value="<?= $pincode ?>">

        
        <!-- <label>State</label>
        <input type="text" name="state" value="<?= $state ?>"> -->

        <label>Country</label>
        <select onchange="print_state('state',this.selectedIndex);" id="country" name ="country"></select>

        <label>State</label>
        <select name ="state" id ="state"></select>
			<script language="javascript">print_country("country");</script>
    
        <label>City</label>
        <input type="text" name="city" value="<?= $city ?>">



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
    <button type="submit" name="submit">submit</button>
 
</form>
</body>
</html>

<!-- ----------------------------------------------------------------------------------------------------------------- -->

<?php
    $flat_number = ($_POST['flat_number']);
    $street = ($_POST['street']) ;
    $landmark = ($_POST['landmark']) ;
    $pincode = ($_POST['pincode']) ;
    $city = ($_POST['city']) ;
    $state = ($_POST['state']) ;
    $country = ($_POST['country']) ;
    $email = ($_POST['email']) ;
    $course = ($_POST['course']) ;
    $specialisation = ($_POST['specialisation']) ;
    $tenure = ($_POST['tenure']) ;
    $scholarship_required = ($_POST['scholarship_required']) ;

    // database details
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "student";

    // creating a connection
    $con = mysqli_connect($host, $username, $password, $dbname) or die ("Sorry we failed to connect: " . mysqli_connect_error());
   
    

        $sql = "INSERT INTO course (email, course, specialisation, tenure, scholarship_required) 
        VALUES ('$email', '$course', '$specialisation', '$tenure', '$scholarship_required')";
            
        $result = mysqli_query($con, $sql);


    if ($result) {
        echo "<div class='thank-you-message'>Thank you for submitting!</div>";         
    } else {
        echo "Error occurred";
    } 
?>









