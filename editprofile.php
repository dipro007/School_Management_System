<?php 

  session_start();

  require 'connect.php';
  require 'functions.php';

  if(isset($_POST['update'])) {

    $fname = clean($_POST['firstname']);
    $lname = clean($_POST['lastname']);
    $course = clean($_POST['course']);
    $yrlevel = clean($_POST['yrlevel']);

    $query = "UPDATE students SET firstname = '$fname', lastname = '$lname', course = '$course', yrlevel = '$yrlevel'
    WHERE id='".$_SESSION['userid']."'";

    if($result = mysqli_query($con, $query)) {

      $_SESSION['prompt'] = "Profile Updated";
      header("location:profile.php");
      exit;

    } else {

      die("Error with the query");

    }

  }

  if(isset($_SESSION['username'], $_SESSION['password'])) {

    $qry = mysqli_query($con,"SELECT * FROM students where id = {$_SESSION['userid']} ");
    $data = mysqli_fetch_array($qry);
    extract($data);

?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Edit Profile - Student Information System</title>

	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head>
<body>

  <?php include 'header.php'; ?>

  <section>
    
    <div class="container">
      <strong class="title">Edit Profile</strong>
    </div>
    

    <div class="edit-form box-left clearfix">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

        <div class="form-group">
          <label>Student ID No:</label>
          
          <?php 
            $query = "SELECT studentno FROM students WHERE id = '".$_SESSION['userid']."'";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_row($result);

            echo "<p>".$row[0]."</p>";
          ?>

        </div>


        <div class="form-group">
          <label for="firstname">First Name</label>
          <input type="text" class="form-control" name="firstname" value="<?php echo $firstname ?>" placeholder="First Name" required>
        </div>


        <div class="form-group">
          <label for="lastname">Last Name</label>
          <input type="text" class="form-control" name="lastname" value="<?php echo $lastname ?>" placeholder="Last Name" required>
        </div>


        <div class="form-group">
          <label for="course">Course</label>

          <select class="form-control" name="course">
              <option value="English" <?php echo $course == 'BSBA' ? "selected": ""; ?>>English</option>
              <option value="Mathematics" <?php echo $course == 'BSOA' ? "selected": ""; ?>>Mathematics</option>
              <option value="Phyics" <?php echo $course == 'BSIT' ? "selected": ""; ?>>Phyics</option>
              <option value="Chemistry" <?php echo $course == 'BSCS' ? "selected": ""; ?>>Chemistry</option>
              <option value="Biology" <?php echo $course == 'BSCE' ? "selected": ""; ?>>Biology</option>
              <option value="Geography" <?php echo $course == 'BSB' ? "selected": ""; ?>>Geography</option>
              <option value="Economics" <?php echo $course == 'BSO' ? "selected": ""; ?>>Economics</option>
              <option value="Accounting" <?php echo $course == 'BSI' ? "selected": ""; ?>>Accounting</option>
              <option value="Management" <?php echo $course == 'BSC' ? "selected": ""; ?>>Management</option>
              <option value="Finance" <?php echo $course == 'BSE' ? "selected": ""; ?>>Finance</option>
              
            </select>

        </div>


        <div class="form-group">
          <label for="yrlevel">Standard Level</label>

          <select class="form-control" name="yrlevel">
            <option <?php echo $yrlevel == '1st year' ? "selected": ""; ?>>1st Standard</option>
            <option <?php echo $yrlevel == '2nd year' ? "selected": ""; ?>>2nd Standard</option>
            <option <?php echo $yrlevel == '3rd year' ? "selected": ""; ?>>3rd Standard</option>
            <option <?php echo $yrlevel == '4th year' ? "selected": ""; ?>>4th Standard</option>
            <option <?php echo $yrlevel == '5th year' ? "selected": ""; ?>>5th Standard</option>
            <option <?php echo $yrlevel == '6th year' ? "selected": ""; ?>>6th Standard</option>
            <option <?php echo $yrlevel == '7th year' ? "selected": ""; ?>>7th Standard</option>
            <option <?php echo $yrlevel == '8th year' ? "selected": ""; ?>>8th Standard</option>
            <option <?php echo $yrlevel == '9th year' ? "selected": ""; ?>>9th Standard</option>
            <option <?php echo $yrlevel == '10th year' ? "selected": ""; ?>>10th Standard</option>
            <option <?php echo $yrlevel == '11th year' ? "selected": ""; ?>>11th Standard</option>
            <option <?php echo $yrlevel == '12th year' ? "selected": ""; ?>>12th Standard</option>
          </select>

        </div>
        
        <div class="form-footer">
          <a href="profile.php">Go back</a>
          <input class="btn btn-primary" type="submit" name="update" value="Update Profile">
        </div>
        

      </form>
    </div>

  </section>


	<script src="assets/js/jquery-3.1.1.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/main.js"></script>
</body>
</html>

<?php 

  } else {
    header("location:profile.php");
  }

  mysqli_close($con);

?>