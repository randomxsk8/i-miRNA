<!DOCTYPE html>
<html lang="en">
<?php echo file_get_contents("html/header.html"); ?>

<meta name="viewport" content="width=device-width, initial-scale=1">

<body class="unique">

<h2>FAQ</h2>

<button class="collapsible">What are MicroRNAs?</button>
<div class="content">
  <p>MicroRNAs (miRNAs) are small noncoding RNA molecules, which are capable of negatively regulating gene expression to control many cellular mechanisms.</p>
</div>


<button class="collapsible">Have you got only the accession number of the microrna?</button>
<div class="content">
  <p>You can find the ID or the fasta via accession number at <a href="http://www.mirbase.org/">miRBase</a></p>
</div>

<button class="collapsible">How to install MiRanda in local?</button>
<div class="content">
</br>

  <p>First of Miranda software runs on linux os based system, so you need install Miranda.</p>

</br>
<p>
- Download software <a href="http://cbio.mskcc.org/microrna_data/miRanda-aug2010.tar.gz">here</a></p>

<p>- From shell go into your download folder and extract software using the shell command:</p>
<strong>tar xzvf miRanda-aug2010.tar.gz</strong>
</br>
</br>
<p>
- After that you need to compile and install Miranda, using these following commands:
</br>
</br>

<strong>cd 'miRanda-3.3a'</strong>
</br>
<strong>make</strong>
</br>
<strong>sudo make install</strong>
</p>
</br>
<p>
If you want check a correct installation just type command "miranda" on the shell</p></p>
</div>

<button class="collapsible">Why with my MiRanda does not return any results?</button>
<div class="content">
  <p>Check that it is a mature miRNA and belonging to the human species.</p>
</div>

<button class="collapsible">How to get the results of alignment:</button>
<div class="content">
  <p>Click on the "Download" button or enter your email address.</p>
</div>

<button class="collapsible">What are the default parameters of Miranda?</button>
<div class="content">
  <p>Core algorithm parameters:<br>
 </br>-sc S		Set score threshold to S		[DEFAULT: 140.0]<br>
 </br>-en -E		Set energy threshold to -E kcal/mol	[DEFAULT: 1.0]<br>
 </br>-strict	Demand strict 5' seed pairing		[DEFAULT: off]<br>
 </br>-noenergy	Do not perform thermodynamics		[DEFAULT: off]<br></p>
</div>

<button class="collapsible">What is "Score"?</button>
<div class="content">
  <p>Set the alignment score threshold to score.</p>
  <p>Only alignments with scores >= score will be used for analysis.</p>
</div>

<button class="collapsible">What is "Energy"?</button>
<div class="content">
  <p>Set the energy threshold to energy.</p>
 	<p>Only alignments  with  energies  <=  energy  will  be used for analysis. A negative value is required for filtering to occur.</p>
</div>

<button class="collapsible">What is "Strict"?</button>
<div class="content">
  <p>Require  strict  alignment  in the seed region (offset positions 2-8). This option prevents the detection of target sites  which contain gaps or non-canonical base pairing in this region.</p>
</div>

<button class="collapsible">What is "Noenergy"?</button>
<div class="content">
  <p>Turn  off  thermodynamic  calculations  from  RNAlib. If this is used, only the alignment score threshold will be used. The  -en setting will be ignored.
</p>
</div>


<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.display === "block") {
            content.style.display = "none";
        } else {
            content.style.display = "block";
        }
    });
}
</script>

</body>
</html>

<?php echo file_get_contents("html/footer.html"); ?>
