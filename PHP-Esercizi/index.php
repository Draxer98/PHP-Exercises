<?php
session_start();

$conn = new mysqli("192.168.60.144:3306", "michele_gaino", "scremerebbero.associavamo.", "michele_gaino_");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$squl = "SELECT id, cilindrata, potenza, lunghezza, larghezza, proprietario, marca, modello FROM auto";
$result = mysqli_query($conn, $squl);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        table {
            border-collapse: collapse;
        }

        th, td {
            padding: 10px 20px;
            text-align: center;
        }
    </style>

</head>


<body>
<h1> DATABASE AUTO</h1>
<table class="table table-bordered table-striped table-hover">
    <tr style="width: 5px;">
        <th>
            ID
        </th>
        <th>
            CILINDRATA
        </th>
        <th>
            POTENZA
        </th>
        <th>
            LUNGHEZZA
        </th>
        <th>
            LARGHEZZA
        </th>
        <th>
            PROPRIETARIO
        </th>
        <th>
            MARCA
        </th>
        <th>
            MODELLO
        </th>
    </tr>
    <?php
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['cilindrata'] . "</td>";
            echo "<td>" . $row['potenza'] . "</td>";
            echo "<td>" . $row['lunghezza'] . "</td>";
            echo "<td>" . $row['larghezza'] . "</td>";
            echo "<td>" . $row['proprietario'] . "</td>";
            echo "<td>" . $row['marca'] . "</td>";
            echo "<td>" . $row['modello'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "0 risultati";
    }
    ?>
</table>
</body>
</html>