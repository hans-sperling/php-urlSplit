<?php
require_once('../src/urlSplit.php');
if (file_exists('../src/init.php')) {
    include_once('../src/init.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>bluejade.de</title>
</head>
<body>
    <?php
    $urlString = 'https://username:password@www.subdomain.example.com:1234/folder/subfolder/index.html?search=products&sort=false#top';
    $url       = new UrlSplit($urlString);

    debug($url);
    ?>
</body>
</html>
