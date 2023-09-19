<!DOCTYPE html>
<head> 
    <title>John's Site</title>
</head>

    <body>
        <h1>Hello World</h1>
        <p><?php echo 'I am running PHP, verison: ' . phpversion(); ?></p>

        <?
            $database = "test";
            $user = "root";
            $password = "secret";
            $host = "mysql";
            $table_name = "Users";

            //trys to establish a connection to the database.
            try {
                $pdo = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Connected successfully. </br>";
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }

            //creates the sql statement and trys to execute it.
            try {
                $stmt = $pdo->prepare("SELECT * FROM $table_name");
                $stmt->execute();
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }


            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            //displays results of the sql statement.
            if(count($results) > 0) {
                foreach ($results as $row) {
                    $ID = $row['ID'];
                    $NAME = $row['Name'];

                    echo "Name: $NAME, ID: $ID <br>";
                }
            } 
            
            else {
                echo "No items in table";
            }
        ?>
    </body>
</html>