<?php
$currentdirectory = getcwd();
$removedirs = array("/pages","/engines");
$currentdirectory = str_replace($removedirs,"",$currentdirectory);
$enginesdirectory = $currentdirectory . "/engines/";

//Make the form for the page input
include $enginesdirectory . 'degenerate-codons-form.php';

if (isset($_POST['submit']) == true)
  {
  //Process the form input
  include $enginesdirectory . 'degenerate-codons-process-input.php';

  //Screen codons against requirements
  include $enginesdirectory . 'degenerate-codons-screen-codons.php';

  //Generate results table
  include $enginesdirectory . 'degenerate-codons-output-table.php';

  echo '<div class="item">';
  echo '<p class="blockheading">Found Degenerate Codons</p>';
  echo '<p>All possible codons using degenerate nucleic acid codons have been
  searched to find these codons that meet your requirements.</p>';
  echo '<p>Codon - The codon, using standard nucleotide nomeculature.</p>';
  echo '<p>Translated - The amino acids translated by the codon.</p>';
  echo '<p>Wanted Amino Acids Included - The amino acids that are either required or desired that the codon translates.</p>';
  echo '<p>Missing Amino Acids - Amino acids that are desired and are missing from the codon.</p>';
  echo '<p>% Translated Codons Wanted - The percentage of the codons that are translated that translate for required or desired amino acids.</p>';
  echo '<p>% Wanted Amino Acids Translated - The percentage of the required or desired amino acids that have been translated.</p>';
  echo '<p>% Stop Codons - The percentage of translated codons that are stop codons.</p>';
  echo '<p>SD of Amino Acid Frequencies - The standard deviation of the number of each amino acid encoded by this codon. The smaller this number is, the more evenly represented the amino acids are.</p>';
  echo $selectedcodonstablehtml;
  echo '</div>';
  }
?>

<div class="item">
<p class="blockheading">Amino Acid Options</p>
<p>Search for appropriate codons made from degenerate nucleotides for generating
  peptide libraries.
<?php
echo $formhtml;
?>
<p><a href="https://github.com/ROCrooks/DegenerateCodonFinder">Git Repository</a></p>
</div>
