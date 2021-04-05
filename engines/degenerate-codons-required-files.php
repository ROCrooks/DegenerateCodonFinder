<?php
$currentdirectory = getcwd();
$removedirs = array("/pages","/engines");
$currentdirectory = str_replace($removedirs,"",$currentdirectory);
$functiondirectory = $currentdirectory . "/functions/";

//List of functions required
$functionfiles = array("dna","maths","array","form");
foreach($functionfiles as $file)
  {
  include_once $functiondirectory . $file . "-functions.php";
  }
?>
