<?php
// Подключение к базе данных
$dsn = 'mysql:host=localhost;dbname=base-mysql';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    // Контрольный вывод для проверки успешного подключения
    echo "Подключение к базе данных успешно выполнено.<br>";
} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}

// Проверка, что запрос был отправлен методом POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name'])) {
        // Логика для добавления отзыва
        $name = $_POST['name'];
        $review = $_POST['review'];
        $rating = (int) $_POST['rating'];
        $sql = "INSERT INTO reviews (name, review, rating) VALUES (:name, :review, :rating)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute(['name' => $name, 'review' => $review, 'rating' => $rating])) {
            echo "Отзыв успешно добавлен!<br>";
        } else {
            echo "Произошла ошибка при добавлении отзыва.<br>";
        }
    } elseif (isset($_POST['order_id'])) {
        // Логика для отмены заказа
        $order_id = $_POST['order_id'];
        $reason = $_POST['reason'];
        $sql = "INSERT INTO cancellations (order_id, reason) VALUES (:order_id, :reason)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute(['order_id' => $order_id, 'reason' => $reason])) {
            echo "Заказ #$order_id успешно отменен!<br>";
        } else {
            echo "Произошла ошибка при отмене заказа.<br>";
        }
    }
}
?>