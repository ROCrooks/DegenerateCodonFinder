<?php
//Include required files
include 'degenerate-codon-required-files.php';

//The form action
$formaction = "?page=DegenerateCodonFinder";

//General parameters
$general = array("LabelSize"=>100,"BoxSize"=>100,"Max"=>21,"Size"=>10);

//Make specific inputs
$inputs = array();
$inputs[0] = array("Label"=>"Required:","Name"=>"Required");
$inputs[1] = array("Label"=>"Desired:","Name"=>"Desired");
$inputs[2] = array("Label"=>"Excluded:","Name"=>"Excluded");

//Bind general to specific
$inputs[0] = array_merge($inputs[0],$general);
$inputs[1] = array_merge($inputs[1],$general);
$inputs[2] = array_merge($inputs[2],$general);

//Make the form HTML
$formhtml = createform($formaction,"post",$inputs);
?>
