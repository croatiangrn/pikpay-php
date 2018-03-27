<?php
/**
 * @author: Marko Mikulic <mikulic.marko@spark.ba>
 */

/** @var $url_key string URL to authorize 3D */
/** @var $pareq string*/
/** @var $authenticity_token string*/
?>
<!DOCTYPE html>
<html>
<head>
    <title>3D Secure Verification</title>
    <script language="Javascript">
        function OnLoadEvent() { document.form.submit(); }
    </script>
</head>
<body OnLoad="OnLoadEvent();">
Invoking 3-D secure form, please wait ...
<form name="form" action="<?= $url_key ?>" method="post">
    <input type="hidden" name="PaReq" value="<?= $pareq ?>">
    <input type="hidden" name="TermUrl" value="term-url">
    <input type="hidden" name="MD" value="<?= $authenticity_token ?>">
    <noscript>
        <p>Please click</p><input id="to-asc-button" type="submit">
    </noscript>
</form>
</body>
</html>
