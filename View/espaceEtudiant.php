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
	<title>Etudiant</title>
	
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

	function terminerTache($id)
	{
		document.location.replace("../Controlor/MainControlor.php?fun=terTache&id=" + $id );
	}
	
	function rectangle()
	{
	  var canvas = document.getElementById("canvas1"); 
	  var context = canvas.getContext("2d");
	  context.fillStyle="yellow";
	  context.fillRect(10,10,10,10);
	}
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
	</script>

</head>


<body>
	
	<?php include('userMasterPage.php');?>
	<?php include('../DAO/FileAccess.php');
	readMyTaches();
	?>
	<section id="main" class="column">

		<article class="module width_full">
		<header>
			<h3 class="tabs_involved">Taches Manager</h3>
			<ul class="tabs">
	   			<li><a href="#tab1">taches en cours </a></li>
	    		<li><a href="#tab2">taches terminee</a></li>
			</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
   					<th></th> 
    				<th onclick="rectangle();">date</th> 
    				<th onclick="rectangle();">tache</th> 
    				<th>Categorie</th> 
    				<th>tage</th> 
    				<th>cible</th> 
    				<th>Actions</th> 
				</tr> 
			</thead> 
			<tbody> 
				<?php foreach ( $_SESSION['myTachesTab'] as $tache ) { 
					if(($tache[6]."o") == "0o"){
					?>
				
				<tr> 
   					<td><!-- <input type="checkbox">  -->
   					<span><canvas id="canvas1" width="10" height="10"></canvas></span>
   					</td> 
   					<td><?php echo $tache[1] ?></td> 
    				<td><?php echo substr($tache[2], 0, 10) . "..." ?></td> 
    				<td><?php echo $tache[3] ?></td> 
    				<td><?php echo $tache[4] ?></td> 
    				<td><?php if($tache[5] != '1000') {echo getUserById($tache[5]); }else{ echo 'Public';} ?></td> 
    				<td>
	    				<input type="button" value="Terminer" onclick="terminerTache(<?php echo $tache[0];?>)">
	    				<!-- <input type="image" src="images/icn_trash.png" title="Trash" onclick="deleteTache(<?php //echo $tache[0];?>)">
	    				 -->
	    			</td> 
				</tr> 
				<?php }}?>
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
			
			<div id="tab2" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
   					<th></th> 
    				<th onclick="rectangle();">date</th> 
    				<th onclick="rectangle();">tache</th> 
    				<th>Categorie</th> 
    				<th>tage</th> 
    				<th>cible</th> 
				</tr> 
			</thead> 
			<tbody> 
				<?php foreach ( $_SESSION['myTachesTab'] as $tache ) { 
					if(($tache[6]."o") == "1o"){
					?>
				<tr> 
   					<td><!-- <input type="checkbox">  -->
   					<span><canvas id="canvas1" width="10" height="10"></canvas></span>
   					</td> 
   					<td><?php echo $tache[1] ?></td> 
    				<td><?php echo substr($tache[2], 0, 10) . "..." ?></td> 
    				<td><?php echo $tache[3] ?></td> 
    				<td><?php echo $tache[4] ?></td> 
    				<td><?php echo $tache[5] ?></td> 
				</tr> 
				<?php }}?>
			</tbody> 
			</table>

			</div><!-- end of #tab2 -->
			
		</div><!-- end of .tab_container -->
		
		</article><!-- end of taches list -->
	</section>


</body>

</html>

<?php
 ?>