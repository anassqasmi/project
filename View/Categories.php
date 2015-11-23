<?php 
if (!isset($_SESSION))
  {
    session_start();
  }

?>
<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8" />
<title>Admin</title>

<link rel="stylesheet" href="css/layout.css" type="text/css"
	media="screen" />
	
<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
<script src="js/hideshow.js" type="text/javascript"></script>
<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.equalHeight.js"></script>
<script type="text/javascript">



function test()
{
	document.getElementById("aj").style.visibility = 'visible';
	document.getElementById("cat").style.visibility = 'visible';
	document.getElementById("sel").style.visibility = 'hidden';
}

function modifier()
{
	document.getElementById("mod").style.visibility = 'visible';
	document.getElementById("cat").style.visibility = 'visible';
	document.getElementById("aj").style.visibility = 'hidden';
	var t = document.getElementById("selectCat");
	document.getElementById('catfield').value = t.options[t.selectedIndex].text;
}

function deleteCat()
{
	var t = document.getElementById("selectCat");
	document.getElementById('toDeleteCatId').value = t.options[t.selectedIndex].text;
	document.getElementById("form2").submit();
}

function Addcat()
{
	document.getElementById("formCat").submit();
}

function modCat()
{
	var t = document.getElementById("selectCat");
	document.getElementById('oldCatId').value = t.options[t.selectedIndex].text;
	document.getElementById('newCatId').value = document.getElementById('catfield').value;
	document.getElementById("form").submit();
}

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

    </script>
<script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>

</head>

<body>
	
	<?php
	include ('masterPage.php');
	include ('../DAO/FileAccess.php');
	//lool("anass");
	?>
	
	
	<section id="main" class="column">

		<div class="clear"></div>

		<article class="module width_full">
			<header>
				<h3 class="tabs_involved">Categories Manager <?php echo $_SESSION ['wa3'] . "l" ?> </h3>
				<ul class="tabs">
					<li><a href="#tab2" onclick="test()">Nouvelle Categorie +</a></li>
				</ul>
			</header>
			<div class="module_content">
				<div id="sel">
					<fieldset style="width: 100%; float: left; margin-right: 3%;">
						<!-- to make two field float next to one another, adjust values accordingly -->
						<label>Categorie : </label>

						<table border="0" style="width: 100%">
							<tr>
								<td><select id="selectCat" style="width: 62%;">
							<?php
							readCat ();
							$catArry = $_SESSION ['arr'];
							foreach ( $catArry as $catego ) {
								echo '<option>' . $catego . '</option>';
							}
							?>
							</select></td>
								<td style="padding: right"><input type="image"
									src="images/icn_edit.png" title="Edit" onclick="modifier()"></td>
								<td><input type="image" 
									src="images/icn_trash.png" title="Trash" onclick="deleteCat();">
								</td>
							</tr>
						</table>

					</fieldset>
				</div>
				<div id="cat">
					<fieldset>
						<label>Categorie : </label>
						<form id="formCat"
							action="../Controlor/MainControlor.php?fun=addCategorie"
							method="post">
							<input type="text" size="50%" name="cat" id="catfield" />
						</form>
					</fieldset>
				</div>
				

			</div>
			<footer>
				<div class="submit_link" id="aj">
					<input type="submit" value="Ajouter" onclick="Addcat()"
						class="alt_btn">
				</div>
				<div class="submit_link" id="mod">
					<input type="submit" value="Modifier" onclick="modCat()" class="alt_btn">
				</div>
			</footer>
		</article>
		<!-- end of post new article -->

		<div class="spacer"></div>

	</section>
	<form style="display: hidden" action="../Controlor/MainControlor.php?fun=ModCategorie" method="post" id="form">
		<input type="text" size="20" name="oldCat" id="oldCatId" >
		<input type="text" size="20" name="newCat" id="newCatId" >
	</form>
	
	<form style="display: hidden" action="../Controlor/MainControlor.php?fun=deleteCategorie" method="post" id="form2">
		<input type="text" size="20" name="oldCat" id="toDeleteCatId" >
	</form>


</body>

<script type="text/javascript">
	document.getElementById("aj").style.visibility = 'hidden';
	document.getElementById("cat").style.visibility = 'hidden';
	document.getElementById("mod").style.visibility = 'hidden';
</script>

</html>