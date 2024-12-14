<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новинки наших писателей</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            text-align: center;
        }

        header {
            background-color: #fff;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        header img {
            max-width: 100px;
            margin-right: 20px;
            cursor: pointer;
        }

        header h1 {
            color: #333;
            margin: 0;
            font-size: 24px;
        }

        h2 {
            margin-top: 20px;
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <header onclick="window.location.href='main.html'">
        <img src="./log.png" alt="Логотип">
        <h1>Kaleidoscope Books</h1>
    </header>
    <h2>Новинки наших писателей</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Автор</th>
                <th>Название книги</th>
                <th>Дата добавления</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Соединение с базой данных (замените параметры на свои)
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "uni-lit_project";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Выполнение запроса для извлечения данных из базы данных
            $sql = "SELECT * FROM books";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["author"] . "</td>";
                    echo "<td>" . $row["title"] . "</td>";
                    echo "<td>" . $row["date_added"] . "</td>";
                    echo "<td><a href='view_book.php?id=" . $row["id"] . "'>Просмотреть</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Нет доступных книг</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
