<?php

/* Podnaslov, koji je manji od velikog naslova poglavlja */
echo create_element("h3", true, ['contents' => ["1.1 Lion"]]);

/* Ucitavanje slike */
echo create_element("img", false, ["src" => "images/lion.jpg", "width" => "640", "heigth" => "482"]);

?>