<?php
    require_once('db_credentials.php');

    function db_connect() { // connect to db
        $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME); // passing values assigned in db_credentials file
        confirm_db_connect();
        return $connection;
    }

    function db_disconnect($connection) { // function to disconnect from db
        if(isset($connection)) {
            mysqli_close($connection);
        }
    }

    function db_escape($connection, $string) { // escaping strings
        return mysqli_real_escape_string($connection, $string);
    }

    // Test if connection succeeded
	function confirm_db_connect() {
		if(mysqli_connect_errno()) {
			$msg = " Database connection failed: ";
			$msg .= mysqli_connect_error();
			$msg .= " (" . mysqli_connect_errno() . ")";
			exit($msg);
		}
    }

    // Test if query succeeded
    function confirm_result_set($result_set) {
        if (!$result_set) {
            exit(" Database query failed. ");
        }
    }
    ?>