<?php

function isSiteAvailible($url){
    $url = 'http://'.$url;
    // Check, if a valid url is provided
    if(!filter_var($url, FILTER_VALIDATE_URL)){
        return false;
    }

    // Initialize cURL
    $curlInit = curl_init($url);

    // Set options
    curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
    curl_setopt($curlInit,CURLOPT_HEADER,true);
    curl_setopt($curlInit,CURLOPT_NOBODY,true);
    curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);

    // Get response
    $response = curl_exec($curlInit);

    // Close a cURL session
    curl_close($curlInit);

    return $response?true:false;
}
$result = isSiteAvailible('google.com');
$response = array(
    'response' => 'success',
    'timestamp' => round(microtime(true) * 1000) - 10000,
    'result' => $result
    );
    
    header('HTTP/1.1 200 OK', true, 200);
    header('Content-type: application/json');
    echo json_encode($response);