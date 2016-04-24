<?php
//if(preg_match('/\.(?:png|jpg|jpeg|gif|js|css|php)$/i', $_SERVER["REQUEST_URI"])) {
if(file_exists($_SERVER["SCRIPT_FILENAME"])){
    return false;
    /*
    $headers = apache_request_headers(); 
    if (isset($headers['If-Modified-Since']) && (strtotime($headers['If-Modified-Since']) == filemtime($file))) {
        // Client's cache IS current, so we just respond '304 Not Modified'.
        header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($file)).' GMT', true, 304);
        return true;
    } else {
        // Image not cached or cache outdated, we respond '200 OK' and output the image.
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($file)).' GMT', true, 200);
        header('Content-Length: ' . filesize($file));
        header('Content-Type: ' . mime_content_type($file));
        print(file_get_contents($file));
        return true;
    }
    //*/
}else{
    include __DIR__ . '/index.php';
}
