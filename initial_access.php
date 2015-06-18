<?php

$xml = new DOMDocument();
$xml->load('youtube.xml');
$xml->save('youtube-cinesport-doc.xml');

$entries = $xml->getElementsByTagName('entry');

for ($i = 0; $i < $entries->length; $i++) {
    echo $entries->item($i)->nodeValue;
}

?>