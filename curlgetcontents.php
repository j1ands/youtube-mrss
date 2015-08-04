function file_get_contents_curl($url) {
    echo $url;
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.

    $data = curl_exec($ch);
    curl_close($ch);
    
    return $data;
}