<?php
require "database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = htmlspecialchars($_POST['Username']);
    $password = htmlspecialchars($_POST['Password']);
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $connect->prepare('SELECT * FROM tbluser WHERE username = :username');
    if ($stmt) {
         $stmt->execute([
            ':username' => $username
        ]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($result)) {
            echo '<script> alert("User already exists")</script>';
        }
    }
    try {
        $stmt = $connect->prepare('INSERT INTO tbluser (username, password) VALUES (:username,  :password)');
        $stmt->execute(array(
            ':username' => $username,
            ':password' => $passwordHash,
            ));
       echo '<script>alert("Registration succesfull")</script>';

       $last_id = $connect->lastInsertId();
       $value_of_money = 30;
            
       $stmt = $connect->prepare('INSERT INTO tblmoneyz (user_id, moneyz) VALUES (:lastid,  :amount_money)');
        $stmt->execute(array(
            ':lastid' => $last_id,
            ':amount_money' => $value_of_money,
            ));
    }

    catch(PDOException $e) {
        echo $e->getMessage();
    }

    }

    

?>


<!DOCTYPE html>
<html lang="en">
<head>
  
</head>
<body>
    <form action="register.php" method="post">
        <input type="text" name="Username" placeholder="Username" required>
        <input type="password" name="Password" placeholder="Password" required>
        <input type="submit" value="Register">
        <a href="login.php">Go to Login</a>
    </form>
</body>
</html>