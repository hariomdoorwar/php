

<html>
    <head>
        <title>Form Example</title>
    </head>


    <body>
   <link rel="stylesheet" href="css.css">


       <form method="POST" action="academic.php">
  <div id="section1">
    <h1>Personal Details</h1>
    <label>First Name</label>
    <input type="text" name="first_name" value="<?= $first_name ?>" required pattern="[a-zA-Z]+">

    <label>Last Name</label>
    <input type="text" name="last_name" value="<?= $last_name ?>" required pattern="[a-zA-Z]+">

    <label>Gender</label>
    <br>
    <input type="radio" name="gender" value="male" <?= $gender === 'male' ? 'checked' : '' ?>> Male
    <input type="radio" name="gender" value="female" <?= $gender === 'female' ? 'checked' : '' ?>> Female
    <input type="radio" name="gender" value="other" <?= $gender === 'other' ? 'checked' : '' ?>> Other

    <label>Father Name</label>
    <input type="text" name="father_name" value="<?= $father_name ?>" required pattern="[a-zA-Z]+">

    <label>DOB</label>
    <input type="date" name="dob" value="<?= $dob ?>" required>

    <label>Citizenship</label>
    <select name="citizenship" required>
      <option value="">Select</option>
      <option value="indian" <?= $citizenship === 'indian' ? 'selected' : '' ?>>Indian</option>
      <option value="american" <?= $citizenship === 'american' ? 'selected' : '' ?>>American</option>
      <option value="british" <?= $citizenship === 'british' ? 'selected' : '' ?>>British</option>
    </select>

    <label>Email</label>
    <input type="email" name="email" value="<?= $email ?>" required>

    <label>Mobile</label>
    <input type="tel" name="mobile" required pattern="[0-9]{10}" title="Please enter a 10-digit mobile number" value="<?= $mobile ?>">
         <br>
         <br>
    <button type="submit">Next</button>
  </div>
</form>
</body>
</html>


