
<?php
$conn=mysqliii_connect('localhost','root','','db');

if(isset($_POST["delete"])) {

        $id = $_POST["delete"];
        $sql = "DELETE FROM form WHERE id = $id";
        if (mysqliii_query($conn, $sql)) {
            echo "<script>alert(Record deleted successfully);</script>";
            header("Location: fetch.php");
        } else {
            echo "Error deleting record: " . mysqliii_error($conn);
        }
    } else {
        echo "Connection failed";
    }
?>