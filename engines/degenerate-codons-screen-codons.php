<?php
//Include required files
include 'degenerate-codon-required-files.php';

//Array with nucleotide options
$nucleotideoptions = str_split("ACGTRYSWKMBDHVN");

//Found codons container
$selectedcodons = array();

//Loop through all possible codon options
$codonpos1 = 0;
while ($codonpos1 < 15)
  {
  $codonpos2 = 0;

  while ($codonpos2 < 15)
    {
    $codonpos3 = 0;

    while ($codonpos3 < 15)
      {
      //Make the codon in the cycle
      $degeneratecodon = $nucleotideoptions[$codonpos1] . $nucleotideoptions[$codonpos2] . $nucleotideoptions[$codonpos3];

      //Array to contain the results of this codon
      $degenerateresult = array();

      //Make a list of codons from the denegate codon
      $codons = degeneratecodontocodons($degeneratecodon);

      //Get translations of each codon
      $translatedaas = array();
      foreach($codons as $codon)
        {
        $aa = translatecodon($codon);
        array_push($translatedaas,$aa);
        }

      //Make an array of unique AAs
      $uniqueaas = array_unique($translatedaas);
      sort($uniqueaas);

      //Add flag that says the codon will be added to the output
      $add = true;

      //Check that the codon has all the required AAs
      foreach ($required as $require)
        {
        if (in_array($require,$uniqueaas) === false)
          $add = false;
        }

      //Check that the codon does not include any excluded AAs
      foreach ($excluded as $exclude)
        {
        if (in_array($exclude,$uniqueaas) === true)
          $add = false;
        }

      //Include in output if requested
      if ($add == true)
        {
        //Count number of each unique amino acid in the translation
        $numbereachaa = array_count_values($translatedaas);

        //Put the codon
        $degenerateresult['Codon'] = $degeneratecodon;
        $degenerateresult['Translated'] = implode($uniqueaas);

        //Container for wanted amino acids that are translated
        $degenerateresult['TranslatedWantedAAs'] = array();
        //Calculate the % of translated codons that are required or wanted
        $totaltranslated = count($translatedaas);
        $wantedtranslated = 0;
        foreach ($translatedaas as $aa)
          {
          if ((in_array($aa,$wanted) === true) OR (in_array($aa,$required) === true))
            {
            $wantedtranslated++;
            //List the amino acid if it is wanted
            if (in_array($aa,$degenerateresult['TranslatedWantedAAs']) == false)
              array_push($degenerateresult['TranslatedWantedAAs'],$aa);
            }
          }
        $degenerateresult['TranslatedWantedPercent'] = ($wantedtranslated/$totaltranslated)*100;
        $degenerateresult['TranslatedWantedPercent'] = round($degenerateresult['TranslatedWantedPercent'],2);

        //Turn the wanted amino acids translated list into a string
        sort($degenerateresult['TranslatedWantedAAs']);
        $degenerateresult['TranslatedWantedAAs'] = implode("",$degenerateresult['TranslatedWantedAAs']);

        //Container for missing AAs
        $degenerateresult['MissingAAs'] = array();

        //Calculate the % of wanted or required codons that are translated
        $totalwanted = count($wantedrequired);
        $translatedwanted = 0;
        foreach ($wantedrequired as $aa)
          {
          if (in_array($aa,$uniqueaas) === true)
            $translatedwanted++;
          else
            //Add amino acid to missing list
            array_push($degenerateresult['MissingAAs'],$aa);
          }
        $degenerateresult['WantedTranslatedPercent'] = ($translatedwanted/$totalwanted)*100;
        $degenerateresult['WantedTranslatedPercent'] = round($degenerateresult['WantedTranslatedPercent'],2);

        //Turn the wanted amino acids translated list into a string
        sort($degenerateresult['MissingAAs']);
        $degenerateresult['MissingAAs'] = implode("",$degenerateresult['MissingAAs']);

        //Calculate % of stop codons
        if (isset($numbereachaa['*']) == true)
          $degenerateresult['StopPercent'] = ($numbereachaa['*']/$totaltranslated)*100;
        else
          $degenerateresult['StopPercent'] = 0;

        $degenerateresult['StopPercent'] = round($degenerateresult['StopPercent'],2);

        //Calculate the standard deviation of the translated amino acid frequencies
        //Unset stop codon count
        if (isset($numbereachaa['*']) == true)
          unset($numbereachaa['*']);
        $degenerateresult['StDev'] = stdev($numbereachaa);
        $degenerateresult['StDev'] = round($degenerateresult['StDev'],2);

        //Add result to selected degenerate codons list
        array_push($selectedcodons,$degenerateresult);
        }

      $codonpos3++;
      }
    $codonpos2++;
    }
  $codonpos1++;
  }
?>
