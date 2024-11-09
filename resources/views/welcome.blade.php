<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ProContext</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            justify-content: center;
        }

        .header-container {
            display: flex;
            align-items: center;
            gap: 20px; /* Расстояние между h1 и ul */
        }

        h1 {
            font-size: 26px;
            color: #222;
            margin: 0;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        li {
            margin-bottom: 5px;
        }

        p {
            margin-top: 20px; /* Отступ сверху для p, чтобы он не сливался с верхними элементами */
        }
    </style>
</head>
<body>
    
    <div class="header-container">
        <h1>Список API:</h1>
        <ul>
            <li>(<strong>GET</strong>) http://procontext/api/users - список всех пользователей</li>
            <li>(<strong>GET</strong>) http://procontext/api/users/{id} - данные о пользователе с id из параметра</li>
            <li>(<strong>POST</strong>) http://procontext/api/users - Добавление нового пользователя</li>
            <li>(<strong>PUT</strong>) http://procontext/api/users/{id} - Обновление данных о пользователе</li>
            <li>(<strong>DELETE</strong>) http://procontext/api/users/{id} - Удаление пользователя</li>
        </ul>
    </div>
    <br>
    <h1>Пример JSON в запросе</h1>
    <pre>
    {
        "name": "Иван Иванов",
        "email": "ivan.ivanov@mail.ru",
        "age": 42
    }
    </pre>

</body>

</body>
</html>
