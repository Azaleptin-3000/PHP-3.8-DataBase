<?php
// Подключение к базе данных
$host = 'localhost'; // ваш хост
$db = 'base-mysql'; // имя вашей базы данных
$user = 'root'; // имя пользователя MySQL
$pass = ''; // пароль (если есть)
$charset = 'utf8mb4';

// Настройка PDO
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Подключение к базе данных успешно завершено.<br>";
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Обработка отправки отзыва
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['name'], $_POST['review'], $_POST['rating'])) {
    $name = $_POST['name'];
    $review = $_POST['review'];
    $rating = $_POST['rating'];

    // SQL-запрос для добавления отзыва в базу данных
    $sql = "INSERT INTO reviews (name, review, rating) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $review, $rating]);

    echo "Отзыв добавлен успешно!";
}
?>

<!-- Код для отображения отзывов -->
<h3>Отзывы о товаре</h3>
<?php
// SQL-запрос для получения всех отзывов из таблицы reviews
$sql = "SELECT * FROM reviews";
$stmt = $pdo->query($sql);
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Вывод всех отзывов на страницу
if ($reviews) {
    foreach ($reviews as $review) {
        echo "<p><strong>{$review['name']}</strong>: {$review['review']} (Рейтинг: {$review['rating']})</p>";
    }
} else {
    echo "Отзывов пока нет.";
}
?>