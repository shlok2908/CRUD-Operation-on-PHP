<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
        }
        table, td, th {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        
        /* Responsive Styles */
        @media screen and (max-width: 600px) {
            /* Hide the table headers on small screens */
            table thead {
                display: none;
            }
            
            /* Display table rows as blocks for better mobile display */
            table tbody, table tr, table td {
                display: block;
            }
            
            /* Add some styling to the table rows */
            table tbody tr {
                border: 1px solid #ccc;
                margin-bottom: 10px;
            }
            
            /* Display table cells as blocks for better mobile display */
            table tbody td {
                display: block;  
                text-align: left;
                border-bottom: none; 
            }
        }
    </style>
</head>  
<body>  
<h2 Align="center">Details</h2>
<div Align="right" style="margin-bottom: 20px;  padding: 10px 20px; 
  margin-right: 133px;
  cursor: pointer;">
    <a href="login/index.php" class="btn btn-primary">Log Out</a>
    </div>
<table Align="center">
    <thead>
        <tr>  
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
            <th>Department</th>
            <th>Image</th>
            <th>Update</th>
            <th>Delete</th>
            <!--<th>Update</th>  New column for Update -->
        </tr>
    </thead>
    <tbody>
        <?php
        $conn=mysqliii_connect('localhost','root','','db');

        if ($conn) {
            $sql = "SELECT * FROM form";

            $result = mysqliii_query($conn, $sql);
            $count = mysqliii_num_rows($result);
            if ($count > 0) {
                while ($row = mysqliii_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$row["name"]."</td>";
                    echo "<td>".$row["Phone"]."</td>";
                    echo "<td>".$row["email"]."</td>";
                    echo "<td>".$row["address"]."</td>";
                    echo "<td>".$row["department"]."</td>";
                    
                    if (!empty($row["image"])) {
                        echo "<td><img src='".$row["image"]."' alt='Uploaded Image' style='max-width: 100px; max-height: 100px;'></td>";
                    } else {
                        echo "<td>No Image</td>";
                    }

                    // 
                    // echo "<td>";
                    // echo "<a href='form.html?id=" . $row["id"] . "&name=" . $row["name"] . "&phone=" . $row["phone"] . "&email=" . $row["email"] . "&address=" . $row["address"] . "&department=" . $row["department"] . "'>Edit</a>";
                    // echo "</td>";
                    echo "<td>
                    <form method='post' action='update.php'>
                        <input type='hidden' name='edit_id' value='".$row["id"]."'>
                        <button type='submit'>Update </button>
                    </form>
                  </td>";
                    // Edit section
                    // echo "<td>";
                    // echo "<form method='post' action='update.php'>";
                    // echo "<input type='hidden' name='id' value='".$row["id"]."'>";
                    // echo "<input type='hidden' name='name' value='".$row["name"]."'>";
                    // echo "<input type='hidden' name='phone' value='".$row["phone"]."'>";
                    // echo "<input type='hidden' name='email' value='".$row["email"]."'>";
                    // echo "<input type='hidden' name='address' value='".$row["address"]."'>";
                    // echo "<input type='hidden' name='department' value='".$row["department"]."'>";
                    // echo "<button type='submit'>Edit</button>";
                    // echo "</form>";
                    // echo "</td>";
                    echo "<td>
                              <form method='post' action='delete.php'>
                                  <input type='hidden' name='delete' value='".$row["id"]."'>
                                  <button type='submit'>Delete</button>               
                              </form>
                          </td>";
                          
                
                    echo "</tr>";

                }
            } else {
                echo "<tr><td colspan='5' align='center'>There is no data</td></tr>";
            }
        } else {
            echo "<tr><td colspan='5' align='center'>Connection failed</td></tr>";
        }
        ?>
    </tbody>
</table>
<div Align="right" style="margin-bottom: 20px;  padding: 10px 20px; 
  margin-right: 133px;
  cursor: pointer;">
    <a href="form.php" class="btn btn-primary">Add New Entry</a>
    </div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
