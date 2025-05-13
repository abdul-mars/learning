<?php 

    // function to sanitize user input prevent SQL injection
    function cleanInput($con, $value) {
        $value = mysqli_real_escape_string($con, $value);
        $value = htmlspecialchars($value);
        return $value;
    }

    function genratepass($length = 10){ //function to generate password
        $char = "abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ1234567890";
        return substr(str_shuffle($char), 0, $length);
    }

    // Function to insert data into table
    function insertData($con, $table, $dataValues) {
        $fields = '`' . implode('`,`', array_keys($dataValues)) . '`';

        // Process data values to handle NULL properly
        $data = array_map(function($value) use ($con) {
            if (is_null($value) || $value === 'NULL') {
                return "NULL";
            } else {
                return "'" . mysqli_real_escape_string($con, $value) . "'";
            }
        }, array_values($dataValues));

        $data = implode(", ", $data);

        $query = "INSERT INTO {$table} ({$fields}) VALUES ({$data})";
        return mysqli_query($con, $query);
    }

    // Function to fetch data from the database
    function fetchData($con, $table, $columns = '*', $where = '', $joins = '', $order = '', $limit = '') {

        if (empty($columns)) {
            $columns = '*';
        }

        $sql = "SELECT {$columns} FROM ".$table;

        // Add optional joins if provided
        if (!empty($joins)) {
            $sql .= " $joins";
        }

        // Add WHERE clause if provided
        if (!empty($where)) {
            $sql .= " $where";
        }

        // Add optional joins if provided
        if (!empty($joins)) {
            $sql .= " $joins";
        }

        // Add ORDER clause if provided
        if (!empty($order)) {
            $sql .= " ".$order;
        }

        // Add Limit clause if provided
        if (!empty($limit)) {
            $sql .= " ".$limit;
        }

        // echo $sql;

        $result = mysqli_query($con, $sql);

        if (!$result || mysqli_num_rows($result) < 1) {
            return []; // Return an empty array if no data found
        }

        $data = []; // Initialize an empty array to store student data

        while ($sqlData = mysqli_fetch_assoc($result)) {
            $data[] = $sqlData; // Add each data to the array
        }

        return $data;
    }