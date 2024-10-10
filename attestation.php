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
} catch (PDOException $e) {
    echo '<div class="alert alert-danger text-center">Ошибка подключения к базе данных: ' . $e->getMessage() . '</div>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Проведение аттестации сварных соединений</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Шапка -->
<header class="bg-dark text-white py-4 text-center">
    <h1>Аттестация сварочных соединений</h1>
</header>

<div class="container my-5">
    <h2 class="text-center mb-4">Форма проведения аттестации</h2>
    <form action="attestation_submit.php" method="post">
        <!-- Поле для выбора нормативного документа ГОСТ -->
        <div class="mb-3">
            <label for="gostSelect" class="form-label">Выберите нормативный документ (ГОСТ):</label>
            <select class="form-select" id="gostSelect" name="document" required>
                <option value="" disabled selected>Выберите ГОСТ</option>
                <?php
                // Запрос для получения всех ГОСТов из базы данных
                try {
                    $stmt = $pdo->query("SELECT document FROM docs");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . htmlspecialchars($row['document']) . '">' . htmlspecialchars($row['document']) . '</option>';
                    }
                } catch (PDOException $e) {
                    echo '<option value="" disabled>Ошибка загрузки ГОСТов: ' . $e->getMessage() . '</option>';
                }
                ?>
            </select>
        </div>

        <!-- Поле для выбора условного обозначения соединения -->
        <div class="mb-3">
            <label for="designationSelect" class="form-label">Выберите условное обозначение соединения:</label>
            <select class="form-select" id="designationSelect" name="wj_symbol" required>
                <option value="" disabled selected>Выберите обозначение</option>
                <?php
                // Запрос для получения всех условных обозначений из базы данных
                try {
                    $stmt = $pdo->query("SELECT DISTINCT wj_symbol FROM docobjprm");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . htmlspecialchars($row['wj_symbol']) . '">' . htmlspecialchars($row['wj_symbol']) . '</option>';
                    }
                } catch (PDOException $e) {
                    echo '<option value="" disabled>Ошибка загрузки обозначений: ' . $e->getMessage() . '</option>';
                }
                ?>
            </select>
        </div>

        <!-- Таблица параметров сварного соединения (Эталонные значения) -->
        <div id="parametersTable" class="mt-5" style="display: none;">
            <h4 class="text-center">Эталонные параметры сварного соединения</h4>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Толщина стенки</th>
                        <th>b номин.</th>
                        <th>b откл.</th>
                        <th>C номин.</th>
                        <th>C откл.</th>
                        <th>e номин.</th>
                        <th>e откл.</th>
                        <th>g номин.</th>
                        <th>g откл.</th>
                        <th>e1 номин.</th>
                        <th>e1 откл.</th>
                        <th>g1 номин.</th>
                        <th>g1 откл.</th>
                        <th>k номин.</th>
                        <th>k откл.</th>
                        <th>&alpha;</th>
                        <th>&alpha; откл.</th>
                        <th>R</th>
                        <th>i</th>
                        <th>h +1</th>
                        <th>f +1</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="parametersRow">
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Таблица для ввода параметров пользователем -->
        <div id="userInputTable" class="mt-5">
            <h4 class="text-center">Введите свои параметры для проверки</h4>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Толщина стенки</th>
                        <th>b</th>
                        <th>C</th>
                        <th>e</th>
                        <th>g</th>
                        <th>e1</th>
                        <th>g1</th>
                        <th>k</th>
                        <th>&alpha;</th>
                        <th>R</th>
                        <th>i</th>
                        <th>h +1</th>
                        <th>f +1</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="number" class="form-control" name="thickness" id="thickness" required></td>
                        <td><input type="number" class="form-control" name="b" id="b" required></td>
                        <td><input type="number" class="form-control" name="c" id="c" required></td>
                        <td><input type="number" class="form-control" name="e" id="e" required></td>
                        <td><input type="number" class="form-control" name="g" id="g" required></td>
                        <td><input type="number" class="form-control" name="e1" id="e1" required></td>
                        <td><input type="number" class="form-control" name="g1" id="g1" required></td>
                        <td><input type="number" class="form-control" name="k" id="k" required></td>
                        <td><input type="number" class="form-control" name="alpha" id="alpha" required></td>
                        <td><input type="number" class="form-control" name="r" id="r" required></td>
                        <td><input type="number" class="form-control" name="i" id="i" required></td>
                        <td><input type="number" class="form-control" name="h1" id="h1" required></td>
                        <td><input type="number" class="form-control" name="f1" id="f1" required></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Кнопка для сверки значений с эталоном -->
        <div class="text-center my-4">
            <button type="button" class="btn btn-primary" id="compareBtn">Сверить</button>
        </div>

        <!-- Кнопка для сохранения результатов аттестации -->
        <div class="text-center">
            <button type="submit" class="btn btn-success">Сохранить результат аттестации</button>
        </div>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('designationSelect').addEventListener('change', function () {
        const documentValue = document.getElementById('gostSelect').value;
        const wjSymbol = this.value;

        if (!documentValue || !wjSymbol) {
            alert('Пожалуйста, выберите ГОСТ и обозначение соединения.');
            return;
        }

        // Сделаем AJAX запрос к серверу для получения параметров из базы данных
        fetch(`./get_standard_values.php?document=${documentValue}&wj_symbol=${wjSymbol}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const row = document.getElementById('parametersRow');
                    row.innerHTML = `
                        <td>${data.values.wall_thikness || '-'}</td>
                        <td>${data.values.b_nomin || '-'}</td>
                        <td>${data.values.b_error || '-'}</td>
                        <td>${data.values.c_nomin || '-'}</td>
                        <td>${data.values.c_error || '-'}</td>
                        <td>${data.values.e_nomin || '-'}</td>
                        <td>${data.values.e_error || '-'}</td>
                        <td>${data.values.g_nomin || '-'}</td>
                        <td>${data.values.g_error || '-'}</td>
                        <td>${data.values.e1_nomin || '-'}</td>
                        <td>${data.values.e1_error || '-'}</td>
                        <td>${data.values.g1_nomin || '-'}</td>
                        <td>${data.values.g1_error || '-'}</td>
                        <td>${data.values.k_nomin || '-'}</td>
                        <td>${data.values.k_error || '-'}</td>
                        <td>${data.values.alpha || '-'}</td>
                        <td>${data.values.alpha_error || '-'}</td>
                        <td>${data.values.R || '-'}</td>
                        <td>${data.values.i || '-'}</td>
                        <td>${data.values.h_pm1 || '-'}</td>
                        <td>${data.values.f_pm1 || '-'}</td>
                    `;
                    document.getElementById('parametersTable').style.display = 'block';
                } else {
                    alert('Не удалось загрузить параметры соединения.');
                }
            })
            .catch(error => {
                console.error('Ошибка при загрузке параметров соединения:', error);
                alert('Ошибка при загрузке параметров соединения.');
            });
    });

    document.getElementById('compareBtn').addEventListener('click', function () {
        // Логика сверки значений
        const documentValue = document.getElementById('gostSelect').value;
        const wjSymbol = document.getElementById('designationSelect').value;

        if (!documentValue || !wjSymbol) {
            alert('Пожалуйста, выберите ГОСТ и обозначение соединения.');
            return;
        }

        // Сделаем AJAX запрос к серверу для получения эталонных значений
        fetch(`./get_standard_values.php?document=${documentValue}&wj_symbol=${wjSymbol}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Получаем значения из таблицы и сравниваем с эталонными, учитывая допустимые отклонения
                    const fields = ['thickness', 'b', 'c', 'e', 'g', 'e1', 'g1', 'k', 'alpha', 'r', 'i', 'h1', 'f1'];
                    let allMatch = true;

                    fields.forEach(field => {
                        const inputValue = parseFloat(document.getElementById(field).value);
                        const nominValue = parseFloat(data.values[`${field}_nomin`] || 0);
                        const errorValue = parseFloat(data.values[`${field}_error`] || 0);

                        if (Math.abs(inputValue - nominValue) > errorValue) {
                            allMatch = false;
                            document.getElementById(field).classList.add('is-invalid');
                        } else {
                            document.getElementById(field).classList.remove('is-invalid');
                        }
                    });

                    if (allMatch) {
                        alert('Все значения совпадают с эталонными.');
                    } else {
                        alert('Некоторые значения не совпадают с эталонными. Проверьте выделенные поля.');
                    }
                } else {
                    alert('Не удалось загрузить эталонные значения.');
                }
            })
            .catch(error => {
                console.error('Ошибка при загрузке эталонных значений:', error);
                alert('Ошибка при загрузке эталонных значений.');
            });
    });
</script>

</body>
</html>