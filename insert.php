<?php
	
$name = $_REQUEST['name'];
$comments = $_REQUEST['comments'];
$description = $_REQUEST['description'];



require("db.php");

mysqli_query($con, "INSERT INTO comments(name, comments, description) VALUES('$name','$comments', '$description')");

$result = mysqli_query($con, "SELECT * FROM comments ORDER BY id ASC");
while($row=mysqli_fetch_array($result)){
echo "<div class='comments_content'>";
echo "<h4><a href='delete.php?id=" . $row['id'] . "'> X</a></h4>";
echo "<h1>" . $row['name'] . "</h1>";
echo "<h5>" . $row['description'] . "</h5>";
echo "<h2>" . $row['date_publish']. "</h2></br></br>";
echo "<h3>" . $row['comments'] . "</h3>";
echo "</div>";
}
mysqli_close($con);
?>