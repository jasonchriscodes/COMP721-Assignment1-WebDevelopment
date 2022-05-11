<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=edge" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
 <title>Post Status Page</title>
 <link rel="stylesheet" href="styles1.css" />
 <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
 <script type="text/javascript" src="http://tgh7346.cmslamp14.aut.ac.nz/assign1/scripts.js"></script>
 <style type="text/css">
 .error {
  color: #FF0000;
 }

 #status {
  margin-left: 37px;
 }
 </style>
</head>

<body onload="renderTime()">
 <div class="content">
  <div class="wrapper">
   <div class="blog_post">
    <div class="container_copy">
     <h3 id="clockDisplay"></h3>
     <!-- creating Heading -->
     <h1>Status Posting System</h1>

     <!--creating Form -->
     <form action="poststatusprocess.php" method="post">

      <!--creating Status code field -->
      <label for="statusCodeID">Status Code (required): <input class="w3-input w3-border w3-light-grey" type="text"
        name="code" minlength=" 5" maxlength="5" required
        oninvalid="this.setCustomValidity('The status code must start with an `S` followed by four digits, like `S0001` and cannot be blank!')"
        oninput="this.setCustomValidity('')" id=" statusCodeID" pattern="^S\d\d\d\d$" />
      </label>

      <!--creating Status field -->
      <label>Status (required): <input id="statusBar" class="w3-input w3-border w3-light-grey" id="status" type="text"
        name="status" required
        oninvalid="this.setCustomValidity('The status can only contain alphanumericals and spaces, comma, period, exclamation point and question mark and cannot be blank!')"
        oninput="this.setCustomValidity('')" pattern="^[a-zA-Z0-9,.!?]{1}[a-zA-Z0-9,.!?\s]*$" />
      </label>

      <!--creating Share field -->
      <label>Share:
       <input type="radio" name="share" value="Public" required>Public
       <input type="radio" name="share" value="Friends">Friends
       <input type="radio" name="share" value="Only me">Only me
      </label>
      <br>

      <!-- creating Date field -->
      <label> Date:
       <input type="text" name="date" required value="<?php echo date('d/m/Y'); ?>">
      </label>
      <br>

      <!--creating Checkbox -->
      <label>Permission Type:</label>
      <input type="checkbox" name="permissions[]" value="Allow like">
      <label> Allow like</label>
      <input type="checkbox" name="permissions[]" value="Allow comment">
      <label> Allow comment</label>
      <input type="checkbox" name="permissions[]" value="Allow share">
      <label> Allow share</label><br><br>
      <input class="btn_primary" type="submit" name="submit" value="POST">
      <input class="btn_primary" type="reset" name="reset" value="Reset"><br><br>
      <div class="btn_primary">
       <a href="http://tgh7346.cmslamp14.aut.ac.nz/assign1/index.html">Return to Home Page</a>
      </div>
      </p>
     </form>
    </div>
   </div>
  </div>
 </div>
</body>

</html>