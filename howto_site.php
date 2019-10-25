<?php echo file_get_contents("html/header.html"); ?>
<form action="script_example.php"  method="post" id="searchform" enctype="multipart/form-data">
<div id="miRNA search">
    <div class="trasparenza">
    <br>
        <fieldset id="searchs">
            <legend> Search Interface</legend>
            <b> <p>Here you can try our site with an example already inserted</p>
            <br>
                <p>Click on search to make the alignment!</p></b>
                <div class="row main-content">
                    <div class="col-sm-6">
                    <br><br>
                    <div class="autocomplete">
                        <input type="text" id="myTextareaTry" name="code" placeholder="hsa-miR-181a-2" disabled readonly>
                    </div>
                    <br><br>
                    <p>Or</p>
                    <br>
                    <textarea class="fasta-sequence" name ="fasta" id="fasta" rows="5" cols="30" placeholder=">hsa-mir-181a-2 MIMAT0000223
AACAUUCAACGCUGUCGGUGAGU" disabled readonly></textarea>
                    <br><br>
                    <p>Or</p>
                    <br>

                    <label for="file">Upload a FASTA:</label>
                    <input type="file" name="file" id="file" disabled/> 
                    <br>
                    <p>
                        <strong>Note:</strong> Only .fasta format allowed to a max size of 5 MB.
                    </p>
                    </div>
                    <br>
                    <br>
                    <div class="col-sm-6 energy-section">
                        <div id ="destra1">
                            Score:
                            <input type="text" name="score" id="score" size="4" maxlength="5" class="score" placeholder="140" disabled readonly/>
                        </div>
                        <br>
                        <br>
                        <div id ="destra2">
                            Energy:
                            <div class="slidecontainer2">
                                <input type="range" name="energy" min="-20" max="1" value="1" class="slider2" id="myRange" disabled readonly title="disabled"/>
                                <br>
                                <p>Value: <span id="energy"></span></p>
                            </div>

                            <script>
                                var slider = document.getElementById("myRange");
                                var output = document.getElementById("energy");
                                output.innerHTML = slider.value;

                                slider.oninput = function() {
                                  output.innerHTML = this.value;
                                }
                            </script>
                        </div>
                        <br>
                        <br>
                        <div id ="strict">
                            Strict:
                            <input type="radio" name="strict" value="on" disabled/>On
                            <input type="radio" name="strict" value="off" checked value="on"/>Off<br/>
                        </div>
                        <br>
                        <br>
                        <div id ="noenergy">
                            No energy:
                            <input type="radio" name="noenergy" value="on" disabled/>On
                            <input type="radio" name="noenergy" value="off" checked value="on"/>Off<br/>
                        </div>
                    </div>
                </div>
                <div class=" centra-contenuto row">
                	<div id="loading" class="loading_dna"><img src="images/loading.gif" alt="" />Loading!</div>
                	<input id="submit" class="btn btn-primary search_button" value="Search!" type="submit" />
            		<script type="text/javascript">
            		(function (d) {
            		  d.getElementById('searchform').onsubmit = function () {
            		    d.getElementById('submit').style.display = 'none';
            		    d.getElementById('loading').style.display = 'block';
            		  };
            		}(document));
            		</script>
                </div>               
        </fieldset>
    </div>
</div>
</form>
<?php echo file_get_contents("html/footer.html"); ?>