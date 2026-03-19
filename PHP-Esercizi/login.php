<?php
session_start();

$conn = new mysqli("192.168.60.144:3306", "michele_gaino", "scremerebbero.associavamo.", "michele_gaino_");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if (isset($_POST["login"])) {

    $username = trim($_POST["user"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT password FROM user WHERE user = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {

        $stmt->bind_result($password);
        $stmt->fetch();

        header("Location: index.php");
    } else {
        $message = "Utente non trovato!";
    }

    $stmt->close();

}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>

<h2>LOGIN</h2>

<form method="post">
    <input type="text" name="user" required placeholder="Username"><br><br>
    <input type="password" name="password" required placeholder="Password"><br><br>
    <button type="submit" name="login">LOGIN</button>
    <br> <br>
    <a href="register.php"> Non hai un'account? registrati</a>
</form>



<br>
<b style="color:red;">
    <?php echo $message; ?>
</b>

</body>
</html>