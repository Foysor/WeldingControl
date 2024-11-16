<?php
// Установите заголовок для указания кодировки страницы
header('Content-Type: text/html; charset=UTF-8');

// Параметры подключения к базе данных
$host = 'localhost';
$dbname = 'welding'; // Имя базы данных
$username = 'root'; // Имя пользователя
$password = ''; // Пароль (по умолчанию пустой)

try {
    // Подключение с указанием кодировки
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES 'utf8mb4'");
} catch (PDOException $e) {
    echo '<div class="alert alert-danger text-center">Ошибка подключения к базе данных: ' . $e->getMessage() . '</div>';
    exit();
}
?>
