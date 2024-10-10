<?php
header('Content-Type: application/json');

// Подключение к базе данных
$host = 'localhost';
$dbname = 'welding'; // Имя базы данных
$username = 'root'; // Имя пользователя
$password = ''; // Пароль (по умолчанию пустой)

try {
    // Создаем подключение к базе данных
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Ошибка подключения к базе данных: ' . $e->getMessage()]);
    exit();
}

// Получение параметра из запроса
$documentId = isset($_GET['document']) ? $_GET['document'] : null;

if (!$documentId) {
    echo json_encode(['success' => false, 'message' => 'Не указан параметр документа']);
    exit();
}

try {
    // Запрос к базе данных для получения условных обозначений соединений, соответствующих выбранному документу
    $stmt = $pdo->prepare("SELECT wj_symbol FROM docobjprm WHERE idDOC = :documentId");
    $stmt->bindParam(':documentId', $documentId, PDO::PARAM_INT);
    $stmt->execute();

    $designations = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $designations[] = $row['wj_symbol'];
    }

    echo json_encode(['success' => true, 'designations' => $designations]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Ошибка выполнения запроса: ' . $e->getMessage()]);
}
?>
