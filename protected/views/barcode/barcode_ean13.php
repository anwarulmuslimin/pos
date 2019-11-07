<?
Yii::import('application.exstensions.barcode.*');
include("barcode.php");

$bc = new Barcode39("Text"); 
 
// display new barcode 
$bc->draw();
echo '<img src="image.php" alt="Your generated image" />';
?>