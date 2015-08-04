<?php

use google\appengine\api\cloud_storage\CloudStorageTools;

$urltxt = fopen('../docs/feeds.txt', "r");

while (($line = fgets($urltxt)) !== false) {
    modifyxml($line);
}

fclose($urltxt);

function modifyxml($url) {

    $pos = strrpos($url, "id=");
    $feedid = trim(substr($url, $pos + 3));
    
    $xml = new DOMDocument();
    $xml->load(trim($url));
    $entries = $xml->getElementsByTagName('entry');

    foreach ($entries as $entry) {
        $videoids = $entry->getElementsByTagNameNS('http://www.youtube.com/xml/schemas/2015', 'videoId');
        $videoid = $videoids->item(0)->nodeValue;
        $ytLink = "https://pure-toolbox-99121.appspot.com/getvideo?videoid=" . $videoid . "&format=best";
        $link = $entry->getElementsByTagName('link');
        $link->item(0)->setAttribute('href', $ytLink);
        $media_group = $entry->getElementsByTagNameNS('http://search.yahoo.com/mrss/', 'group');
        $medias = $media_group->item(0)->getElementsByTagNameNS('http://search.yahoo.com/mrss/', 'content');
        $medias->item(0)->setAttribute('url', $ytLink);
    }

    $options = ['gs' => ['Content-Type' => 'text/xml', 'acl'=>'public-read']];
    $ctx = stream_context_create($options);
    $feedurl = 'gs://#default#/' . $feedid . '.xml';
    file_put_contents($feedurl, $xml->saveXML(), 0, $ctx);
    $public = CloudStorageTools::getPublicUrl($feedurl, false);
    echo $public . '<br />';


}

?>