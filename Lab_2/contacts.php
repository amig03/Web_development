<?php
	if (count($_POST)) {
		// Подключаемся к БД
    
		$host = "127.0.0.1";
    	$user = "amig03";
    	$pass = "_mysql_";
    	$db_name = "dogs_db";
    
    	$mysql = new mysqli($host, $user, $pass, $db_name);
    	$mysql -> set_charset("utf8");
    
    	// Определяем переменные для записи в БД
    
    	$name = $mysql -> real_escape_string(htmlspecialchars($_POST['name']));
    	$city = $mysql -> real_escape_string(htmlspecialchars($_POST['city']));
    	$email = $mysql -> real_escape_string(htmlspecialchars($_POST["email"]));
    	$phone = $mysql -> real_escape_string(htmlspecialchars($_POST["phone"]));
    	$comment = $mysql -> real_escape_string(htmlspecialchars($_POST["comment"]));
    
    	if ($mysql -> connect_errno) {
        	echo "ERROR: " . $mysql -> connect_error;
        	exit;
    	}
    
    	// Осуществляем запрос
    
    	$query = "INSERT INTO
                	dogs_db.requests (
                    	`id`,
                    	`name`,
                    	`city`,
                    	`email`,
                    	`phone`,
                    	`comment`
                	) VALUES (
                    	NULL,
                    	'" . $name . "',
                    	'" . $city . "',
                    	'" . $email . "',
                    	'" . $phone . "',
                    	'" . $comment . "'
            	);";
            	
        $message = false;
            	
        if ($mysql -> query($query)) {
        	$message = "Ваше обращение успешно отправлено!";
        } else {
        	$message = "Произошла ошибка! Попробуйте еще раз позднее." . $mysql -> error;
        }
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles\main.css">
	<link rel="stylesheet" type="text/css" href="styles\contacts.css">
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
		<div id="main_content">
			<h1>Наши контакты</h1>

			<p class="info"><b>Адрес:</b> Костромская область, Костромской район, д. Симаково</p>
			<p class="info"><b>Телефон:</b> +7 999 888 77 66</p>

			<p class="info"><b>E-mail:</b> e-mail@mail.ru</p>

			<input type="button" id="map_button" class="button" value="Показать на карте">
			<div id="map">
				<iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A406380c375f18e0b2787044a6ad550452549a67fe5b9386c774fda9e73b5a662&amp;source=constructor" width="500" height="400" frameborder="0"></iframe>
			</div>

			<p>
				<i>
					Вы можете связаться с нами, используя форму ниже<br>
					Обратите внимание: поля, отмеченные звездочкой - обязательны для заполнения.
				</i>
			</p>
			<br>

			<form action="contacts.php" method="post">
				<label for="name">Имя:<span>*</span></label>
				<input type="text" name="name" id="name" placeholder="Введите ваше имя" required>
				<br>

				<label for="phone">Телефон:<span>*</span></label>
				<input type="text" name="phone" id="phone" value="+7 (___) ___-__-__" pattern="\+7 \([0-9]{3}\) [0-9]{3}-[0-9]{2}-[0-9]{2}" required>
				<br>

				<label for="email">Электронная почта:<span>*</span></label>
				<input type="email" name="email" id="email" placeholder="example@mail.com" pattern=".+@.+\..+" required>
				<br>

				<label for="city">Город:</label>
				<input type="text" name="city" id="city">
				<br>

				<label for="comment">Текст обращения:<span>*</span></label>
				<textarea maxlength="250" name="comment" id="comment" required></textarea>
				
<?php
	if ($message) {
		echo '<div style="color: red; font-size: 20pt;">' . $message . '</div>'	;
	}
?>

				<input type="submit" name="submit" class="button" value="Отправить">
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
<script type="text/javascript" src="\js\contacts.js"></script>

</body>
</html>