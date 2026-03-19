<?php
session_start();

$conn = new mysqli("192.168.60.144:3306", "michele_gaino", "scremerebbero.associavamo.", "michele_gaino_");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if (isset($_POST["login"])) {

    $codiceFiscale = $_POST["codiceFiscale"];

    $stmt = $conn->prepare("SELECT cf FROM persona WHERE cf = ?");
    $stmt->bind_param("s", $codiceFiscale);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {

        $stmt->bind_result($codiceFiscale);
        $stmt->fetch();
        $_SESSION['codiceFiscale'] = $codiceFiscale;
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
    <input type="text" name="codiceFiscale" required placeholder="CodiceFiscale"><br><br>
    <button type="submit" name="login">LOGIN</button>
</form>

<br>
<b style="color:red;">
    <?php echo $message; ?>
</b>

</body>
</html>
