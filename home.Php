<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';
 
 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: login.php");
  exit;
 }
 // select loggedin users detail
 $res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow=mysql_fetch_array($res);
?>

<!DOCTYPE html>
<html>
<head>
<title>Help Desk</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">

<h1>User Desk</h1>
     </div>
        
       <form>
       <h2><span class="glyphicon glyphicon-user"></span>&nbsp;Welcome' <?php echo $userRow['userName']; ?>&nbsp;<span class="caret"></h2>


<table width="100%" border="1">
        <tr> 
           
          <td><strong><font color="#000000">TechName</font></strong></td>        
          <td><strong><font color="#000000">techStatus</font></strong></td>   
          <td><strong><font color="#000000">lastLogin</font></strong></td>                    

         
         
    <td><strong><font color="#000000">Complaints</font></strong></td>
        </tr>
  <?PHP
    include("Dbconnect.php");
    
    $sql = "SELECT * FROM `techuser` Order by userId DESC ";
    //echo $sql;exit;
    $result = mysql_query($sql);
    while($row=mysql_fetch_array($result))
    {
    ?>
        <tr> 
    
          <td><?php echo $row['userName']; ?></td>
      
          
          <td><?php
     if($row['techStatus'] ==1 )
   {
   echo "Active";
   }
   else
   {
   echo "Inactive";
   } 
   ?>

    <td><?php echo $row['lastLogin']; ?></td>
          <?php

          $now = date('Y-m-d h:i:s');
         mysql_query('UPDATE `techuser` SET `lastLogin` = $now()');
        
          ?>


         
     <td><a href="complaint.php?cid=<?php echo $row['userId']; ?>"><strong>Click here to complaint</strong></a></td>
        </tr>
  <?php
  }
  ?>

 <div id="charNum"></div>



       	<p></p>
        <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
       </form>
             

</body>
</html>

<?php ob_end_flush(); ?>


