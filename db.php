<?php
// Параметры подключения к базе данных
$dsn = 'mysql:host=localhost;dbname=base-mysql';
$username = 'root';
$password = '';

try {
    // Создание подключения через PDO
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    // Контрольный вывод для проверки успешного подключения
    echo "Подключение к базе данных успешно выполнено.";

} catch (PDOException $e) {
    // Вывод ошибки подключения
    die("Ошибка подключения: " . $e->getMessage());
}
?>