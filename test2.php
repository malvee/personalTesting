<html>
<?php 
$db = new mysqli("localhost", "root", "", "phplogin");
$string = "blah blah hhh";
$db->query("UPDATE users 
     SET query='$string'
     WHERE username='malvee'");
 


?>
<body>
	
</body>
</html>