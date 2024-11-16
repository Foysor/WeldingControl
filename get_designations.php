<?php
header('Content-Type: application/json');

// Подключение к базе данных
require_once 'db_connect.php';

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
