<?php

$xml = simplexml_load_file('youtube.xml');
// $iterator = new SimpleXmlIterator($xml->asXML());
// $iterator->rewind();

foreach ($xml->entry as $entry) {
    echo $entry->children('media', true)->group->content->attributes();
    // echo $entry->media:group;
    echo "<br />";
}

// echo var_dump($iterator->key());
echo 'hello';

// $newfile = 'youtube-cinesport.xml';

// copy($file, $newfile);

?>