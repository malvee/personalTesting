<html>
<?php
	include "twitteroauth.php";
	$api_key='ba28ee0ae71432fe85206c36d0e6a641';
	$consumer = "5blMAfvgOmZBZyfM2usfcX97c";
	$counsumerSecret = "oYVA9roicxA0nVSX7kXujVnb0Eyn0EFpqy4cSpQ5ZpUyzxeaHQ";
	$accessToken = "2319828684-dXOy6CW1Mf7nsm32YMbH9qcwMLP8NtetGTxTAbC";
	$accessTokenSecret = "mp4svtYl7DQAWQmGCBAppHO5aBr8HVmB04T6xU4c7GK8E";
	$twitter = new TwitterOAuth($consumer, $counsumerSecret, $accessToken, $accessTokenSecret);
	$db = new mysqli("localhost", "root", "", "phplogin");
	$result = $db->query("SELECT * FROM users WHERE username = 'malvee'");
	$ans = $result->fetch_all(MYSQLI_ASSOC);
	$dbArray = preg_split('/\s+/', trim($ans[0]["query"]));
	if (isset($_POST["text"]))
	{
		
		$sentTextArray = preg_split('/\s+/', trim($_POST["text"]));
		
		// given two string array $dbArray and $sentTextArray the code below merges the two into $dbArray
		foreach ($sentTextArray as $x)
		{
			$count = 0;
			foreach ($dbArray as $y)
			{
				if (!(strtolower($x) == strtolower($y)))
					$count++;
				else
					break;
					
			}
			if ($count == count($dbArray))
				array_push($dbArray, $x);

		}
		////
		$string = "";
		foreach($dbArray as $x)
		{
			$string .= (" ".$x);
		}
		echo $string;
		$db -> query("UPDATE users SET query= '$string'  WHERE username='malvee'");
		$string = "";
		echo "<form action = \"test.php\" method = \"POST\">"; 
		foreach($dbArray as $text)
		{
			
			echo  "<input type=\"checkbox\" name=\"checktest\" value = \"yes\" checked> ".$text;
		
	
		}
		//echo "<input type = \"submit\" >";
		echo "</form>";
	}
	else
	{
		
		foreach($dbArray as $text)
		{
			
			echo  "<input type=\"checkbox\" name=\"checktest\" value = \"yes\" checked> ".$text;
		
	
		}
	}
?>
<body>
	<form action = "test.php" method = "POST">
		<input type = "text" name = "text"/>
		<input type = "submit" value = "Add to list"> <br>
	</form>
</body>
</html>