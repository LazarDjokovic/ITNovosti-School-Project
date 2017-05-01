
        <div id="sadrzaj">
            <?php
				if(isset($_SESSION['email']) && $_SESSION['email']=='lakilazar1@gmail.com')
				{
					if(isset($_REQUEST['admin_obrisi']))
					{
						$upit="DELETE FROM users WHERE id_users='".$_REQUEST['admin_obrisi']."'";
						
						include('konekcija.php');
						$rezultat=mysql_query($upit,$konekcija);
						mysql_close($konekcija);
					}
					
					$upit_users="SELECT * FROM users";
					
					include('konekcija.php');
					$rezultat_users=mysql_query($upit_users,$konekcija);
					mysql_close($konekcija);
				
					
						echo("
							<div id='admin_sredina'>
							<div id='admin_users'>
								<br/>
									<a href='index.php?page=18'><div id='dodaj_novog_korisnika' name='dodaj_novog_korisnika'><b>Dodaj novog korisnika</b></div></a>
								<br/>
								<h2>ADMIN PANEL ZA TABELU USERS</h2><br/>
								<table border='3px solid #FFF'>
									<tr>
										<td>Ime</td>
										<td>Prezime</td>
										<td>Email</td>
										<td>Opis</td>
										<td>Slika</td>
										<td>Izmeni</td>
										<td>Obriši</td>
									</tr>
							");
					while($red=mysql_fetch_array($rezultat_users))
					{
						$id_users=$red['id_users'];
						$first_name=$red['first_name'];
						$last_name=$red['last_name'];
						$email=$red['email'];
						$profile_description=$red['profile_description'];
						$profile_picture=$red['profile_picture'];
						
						
						echo("
									<tr>
										<td>".$first_name."</td>
										<td>".$last_name."</td>
										<td>".$email."</td>
										<td>".$profile_description."</td>
										<td><img src='slike/profilne/".$profile_picture."' width='50px' height='50px'></td>
										<td><a href='index.php?page=16&id=$id_users'><img src='slike/admin_panel/edit.png' name='admin_izmeni'></a></td>
										<td>
											<form action='".$_SERVER['PHP_SELF']."?page=7' method='POST'>
												<input type='hidden' name='page' value='7'/>
												<a href='index.php?page=7&admin_obrisi=$id_users'><img src='slike/admin_panel/error.png'></a>
											</form>
										</td>
									</tr>
						");
					}
					echo("
							</table><br/>
						</div>
						</div>
					");
				}
				else
				{
					header('Location:index.php?page=0');
				}
			?>
        </div>
        