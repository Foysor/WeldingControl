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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Контроль качества сварки</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#documents">Документы</a></li>
                <li class="nav-item"><a class="nav-link" href="#lectures">Лекции</a></li>
                <li class="nav-item"><a class="nav-link" href="#tests">Тесты</a></li>
                <li class="nav-item"><a class="nav-link" href="#attestation">Аттестация</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Главное содержимое -->
<div class="container my-5">

    <!-- Документы -->
    <section id="documents" class="my-5">
        <h2 class="text-center mb-4">Просмотр документов</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Документ 1</h5>
                        <p class="card-text">Описание документа, касающегося контроля качества сварки.</p>
                        <a href="document1.pdf" target="_blank" class="btn btn-primary">Открыть документ</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Документ 2</h5>
                        <p class="card-text">Описание второго документа для контроля сварных соединений.</p>
                        <a href="document2.pdf" target="_blank" class="btn btn-primary">Открыть документ</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Лекции -->
    <section id="lectures" class="my-5">
        <h2 class="text-center mb-4">Просмотр лекций</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Лекция 1</h5>
                        <p class="card-text">Основы визуального контроля сварки.</p>
                        <a href="lecture1.mp4" target="_blank" class="btn btn-primary">Смотреть лекцию</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Лекция 2</h5>
                        <p class="card-text">Методы измерительного контроля сварных соединений.</p>
                        <a href="lecture2.mp4" target="_blank" class="btn btn-primary">Смотреть лекцию</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Тесты -->
    <!-- <section id="tests" class="my-5">
        <h2 class="text-center mb-4">Решение тестов</h2>
        <div class="text-center">
            <a href="test1.php" class="btn btn-success m-2">Тест 1</a>
            <a href="test2.php" class="btn btn-success m-2">Тест 2</a>
        </div>
    </section> -->

    <!-- Аттестация -->
    <section id="attestation" class="my-5">
        <h2 class="text-center mb-4">Проведение аттестации</h2>
        <p class="text-center">Аттестацию проводит инженер, заполняя параметры сварного шва, выполненного аттестуемым сварщиком.</p>
        <div class="text-center">
            <a href="attestation.php" class="btn btn-danger">Начать аттестацию</a>
        </div>
    </section>

</div>

<!-- Подвал -->
<footer class="bg-dark text-white text-center py-3">
    <p>&copy; 2024 Система контроля качества сварных соединений</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
