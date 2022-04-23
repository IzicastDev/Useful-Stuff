<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  require('validator.php');

  $errors = [];

  if(isset($_POST['submit'])){
    // validate entries
    $validation = new Validator($_POST);
    $errors = $validation->validateForm();

    // if errors is empty --> save data to db
  }

?>

<html lang="en">
<head>
  <title>PHP OOP</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  
<!-- FORM -->
  <div class="new-user">
    <h2>Create a new user</h2>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
      
      <!-- USERNAME -->
        <label>username: </label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($_POST['username'] ?? '') ?>">
        <div class="error">
          <?php echo $errors['username'] ?? '' ?>
        </div>
        
      <!-- STRING -->
        <label>string: </label>
        <input type="text" name="str" value="<?php echo htmlspecialchars($_POST['str'] ?? '') ?>">
        <div class="error">
          <?php echo $errors['str'] ?? '' ?>
        </div>
        
      <!-- EMAIL -->
        <label>email: </label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? '' )?>">
        <div class="error">
          <?php echo $errors['email'] ?? '' ?>
        </div>
        
      <!-- INTEGER-->
        <label>integer value: </label>
        <input type="text" name="intvalue" value="<?php echo htmlspecialchars($_POST['intvalue'] ?? '') ?>">
        <div class="error">
          <?php echo $errors['intvalue'] ?? '' ?>
        </div>
        
      <!-- INTEGER RANGE-->
        <label>integer range: </label>
        <input type="text" name="range" value="<?php echo htmlspecialchars($_POST['range'] ?? '') ?>">
        <div class="error">
          <?php echo $errors['range'] ?? '' ?>
        </div>
        
        
      <!-- SUBMIT -->
        <input type="submit" value="submit" name="submit" >

    </form>
  </div>

  <!-- Buttons -->
  <div class="btnWrapper">
    <a href="#" class="button-6" role="button">Test</a>   
  </div>

</body>
</html>