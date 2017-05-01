
        <div id="sadrzaj">
            <?php
				if(isset($_SESSION['email']) && $_SESSION['email']=='lakilazar1@gmail.com')
				{
					if(isset($_REQUEST['dodaj_novog_korisnika']))
					{
						$ime=$_REQUEST['admin_dodaj_ime'];
						$prezime=$_REQUEST['admin_dodaj_prezime'];
						$email=$_REQUEST['admin_dodaj_email'];
						$lozinka=$_REQUEST['admin_dodaj_lozinku'];
						$opis=$_REQUEST['admin_dodaj_opis'];
						
						$upit="INSERT INTO users VALUES ('','".$ime."','".$prezime."','".$email."','".md5($lozinka)."','".$opis."','default.png',2,1)";
						
						include('konekcija.php');
						mysql_query($upit,$konekcija);
						mysql_close($konekcija);
						
					}
					
					echo("
					<div id='admin_sredina'>
							<div id='admin_users'>
								<h2>ADMIN PANEL ZA DODAVANJE NOVOG KORISNIKA</h2><br/>
								<table border='3px solid #FFF'>
									<tr>
										<td>Ime</td>
										<td>Prezime</td>
										<td>Email</td>
										<td>Lozinka</td>
										<td>Opis</td>
										<td>Dodaj</td>
									</tr>
									<tr>
											<form action='".$_SERVER['PHP_SELF']."?page=18' method='POST'>
												<input type='hidden' name='page' value='18'/>
												<td><input type='text' name='admin_dodaj_ime' style='width:150px;'></td>
												<td><input type='text' name='admin_dodaj_prezime' style='width:150px;'></td>
												<td><input type='text' name='admin_dodaj_email' style='width:150px;'></td>
												<td><input type='password' name='admin_dodaj_lozinku' style='width:150px;'></td>
												<td><input type='text' name='admin_dodaj_opis' style='width:150px;'></td>
												<td><input type='submit' value='Dodaj' name='dodaj_novog_korisnika' style='width:100px;height:30px;background-color:#404040;color:#FFF;font-size:20px;'/></td>
											</form>
										</tr>
								</table>
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
        