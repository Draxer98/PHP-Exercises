<?php
session_start();

$mysql = new mysqli("127.0.0.1", "michele_gaino", "1234", "db");

if($mysql->connect_error) {
    die($mysql->connect_error);
}

if(isseT($_POST["login"])) {
    $user = $_POST['user'];
    $password = $_POST['password'];

    $stmt = $mysql->prepare("SELECT user FROM persona WHERE user = ? AND password = ?");
    $stmt->bind_param("ss", $user, $password);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0) {
        $stmt->bind_result($user);
        $stmt->fetch();
        $_SESSION['user'] = $user;
        header("Location: index.php");
    } else {
        echo "Utente non trovato, riprova";
    }
}

$mysql->close();
?>

<HTML>
    <head>
        <title>LOGIN SPIAGGIA</title>
    </head>
    <body>
        <form method="post">
            User:
            <input type="text" name="user" required> <br>
            Password:
            <input type="text" name="password" required> <br>
            <button type="submit" name="login"> LOGIN </button>
        </form>
    </body>
</HTML>