
       <form action="login.php" method="post">
        <input type="text" name="Username" placeholder="Username" required>
        <input type="password" name="Password" placeholder="Password" required>
        <input type="submit" value="Login">
		<a href="register.php">Go to Register</a>

    </form>

	  <?php
        require "database.php";

    
       
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$username = $_POST['Username'];
			$password = $_POST['Password'];
		
			   $sql = "SELECT * FROM tbluser WHERE username = :username ";  
			   $stmt = $connect->prepare($sql);  
			   $stmt->execute(  
					array(  
						 'username'     =>     $username,  
					)  
			   ); 
			   $resultaat = $stmt->fetch(PDO::FETCH_ASSOC);
			   
			   if($resultaat) {
				   $wachtwoordindb = $resultaat["Password"];
				   if(password_verify($password, $wachtwoordindb)){
					echo '<script> alert("Logged in")</script>';
			   }

			} else {
				echo '<script> alert("Invalid username or password")</script>';
			}
		}
		
	
			   ?>
	 
 

	
	
</body>
</html>

