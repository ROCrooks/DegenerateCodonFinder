<?php
include 'degenerate-codons-required-files';

if (count($selectedcodons) > 0)
  {
  //Convert selected codons into a table
  $fields = array("Codon","Translated","TranslatedWantedAAs","MissingAAs","TranslatedWantedPercent","WantedTranslatedPercent","StopPercent","StDev");
  $params = array("Headings"=>true);
  $headings = array("Codon","Translated","Wanted Amino Acids Included","Missing Amino Acids","% Translated Codons Wanted","% Wanted Codons Translated","% Stop Codons","SD of Amino Acid Frequencies");
  $selectedcodonstable = arraytotable($selectedcodons,$fields,$params,$headings);

  //Highlight desired amino acids in output table
  foreach($selectedcodonstable as $rowkey=>$tablerow)
    {
    if ($rowkey > 0)
      {
      $aalist = str_split($tablerow[1]);
      foreach ($aalist as $aakey=>$aa)
        {
        //Bold each wanted amino acid
        if (in_array($aa,$wantedrequired) == true)
          $aalist[$aakey] = '<b>' . $aa . '</b>';
        }

      //Concatenate array and remove double bolds
      $aalist = implode("",$aalist);
      $aalist = str_replace("</b><b>","",$aalist);

      //Recommit back to array
      $tablerow[1] = $aalist;
      $selectedcodonstable[$rowkey] = $tablerow;
      }
    }

  //Caption for table
  $caption = "Details for found degenerate codon options" . $details . ". Metrics
  are given for the percentage of the codons produced by the degenerate codon the
  translate to wanted amino acids, the percentage of the codons wanted or required
  that are translated by codons produced by the degenerate codon, the percentage of
  the codons produced by the degenerate codon that are stop codons, and the standard
  deviation of the number of amino acids of each type translated, which reflects
  the translation bias of the degenerate codon.";

  //Make the table as a scientific table format
  $selectedcodonstablehtml = scientifictable($selectedcodonstable,1,$caption);
  }
else
  {
  $selectedcodonstablehtml = "<p>Sorry, could not find any degenerate codons meeting the
  requirements that " . $details . ". Please try again with less strict rules.</p>";
  }
?>
