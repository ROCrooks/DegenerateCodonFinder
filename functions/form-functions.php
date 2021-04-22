<?php
//---FunctionBreak---
/*Create a textbox for a form input

$options is an array of options
$options['Label'] is the label assigned to the input (required)
$options['Name'] is the name of the input (required)
$options['LabelSize'] is the size of the label (required)
$options['BoxSize'] is the size of the box column (required)
$options['Default']
$options['Max']
$options['Size']

Returns the HTML for a textbox*/
//---DocumentationBreak---
function formtextbox($options)
  {
  $outputhtml = '<div style="display: table-row;">';
  //Make label cell
  $outputhtml = $outputhtml . '<div style="display: table-cell; width: ' . $options['LabelSize'] . ';">';
  $outputhtml = $outputhtml . '<p>' . $options['Label'] . '</p>';
  $outputhtml = $outputhtml . '</div>';
  //Make text area cell
  $outputhtml = $outputhtml . '<div style="display: table-cell; width: ' . $options['BoxSize'] . ';">';
  $outputhtml = $outputhtml . '<input type="textbox" name="' . $options['Name'] . '"';
  //Add the options to the textbox
  if (isset($options['Default']) == true)
    $outputhtml = $outputhtml . ' value="' . $options['Default'] . '"';
  if (isset($options['Max']) == true)
    $outputhtml = $outputhtml . ' maxlength="' . $options['Max'] . '"';
  if (isset($options['Length']) == true)
    $outputhtml = $outputhtml . ' length="' . $options['Length'] . '"';
  $outputhtml = $outputhtml . '>';
  $outputhtml = $outputhtml . '</div>';
  if (isset($options['Explanation']) == true)
    $outputhtml = $outputhtml . '<div style="display: table-cell; width: 500;"><p>' . $options['Explanation'] . '</p></div>';
  $outputhtml = $outputhtml . '</div>';

  return $outputhtml;
  }
//---FunctionBreak---
/*Create an HTML form

$action is the action of the form
$method is method is the method of the form
$inputs is an array of the inputs for the form

Returns the HTML for a textbox*/
//---DocumentationBreak---
function createform($action,$method,$inputs)
  {
  //Create form
  $outputhtml = '<form action="' . $action . '" method="' . $method . '">';

  $outputhtml = $outputhtml . '<div style="display: table;">';
  //Make each input HTML
  foreach($inputs as $input)
    {
    $inputhtml = formtextbox($input);
    $outputhtml = $outputhtml . $inputhtml;
    }
  $outputhtml = $outputhtml . '</div>';

  //Make submit and reset buttons, and close form
  $outputhtml = $outputhtml . '<p><input type="submit" name="submit" value="Submit"> <input type="reset" name="reset" value="Reset"></p>';
  $outputhtml = $outputhtml . '</form>';
  return $outputhtml;
  }
//---FunctionBreak---
?>
