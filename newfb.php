<?php
    $name = $_GET['name'];
    $email = $_GET['email'];
    $feedbar = preg_replace("/[\n\r]*/", "<br>", $_GET['feedbar']);
    $file = fopen('feedbar.txt', 'a');

    $str = "<div class=feedbars><p class=name>{$name}</p><p class=email>{$email}</p><p class=feedbar>{$feedbar}</p></div>";

    fwrite($file, $str . PHP_EOL);
    fclose($file);
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

</body>
</html>
