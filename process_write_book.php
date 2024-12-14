<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Соединение с базой данных (замените параметры на свои)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "uni-lit_project";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Получение данных из формы
    $book_author = $_POST["book_author"];
    $book_title = $_POST["book_title"];
    $book_content = $_POST["book_content"];

    // Загрузка файла (если выбран)
    if ($_FILES["docx_file"]["size"] > 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["docx_file"]["name"]);
        move_uploaded_file($_FILES["docx_file"]["tmp_name"], $target_file);
        $docx_path = $target_file;
    } else {
        $docx_path = null;
    }

    // Получение текущей даты и времени
    $current_datetime = date("Y-m-d H:i:s");

    // Вставка данных в базу данных
    $sql = "INSERT INTO books (author, title, content, docx_path, date_added) VALUES ('$book_author', '$book_title', '$book_content', '$docx_path', '$current_datetime')";

    if ($conn->query($sql) === TRUE) {
        echo "Книга успешно сохранена в базе данных.";
        echo '<br><a href="novelties.php">Посмотреть</a>';
    } else {
        echo "Ошибка при сохранении книги: " . $conn->error;
        echo "";
        echo '<br><a href="process_write_book.php">Повторить еще раз</a>';
    }

    $conn->close();
}
?>