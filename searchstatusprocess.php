<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Search Status Process</title>
 <link rel="stylesheet" href="styles1.css" />
 <script type="text/javascript" src="http://tgh7346.cmslamp14.aut.ac.nz/assign1/scripts.js"></script>
</head>

<body onload="renderTime()">
 <div class="content">
  <div class="wrapper">
   <div class="blog_post">
    <div class="container_copy">
     <h3 id="clockDisplay"></h3>
     <h1>Status Information</h1>
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
            if (!empty($_GET["submit"])) {
              $search = mysqli_real_escape_string($conn, $_GET["Search"]);
            }

            // Counting error number
            $errorcount = 0;

            // Checking for required field
            if (empty($search) == true) {
              echo '<p class="error"><strong style="color:red;">*The search field cannot be empty. Please enter a keyword to search. </strong></p><br>';
              $errorcount += 1;
            }

            if ($errorcount == 0) {
              echo '<p class="success">Searching for keyword: ' . $search . '</p><br>';
              $query = "SELECT * FROM STATUS WHERE status LIKE '%$search%'"; // % is searching for any text that contain $search
              $result = mysqli_query($conn, $query)
                or die("<p>Unable to execute the query.</p>" . "<p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>");
              $resultCheck = mysqli_num_rows($result);
              if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<p">Status: ' . $row['STATUS'] . '<br><hr>';
                  echo 'Status Code: ' . $row['CODE'] . '<br><hr>';
                  echo 'Share: ' . $row['SHARE'] . '<br><hr>';
                  echo 'Date Posted: ' . $row['DATE'] . '<br><hr>';
                  echo 'Permission: ' . $row['PERMISSION'] . '<br><hr>' . '</p>';
                }
              } else {
                echo '<p class="error"><strong style="color:red;">*Status not found. Please try a different keyword.</strong></p>';
              }
            } else {
              echo '<p class="error"><strong style="color:red;">*Fail to retrieve data from database.</strong></p>';
            }
            ?>
      <!-- Buttons -->
     <div class="btn_primary">
      <a href="http://tgh7346.cmslamp14.aut.ac.nz/assign1/searchstatusform.html">Search for another status</a>
     </div>
     <br><br>
     <div class="btn_primary">
      <a href="http://tgh7346.cmslamp14.aut.ac.nz/assign1/index.html">Return to Home Page</a>
     </div>
    </div>
   </div>
   <?php
      // Close connection
      mysqli_close($conn);
      ?>
   </p>
  </div>
 </div>
 </div>
 </div>
</body>


</html>