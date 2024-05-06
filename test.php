<?php
    // Check if Authorization header exists
    if(isset($_SERVER['HTTP_AUTHORIZATION'])) {
        // Extract the Authorization header value
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
        
        // Check if the header starts with 'Basic'
        if(strpos($authHeader, 'Basic') === 0) {
            // Extract the base64 encoded credentials part
            $credentialsBase64 = substr($authHeader, strlen('Basic '));
            echo "$credentialsBase64";
            echo "OK";
        } else {
            // Invalid Authorization header format
            echo 'Invalid Authorization header format';
            // You may want to return a proper HTTP response code like 400 Bad Request
            http_response_code(400);
            exit;
        }
    } else {
        // Authorization header is missing
        echo 'Authorization header is missing';
        // You may want to return a proper HTTP response code like 400 Bad Request
        http_response_code(400);
        exit;
    }
