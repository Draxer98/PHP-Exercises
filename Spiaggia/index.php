<?php
session_start();

$mysql = new mysqli("127.0.0.1", "michele_gaino", "1234", "db");

if($mysql->connect_error) {
    die($mysql->connect_error);
}

$user = $_SESSION['user'];
$admin = 0;

$stmt = $mysql->prepare("SELECT admin FROM persona WHERE admin = 1 AND user = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0) {
    $admin = 1;
}
$stmt->close();
?>
<html>
    <head>
        <title>
            INDEX SPIAGGIA
        </title>
    </head>
    <body>
        <?php
        if($admin == 1){
            $stmt = $mysql->prepare("SELECT quantitaTeli FROM stagione");
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['quantitaTeli'] . "</td>";
                echo "</tr>";
            }
        } else {

        }
        ?>
    </body>
</html>