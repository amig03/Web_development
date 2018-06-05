<?php
    // Получаем ID статьи
    
    $id = intval($_GET['id']);
    
    // Подключаемся к БД
    
    $host = "127.0.0.1";
    $user = "amig03";
    $pass = "_mysql_";
    $db_name = "dogs_db";
    
    $mysql = new mysqli($host, $user, $pass, $db_name);
    $mysql -> set_charset("utf8");
    
    // Осуществляем запрос
    
    $query = "SELECT * FROM dogs_db.articles AS dg WHERE dg.id = " . $id;
    
    $result = $mysql -> query($query);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="..\styles\main.css">
	<link rel="stylesheet" type="text/css" href="..\styles\article.css">
</head>
<body>

<header>
	<div id="menu">
		<ul>
			<?php include 'header.php'; ?>
		</ul>
	</div>
	<img id="logo" src="/images/logo.png" alt="logo">
</header>

<main>
	<div id="did_you_know">
		<p>Знаете ли вы?</p>
		<div>...</div>
	</div>
	<div id="content_container">
	    
<?php
    
    if ($id == 0 || $result -> num_rows == 0) {
        echo "Такой статьи не существует!";
    } elseif ($result -> num_rows == 1) {
        $row = $result -> fetch_array(MYSQLI_ASSOC);
        echo '<h1>' . $row['header'] . '</h1>';
        echo '<img src="..' . $row['img'] . '" alt="' . $row['header'] . '">';
        echo htmlspecialchars_decode($row['text']);
    }

?>
	
	</div>
</main>

<footer>
	<div>
		<p>ООО "Компания" © 2018</p>
	</div>
</footer>

<script type="text/javascript" src="\js\main.js"></script>

</body>
</html>