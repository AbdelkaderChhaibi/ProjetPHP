<?php session_start(); 
error_reporting(0); ?>
<!DOCTYPE html>
<html>
<head>
	<title>ajout livre</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="fom.css">
</head>
<body background="images/b.jpg">
<?php 	
if(isset($_SESSION['valid'])){
include("connexion.php");
?>
			<header>
		<div class="container-fluid" >
			<div class="row" style="background:#ffffff">
				<div class="col-sm-2" ><a href="index.php"><img src="images/logo2.png" class="img-responsive"></a></div>
				<div class="col-sm-8"></div>
				<div class="col-sm-2"><font size="4"> Bienvenue <?php echo $_SESSION['login'];?>!</font>
				<a href='logout.php' class="btn btn-info btn-responsive"><span>Deconixion</span></a>  </div>
			</div>
		</div>
	</header>
		<nav class="navbar navbar-inverse">
		<div class="container-fluid" >
		<div class="navbar-header"><a class="navbar-brand" href="index.php"><h5>Notre bibliothéque</h5> </a>
		</div>
		<ul class="nav navbar-nav">
			<li class="active"><a href="indexadmin.php">accueil</a></li>
		<li><a href='g_adherant.php'>gestion adherant </a></li>
		<li><a href='g_livre.php'>gestion livre</a></li>
		<li><a href='g_resv.php'>gestion de resevation </a></li>
		<li><a href="g_demande.php">gestion de demande</a></li>
		</ul>
		</div>
		</nav>



<div class=" container" >
	<div class="row">
		<div class="col-md-6 col-md-offset-3 style1">
		<a href="g_livre.php" class="btn btn-info">R e t o u r</a>
<form action="" method="post" enctype="multipart/form-data">
			<h2 >Ajouter Livre</h2>

	

		
		<div  class="form1">  <label  class="form-group hh"> T i t l e : </label>
			<input type="text" name="title" placeholder="title" class="form-group input" >
		 </div >
		<div class="form1">
			<label  class="form-group hh">A u t e u r : </label>
			<input type="text" name="auteur" placeholder="auteur" class="form-group input">
		 </div> 
		<div  class="form1">
				<label class="form-group hh">D a t e : </label>
			<input type="date" name="date" class="form-group input" >
		</div>
		<div class="form1">
			<label class="form-group hh">nombre da page:</label>
			<input type="text" name="nbrpage" placeholder="nbrpage" class="form-group input">
		</div>
		<div class="form1" >
			<label class="form-group hh" >image:</label>
			<input type="file" name="imageL" class="form-group input" style='margin-left:35%;' >
		</div>
		<div>
			<input type="submit" name="submit" class="form-group btn btn-info inputbtn" value="Ajouter">
 </div>
 </form>

</div></div></div>
<?php
	if(isset($_POST['submit'])){
		$title=$_POST['title'];
		$auteur=$_POST['auteur'];
		$date=$_POST['date'];
		$nbrpage=$_POST['nbrpage'];
		//if(empty($code)||empty($title)||empty($autheur)||empty($date)||empty($nbrpage)) {
		$photo="";
        $imageName=$_FILES['imageL']['name'];
        $imageTMP= $_FILES['imageL']['tmp_name'];
        $imageExt=strchr($imageName,".");
        $exTable=['.png','.PNG', '.jpg' , '.JPG', '.gif'];
        $imageDest='images/'.$imageName;
        if( in_array($imageExt,$exTable))
        {
            if(move_uploaded_file($imageTMP,$imageDest))
            {
                $photo=$imageDest;


            }
            

        }
        else
        {
           				echo "<div class='container'>
		<div class='col-md-6 col-md-offset-3'>
			<div class='alert alert-danger'>
		<h3  style='text-align: center;' > enter un ficher valide : </h3><br><br>
		</div></div></div>";
        }

			if(empty($title)) {
			 echo "<div class='container'>
		<div class='col-md-6 col-md-offset-3'>
			<div class='alert alert-danger'>
		<h3  style='text-align: center;' > le titre est vide </h3><br><br>
	</div></div></div>";
	 			}
	 		  
			elseif(empty($auteur)){
				echo "<div class='container'>
		<div class='col-md-6 col-md-offset-3'>
			<div class='alert alert-danger'>
		<h3  style='text-align: center;' > le nom d'auteur est vide </h3><br><br>
	</div></div></div>";
			}
			elseif(empty($date)){
				echo "<div class='container'>
		<div class='col-md-6 col-md-offset-3'>
			<div class='alert alert-danger'>
		<h3  style='text-align: center;' > date est vide </h3><br><br>
	</div></div></div>";
			}
			elseif(empty($photo)){
				echo "<div class='container'>
		<div class='col-md-6 col-md-offset-3'>
			<div class='alert alert-danger'>
		<h3  style='text-align: center;' > enter une image : </h3><br><br>
	</div></div></div>";
			}

			elseif(empty($nbrpage)){
				echo "<div class='container'>
		<div class='col-md-6 col-md-offset-3'>
			<div class='alert alert-danger'>
		<h3  style='text-align: center;' > le nombre de pages est vide </h3><br><br>
	</div></div></div>";
			}else{
		 			 	echo "<div class='container'>
		<div class='col-md-6 col-md-offset-3'>
			<div class='alert alert-danger'>
		<h5  style='text-align: center;' > l'ajout  avec succés </h5><br><br>
		<hr>

		<a href='g_livre.php'><h3 style='text-align: center;'>retour</h3></a>
	</div></div></div>" ;
$sql1 =mysqli_query($mysqli,"INSERT INTO livre ( title, autheur, date_sortie, nombre_de_pages, dispo, reserver, photo) VALUES ( '$title', '$auteur', '$date', '$nbrpage', '1', NULL,'$photo')");
		 	echo "<script>window.location.href='ajout2.php';</script>";
		 		}


	 }?>

<footer>
<div class="container-fluid">
	<div class="row"style=" background: #000000;box-shadow: 0 15px 28px 0 rgba(0,0,0,0.2),0 9px 26px 0 rgba(0,0,0,0.19); ">
		<br><br><br>
		<p style="text-align: center;"><small> ce site etait créer comme etant un projet de programation web pour les etudiants de 3 éme info à l'école polytechnique de sousse</small> <br>      &copy Notre Bibliotheque 2020 </p>



	</div>
</div>	
</footer>


<?php



 }else{

			echo "<div style='background-color:white;'>You must be logged in to view this page.<br/><br/>
		  <a href='index.php'>Login</a></div>";


		}
?>








</body>
</html>