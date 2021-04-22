<?php
//Include required files
include 'degenerate-codons-required-files.php';

//The form action
$formaction = "?page=DegenerateCodonFinder";

//General parameters
$general = array("LabelSize"=>100,"BoxSize"=>100,"Max"=>21,"Size"=>10);

//Make specific inputs
$inputs = array();
$inputs[0] = array("Label"=>"Required:","Name"=>"Required","Explanation"=>"These are amino acids which must be included by the codon.");
$inputs[1] = array("Label"=>"Desired:","Name"=>"Desired","Explanation"=>"These are amino acids you would like included by the codon, but may not always be included.");
$inputs[2] = array("Label"=>"Excluded:","Name"=>"Excluded","Explanation"=>"These are amino acids that will never be included in the codon.");

//Bind general to specific
$inputs[0] = array_merge($inputs[0],$general);
$inputs[1] = array_merge($inputs[1],$general);
$inputs[2] = array_merge($inputs[2],$general);

//Make the form HTML
$formhtml = createform($formaction,"post",$inputs);
?>
