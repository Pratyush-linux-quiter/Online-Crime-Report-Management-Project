<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crime report";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add CSS for styling
echo "<style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
      </style>";

// Add a button for back to homepage
echo "<button onclick=\"window.location.href='index.html'\">Back to Homepage</button>";

// SQL query to fetch crime statistics
$sql = "SELECT id, crime_type, date_reported, description, location FROM reports";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Crime Type</th>
                <th>Date</th>
                <th>Description</th>
                <th>Location</th>
            </tr>";
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"]. "</td>
                <td>" . $row["crime_type"]. "</td>
                <td>" . $row["date_reported"]. "</td>
                <td>" . $row["description"]. "</td>
                <td>" . $row["location"]. "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// New section to display crime cases by status
echo "<h2>Crime Cases by Status</h2>";

$status_sql = "SELECT 
                YEAR(date_reported) as year, 
                MONTH(date_reported) as month, 
                status, 
                COUNT(*) as count 
               FROM reports 
               GROUP BY YEAR(date_reported), MONTH(date_reported), status 
               ORDER BY YEAR(date_reported), MONTH(date_reported)";
$status_result = $conn->query($status_sql);

if ($status_result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Year</th>
                <th>Month</th>
                <th>Status</th>
                <th>Count</th>
            </tr>";
    while($status_row = $status_result->fetch_assoc()) {
        echo "<tr>
                <td>" . $status_row["year"]. "</td>
                <td>" . $status_row["month"]. "</td>
                <td>" . $status_row["status"]. "</td>
                <td>" . $status_row["count"]. "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
