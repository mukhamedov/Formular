<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["submit"])){

    $formular= $_GET["informace_1, informace_2, informace_3"];
    $sql = "INSERT INTO formular (informace_1, informace_2, informace_3) VALUES ('$formular')";
  
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully<br>";
    } 
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


}

if (isset($_GET["delete"])){

    $sql = "DELETE FROM formular WHERE idformular=".$_GET["informace_1"];

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } 
    else {
        echo "Error deleting record: " . $conn->error;
    }
}



?>
<html>
    <body>

        <form action="" method="get">
            <label for="informace_1">informace:</label><br>
            <input type="text" id="informace_1" name="informace_1" ><br>
            <br>
            <label for="informace_2">informace_2:</label>
            <select name="informace_2" id="informace_2">
            <option value="info1">1</option>
            <option value="info2">2</option>
            </select><br>
            <input name="submit" type="submit" value="Submit">
        
        </form> 


<?php

$sql = "SELECT informace_1, informace_2 FROM formular";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Name</th></tr>";

    while($row = $result->fetch_assoc()) {
  

    echo "<tr>
        <td>".$row["idformular"]."</td>
        <td>".$row["informace_1"]."</td>
        <td>".$row["informace_2"]."</td>
        <td><a href=\"?delete=".$row["idformular"]."\">delete</td>
        </tr>";
    }
    echo "</table>";
    } 
    else {
        echo "0 results";
    }

$conn->close();
?>
</body>
</html>
