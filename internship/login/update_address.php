<?php
include ('../conn/conn.php');

// Start the session
session_start();

// Initialize variables
$address = '';
$user_id = isset($_SESSION['tbl_user_id']) ? $_SESSION['tbl_user_id'] : null;

if (!$user_id) {
    die("User not logged in.");
}

try {
    $sql = "SELECT address FROM tbl_user WHERE tbl_user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $address = $row['address'];
    } else {
        $address = 'No address found';
    }
} catch (PDOException $e) {
    echo "Error fetching address: " . $e->getMessage();
}

// Update the address if the form is submitted
if (isset($_POST["update"])) {
    $new_address = $_POST["address"];

    try {
        $sql = "UPDATE tbl_user SET address = ? WHERE tbl_user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $new_address, PDO::PARAM_STR);
        $stmt->bindParam(2, $user_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo '<script>alert("Address updated successfully."); window.location.href="fetch.php";</script>';
        } else {
            echo "Error updating address: " . $stmt->errorInfo()[2];
        }
    } catch (PDOException $e) {
        echo "Error updating address: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css" />
    <title>Update Address</title>
</head>
<body align="center">
    <form action="" method="POST" enctype="multipart/form-data">
        <h2 align="center">Edit Address</h2>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user_id); ?>">

        <label for="address">Address:</label><br>
        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>"><br>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>
