<meta charset="utf-8">
<?php
    
    // Определяем пути сохранения изображений для статьи и сохраняем их
    
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/images/breeds/';
    
    $img_pre_path_full = $upload_dir . basename($_FILES['img_pre']['name']);
    $img_path_full = $upload_dir . basename($_FILES['img']['name']);
    
    $img_pre_path = '/images/breeds/' . basename($_FILES['img_pre']['name']);
    $img_path = '/images/breeds/' . basename($_FILES['img']['name']);
    
    move_uploaded_file($_FILES['img_pre']['tmp_name'], $img_pre_path_full);
    move_uploaded_file($_FILES['img']['tmp_name'], $img_path_full);
    
    // Подключаемся к БД
    
    $host = "127.0.0.1";
    $user = "amig03";
    $pass = "_mysql_";
    $db_name = "dogs_db";
    
    $mysql = new mysqli($host, $user, $pass, $db_name);
    $mysql -> set_charset("utf8");
    
    // Определяем переменные для записи в БД
    
    $img_pre_path = $mysql -> real_escape_string($img_pre_path);
    $img_path = $mysql -> real_escape_string($img_path);
    $header = $mysql -> real_escape_string(htmlspecialchars($_POST["header"]));
    $text_pre = $mysql -> real_escape_string(htmlspecialchars($_POST["text_pre"]));
    $text = $mysql -> real_escape_string(htmlspecialchars($_POST["text"]));
    
    if ($mysql -> connect_errno) {
        echo "ERROR: " . $mysql -> connect_error;
        exit;
    }
    
    // Осуществляем запрос
    
    $query = "INSERT INTO
                dogs_db.articles (
                    `id`,
                    `header`,
                    `img_pre`,
                    `img`,
                    `text_pre`,
                    `text`
                ) VALUES (
                    NULL,
                    '" . $header . "',
                    '" . $img_pre_path . "',
                    '" . $img_path . "',
                    '" . $text_pre . "',
                    '" . $text . "'
                    
            );";
    
    $mysql -> query($query);
?>