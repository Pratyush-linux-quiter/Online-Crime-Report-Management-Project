<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        h1 {
            color: #28a745;
            margin-bottom: 20px;
        }
        p {
            color: #555;
            margin-bottom: 10px;
        }
        .back-button {
            background: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        .back-button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Criminal Details Added Successfully</h1>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($_GET['name']); ?></p>
        <p><strong>Age:</strong> <?php echo htmlspecialchars($_GET['age']); ?></p>
        <p><strong>Crime:</strong> <?php echo htmlspecialchars($_GET['crime']); ?></p>
        <p><strong>Photo:</strong> <?php echo htmlspecialchars($_GET['photo']); ?></p>
        <p><strong>Video:</strong> <?php echo htmlspecialchars($_GET['video']); ?></p>
        <button class="back-button" onclick="window.location.href='add_criminal.php'">Back to Admin Page</button>
    </div>
</body>
</html>
