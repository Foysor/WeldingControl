<?php
// Подключение к базе данных MySQL
$host = 'localhost';
$dbname = 'test';  // Имя вашей базы данных
$username = 'root';  // Пользователь XAMPP по умолчанию
$password = '';  // Пароль по умолчанию пуст

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
    exit;
}

// Выполняем запрос к таблице
try {
    $query = "SELECT * FROM table1";
    $stmt = $pdo->query($query);

    // Подключаем CSS для стилизации таблицы
    echo "
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
    ";

    // Вывод данных в таблицу
    echo "<h3>Результаты Теста 1:</h3>";
    echo "<table>";
    echo "<tr>";
    for ($i = 0; $i < $stmt->columnCount(); $i++) {
        $col = $stmt->getColumnMeta($i);
        echo "<th>" . $col['name'] . "</th>";
    }
    echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} catch (PDOException $e) {
    echo "Ошибка при выполнении запроса: " . $e->getMessage();
}
?>
