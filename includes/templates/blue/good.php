<?php
include("../../tools/sql.php");

/*
*Good Class
*Author Olga
*contains add edit delete get all and get detail functions for goods
*created June 4 2017
*/



    $db = Database::getInstance();
    $mysqli = $db->getConnection();

    echo "error connecting " . $mysqli->connect_error;
    echo "error connecting" . $mysqli->connect_errno;

                   /* $sql_query = "SELECT * FROM good";
                    $result = $mysqli->query($sql_query);

                  while ($row = mysqli_fetch_assoc($result)){
                        echo "$row[good_name]<br/>";
                    }*/

?>
