<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Система контроля сварных соединений</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Скрываем лекции и тесты после третьей по умолчанию */
        .lecture-card,
        .test-block {
            display: none;
        }

        /* Показываем первые три лекции и теста */
        .lecture-card:nth-of-type(-n+3),
        .test-block:nth-of-type(-n+3) {
            display: block;
        }

        /* Фиксированная шапка */
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
        }

        /* Отступ для основного контента чтобы не перекрывалось шапкой */
        body {
            padding-top: 100px;
        }

        /* Кнопка "Вверх" */
        #backToTopBtn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
            z-index: 1030;
        }
    </style>
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
            <?php
            // Подключение к базе данных
            $host = 'localhost';
            $dbname = 'welding'; // Имя базы данных
            $username = 'root'; // Имя пользователя
            $password = ''; // Пароль (по умолчанию пустой)

            try {
                // Создаем подключение к базе данных
                $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Выполняем запрос для получения всех лекций
                $sql = "SELECT * FROM lecture";
                $stmt = $pdo->query($sql);

                // Проверка, есть ли лекции
                if ($stmt->rowCount() > 0) {
                    // Вывод каждой лекции в виде карточки
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '
                        <div class="col-12 mb-3 lecture-card">
                            <div class="card border-light shadow-sm">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Лекция ' . $row["IDlec"] . ': ' . $row["Lecture"] . '</h5>
                                    <a href="lecture' . $row["IDlec"] . '.mp4" target="_blank" class="btn btn-primary mt-3">Смотреть лекцию</a>
                                </div>
                            </div>
                        </div>';
                    }
                } else {
                    echo '<p class="text-center">Лекций пока нет.</p>';
                }

            } catch (PDOException $e) {
                echo 'Ошибка подключения: ' . $e->getMessage();
            }
            ?>
        </div>
        <div class="text-center mt-4">
            <button class="btn btn-light toggle-btn" data-target="lecture-card">Показать ещё</button>
        </div>
    </section>

    <!-- Тесты -->
    <section id="tests" class="my-5">
        <h2 class="text-center mb-4">Решение тестов</h2>
        <div class="row justify-content-center" id="testContainer">
            <?php
            try {
                // Выполняем запрос для получения всех тестов
                $stmt = $pdo->query("SELECT * FROM testing");
                $tests = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Вывод тестов
                foreach ($tests as $index => $test) {
                    echo '<div class="col-12 mb-3 test-block">
                            <div class="card border-light shadow-sm">
                                <div class="card-body text-center">
                                    <h5 class="card-title">' . $test['test'] . '</h5>
                                    <a href="test' . $test['IDtest'] . '.php" target="_blank" class="btn btn-success mt-3">Начать тест</a>
                                </div>
                            </div>
                          </div>';
                }
            } catch (PDOException $e) {
                echo 'Ошибка подключения к базе данных: ' . $e->getMessage();
            }
            ?>
        </div>
        <div class="text-center mt-4">
            <button class="btn btn-light toggle-btn" data-target="test-block">Показать ещё</button>
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

<!-- Кнопка "Вверх" -->
<button id="backToTopBtn" class="btn btn-secondary">Вверх</button>

<!-- Подвал с индикатором подключения к базе данных -->
<footer class="bg-dark text-white text-center py-3 position-relative">
    <p>&copy; 2024 Система контроля качества сварных соединений</p>
    <div style="position: absolute; bottom: 10px; right: 10px;">
        <?php
        // Отображение состояния подключения
        if ($pdo) {
            echo '<span class="badge bg-success">Подключение к базе данных: Активно</span>';
        } else {
            echo '<span class="badge bg-danger">Подключение к базе данных: Отсутствует</span>';
        }
        ?>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Скрипт для отображения всех лекций и тестов при нажатии на кнопку -->
<script>
    document.querySelectorAll('.toggle-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            var targetClass = button.getAttribute('data-target');
            var elements = document.querySelectorAll('.' + targetClass);
            var isCollapsed = button.textContent.trim() === 'Показать ещё';

            elements.forEach(function (element, index) {
                if (index >= 3) {
                    element.style.display = isCollapsed ? 'block' : 'none';
                }
            });

            button.textContent = isCollapsed ? 'Свернуть' : 'Показать ещё';
        });
    });

    // Скрипт для кнопки "Вверх"
    var backToTopBtn = document.getElementById("backToTopBtn");
    window.onscroll = function () {
        if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
            backToTopBtn.style.display = "block";
        } else {
            backToTopBtn.style.display = "none";
        }
    };

    backToTopBtn.addEventListener("click", function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>

</body>
</html>