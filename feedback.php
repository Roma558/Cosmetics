<?php
// Обработчик формы записи на прием

// Проверяем, была ли отправлена форма
if (isset($_POST['send'])) {
    // Подключаемся к базе данных
    $link = mysqli_connect("localhost", "root", "", "praktika");
    
    // Проверка соединения
    if (!$link) {
        $error_message = "Ошибка подключения к базе данных: " . mysqli_connect_error();
        // Перенаправляем обратно с ошибкой
        header("Location: feedback.html?error=" . urlencode($error_message));
        exit();
    }
    
    // Получаем данные из формы
    $name = mysqli_real_escape_string($link, $_POST['sirname']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $phone = mysqli_real_escape_string($link, $_POST['phone']);
    
    // Проверяем, что поля не пустые
    if (!empty($name) && !empty($email) && !empty($phone)) {
        // Вставляем данные в таблицу
        $sql_insert = "INSERT INTO feedback (name, email, phone) VALUES ('$name', '$email', '$phone')";
        
        if (mysqli_query($link, $sql_insert)) {
            $success_message = $name . ", вы успешно записаны на прием!";
            // Перенаправляем обратно с сообщением об успехе
            header("Location: feedback.html?success=" . urlencode($success_message));
            exit();
        } else {
            $error_message = "Ошибка при записи: " . mysqli_error($link);
            // Перенаправляем обратно с ошибкой
            header("Location: feedback.html?error=" . urlencode($error_message));
            exit();
        }
    } else {
        $error_message = "Пожалуйста, заполните все поля!";
        // Перенаправляем обратно с ошибкой
        header("Location: feedback.html?error=" . urlencode($error_message));
        exit();
    }
    
    mysqli_close($link);
} else {
    // Если форма не была отправлена, перенаправляем на форму
    header("Location: feedback.html");
    exit();
}
?>