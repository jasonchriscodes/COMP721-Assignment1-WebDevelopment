<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=edge" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
 <title>Process Post Status Page</title>
 <link rel="stylesheet" href="styles1.css" />
 <script type="text/javascript" src="http://tgh7346.cmslamp14.aut.ac.nz/assign1/scripts.js"></script>
 <style type="text/css">
 .success {
  color: #006600;
 }
 </style>
</head>

<body onload="renderTime()">
 <!--Main Content-->
 <div class="content">
  <div class="wrapper">
   <div class="blog_post">
    <div class="container_copy">
     <h3 id="clockDisplay"></h3>
     <h1>Status Posting System</h1>
     <p>
      <?php
            // sql info or use include 'file.inc', for protection login credencials
            require_once('../../conf/sqlinfo.inc.php'); // ../ means go 1 lvl back in directory

            // Login and retreive data from database
            $conn = mysqli_connect($sql_host, $sql_user, $sql_pass);

            // Open connection and check if connection successful
            if (!$conn) {
              die("Database connection status: failed! Error code " . mysqli_connect_errno() . ": " . mysqli_connect_error() . ".");
            } else {
              echo "Database connection status: success!";
            }

            // Check sql function statement successful
            $dbSelect = @mysqli_select_db($conn, $sql_db)
              or die("<p>Unable to select the database.</p>"
                . "<p>Error code " . mysqli_errno($conn)
                . ": " . mysqli_error($conn) . "</p>");
            echo "<p>Successfully opened the database.</p>";

            //Retrieve data from form            
            if (!empty($_POST["submit"])) {
              $code = mysqli_real_escape_string($conn, $_POST["code"]);
              $status = mysqli_real_escape_string($conn, $_POST["status"]);
              $share = mysqli_real_escape_string($conn, @$_POST["share"]);
              $date = mysqli_real_escape_string($conn, @$_POST["date"]);
              $permissions = @$_POST["permissions"];
              if (!empty($permissions)) {
                $permission = implode(",", $permissions);
              } else {
                $permission = "No permission is selected";
              }
            }

            // Counting error number
            $errorcount = 0;

            // Checking for required field
            if (empty($code) || empty($status) || empty($share) == true) {
              echo '<p class="error"><strong style="color:red;">*The field cannot be empty. </strong></p><br>';
              $errorcount += 1;
            }

            // Code length validation
            if (strlen($code) > 5 || strlen($code) < 5) {
              echo '<p class="error"><strong style="color:red;">*Code need to be 5 length long. </strong></p><br>';
              $errorcount += 1;
            }

            // Code criteria validation
            if (!preg_match('/^S\d{4}$/', $code)) {
              echo '<p class="error"><strong style="color:red;">*The status code must start with an `S` followed by four digits, like `S0001`. </strong></p><br>';
              $errorcount += 1;
            }

            // Status criteria validation
            if (!preg_match('/^[A-Za-z0-9\ \.\?\!]+$/', $status)) {
              echo '<p class="error"><strong style="color:red;">*Status can only contain alpanumeric charcters including spaces, comma, full stop, exclamation point and question mark.</strong></p><br>';
              $errorcount += 1;
            }

            function validateDate($date, $format = 'Y-m-d H:i:s')
            {
              $d = DateTime::createFromFormat($format, $date);
              return $d && $d->format($format) == $date;
            }

            // Date criteria validation
            if (!validateDate($date, $format = 'd/m/Y')) {
              echo '<p class="error"><strong style="color:red;">*Invalid Date format. It should be dd/mm/yyy (e.g., 15/02/2021)</strong></p><br>';
              $errorcount += 1;
            }

            // If there are no tables, create one
            $query = "SELECT CODE FROM STATUS";
            $result = mysqli_query($conn, $query);
            if (empty($result)) {
              $query = "CREATE TABLE STATUS (CODE varchar(5), STATUS varchar(100), SHARE varchar(10), DATE varchar(10), PERMISSION varchar(50), PRIMARY KEY (CODE))";
              $result = mysqli_query($conn, $query);
            }

            // Checking duplicate for code from database.
            $query = "SELECT * FROM STATUS WHERE code = '$code'";
            $result = mysqli_query($conn, $query);
            if (@mysqli_num_rows($result) > 0) {

              $errorcount += 1;
              echo ("<p class='error'><strong style='color:red;'>*Status Code '" . $code . "' is already exist. Please try another one!</strong></p><br>");
            }

            if ($errorcount == 0) {
            ?>

      <!-- Show result -->
     <div class='confirm-result'>
      Status: <?php echo $code; ?>
      <br>
      <hr>
      Status Code: <?php echo $status; ?>
      <br>
      <hr>
      Share: <?php echo $share; ?>
      <br>
      <hr>
      Date Posted: <?php echo $date; ?>
      <br>
      <hr>
      Permission: <?php echo $permission; ?>
      <br>
      <hr>
      <br>
      <br>
     </div>


     <p class="success"><strong style='color:green;'>Congratulations! The status has been posted!</strong></p><br>
     <?php

              if (true == $conn) {
                //Inserting data to database
                $query = "INSERT INTO STATUS(code, status, share, date, permission) ";
                $query .= "VALUES ('$code', '$status', '$share', '$date','$permission')";
                $result = @mysqli_query($conn, $query)
                  or die("<p>Unable to execute the query.</p>" . "<p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>");
              }
            }

            // Close connection
            mysqli_close($conn);
        ?>

     <!-- Buttons -->
     <div class="btn_primary">
      <a href="http://tgh7346.cmslamp14.aut.ac.nz/assign1/index.html">Return to Home Page</a>
     </div>
     <br><br>
     <div class="btn_primary">
      <a href="http://tgh7346.cmslamp14.aut.ac.nz/assign1/poststatusform.php">Return to Post Status Page</a>
     </div>
     <br><br>
    </div>
    </p>
   </div>
  </div>
 </div>
 </div>
</body>

</html>