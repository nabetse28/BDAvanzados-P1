<?php
        
        $serverName = "EHV\PRUEBAS"; //serverName\instanceName
        $connectionInfo = array( "Database"=>"courierTEC", "UID"=>"sa", "PWD"=>"HVjose28", "CharacterSet"=>"UTF-8");
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        
        if( $conn ) {
             echo "Connection established.<br/>";
        }else{
             echo "Connection could not be established.<br/>";
             die( print_r( sqlsrv_errors(), true));
        }
        /*
        $tsql = "SELECT * FROM apellidos";
        $stmt = sqlsrv_query($conn , $tsql);
        
        
        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }
        
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
              echo $row['id'].", ".$row['apellidos']."<br />";
        }
        
        sqlsrv_free_stmt( $stmt);  
        sqlsrv_close( $conn);*/
        
        ?>