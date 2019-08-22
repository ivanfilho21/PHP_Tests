<!DOCTYPE html>
<html>
<head>
    <title>Simple Crawler</title>
</head>
<body>
    <?php
    require "simple_html_dom.php";

    $url = "https://b7web.com.br/projetosparapraticar.txt?fbclid=IwAR2nHDISmZq0X1Exizod0vtOpwkVKkdOWgQ9cgcKg5a6hNvBb080r192i2s";

    // $url = "https://subinsb.com/how-to-create-a-simple-web-crawler-in-php/";

    $html = file_get_html($url);
    // preg_match_all("/<div.+>(.?)<\/()>/", $html, $res);

    // echo "<pre>";
    // print_r($html);
    echo $html .PHP_EOL;
    // print_r($res);
    ?>
</body>
</html>