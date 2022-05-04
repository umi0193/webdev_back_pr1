<?php

$id_count = 2;

function getUserByCityId($id_count)
{

$_ENV = parse_ini_file("connecter.env");

$server = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];
$bd = $_ENV['DB_NAME'];

// Открываем соединение
$mysqli_connection = mysqli_connect($server, $user, $password, $bd);
 
// Проверка результата подключения
if (!$mysqli_connection) {
      echo "Что-то пошло не так!:(";
    }
echo "Соединение с БД установлено!:)";
 

$command_sql = "SELECT * FROM Users WHERE City_id = '$id_count'";

if ($result = mysqli_query($mysqli_connection, $command_sql))
{
echo "<table><tr><th>Name</th><th>Phone</th><th>City_id</th></tr>";
    foreach($result as $row){
        echo "<tr>";
            echo "<td>" . $row["Name"] . "</td>";
            echo "<td>" . $row["Phone"] . "</td>";
            echo "<td>" . $row["City_id"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
else {
echo "Пользователь с таким городом не найден";
}
mysqli_close($mysqli_connection);

}

getUserByCityId($id_count);



// Закрываем соединение


?>
