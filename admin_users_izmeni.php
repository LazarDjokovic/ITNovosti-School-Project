
        <div id="sadrzaj">
            <?php
				$id=@$_REQUEST['id'];
				if(isset($_SESSION['email']) && $_SESSION['email']=='lakilazar1@gmail.com')
				{
					if(isset($_REQUEST['btn_za_profilnu']))
					{
						$putanja=$_FILES['upload_slike']['name'];
						move_uploaded_file($_FILES['upload_slike']['tmp_name'],"slike/profilne/".$putanja);
						$upit = "UPDATE users SET profile_picture = '".$putanja."' WHERE id_users=$id";
						
						include('konekcija.php');
						mysql_query($upit,$konekcija);
						mysql_close($konekcija);
					}
					
					if(isset($_REQUEST['izmeni_podatke']))
					{
						$first_name2=$_REQUEST['admin_first_name'];
						$last_name2=$_REQUEST['admin_last_name'];
						$email2=$_REQUEST['admin_email'];
						$password2=$_REQUEST['admin_password'];
						$profile_description2=$_REQUEST['admin_profile_description'];
						$active2=$_REQUEST['admin_active'];
						
						$upit="UPDATE users SET first_name='".$first_name2."', last_name='".$last_name2."', email='".$email2."', password='".$password2."', profile_description='".$profile_description2."', active='".$active2."'  WHERE id_users=$id";
						
						include('konekcija.php');
						mysql_query($upit,$konekcija);
						mysql_close($konekcija);
					}
					
					
					$upit="SELECT * FROM users WHERE id_users='".$id."'";
					include('konekcija.php');
					$rezultat=mysql_query($upit,$konekcija);
					mysql_close($konekcija);
					
					$upload_slike='';
					$id_users='';
					
					
					
					echo("
								<div id='admin_sredina'>
								<div id='admin_users'>
									<h2>ADMIN PANEL ZA KORISNIKA</h2>
									<table border='3px solid #FFF'>
										<tr>
											<td>Ime</td>
											<td>Prezime</td>
											<td>Email</td>
											<td>Lozinka</td>
											<td>Opis</td>
											<td>Aktivan</td>
											<td>Izmeni</td>
											<td>Slika</td>
										</tr>
								");
					
					while($red=mysql_fetch_array($rezultat))
					{
						$id_users=$red['id_users'];
						$first_name=$red['first_name'];
						$last_name=$red['last_name'];
						$email=$red['email'];
						$password=$red['password'];
						$profile_description=$red['profile_description'];
						$profile_picture=$red['profile_picture'];
						$active=$red['active'];
						
						echo("
										<tr>
											<form action='".$_SERVER['PHP_SELF']."?page=16' method='POST'>
												<input type='hidden' name='page' value='16'/>
												<td><input type='text' value='".$first_name."' name='admin_first_name'></td>
												<td><input type='text' value='".$last_name."' name='admin_last_name'></td>
												<td><input type='text' value='".$email."' name='admin_email'></td>
												<td><input type='text' value='".$password."' name='admin_password'></td>
												<td><input type='text' value='".$profile_description."' name='admin_profile_description'></td>
												<td><input type='text' value='".$active."' name='admin_active' style='width:50px;'></td>
												<td><input type='submit' value='Izmeni' name='izmeni_podatke' id='izmeni_podatke'/></td>
												<input type='hidden' name='id' value='$id_users'/>
											</form>
											<td>
												<form action='".$_SERVER['PHP_SELF']."?page=16' method='POST' enctype='multipart/form-data'>
													<input type='hidden' name='page' value='16'/>
													<img src='slike/profilne/".$profile_picture."' width='50px' height='50px'><br/>
													<input type='file' name='upload_slike' id='upload_slike' class='izaberi_sliku'/><br/>
													<input type='submit' value='Postavite profilnu sliku' name='btn_za_profilnu' id='btn_za_profilnu' class='izaberi_sliku'/>
													<input type='hidden' name='id' value='$id_users'/>
												</form>
											</td>
										</tr><br/>
							");
					}
					echo("
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
        


