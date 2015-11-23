<?php 
if (!isset($_SESSION))
  {
    session_start();
  }

?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>Admin</title>
	
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="js/hideshow.js" type="text/javascript"></script>
	<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.equalHeight.js"></script>
	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

	});

	
	function addTache()
	{
		var t = document.getElementById("selectCat");
		document.getElementById('categorie').value = t.options[t.selectedIndex].text;
	
		var t = document.getElementById("selectTag");
		document.getElementById('tag').value = t.options[t.selectedIndex].text;

		var t = document.getElementById("selectQui");
		document.getElementById('pourQui').value = t.options[t.selectedIndex].value;

		var t = document.getElementById("contenu");
		document.getElementById('tacheContenu').value = t.value;

		var t = document.getElementById("selectedDate");
		document.getElementById('laDate').value = t.value;
		
		document.getElementById("newFormTache").submit();
	}

	function vider()
	{

		var t = document.getElementById("contenu");
		t.value = "";

		var t = document.getElementById("selectedDate");
		t.value = "";
	}
	
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>

</head>


<body>
	
	<?php 
	include('masterPage.php');
	include ('../DAO/FileAccess.php');
	?>
	
	
	<section id="main" class="column">

		<div class="clear"></div>
		
		<article class="module width_full">
			<header><h3>Nouvelle tache</h3></header>
				<div class="module_content">
				
				</div>
				<div class="module_content">
						<fieldset>
							<label>Date : </label>
							<input type="date" size="50%" id="selectedDate"/>
						</fieldset>
						<fieldset>
							<label>Tache : </label>
							<textarea rows="12" name="contenu" id="contenu"></textarea>
						</fieldset>
						<fieldset style="width:48%; float:left; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label>Categorie : </label>
							<select style="width:92%;" id=selectCat>
								<?php
									readCat ();
									$catArry = $_SESSION ['arr'];
									foreach ( $catArry as $catego ) {
										echo '<option>' . $catego . '</option>';
									}
								?>
							</select>
						</fieldset>
						<fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label>Tags : </label>
							<select style="width:92%;" id="selectTag">
								<?php
									readTagg();
									$tagArry = $_SESSION ['arrT'];
									foreach ( $tagArry as $tagArry ) {
										echo '<option>' . $tagArry . '</option>';
									}
								?>
							</select>
						</fieldset><div class="clear"></div>
				</div>
			<footer>
				<div class="submit_link">
					<select id="selectQui">
						<option value="1000">public</option>
						<?php
							readEtudiants();
							$tagArry = $_SESSION ['arrU'];
							foreach ( $tagArry as $tagArry ) {
								echo '<option value ='. $tagArry[0] . '>' . $tagArry[1] . '</option>';
							}
						?>
					</select>
					<select id="selectQuiG">
						<option value="1000">public</option>
						<?php
							readGroups();
							$tagArry = $_SESSION ['GroupeTab'];
							foreach ( $tagArry as $tagArry ) {
								echo '<option value="' . $tagArry[0] . '">' . $tagArry[1] . '</option>';
							}
						?>
					</select>
					<input type="submit" value="Publier" class="alt_btn" onclick="addTache()">
					<input type="submit" value="Vider" onclick="vider()">
				</div>
			</footer>
		</article><!-- end of post new article -->
				<div class="spacer"></div>
	</section>
	<form style="display: hidden" method="post" action="../Controlor/MainControlor.php?fun=addTache" id="newFormTache">
		<input type="text" id="categorie" name="categorie">
		<input type="text" id="tag" name="tag">
		<input type="text" id="tacheContenu" name="tacheContenu">
		<input type="text" id="pourQui" name="pourQui">
		<input type="text" id="laDate" name="laDate">
	</form>

</body>

</html>

<?php
 ?>