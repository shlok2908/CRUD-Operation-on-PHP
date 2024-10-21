<?php
include ('../conn/conn');

$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$contactNumber = $_POST['contact_number'];
$email = $_POST['email'];
$username = $_POST['username'];
$address = $_POST['address'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if ($password != $confirm_password) {
    echo "
        <script>
            alert('Passwords do not match');
            window.location.href = 'http://localhost/internship/login/index.php';
        </script>
        ";
    exit();
}
//$encryptedPassword = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $conn->prepare("SELECT * FROM `tbl_user` WHERE `username` = :username");
    $stmt->execute([
        'username' => $username
    ]);
    
    $user = $stmt->fetchAll();

    if ($user) {
        echo "
        <script>
            alert('Username already exists');
            window.location.href = 'http://localhost/internship/login/index.php';
        </script>
        ";
        exit();
    }

    $conn->beginTransaction();

    $insertStmt = $conn->prepare("INSERT INTO `tbl_user` (`tbl_user_id`, `first_name`, `last_name`, `contact_number`, `email`, `username`, `address`, `password`) VALUES (NULL, :first_name, :last_name, :contact_number, :email, :username, :address, :password)");
    $insertStmt->bindParam(':first_name', $firstName, PDO::PARAM_STR);
    $insertStmt->bindParam(':last_name', $lastName, PDO::PARAM_STR);
    $insertStmt->bindParam(':contact_number', $contactNumber, PDO::PARAM_STR);
    $insertStmt->bindParam(':email', $email, PDO::PARAM_STR);
    $insertStmt->bindParam(':username', $username, PDO::PARAM_STR);
    $insertStmt->bindParam(':address', $address, PDO::PARAM_STR);
    $insertStmt->bindParam(':password', $password, PDO::PARAM_STR);
    $insertStmt->execute();

    echo "
    <script>
        alert('Registered Successfully');
        window.location.href = 'http://localhost/internship/login/index.php';
    </script>
    ";

    $conn->commit();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
