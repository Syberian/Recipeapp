
<?php
$test = "";
if(isset($_POST['ondelete']))
{
	usun($_POST['ondelete']);
}

if(isset($_POST['onmodify']))
{
	
}

function dodaj()
{
	$connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	
    if(isset($_POST['tytul']) && isset($_POST['opis'])&& empty($_POST['id']))
	{
		$tytul = $_POST['tytul'];
		$opis = $_POST['opis'];
		$autor = $_SESSION['login'];
		
		$sql = "SELECT id FROM uzytkownicy where nazwaUzytkownika = '$autor'";
		
		$result = $connect->query($sql);
		
		if ($result->num_rows > 0)
		{
  
			while($row = $result->fetch_assoc())
			{
				$userID =  $row['id'];	
			}
		}
		
		$sql = "INSERT INTO przepisy (idUzytkownik,tytul,opis,autor)
		VALUES ('$userID', '$tytul', '$opis','$autor')";
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
		
		
		$sql = "UPDATE przepisy SET tytul = '$tytul', opis = '$opis' WHERE id='$id'";
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
					/*
							<div class="przepis bg-lightgreen">

								<p class="przepisTitle mx-auto my-auto">Testowy przepis</p>

								<textarea readonly rows="10" cols="30" ></textarea>

							</div> 
					*/
					echo "
					<div class='przepis bg-lightgreen'> 
						<p class='przepisTitle mx-auto-my-auto'>".$tytul."

						</p> 
						<textarea readonly rows='10' cols='30'>".$opis."</textarea>
						<div class='centerButtons'>
							<a href='#' onclick='modifyRecipe(".$id.",`".$tytul."`,`".$opis."`)' data-bs-toggle='modal' data-bs-target='#modifyRecipeModal'><i class='bi bi-pencil'></i></a>
							<a href='#' onclick='deleteRecipe(".$id.")'><i class='bi bi-file-earmark-x'></i></a>
						</div>
						<input type='hidden' name='id' value='.$id.'/>
						
					</div>";
					
					
					
				}
			}
}

function wyswietlWszystko()
{
	$connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	
	$sql = "SELECT nazwaUzytkownika FROM uzytkownicy";
			
			$result = $connect->query($sql);
			
			if ($result->num_rows > 0)
			{
	  
				while($row = $result->fetch_assoc())
				{
					$userName =  $row['nazwaUzytkownika'];	
					
				}
			}
			
			
			$sql = "SELECT idUzytkownik,tytul,opis,autor FROM przepisy ";
	
			$result = $connect->query($sql);

			if ($result->num_rows > 0) 
			{
				while($row = $result->fetch_assoc())
				{
					echo "<h5>Tytuł:</h5>" . $row["tytul"]. " <h5>Opis:</h5>". $row["opis"]."<h5>Autor:</h5>".$row["autor"]."<br><br>"  ;
				}
			}
			else
			{
			  echo "Brak przepisów";
			}
	
}


?>



