document.addEventListener("DOMContentLoaded", function() {
    // Получаем форму для отзывов
    const reviewForm = document.getElementById("reviewForm");
    
    // Обработчик для формы отзывов
    reviewForm.addEventListener("submit", function(event) {
        event.preventDefault(); // Предотвращаем стандартное поведение формы
        
        const formData = new FormData(reviewForm); // Получаем данные формы

        fetch('process.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text()) // Получаем ответ
        .then(data => {
            // Обработка ответа
            alert(data);
        })
        .catch(error => console.error('Ошибка:', error));
    });

    // Получаем форму для отмены заказа
    const cancelOrderForm = document.getElementById("cancelOrderForm");
    
    // Обработчик для формы отмены заказа
    cancelOrderForm.addEventListener("submit", function(event) {
        event.preventDefault(); // Предотвращаем стандартное поведение формы
        
        const formData = new FormData(cancelOrderForm); // Получаем данные формы

        fetch('process.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text()) // Получаем ответ
        .then(data => {
            // Обработка ответа
            alert(data);
        })
        .catch(error => console.error('Ошибка:', error));
    });
});