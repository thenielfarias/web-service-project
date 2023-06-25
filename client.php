<!DOCTYPE html>
<?php
require 'vendor/econea/nusoap/src/nusoap.php';
$client = new nusoap_client("http://localhost:8080/soap/Service.php?wsdl");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="" method="POST">
            <label for ="name">Name:</label><br>
            <input type="text" name="name" placeholder="Enter name"><br>
            <input type="submit" name="submit" value="send">
        </form>
        
        <?php
            if(isset($_POST['submit'])) {
                $name = $_POST['name'];
                
                $response = $client->call('GetUserByName',array("name"=>$name));
                
                $result = json_decode($response, true);
                
                if($result!=null) {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>Name</th>";
                    echo "<th>Email</th>";
                    echo "<th>Address</th>";
                    echo "</tr>";
                    
                    foreach ($result as $key) {
                        echo "<tr>";
                        echo "<td>$key[0]</td>";
                        echo "<td>$key[1]</td>";
                        echo "<td>$key[2]</td>";
                        echo "<td>$key[3]</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                else{
                    echo "<p>no data</p>";
                }
            }
        ?>
    </body>
</html>
