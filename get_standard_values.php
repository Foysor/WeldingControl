<?php
header('Content-Type: application/json');

// Подключение к базе данных
$host = 'localhost';
$dbname = 'welding';
$username = 'root';
$password = '';

try {
    // Создаем подключение к базе данных
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Ошибка подключения к базе данных: ' . $e->getMessage()]);
    exit();
}

// Получение параметров из запроса
$document = isset($_GET['document']) ? $_GET['document'] : null;
$wj_symbol = isset($_GET['wj_symbol']) ? $_GET['wj_symbol'] : null;

if (!$document || !$wj_symbol) {
    echo json_encode(['success' => false, 'message' => 'Не указаны все необходимые параметры']);
    exit();
}

// Запрос к базе данных для получения эталонных значений из представления objprmview
try {
    $stmt = $pdo->prepare("
        SELECT wall_thikness, b_nomin, b_error, c_nomin, c_error, e_nomin, e_error, g_nomin, g_error, 
               e1_nomin, e1_error, g1_nomin, g1_error, k_nomin, k_error, alpha, alpha_error, 
               R, i, h_pm1, f_pm1
        FROM objprmview
        WHERE document = :document AND wj_symbol = :wj_symbol
    ");
    $stmt->execute(['document' => $document, 'wj_symbol' => $wj_symbol]);

    $values = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($values) {
        echo json_encode(['success' => true, 'values' => $values]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Данные не найдены']);
    }

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Ошибка выполнения запроса: ' . $e->getMessage()]);
}
?>
