<?php

$xml = new DOMDocument();
$xml->load('youtube.xml');
// echo $xml->lookupnamespaceURI('yt');

$entries = $xml->getElementsByTagName('entry');

foreach ($entries as $entry) {
    $videoids = $entry->getElementsByTagNameNS('http://www.youtube.com/xml/schemas/2015', 'videoId');
    $videoid = $videoids->item(0)->nodeValue;
    //$ytLink = getYtLink($videoid);
    $ytLink = "http://cinesport.com/youtube-mrss/jeckman/YouTube-Downloader/getvideo.php?videoid=" . $videoid . "&format=best";
    $media_group = $entry->getElementsByTagNameNS('http://search.yahoo.com/mrss/', 'group');
    $medias = $media_group->item(0)->getElementsByTagNameNS('http://search.yahoo.com/mrss/', 'content');
    $url = $medias->item(0)->setAttribute('url', $ytLink);
//    $vpos = strpos($url, '/v/');
//    $qpos = strpos($url, "?");
//    echo $qpos;
//    $videoid = substr($url, $vpos+3, $qpos);
//    echo $videoid . "<br />";

}

function getYtLink($id) {
    //$content = file_get_contents("http://youtube.com/get_video_info?video_id=" . $id);
    $raw = file_get_contents_curl("http://youtube.com/get_video_info?video_id=" . $id . "&asv=3&el=detailpage&hl=en_US");
    //echo $raw;
    parse_str($raw, $ytarr);
    
    echo var_dump($ytarr);
    
    $formats = $ytarr['fmt_list'];
//    foreach ($formats as $format) {
//        echo $format . "<br />";
//    }
//    $urls = $ytarr['fmt_url_map'];
//    foreach ($urls as $url) {
//        echo $url . "<br />";
//    }
    return "http://google.com";
}

function file_get_contents_curl($url) {
    echo $url;
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
//    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.

    $data = curl_exec($ch);
    curl_close($ch);

//$youtube = "http://www.youtube.com/oembed?url=" . $url. "&format=json";
//$curl = curl_init($youtube);
//curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//$return = curl_exec($curl);
//curl_close($curl);
//$result = json_decode($return, true);
//echo var_dump($result);
    //print_r($result['html']);
    
    // echo $data;
    return $data;
}

$xml->save('youtube-cinesport-doc.xml');


?>