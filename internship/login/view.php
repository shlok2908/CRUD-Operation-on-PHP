<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address</title>
</head>
<body>
    
<h1>Address</h1>
<?php
include('../conn/conn.php');

if ($conn) {
    try {
        $sql = "SELECT address FROM tbl_user";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($results) > 0) {
            foreach ($results as $row) {
                echo "<p>" . htmlspecialchars($row["address"]) . "</p>";
            }
        } else {
            echo "<p>No addresses found.</p>";
        }
    } catch (PDOException $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p>Database connection failed.</p>";
}
?>

<form action="update_address.php" method="post">
    <button type="submit">Update Address</button>
</form>
</body>
</html>
