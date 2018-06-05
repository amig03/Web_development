<?php
			
	$menu = array(
	    "Главная" => "/",
	    "Породы" => "/breeds.php",
	    "Фотографии" => "/photos.php",
	    "Контакты" => "/contacts.php"
	);
	
	foreach ($menu as $key => $value) {
	   echo '<a href="' . $value . '"><li>' . $key . '</li></a>';
	}

?>