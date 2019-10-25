<form action="script.php" method="post" id="searchform" enctype="multipart/form-data">
<div class="trasparenza">
    <fieldset>
	    <div>
          <h3> Introduction</h3>
              <p>Welcome to the aligment tool page! miRanda is an algorithm for the detection of potential microRNA target sites in genomic sequences. miRanda reads RNA sequences  (such
              as  microRNAs) from an id or a file or a fasta and genomic DNA/RNA sequences from a database.</p>
              <p><a href="howto_site.php">Click here for try an alignment</a></p>
      	</div>
      	<br>
      	<br>
        <h4>Last miRNA alignment</h4>
        <?php 
          $filename = 'uploads/last.txt';
          if (file_exists($filename)) {
               echo file_get_contents("uploads/last.txt");     
          }?>
      	<div>
	      	<br>
	      	<br>
	        <legend> Search Interface</legend>
	        <div class="row main-content">
	            <div class="col-sm-6">
		            <br><br>
	              	<div class="autocomplete">
	                    <input type="text" id="myTextarea" name="code" placeholder="Input your miRNA ID..">
	                </div>
	                <script>
	                  function autocomplete(inp, arr) {
	                    /*the autocomplete function takes two arguments,
	                    the text field element and an array of possible autocompleted values:*/
	                    var currentFocus;
	                    /*execute a function when someone writes in the text field:*/
	                    inp.addEventListener("input", function(e) {
	                        var a, b, i, val = this.value;
	                        /*close any already open lists of autocompleted values*/
	                        closeAllLists();
	                        if (!val) { return false;}
	                        currentFocus = -1;
	                        /*create a DIV element that will contain the items (values):*/
	                        a = document.createElement("DIV");
	                        a.setAttribute("id", this.id + "autocomplete-list");
	                        a.setAttribute("class", "autocomplete-items");
	                        /*append the DIV element as a child of the autocomplete container:*/
	                        this.parentNode.appendChild(a);
	                        /*for each item in the array...*/
	                        for (i = 0; i < arr.length; i++) {
	                          /*check if the item starts with the same letters as the text field value:*/
	                          if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
	                            /*create a DIV element for each matching element:*/
	                            b = document.createElement("DIV");
	                            /*make the matching letters bold:*/
	                            b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
	                            b.innerHTML += arr[i].substr(val.length);
	                            /*insert a input field that will hold the current array item's value:*/
	                            b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
	                            /*execute a function when someone clicks on the item value (DIV element):*/
	                            b.addEventListener("click", function(e) {
	                                /*insert the value for the autocomplete text field:*/
	                                inp.value = this.getElementsByTagName("input")[0].value;
	                                /*close the list of autocompleted values,
	                                (or any other open lists of autocompleted values:*/
	                                closeAllLists();
	                            });
	                            a.appendChild(b);
	                          }
	                        }
	                    });
	                    /*execute a function presses a key on the keyboard:*/
	                    inp.addEventListener("keydown", function(e) {
	                        var x = document.getElementById(this.id + "autocomplete-list");
	                        if (x) x = x.getElementsByTagName("div");
	                        if (e.keyCode == 40) {
	                          /*If the arrow DOWN key is pressed,
	                          increase the currentFocus variable:*/
	                          currentFocus++;
	                          /*and and make the current item more visible:*/
	                          addActive(x);
	                        } else if (e.keyCode == 38) { //up
	                          /*If the arrow UP key is pressed,
	                          decrease the currentFocus variable:*/
	                          currentFocus--;
	                          /*and and make the current item more visible:*/
	                          addActive(x);
	                        } else if (e.keyCode == 13) {
	                          /*If the ENTER key is pressed, prevent the form from being submitted,*/
	                          e.preventDefault();
	                          if (currentFocus > -1) {
	                            /*and simulate a click on the "active" item:*/
	                            if (x) x[currentFocus].click();
	                          }
	                        }
	                    });
	                    function addActive(x) {
	                      /*a function to classify an item as "active":*/
	                      if (!x) return false;
	                      /*start by removing the "active" class on all items:*/
	                      removeActive(x);
	                      if (currentFocus >= x.length) currentFocus = 0;
	                      if (currentFocus < 0) currentFocus = (x.length - 1);
	                      /*add class "autocomplete-active":*/
	                      x[currentFocus].classList.add("autocomplete-active");
	                    }
	                    function removeActive(x) {
	                      /*a function to remove the "active" class from all autocomplete items:*/
	                      for (var i = 0; i < x.length; i++) {
	                        x[i].classList.remove("autocomplete-active");
	                      }
	                    }
	                    function closeAllLists(elmnt) {
	                      /*close all autocomplete lists in the document,
	                      except the one passed as an argument:*/
	                      var x = document.getElementsByClassName("autocomplete-items");
	                      for (var i = 0; i < x.length; i++) {
	                        if (elmnt != x[i] && elmnt != inp) {
	                          x[i].parentNode.removeChild(x[i]);
	                        }
	                      }
	                    }
	                    /*execute a function when someone clicks in the document:*/
	                    document.addEventListener("click", function (e) {
	                        closeAllLists(e.target);
	                        });
	                  	}
		                 
		              	fetch('database/mirna_ids.json').then(function(response) {
		                	response.json().then(function(json) {
		                    	autocomplete(document.getElementById("myTextarea"), json);
		                  	});
		                });                          
	          		</script>

	                <br><br>
	                <p>Or</p>
	                <br>
	                <textarea class="fasta-sequence" name ="fasta" id="fasta" rows="5" cols="30" placeholder="Input your FASTA sequence.."></textarea>
	                <br><br>
	                <p>Or</p>
	                <br>

	                <label for="file">Upload a FASTA:</label>
	                <input type="file" name="file" id="file" /> 
	                <br>
	                <p>
	                    <strong>Note:</strong> Only .fasta format allowed to a max size of 5 MB.
	                </p>
	            </div>
	          	<br>
	         	<br>
	          	<div class="col-sm-6 energy-section">
	              	<div>
		                Score:
		                <input type="text" name="score" id="score" size="4" maxlength="3" class="score" placeholder="140" value="140"/>
	              	</div>
	              	<br>
	              	<br>
	              	<div>
	          			Energy:
	                  	<div class="slidecontainer">
	                    	<input type="range" name="energy" min="-20" max="1" value="1" class="slider" id="myRange">
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
	              	<div>
	                    Strict:
	      			    <input type="radio" name="strict" value="on"/>On
	      			    <input type="radio" name="strict" value="off" checked value="on"/>Off<br/>
	              	</div>
	              	<br>
	              	<br>
	              	<div>
	    				<script>
	    					$(document).ready(function(){
	    					  $('input:radio[name="noenergy"]').change(function() {
	    						if ($('input:radio[name="noenergy"]:checked').val() == 'on'){
	    							alert('Select this option the thermodynamic parameter will be not calculate on the alignment');
	    						  };
	    					  });
	    					});
	    				</script>
	                  	No energy:
	            			<input type="radio" name="noenergy" value="on"/>On
	            			<input type="radio" name="noenergy" value="off" checked value="on"/>Off<br/>
	              	</div>	
	          	</div>
	        </div>

	        <div class=" centra-contenuto row">
	        	<div id="loading" class="loading_dna"><img src="images/loading.gif" alt="loading" />Loading!</div>
	        	<input id="submit" class="btn btn-primary search_button" value="Search!" type="submit" />
	    		<script>                
	    		(function (d) {
	    		  d.getElementById('searchform').onsubmit = function () {
	    		    d.getElementById('submit').style.display = 'none';
	    		    d.getElementById('loading').style.display = 'block';
	    		  };
	    		}(document));
	    		</script>
	        </div>
	        <br><br>
	  </div>               
    </fieldset>
</div>
</form>

