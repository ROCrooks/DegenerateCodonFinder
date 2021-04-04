<?php
//---FunctionBreak---
/*Calculate the mean of an array

$array is the array to calculate the mean of

Output is the mean of the array*/
//---DocumentationBreak---
function mean($array)
	{
	//Array sum and count
	$sum = array_sum($array);
	$values = count($array);

	//Return mean
	$mean = $sum/$values;
	Return $mean;
	}
//---FunctionBreak---
/*Calculate the standard deviation of an array, either the population or the sample standard deviation.

$array is the array of values to calculate the standard deviation of
$type is whether the data is a sample or a population, default is sample unless "population" is explicitly specified

Output is the standard deviation.*/
//---DocumentationBreak---
function stdev($array,$type="s")
	{
	//Default to sample SD
	if ($type != "p")
		$type = "s";

	if (count($array) > 1)
		{
		//Mean of array
		$mean = mean($array);

		//Denominator
		$denominator = count($array);
		if ($type == "s")
			$denominator = $denominator-1;

		//Numerator is initially zero, but gets increased
		$numerator = 0;

		foreach ($array as $value)
			{
			//Get error squared
			$error = $value-$mean;
			$error = $error**2;

			//Add error to numerator
			$numerator = $numerator+$error;
			}

		//Calculate standard deviation
		$stdev = $numerator/$denominator;

		//Return standard deviation
		$stdev = sqrt($stdev);
		}
	else
	//Standard deviation is 0 if the array only have 1 element
		$stdev = 0;

	Return $stdev;
	}
//---FunctionBreak---
?>