<?php
    // Initialize variables
  

    $section = isset($_POST['section']) ? $_POST['section'] : 1;
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $father_name = isset($_POST['father_name']) ? $_POST['father_name'] : '';
    $dob = isset($_POST['dob']) ? $_POST['dob'] : '';
    $citizenship = isset($_POST['citizenship']) ? $_POST['citizenship'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
    $education_degree = isset($_POST['education_degree']) ? $_POST['education_degree'] : '';
    $college = isset($_POST['college']) ? $_POST['college'] : '';
    $university = isset($_POST['university']) ? $_POST['university'] : '';
    $field_of_specialisation = isset($_POST['field_of_specialisation']) ? $_POST['field_of_specialisation'] : '';
    $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
    $completion_date = isset($_POST['completion_date']) ? $_POST['completion_date'] : '';
    $cgpa = isset($_POST['cgpa']) ? $_POST['cgpa'] : '';
    $course = isset($_POST['course']) ? $_POST['course'] : '';
    $specialisation = isset($_POST['specialisation']) ? $_POST['specialisation'] : '';
    $tenure = isset($_POST['tenure']) ? $_POST['tenure'] : '';
    $scholarship_required = isset($_POST['scholarship_required']) ? $_POST['scholarship_required'] : '';
    $flat_number = isset($_POST['flat_number']) ? $_POST['flat_number'] : '';
    $street = isset($_POST['street']) ? $_POST['street'] : '';
    $landmark = isset($_POST['landmark']) ? $_POST['landmark'] : '';
    $pincode = isset($_POST['pincode']) ? $_POST['pincode'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $state = isset($_POST['state']) ? $_POST['state'] : '';
    $country = isset($_POST['country']) ? $_POST['country'] : '';


?>

<html>
    <head>
        <title>Form Example</title>
    </head>


    <body>
    <script src="myScript.js"></script>

   

        <form method="POST" action="process.php">
            <div id="section1">
                <h1>Personal Details</h1>
                <label>First Name</label>
                <input type="text" name="first_name" value="<?= $first_name ?>">

                <label>Last Name</label>
                <input type="text" name="last_name">

                <label>Gender</label>
            <br>
            <input type="radio" name="gender" value="male" <?= $gender === 'male' ? 'checked' : '' ?>> Male
            <input type="radio" name="gender" value="female" <?= $gender === 'female' ? 'checked' : '' ?>> Female
            <input type="radio" name="gender" value="other" <?= $gender === 'other' ? 'checked' : '' ?>> Other

            <label>Father Name</label>
            <input type="text" name="father_name" value="<?= $father_name ?>">

            <label>DOB</label>
            <input type="date" name="dob" value="<?= $dob ?>">

            <label>Citizenship</label>
            <select name="citizenship">
                <option value="">Select</option>
                <option value="indian" <?= $citizenship === 'indian' ? 'selected' : '' ?>>Indian</option>
                <option value="american" <?= $citizenship === 'american' ? 'selected' : '' ?>>American</option>
                <option value="british" <?= $citizenship === 'british' ? 'selected' : '' ?>>British</option>
            </select>

            <label>Email</label>
            <input type="email" name="email" value="<?= $email ?>">

            <label>Mobile</label>
            <input type="number" name="mobile" required pattern="[0-9]{10}" title="Please enter a 10-digit mobile number" value="<?= $mobile ?>">

            <button type="button" onclick="nextStep()">Next</button>

        </div>




       <div id="section2" style="display:none;">
            <h1>Academic Details</h1>
            <label>Education Degree</label>
            <select name="education_degree">
                <option value="">Select</option>
                <option value="btech" <?= $education_degree === 'btech' ? 'selected' : '' ?>>B.Tech</option>
                <option value="mtech" <?= $education_degree === 'mtech' ? 'selected' : '' ?>>M.Tech</option>
                <option value="mba" <?= $education_degree === 'mba' ? 'selected' : '' ?>>MBA</option>
            </select>

            <label>College</label>
            <input type="text" name="college" value="<?= $college ?>">

            <label>University</label>
            <input type="text" name="university" value="<?= $university ?>">

            <label>Field Of Specialisation</label>
            <input type="text" name="field_of_specialisation" value="<?= $field_of_specialisation ?>">

            <label>Start Date</label>
            <input type="date" name="start_date" value="<?= $start_date ?>">

            <label>Completion Date</label>
            <input type="date" name="completion_date" value="<?= $completion_date ?>">

            <label>CGPA</label>
            <input type="number" name="cgpa" value="<?= $cgpa ?>">
            <button type="button" onclick="nextStep()">Next</button>
</div>

    <div id="section3" style="display:none;">
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
        <br>
        <br>
        <button type="button"  onclick="nextStep()">Next</button>
        </div>


    <div id ="section4" style="display: none;">
        <h1>Address Information</h1>
        <label>Flat/House/Wing Number</label>
        <input type="text" name="flat_number" value="<?= $flat_number ?>">

        <label>Street/Locality/Area</label>
        <input type="text" name="street" value="<?= $street ?>">

        <label>Landmark</label>
        <input type="text" name="landmark" value="<?= $landmark ?>">

        <label>Pincode</label>
        <input type="text" name="pincode" value="<?= $pincode ?>">

        <label>City</label>
        <input type="text" name="city" value="<?= $city ?>">

        <label>State</label>
        <input type="text" name="state" value="<?= $state ?>">

        <label>Country</label>
        <input type="text" name="country" value="<?= $country ?>">

        <button type="submit" name="submit">submit</button>
        </div>

 
</form>
</body>




<style>
   /* Background color and font styling */
   


body {
  background-color: #F8F8F8;
  font-family: Arial, sans-serif;
  font-size: 16px;
  background-image: url("as2/study.avif");
    background-size: cover;
}

/* Heading styling */
h1 {
  color: #4CAF50;
  font-size: 28px;
}

/* Label and input field styling */
label {
  display: block;
  margin-bottom: 5px;
  color: #333;
}

input[type="text"],
input[type="email"],
input[type="number"],
input[type="date"],
select {
  border: 1px solid #ccc;
  padding: 10px;
  border-radius: 4px;
  width: 100%;
  margin-bottom: 15px;
  box-sizing: border-box;
}

/* Radio button styling */
input[type="radio"] {
  margin-right: 5px;
}

/* Button styling */
button {
  background-color: #4CAF50;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 4px;
  cursor: pointer;
}

button:hover {
  background-color: #3E8E41;
}

/* Section styling */
#section1,
#section2,#section3,
#section4 {
  max-width: 500px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  border-radius: 5px;
  margin-top: 50px;
}

#section1 h1,
#section2 h1,#section1 h3,
#section2 h4 {
  margin-top: 0;
}


</style>


</html>