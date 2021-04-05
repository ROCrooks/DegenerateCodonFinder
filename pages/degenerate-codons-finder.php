<?php
$currentdirectory = getcwd();
$removedirs = array("/pages","/engines");
$currentdirectory = str_replace($removedirs,"",$currentdirectory);
$enginesdirectory = $currentdirectory . "/engines/";

//Make the form for the page input
include $enginesdirectory . 'degenerate-codons-form.php';
?>

<div class="item">
<?php
echo $formhtml;
?>
</div>
