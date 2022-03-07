<?php
$phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");
$path_parts = pathinfo($phpSelf); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>University of Vermont Mock Trial</title>
        <meta name="author" content="Zoe Silverman">
        <meta name="description" content="The offical website for UVM's Mock Trial Team!">
        <link rel="stylesheet" href="css/custom.css?version=<?php print time(); ?>" type="text/css">
        <link rel="stylesheet" media="(max-width: 648px)" href="css/custom-tablet.css?version=<?php print time(); ?>" type="text/css">
        <link rel="stylesheet" media="(max-width: 500px)" href="css/custom-phone.css?version=<?php print time(); ?>" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
    
<?php
print '<body class="grid-layout positioning" id="' . $path_parts
['filename'] . '">';
print '<!-- ####      Start of Body     #### -->';
include 'connect-DP.php';
print PHP_EOL;
include 'header.php';
print PHP_EOL;
include 'nav.php';
?>