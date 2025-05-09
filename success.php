<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Submitted</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="success-card" class="success-card">
        <h3>Report Submitted Successfully!</h3>
        <p><strong>User ID:</strong> <span id="user_id"><?php echo htmlspecialchars($_GET['user_id']); ?></span></p>
        <p><strong>Name:</strong> <span id="name"><?php echo htmlspecialchars($_GET['name']); ?></span></p>
        <p><strong>Crime Type:</strong> <span id="crime_type"><?php echo htmlspecialchars($_GET['crime_type']); ?></span></p>
    <button id="back-button">Back</button>
    </div>
    <!-- <script>
        // Auto-refresh the page after 5 seconds
        setTimeout(function() {
            window.location.href = 'report.html';
        }, 1000);
    </script> -->
        <!-- <script>
        // Refresh the page on button click
        document.getElementById('refresh-button').addEventListener('click', function() {
            window.location.href = 'report.html';
        });
    </script> -->
    <script>
        // Redirect to report.html on Back button click
        document.getElementById('back-button').addEventListener('click', function() {
            window.location.href = 'report.html';
        });
    </script>
</body>
</html>