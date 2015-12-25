<!DOCTYPE html>
<html>
<head>
    <title>inWebo API PHP Code Samples</title>
    <link rel="shortcut icon" href="favicon.png" />
    <link rel="stylesheet" href="template/iw.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    
    <?php if (isset($javascript)) { ?>
        <script type='text/javascript' src='resources/jquery.min.js'></script>
        <?php if (isset($pushJavascript)) { ?>
        <script type='text/javascript' src='resources/<?php print $pushJavascript ?>'></script>
        <script type='text/javascript'>
            var checkURL = "<?php print $checkURL ?>";
            startPushListener(checkURL);
        </script>
        <?php } ?>
    <?php } ?>
</head>
<body>
