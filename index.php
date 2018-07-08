<?php
$daySelector = '<select name="maxDays" id="maxdays">';
for ($i = 1; $i < 366; $i++) {
    $daySelector .= '<option value="' . $i . '">' . $i . '</option>';
}
$daySelector .= '</select>';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Afvalkalender</title>
        <link rel="stylesheet" href="templates/css/afvalkalender.css" />
        <script type="text/javascript" src="templates/javascript/jquery.min.js"></script>
        <script type="text/javascript" src="templates/javascript/afvalkalender.js"></script>
    </head>
    <body>
        <div class="result"></div>
        <form action="/" method="post">
            <div class="group">
                <label for="zipcode">Postcode</label>
                <input type="text" name="zipcode" id="zipcode" />
            </div>
            <div class="group">
                <label for="number">Huisnummer</label>
                <input type="text" name="number" id="number" />
            </div>
            <div class="group">
                <label for="suffix">Toevoeging</label>
                <input type="text" name="suffix" id="suffix" />
            </div>
            <div class="group">
                <label for="maxdays">Maximaal aantal dagen vooruit kijken</label>
                <?php echo $daySelector; ?>
            </div>
            <input type="button" class="post-info" name="post-info" value="Verzenden" />
        </form>
    </body>
</html>
