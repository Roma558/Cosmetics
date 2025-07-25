<!DOCTYPE html>
<html>

<head>
  <title>Клиника косметологии "Гармония" - Записаться на прием</title>
  <link rel="stylesheet" type="text/css" href="my_styles.css">
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
  <header>
    <img src="images/Logo.jpg" id="logo" align="center">
    <h1>Гармония</h1>
    <div class="subtitle">Клиника косметологии в Москве</div>
  </header>
  <div id="content">
    <div id="menu">
      <ul>
        <li><a href="index.html">Главная</a></li>
        <li><a href="price.html">Услуги и цены</a></li>
        <li><a href="raboti.html">Наши работы</a></li>
        <li><a href="feedback.php" class="active">Записаться на прием</a></li>
        <li><a href="kontakti.html">Контакты</a></li>
      </ul>
    </div>
    <div id="article">
      <h2>Записаться на прием</h2>
      
      <?php
      // Обработка формы
      if (isset($_POST['send'])) {
        // Подключаемся к базе данных
        $link = mysqli_connect("localhost", "root", "", "praktika");
        
        // Проверка соединения
        if (!$link) {
          die("Ошибка подключения: " . mysqli_connect_error());
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
            echo "<div style='margin-top: 20px; padding: 10px; background: rgba(212, 165, 181, 0.2); border-radius: 5px;'>";
            echo "<p style='color: #5d3a4e; font-weight: bold;'>" . $name . ", вы успешно записаны на прием!</p>";
            echo "</div>";
          } else {
            echo "<div style='margin-top: 20px; padding: 10px; background: #ffebee; border-radius: 5px;'>";
            echo "<p style='color: #c62828;'>Ошибка при записи: " . mysqli_error($link) . "</p>";
            echo "</div>";
          }
        } else {
          echo "<div style='margin-top: 20px; padding: 10px; background: #fff3e0; border-radius: 5px;'>";
          echo "<p style='color: #ef6c00;'>Пожалуйста, заполните все поля!</p>";
          echo "</div>";
        }
        
        mysqli_close($link);
      }
      ?>
      
      <form name="form1" method="post" action="feedback.php"> 
        <p>Имя: <input type="text" name="sirname" required></p> 
        <p>Ваш Email: <input type="email" name="email" required></p>
        <p>Номер телефона: <input type="text" name="phone" required></p>
        <p><input type="submit" name="send" value="Отправить"></p>
      </form>

      <?php
      // Отображение последней записи (необязательно)
      /*
      $link = mysqli_connect("localhost", "root", "", "praktika");
      
      if ($link) {
        $sql = "SELECT name FROM feedback ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($link, $sql);
        
        if ($result && $line = mysqli_fetch_row($result)) {
          echo "<div style='margin-top: 20px; padding: 10px; background: rgba(212, 165, 181, 0.2); border-radius: 5px;'>";
          echo "<p style='color: #5d3a4e; font-weight: bold;'>" . $line[0] . ", вы записаны на прием!</p>";
          echo "</div>";
        }
        mysqli_close($link);
      }
      */
      ?>
    </div>
  </div>
  <footer>Все права защищены © 2004-2025 Клиника косметологии "Гармония"</footer>
</body>

</html>