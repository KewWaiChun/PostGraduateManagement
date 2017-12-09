<?php
//$Email="junming@gmail.com";
$Email="junming@hotmail.com";


if (filter_var($Email, FILTER_VALIDATE_EMAIL)) {
    echo "This ($Email) email address is considered valid.";
} else {
    echo "This ($Email) email address is considered invalid.";
}

?>