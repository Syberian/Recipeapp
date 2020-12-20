<!--logowanie-->
<?php
	require('polacz.php');
	require('operacje.php');
	session_start();
	logowanie();
	rejestracja();
?>

<!-- Uniknięcie dodawania tych samych przepisów przy odświeżaniu strony -->
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap-icons-1.2.1/font/bootstrap-icons.css" />
    <title>Recipe Book</title>
</head>
<body>

  <!--modal rejestracja-->
<div class="modal fade" id="rejestracja" tabindex="0" aria-labelledby="rejestracjaModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
	<div class="modal-content">
	<div class="modal-header">
		<h5 class="modal-title" id="rejestracjaModalLabel">Rejestracja</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	<div class="modal-body">
		<form action="index.php" method="POST" id="reg">
			<div>
			<label for="login" class="form-label">Login</label>
			<input type="text" name="login" class="form-control" id="login" name="login">
			</div>
			<div>
			<label for="password" class="form-label">Hasło</label>
			<input type="password" name="password" class="form-control" id="password" name="password">
			</div>

			<div>
			<label for="password" class="form-label">Potwierdź Hasło</label>
			<input type="password" name="password2" class="form-control" name="password2">
			</div>

			<div>
			<br>
			<span>Masz już konto? <a href="#" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#logowanie">Zaloguj się</a></span>
			
			</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
		<input type="submit" class="btn btn-primary bg-purple" value="Zarejestruj" >
		
	</div>
	</form>
	</div>
</div>
</div>
  <!--modal logowanie-->
<div class="modal fade" id="logowanie" tabindex="-1" aria-labelledby="logowanieModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
	<div class="modal-content">
	<div class="modal-header">
		<h5 class="modal-title" id="logowanieModalLabel">Logowanie</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	<div class="modal-body">
		<form action="index.php" method="POST" >
			<div>
			<label for="login" class="form-label">Login</label>
			<input type="text" class="form-control" id="login2" name="login2">
			</div>
			<div>
			<label for="password" class="form-label">Hasło</label>
			<input type="password" class="form-control" id="password3" name="password3">
			</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
		<input type="submit" class="btn btn-primary bg-purple" id="bt" value="Zaloguj">
		
	</div>
	</form>
	</div>
</div>
</div>
<!--Modal Dodaj recepture-->
<div class="modal fade" id="addRecipeModal" tabindex="-2" aria-labelledby="dodajReceptureModal" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
	<div class="modal-content">
	<div class="modal-header">
		<h5 class="modal-title" id="dodajReceptureModal">Dodaj Recepturę</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	<div class="modal-body">
		<form action="index.php" method="POST">
			<div>
				<label for="tytul" class="form-label">Nazwa przepisu</label>
				<input type="text" class="form-control" name="tytul">
			</div>
			<div>
				<label for="opis" class="form-label">Przepis</label>
				<textarea type="text" class="form-control" name="opis"></textarea>
			</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
		<input type="submit" class="btn btn-primary bg-purple" value="Dodaj przepis">
		<?php dodaj() ?>
	</div>
	</form>
	</div>
</div>
</div>

<!--Modyfikuj recepture modal-->
<div class="modal fade" id="modifyRecipeModal" tabindex="-2" aria-labelledby="modifyReceptureModal" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
	<div class="modal-content">
	<div class="modal-header">
		<h5 class="modal-title" id="modifyReceptureModal">Modyfikuj Recepturę</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	<div class="modal-body">
		<form action="index.php" method="POST">
			<div>
				<label for="tytul" class="form-label">Nazwa przepisu</label>
				<input type="text" id="titleToModify" class="form-control" name="modifyTytul">
			</div>
			<div>
				<label for="opis" class="form-label">Przepis</label>
				<textarea type="text" id="recipeToModify" class="form-control" name="modifyOpis"></textarea>

				<input type="hidden" id="tempId" name="tempId">
			</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
		<input type="submit" class="btn btn-primary bg-purple" value="Modyfikuj przepis">
		<?php modyfikuj() ?>
	</div>
	</form>
	</div>
</div>
</div>

<div class="container-fluid h-100">
    <nav class="navbar navbar-expand-lg bg-darkgreen navbar-light">
        <div class="container-fluid">
			<!-- Logo icon -->
            <a href="#">
                <i class="bi bi-journal-check navbar-brand text-white" style="font-size: 2em; line-height: 0;"></i>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto ">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="#">Przepisy</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="#" data-bs-toggle="modal" data-bs-target="#rejestracja">Zarejestruj się</a>
                    </li>
                </ul>
				<span id="loggedAs" style="margin-right: 15px; margin-left: 15px; color: white;">
					<?php
					if(isset($_SESSION['login']))
					{
						echo "Jesteś zalogowany jako: ".$_SESSION['login'];
					}
					?>
				</span>
            </div>
        </div>
    </nav>
	

    <div class="content" style="background-color: #f8f4e8; padding: 20px;">
	
      	<span id="loginBlockade" class="my-auto mx-auto" style="font-weight: bold; display: none;">
			Zaloguj się by odblokować funkcjonalność.
	  	</span>
	  
	  	<div id="recipeContent" style="display: none;">
		  <!-- wyswietl aktualne przepisy z bazy -->
			<?php
			wyswietl();
			?>
	  	</div>
		
		<div id="addRecipe">
			<a href="#" id="addRecipeButton" data-bs-toggle="modal" data-bs-target="#addRecipeModal"><i class="bi bi-plus text-white mx-auto my-auto"></i></a>
		</div>

    </div>
  
    <div class="bg-lightgreen text-white" style="text-align: center;">
        <p class="footer my-auto">Copyright &copy Grzegorz Fojcik & Dawid Ryszka</p>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
	<script src="jquery-3.5.1.min.js"></script>
	<script src="script.js"></script>
</body>
</html>


