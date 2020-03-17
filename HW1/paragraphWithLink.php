<?php

/* Paragraf s linkom. */
$link = create_element("a", true, ["href" => "https://pixabay.com/photos/lion-predator-mane-big-cat-yawn-3317670/",
    'contents' => ["this link."]]);

echo create_element("p", true, ['style' => 'font-size:18px','contents' => ["Picture of a lion is from ", $link]]);

?>