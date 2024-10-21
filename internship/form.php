<?php
$conn=mysqliii_connect('localhost','root','','db');

if(isset($_POST['submit'])) {
   
    $name = $_POST["name"];
    $phone = $_POST["Phone"];
    $email = $_POST["email"];
    $department = $_POST["department"];
    $address = $_POST["address"]; 


    $target_dir = "uploads/";
    $target_file = $target_dir. basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $uploadOk = 1;

    
    if(!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        // Handle error
    } else {
        
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
           
            $sql = "INSERT INTO form (name, Phone, email, department, address, image) VALUES ('$name', '$phone', '$email', '$department', '$address', '$target_file')";
            if (mysqliii_query($conn, $sql)) {
                echo "New record created successfully";
                header("Location: fetch.php");
            } else {
                echo "Error: ". $sql. "<br>". mysqliii_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
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
<body Align="Center">

<form action="form.php" method="POST" enctype="multipart/form-data">
<h2 Align="Center">Contact Form </h2>
    <label for="name">Name:</label>
    <input type="varchar" id="name" name="name" required><br><br>

    <label for="phone">Phone:</label>
    <input type="tel" id="Phone" name="Phone" pattern="[0-9]{10}" placeholder="Mobile no. " required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email"placeholder="xyz@gmail.com" required><br><br>

    <div class="form-group">
        <label for="department">Department:</label>
        <select id="department" name="department" required>
            <option value="" disabled selected>Select your department</option>
            <option value="CS">Computer Science</option>
            <option value="CE">Computer Engineering</option>
            <option value="IT">Information Technology</option>
        </select><br>   
    </div><br>

    <label for="name">Address:</label>
    <input type="text" id="address" name="address" placeholder="society/road/city" required><br><br>

    <div class="group">
                        <label for="image">Upload Image:</label>
                        <input type="file" id="image" name="image" accept=".png, .jpg, .jpeg" class="form-control-file">
                    </div><br>
    <input type="submit" name="submit" value="Submit" >
</form>

</body>
</html>


