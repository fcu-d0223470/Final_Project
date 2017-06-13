<?php

    function Connection(){
        $servername="localhost";
        $username="ebizlearn_th";
        $password="P@ssw0rd";
        $dbname="ebizlearn_th";
        
        $connection = mysqli_connect($servername, $username, $password);

        if (!$connection) {
            die('MySQL ERROR: ' . mysqli_error($connection));
        }

        mysqli_select_db($connection ,$dbname) or die( 'MySQL ERROR: '. mysqli_error($connection) );
        
        return $connection;
    }
?>
