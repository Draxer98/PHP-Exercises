<?php
session_start();

$conn = new mysqli("192.168.60.144:3306", "michele_gaino", "scremerebbero.associavamo.", "michele_gaino_");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if (isset($_POST["register"])) {

    $username = trim($_POST["user"]);
    $password = $_POST["password"];
    $repeat = $_POST["repeat_password"];

    if ($password !== $repeat) {
        $message = "Le password non coincidono!";
    } else {

        $stmt = $conn->prepare("INSERT INTO user (user, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            $message = "Registrazione completata! Ora puoi fare login.";
            header("Location: login.php");
        } else {
            $message = "Username già esistente!";
        }

        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>

<h2>REGISTER</h2>

<form method="post">
    <input type="text" name="user" required placeholder="Username"><br><br>
    <input type="password" name="password" required placeholder="Password"><br><br>
    <input type="password" name="repeat_password" required placeholder="Ripeti Password"><br><br>
    <button type="submit" name="register">REGISTER</button>
    <br> <br>
    <a href="login.php"> Hai già un account? Accedi</a>
</form>

<br>
<b style="color:red;">
    <?php echo $message; ?>
</b>

</body>
</html>