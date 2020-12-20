<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'przepisy');
 
 
$connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($connect === false)
{
    die("ERROR: Błąd przy łączeniu z bazą danych. " . mysqli_connect_error());
}

function logowanie()
{
	$connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	if (isset($_POST['login2']))
	{
        $uzytkownik = ($_POST['login2']);
        $haslo = ($_POST['password3']);
      
        $sql    = "SELECT * FROM `uzytkownicy` WHERE nazwaUzytkownika='$uzytkownik'
                     AND haslo='$haslo'";
					 
        $result = mysqli_query($connect, $sql) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1)
		{
            $_SESSION['login'] = $uzytkownik;
			
       
            header("Location: index.php");
        } 
		else
		{
            echo " <h3>Nieprawidłowa nazwa użytkownika lub hasło</h3><br/>
                 <a href='index.php'>Kliknij tutaj, aby zalogować się ponownie</a> .";
        }
    }
	/*else
	{
	echo  "<h3>Pole login puste</h3>";
	}*/
}


function rejestracja()
{
	$connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	
	if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['password2'])  )
	{
		$uzytkownik = ($_POST['login']);
		$haslo = ($_POST['password']);
		$haslo2 = ($_POST['password2']);
		
		if($haslo == $haslo2)
			
		{
		$sql    = "INSERT into `uzytkownicy` (nazwaUzytkownika, haslo)
					 VALUES ('$uzytkownik', '$haslo')";
		$result   = mysqli_query($connect, $sql);
		}
		
		if (isset($result))
		{
			echo "<h3>Zostałeś pomyślnie zarejestrowany</h3></br>
				  <a href='index.php'>Kliknij tutaj, aby się zalogować </a>";
		} 
		elseif($haslo !=$haslo2)
		{
			echo "<h4>Hasła muszą być takie same</h4>";
		}
		else 
		{
			echo "<h3>Brak wymaganych pól.</h3></br>
				  <a href='index.php'>Kliknij tutaj, aby zarejestrować się jeszcze raz</a>";		  
		}	
    }
	/*
	{
		
		 echo "<h3>Pole login jest puste.</h3></br>
                  <a href='index.php'>Kliknij tutaj, aby zarejestrować się jeszcze raz</a>";
	}*/
	if(isset($_POST['id']) && isset($_POST['tytul']) && isset($_POST['opis']))
	{
		$id= $_POST['id'];
		$tytul= $_POST['tytul'];
		$opis= $_POST['opis'];
		$sql = "UPDATE przepisy SET tytul='$tytul', opis='$opis' WHERE id=$id";
		$result = $connect->query($sql);
	}
		
}

		
?>