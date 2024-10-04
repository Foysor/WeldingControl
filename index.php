<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Система контроля сварных соединений</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Навигационная панель -->
<header class="bg-dark text-white py-4 text-center">
    <h1>Контроль качества сварки</h1>
</header>

<!-- Центрированные кнопки навигации -->
<nav class="d-flex justify-content-center my-3">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link btn btn-outline-light mx-2" href="#documents">Документы</a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn btn-outline-light mx-2" href="#lectures">Лекции</a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn btn-outline-light mx-2" href="#tests">Тесты</a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn btn-outline-light mx-2" href="#attestation">Аттестация</a>
        </li>
    </ul>
</nav>

<div class="container my-5">
    <!-- Документы с выпадающим списком -->
    <section id="documents" class="my-5">
        <h2 class="text-center mb-4">Просмотр документов</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <label for="documentSelect" class="form-label">Выберите нормативный документ:</label>
                <select class="form-select" id="documentSelect" onchange="window.open(this.value, '_blank')">
                    <option value="" disabled selected>Выберите документ</option>
                    <option value="document1.pdf">Документ 1</option>
                    <option value="document2.pdf">Документ 2</option>
                    <option value="document3.pdf">Документ 3</option>
                </select>
            </div>
        </div>
    </section>

    <!-- Лекции -->
 <section id="lectures" class="my-5">
    <h2 class="text-center mb-4">Просмотр лекций</h2>
    <div class="row justify-content-center">
        <div class="col-12 mb-3">
            <div class="card border-light shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Лекция 1: Основы визуального контроля</h5>
                    <a href="lecture1.mp4" target="_blank" class="btn btn-primary mt-3">Смотреть лекцию</a>
                </div>
            </div>
        </div>
        <div class="col-12 mb-3">
            <div class="card border-light shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Лекция 2: Методы измерительного контроля</h5>
                    <a href="lecture2.mp4" target="_blank" class="btn btn-primary mt-3">Смотреть лекцию</a>
                </div>
            </div>
        </div>
    </div>
</section>

    Тесты
    <section id="tests" class="my-5">
        <h2 class="text-center mb-4">Решение тестов</h2>
        <div class="text-center">
            <a href="test1.php" class="btn btn-success m-2">Тест 1</a>
            <a href="test2.php" class="btn btn-success m-2">Тест 2</a>
        </div>
    </section>

    <!-- Аттестация -->
    <section id="attestation" class="my-5">
        <h2 class="text-center mb-4">Проведение аттестации</h2>
        <p class="text-center">Инженер заполняет параметры сварного шва, сделанного аттестуемым сварщиком.</p>
        <div class="text-center">
            <a href="attestation.php" class="btn btn-danger">Начать аттестацию</a>
        </div>
    </section>
</div>

<!-- Подвал с индикатором подключения к базе данных -->
<footer class="bg-dark text-white text-center py-3">
    <p>&copy; 2024 Система контроля качества сварных соединений</p>
    <p>
        <?php
        // Индикатор подключения к БД (на будущее)
        $db_connected = false; // Здесь будет код для проверки подключения к БД
        if ($db_connected) {
            echo '<span class="badge bg-success">Подключение к базе данных: Активно</span>';
        } else {
            echo '<span class="badge bg-danger">Подключение к базе данных: Отсутствует</span>';
        }
        ?>
    </p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
