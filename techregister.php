<?php
 ob_start();
 session_start();
 if( isset($_SESSION['techuser'])!="" ){
  header("Location: techhome.php");
 }
 include_once 'dbconnect.php';

 $error = false;

 if ( isset($_POST['btn-signup']) ) {
  
  // clean user inputs to prevent sql injections
  $name = trim($_POST['name']);
  $name = strip_tags($name);
  $name = htmlspecialchars($name);
  
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);

  $num = trim($_POST['num']);
  $num = strip_tags($num);
  $num = htmlspecialchars($num);

  // basic name validation
  if (empty($name)) {
   $error = true;
   $nameError = "Please enter your full name.";
  } else if (strlen($name) < 3) {
   $error = true;
   $nameError = "Name must have atleat 3 characters.";
  } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
   $error = true;
   $nameError = "Name must contain alphabets and space.";
  }

// basic account number validation
  if (empty($num)) {
   $error = true;
   $numError = "Please enter your account number.";
  } else if (strlen($num) < 5) {
   $error = true;
   $numError = "Account number must have atleat 5 numbers.";
  } else {
   // check number exist or not
   $query = "SELECT userNum FROM techuser WHERE userNum='$num'";
   $result = mysql_query($query);
   $count = mysql_num_rows($result);
   if($count!=0){
    $error = true;
    $numError = "Provided Number is already in use.";
  }
  if ($num != 12345)
  if ($num != 11111)
  if ($num != 22222)
  if ($num != 33333)
  if ($num != 44444)  
  if ($num != 55555)
  if ($num != 66666)
  if ($num != 77777)
  if ($num != 88888)
  if ($num != 99999) 
  {
   $error = true;
   $numError = "Please enter account number provided by the company.";
  }
}
  //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  } else {
   // check email exist or not
   $query = "SELECT userEmail FROM techuser WHERE userEmail='$email'";
   $result = mysql_query($query);
   $count = mysql_num_rows($result);
   if($count!=0){
    $error = true;
    $emailError = "Provided Email is already in use.";
   }
  }

  // password validation
  if (empty($pass)){
   $error = true;
   $passError = "Please enter password.";
  } else if(strlen($pass) < 6) {
   $error = true;
   $passError = "Password must have atleast 6 characters.";
  }

  
  // password encrypt using SHA256();
  $password = hash('sha256', $pass);
  

  // if there's no error, continue to signup
  if( !$error ) {
   

   $query = "INSERT INTO techuser(userName, userEmail, userPass, userNum) VALUES('$name','$email','$password', '$num' )";
   $res = mysql_query($query);
    
   if ($res) {
    $errTyp = "success";
    $errMSG = "Successfully registered, you may login now";
    unset($name);
    unset($email);
    unset($pass);
    unset($num);
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later..."; 
            
     }
   }
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Tech Registration</title>
</head>
<body>

<div class="header">

<h1>Tech Registration</h1>
     </div>

</head>
<body>

 <div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
    
            <?php
   if ( isset($errMSG) ) {
    
    ?>
    <div class="form-group">
             <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
             </div>
                <?php
   }
   ?>
                      
  <!DOCTYPE html>
<html>
<head>
  <title>Help Desk</title>
     <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" value="<?php echo $name ?>" />
                
                <span class="text-danger"><?php echo $nameError; ?></span>
            </div>
            

            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="num" class="form-control" placeholder="Enter account number" maxlength="50" value="<?php echo $num ?>" />
                
                <span class="text-danger"><?php echo $numError; ?></span>
            </div>
            
            

            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
             <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />
                
                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
                
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            
            <div class="form-group">
             
            </div>
              <p></p>
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
            </div>
            
            <div class="form-group">
           
            </div>
            
            <p></p>
            <div class="form-group">
             <a href="login.php">Back to login...</a>
            </div>
        
            <div class="form-group">
             <a href="register.php">Back to user registration...</a>
            </div>
        
        </div>
   
    </form>
    </div> 

</div>

</body>
</html>
<?php ob_end_flush(); ?>