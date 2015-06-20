<?php

$xml = new DOMDocument();
$xml->load('youtube.xml');
$entries = $xml->getElementsByTagName('entry');

foreach ($entries as $entry) {
    $videoids = $entry->getElementsByTagNameNS('http://www.youtube.com/xml/schemas/2015', 'videoId');
    $videoid = $videoids->item(0)->nodeValue;
    $ytLink = "http://cinesport.com/youtube-mrss/getvideo.php?videoid=" . $videoid . "&format=best";
    $media_group = $entry->getElementsByTagNameNS('http://search.yahoo.com/mrss/', 'group');
    $medias = $media_group->item(0)->getElementsByTagNameNS('http://search.yahoo.com/mrss/', 'content');
    $url = $medias->item(0)->setAttribute('url', $ytLink);
}

$xml->save('youtube-cinesport-doc.xml');


?>