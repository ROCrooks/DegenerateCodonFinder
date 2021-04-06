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
</div>
