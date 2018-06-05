<?php
	// Подключаемся к БД
    
    $host = "127.0.0.1";
    $user = "amig03";
    $pass = "_mysql_";
    $db_name = "dogs_db";
    
    $mysql = new mysqli($host, $user, $pass, $db_name);
    $mysql -> set_charset("utf8");
    
    // Осуществляем запрос
    
    $query = "SELECT * FROM dogs_db.articles";
    
    $result = $mysql -> query($query);

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles\main.css">
	<link rel="stylesheet" type="text/css" href="styles\breeds.css">
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
		<div class="add_article_btn"><div class="_add_plus">+</div><div class="_add_text">Добавить статью</div></div>
<?php
	while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
		echo '<div class="article_preview">';
		echo '<span>' . $row['header'] . '</span>';
		echo '<a href="\\article.php?id=' . $row['id'] . '"></a>';
		echo '<img src="' . $row['img_pre'] . '" alt="' . $row['header'] . '">';
		echo '<div class="article_text">' . $row['text_pre'] . '</div>';
		echo '</div>';
	}
?>
	</div>
	<div id="modal">
		<div id="background"></div>
		<div id="wait_window">Пожалуйста, подождите...</div>
		<div id="create_window">
			<h2>Создание новой статьи</h1>
			<form action="create_article.php" accept-charset="utf-8" method="post" enctype="multipart/form-data">
				<span class="fixed_length">Фото для краткого описания статьи: </span>
				<input name="img_pre" type="file" enctype="multipart/form-data" required><br/>
				
				<span class="fixed_length">Основное фото статьи: </span>
				<input name="img" type="file" enctype="multipart/form-data" required><br/>

				<span class="fixed_length">Заголовок статьи: </span><input name="header" type="text" style="width: 65%;"><br/>
				
				<span>Текст для краткого описания статьи (текст), максимум 1000 символов:</span><br/>
				<textarea required name="text_pre" id="pre_text" maxlength="1000"></textarea><br/>
				
				<span>Основной текст статьи (html)</span><br/>
				<textarea required name="text" id="text"></textarea><br/>
				
				<input type="submit" value="Создать статью">
			</form>
		</div>
	</div>
</main>

<footer>
	<div>
		<p>ООО "Компания" © 2018</p>
	</div>
</footer>

<script type="text/javascript" src="\js\main.js"></script>
<script type="text/javascript" src="\js\breeds.js"></script>

</body>
</html>