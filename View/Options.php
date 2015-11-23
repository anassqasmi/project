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
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>

</head>


<body>
	
	<?php include('masterPage.php');?>
	
	<section id="main" class="column">

		<div class="clear"></div>
		
		<article class="module width_full">
			<header><h3>Nouvelle tache</h3></header>
				<div class="module_content">
				<?php $_GET['val']?>
				</div>
				<div class="module_content">
				<form action="../Controlor/MainControlor.php?fun=opt" method="post">
						<fieldset>
							<label>Nom : </label>
							<input type="text" size="50%" name="nom" value="<?php echo $_SESSION['unom']?>"/>
						</fieldset>
						<fieldset>
							<label>Prenom : </label>
							<input type="text" size="50%" name="prenom" value="<?php echo $_SESSION['uprenom']?>"/>
						</fieldset>
						<fieldset>
							<label>Email : </label>
							<input type="text" size="50%" name="email" value="<?php echo $_SESSION['umail']?>"/>
						</fieldset>
						<fieldset>
							<label>Password : </label>
							<input type="password" size="50%" name="pwd1" value="<?php echo $_SESSION['upwd']?>"/>
						</fieldset>
						<fieldset>
							<label>Password : </label>
							<input type="password" size="50%" name="pwd2" value="<?php echo $_SESSION['upwd']?>"/>
						</fieldset>
						<input type="submit" value="valider">
				</form>
						<div class="clear"></div>
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


</body>

</html>

<?php
 ?>