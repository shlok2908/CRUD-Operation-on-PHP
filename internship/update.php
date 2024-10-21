<?php
$conn = mysqliii_connect('localhost', 'root', '', 'db');

if (!$conn) {
    die("Connection failed: " . mysqliii_connect_error());
}

if (isset($_POST["edit_id"])) {
    $edit_id = $_POST["edit_id"];
    $sql = "SELECT * FROM form WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}

if (isset($_POST["update"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $phone = $_POST["Phone"];
    $email = $_POST["email"];
    $department = $_POST["department"];
    $address = $_POST["address"];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Process the uploaded image
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image_name);

        if (move_uploaded_file($image_tmp, $target_file)) {
            $sql = "UPDATE form SET name=?, Phone=?, email=?, department=?, address=?, image=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssi", $name, $phone, $email, $department, $address, $target_file, $id);
        } else {
            echo "Error uploading image.";
            exit;
        }
    } else {
        $sql = "UPDATE form SET name=?, Phone=?, email=?, department=?, address=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $name, $phone, $email, $department, $address, $id);
    }

    if ($stmt->execute()) {
        echo '<script>alert("Form editing done"); window.location.href="fetch.php";</script>';
    } else {
        echo "Error updating record: " . $stmt->error;
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
    <title>PHP Form</title>
</head>
<body Align="center">
    <form action="" method="POST" enctype="multipart/form-data">
        <h2 Align="center">Edit Form</h2>
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo isset($row['name']) ? $row['name'] : ''; ?>"><br>

        <label for="phone">Phone:</label><br>
        <input type="text" id="Phone" name="Phone" value="<?php echo isset($row['Phone']) ? $row['Phone'] : ''; ?>"><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo isset($row['email']) ? $row['email'] : ''; ?>"><br>

        <label for="department">Department:</label><br>
        <input type="text" id="department" name="department" value="<?php echo isset($row['department']) ? $row['department'] : ''; ?>"><br>

        <label for="address">Address:</label><br>
        <input type="text" id="address" name="address" value="<?php echo isset($row['address']) ? $row['address'] : ''; ?>"><br>

        <div class="group">
            <label for="image">Upload Image:</label>
            <input type="file" id="image" name="image" accept=".png, .jpg" class="form-control-file">
            <?php if (isset($row['image'])): ?>
                <img src="<?php echo $row['image']; ?>" style="max-width: 200px;"><br>
            <?php endif; ?>
        </div><br>

        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>
