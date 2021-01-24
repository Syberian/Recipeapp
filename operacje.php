
<?php
if(isset($_POST['ondelete']))
{
	usun($_POST['ondelete']);
}



function dodaj()
{
	$connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	
    if(isset($_POST['tytul']) && isset($_POST['opis'])&& empty($_POST['id']))
	{
		$tytul = $_POST['tytul'];
		$opis = $_POST['opis'];
		$autor = $_SESSION['login'];
		$image = $_FILES['zdjecie']['name'];
		//Zapisanie zdjecia do folderu
		
		$public = $_POST['publiczny'];
		
		
		$sql = "SELECT id FROM uzytkownicy where nazwaUzytkownika = '$autor'";
		
		$result = $connect->query($sql);
		
		if ($result->num_rows > 0)
		{
  
			while($row = $result->fetch_assoc())
			{
				$userID =  $row['id'];	
			}
		}
		
		$sql = "INSERT INTO przepisy (idUzytkownik,tytul,opis,zdjecie,publiczny)
		VALUES ('$userID', '$tytul', '$opis','$image','$public')";
		$result = $connect->query($sql);
		
	
	}
}
function getRecipeTitle($id)
{
	echo $id;
	$connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	$autor = $_SESSION['login'];

	if(!empty($id))
	{
		$sql = "SELECT tytul FROM przepisy WHERE autor = '$autor' AND id = '$id'";
		$result = $connect->query($sql);

		if($result->num_rows > 0)
		{
			$row = $result->fetch_assoc();
			echo $row['tytul'];
		}
	}
}
function modyfikuj()
{
	$connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	
	if(isset($_POST['modifyTytul']) && isset($_POST['modifyOpis']))
	{
		$id = ($_POST['tempId']);
		$tytul = ($_POST['modifyTytul']);
		$opis = ($_POST['modifyOpis']);
		$image = $_POST['zdjecie'];
		
		$sql = "UPDATE przepisy SET tytul = '$tytul', opis = '$opis', zdjecie = '$image' WHERE id='$id'";
		$result = $connect->query($sql);
		
		/*
		if ($result->num_rows > 0)
			{
		  
				while($row = $result->fetch_assoc())
				{
					
					echo 
					'<form action="index.php" method="POST">

					<label for="tytul">Tytuł przepisu:</label><br>
					<input type="text"  name="tytul" id="tytul" value='.$tytul.' ><br>
					<input type="hidden" name="id" value="'.$id.'">
					<label for="opis">Przepis:</label><br>
					<textarea  name="opis" id="opis" rows="10" cols="100" >'.$opis.'
					
					</textarea><br>
					
					<input type="submit" value="Modyfikuj">
					</form> ';
				}
			}
			*/
	}
	
}

function usun($id)
{
	$connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	
	if(!empty($id))
	{
		$sql = "DELETE FROM przepisy WHERE id=$id";
		$result = $connect->query($sql);
	}
}

function wyswietl()
{
	$connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	if(isset($_SESSION['login']))
	{
		$nazwa = $_SESSION['login'];
		$sql = "SELECT id FROM uzytkownicy where nazwaUzytkownika = '$nazwa'";
			
			$result = $connect->query($sql);
			
			if ($result->num_rows > 0)
			{
	  
				while($row = $result->fetch_assoc())
				{
					$userID =  $row['id'];	
				}
			}
			
		$sql = "SELECT * FROM przepisy where idUzytkownik='$userID'";

		$result = $connect->query($sql);

		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc())
			{
				$id = $row['id'];
				$tytul = $row['tytul'];
				$opis = $row['opis'];
				$image = $row['zdjecie'];
				$public = $row['publiczny'];
	
				echo "
				<div class='przepis bg-lightgreen'> 
					<p class='przepisTitle mx-auto-my-auto'>".$tytul."
						<div class='centerButtons'>
							<img class='recipeImage' src='images/".$image."' />
						</div>
					</p> 
					<textarea readonly rows='10' cols='30'>".$opis."</textarea>
					<div class='centerButtons'>
						<a href='#' onclick='modifyRecipe(".$id.",`".$tytul."`,`".$opis."`,`".$image."`)' data-bs-toggle='modal' data-bs-target='#modifyRecipeModal'><i class='bi bi-pencil'></i></a>
						<a href='#' onclick='deleteRecipe(".$id.")'><i class='bi bi-file-earmark-x'></i></a>
					</div>
					<input type='hidden' name='id' value='.$id.'/>
					
				</div>";
				
				
				
			}
		}
		else
		{
			echo "<b>Dodaj nowy przepis klikając w przycisk w prawym dolnym rogu ekranu.</b>";
		}
	}
	
	
}

function wyswietlWszystko()
{
	$connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	
			
			
			$sql = "SELECT uzytkownicy.nazwaUzytkownika,przepisy.tytul,przepisy.opis,przepisy.zdjecie,przepisy.publiczny FROM przepisy,uzytkownicy where uzytkownicy.id = przepisy.idUzytkownik ";
	
			$result = $connect->query($sql);
			
			if ($result->num_rows > 0) 
			{
				while($row = $result->fetch_assoc())
				{
					if($row["publiczny"]=="1")
					{
						
						$tytul = $row['tytul'];
						$opis = $row['opis'];
						$image = $row['zdjecie'];
						$autor = $row['nazwaUzytkownika'];
					
						
						echo "
						<div class='przepis bg-lightgreen'> 
							<p class='przepisTitle mx-auto-my-auto'>".$tytul."
								<div class='centerButtons'>
									<img class='recipeImage' src='images/".$image."' />
								</div>
							</p> 
							<textarea readonly rows='10' cols='30'>".$opis."</textarea>
							<center><b>Autor:  ".$autor."</b></center>
						</div>";
					}
				}
			}
			else
			{
			  echo "";
			}
	
}


?>



