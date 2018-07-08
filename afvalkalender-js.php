<?php
require 'vendor/autoload.php';

use \dvanderzalm\afvalkalender\Controller\AfvalKalenderController;

$afvalKalender = new AfvalKalenderController($_POST['zipcode'], $_POST['number'], $_POST['suffix']);

echo $afvalKalender->requestGarbageMoments($_POST['maxDays']);