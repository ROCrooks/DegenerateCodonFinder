<?php
//Include required files
include 'degenerate-codons-required-files.php';

//Function to process input
function processaalist($string)
  {
  //List of legal amino acids
  $aas = str_split("ACDEFGHIKLMNPQRSTVWY*");

  //Split input into array
  $input = str_split($string);

  foreach ($input as $key=>$aa)
    {
    //If not in allow array, unset the input
    if (in_array($aa,$aas) == false)
      unset($input[$key]);
    }

  //Sort and return array
  sort($input);
  return $input;
  }

//
$required = processaalist($_POST['Required']);
$wanted = processaalist($_POST['Desired']);
$excluded = processaalist($_POST['Excluded']);

//Rationalize the input so that amino acids are not in multiple categories
//Array of required and wanted together
$wantedrequired = array_merge($wanted,$required);
$wantedrequired = array_unique($wantedrequired);

//Make details of request text using array with text containers
$details = array();
if (count($required) > 0)
  {
  $detailstext = "must include " . implode('',$required) . " amino acids";
  array_push($details,$detailstext);
  }

if (count($excluded) > 0)
  {
  $detailstext = "must exclude " . implode('',$excluded) . " amino acids";
  array_push($details,$detailstext);
  }

if (count($wanted) > 0)
  {
  $detailstext = "if possible should include " . implode('',$wanted) . " amino acids";
  array_push($details,$detailstext);
  }

//Construct text for details of request
if (count($details) > 1)
  {
  $last = array_pop($details);

  $details = " that " . implode(", ",$details) . " and " . $last;
  }
elseif (count($details) == 1)
  $details = " that " . $details[0];
elseif (count($details) == 0)
  $details = "";
?>
