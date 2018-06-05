<html>
<meta charset="utf-8">
<body>
<?php

$host = '127.0.0.1';
$user = 'amig03';
$pass = '_mysql_';
$db_name = 'dogs_db';

$mysql = new mysqli($host, $user, $pass, $db_name);
$mysql->set_charset("utf8");

if ($mysql->connect_errno) {
    echo "Возникла ошибка: " . $mysql->connect_error;
    exit;
}

$sql = "SELECT * FROM requests";

// mysqli_query("SET NAMES utf8_general_ci");
$res = $mysql->query($sql);

while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
    echo "name: " . $row["name"] . "<br/>" . "city: " . $row["city"] . "<br/>";
}


?>
</body>
</html>