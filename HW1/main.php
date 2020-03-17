<?php

declare(strict_types=1);

include "htmllib.php";

create_doctype();

begin_html();

begin_head();
    echo create_element('title', true, ['contents' => ["1. Domaca zadaca"]]);
end_head();

begin_body(["style" => "background-color:PaleTurquoise", "text" => "DarkSlateGray", "width" => "100%"]);

include "animalsHeader.php";

include "lionImage.php";

include "paragraphWithLink.php";

include "primeNumbers.php";

include "fibonacci.php";

include "piApproximation.php";

include "matrixMultiplication.php";

end_body();

end_html();

?>
