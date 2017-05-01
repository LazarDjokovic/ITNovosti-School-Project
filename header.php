<?php

    include("login.php");
	
	

    if(!isset($_SESSION['id_users']))
    {
        echo("
		<div id='naslov'>
			<h1><a href='index.php?page=0'>ITNOVOSTI</a></h1>
				<div id='logovanje'>
					<form action='".$_SERVER['PHP_SELF']."?page=13' method='POST' id='forma' name='forma'>
						Email <input type='text' id='email' name='email'/>
						Lozinka <input type='password' id='lozinka' name='lozinka'/>
						<input type='submit' value='Prijavi se' id='prijaviSe' name='prijaviSe'/><br/>
						<a href='index.php?page=11'><input type='button' value='Registruj se' id='registrujSe' name='registrujSe' size='15px'/></a>
					</form>
				</div>
		</div>
		<div id='meni'>
			<ul>");
				$upit_meni="SELECT * FROM menus";
				include("konekcija.php");
				$rezultat_meni= mysql_query($upit_meni, $konekcija);  
				mysql_close($konekcija);
				
				while($red=mysql_fetch_array($rezultat_meni))
				{
					$link=$red['link'];
					$page=$red['page'];
					
					echo("
						<li><a href='".$link."'>".$page."</a></li>
					");
				}
				
				if(isset($_SESSION['email']) && $_SESSION['email']=='lakilazar1@gmail.com')
				{
					echo("
						<li><a href='index.php?page=6'>ADMIN</a></li>
					");
				}
				
				echo("
					</ul>
					</div>
				");
    }
    else
    {
		$upit = "SELECT * FROM users WHERE email = '".$_SESSION['email']."'";
		include("konekcija.php");
		$rezultat = mysql_query($upit, $konekcija);  
		mysql_close($konekcija);
			
		
	
		$slika = ''; 
		while($red = mysql_fetch_array($rezultat))
		{
			$slika .= $red['profile_picture'];  
		} 
		
		if($slika == '')
		{ 
			$mala_slika = "<img src='slike/default.png' alt='Vaša slika'  width='50px' height='50px'/>";   
		}else
		{ 
			$mala_slika = "<img src='slike/profilne/$slika' alt='Vaša slika'  width='50px' height='50px'/>";   
		} 
			
			
			echo("
			<div id='naslov'>
				<h1><a href='index.php?page=0'>ITNOVOSTI</a></h1>
					<div id='logovanje2'>
						<div id='gore'>
							<div id='levo'>
								<a href='index.php?page=5'>$mala_slika</a>
							</div>
							<div id='desno'>
								<ul>
									<li><a href='' id='adresa'>".$_SESSION['email']." &#9660;</a>
									<ul>
										<li><a href='index.php?page=5'>PROFIL</a></li>
										<li><a href='index.php?page=12'>ODJAVI SE</a></li>
									</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
			</div>
			<div id='meni'>
				<ul>");
					$upit_meni="SELECT * FROM menus";
					include("konekcija.php");
					$rezultat_meni= mysql_query($upit_meni, $konekcija);  
					mysql_close($konekcija);
				
					while($red=mysql_fetch_array($rezultat_meni))
					{
						$link=$red['link'];
						$page=$red['page'];
					
						echo("
							<li><a href='".$link."'>".$page."</a></li>
						");
					}
					
					if(isset($_SESSION['email']) && $_SESSION['email']=='lakilazar1@gmail.com')
					{
						echo("
							<li><a style='color:#FF0000;' href='index.php?page=6'>ADMIN</a></li>
						");
					}
					
					echo("
						</ul>
						</div>
					");
    }
	
	
	
	
?>



