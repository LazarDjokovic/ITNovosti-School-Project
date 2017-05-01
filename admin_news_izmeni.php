
        <div id="sadrzaj">
            <?php
				$id=@$_REQUEST['id'];
				
				if(isset($_SESSION['email']) && $_SESSION['email']=='lakilazar1@gmail.com')
				{
					if(isset($_REQUEST['izmeni_podatke']))
					{
						$title2=$_REQUEST['admin_title'];
						$description2=$_REQUEST['admin_description'];
						$email2=$_REQUEST['admin_email'];
						$time2=$_REQUEST['admin_time'];
						
						$upit="UPDATE news SET title='".$title2."', description='".$description2."', email='".$email2."', time='".$time2."' WHERE id_news=$id";
						
						include('konekcija.php');
						mysql_query($upit,$konekcija);
						mysql_close($konekcija);
					}
					
					
					$upit="SELECT * FROM news WHERE id_news='".$id."'";
					include('konekcija.php');
					$rezultat=mysql_query($upit,$konekcija);
					mysql_close($konekcija);
		
					
			
					echo("
								<div id='admin_sredina'>
								<div id='admin_users'>
									<h2>ADMIN PANEL ZA VESTI</h2>
									<table border='3px solid #FFF'>
										<tr>
											<td>Naslov vesti</td>
											<td>Vest</td>
											<td>Postavio</td>
											<td>Vreme</td>
											<td>Izmeni</td>
										</tr>
								");
					
					while($red=mysql_fetch_array($rezultat))
					{
						$title=$red['title'];
						$description=$red['description'];
						$email=$red['email'];
						$time=$red['time'];
						
						
						echo("
										<tr>
											<form action='".$_SERVER['PHP_SELF']."?page=15' method='POST'>
												<input type='hidden' name='page' value='15'/>
												<td><input type='text' value='".$title."' name='admin_title'></td>
												<td><input type='text' value='".$description."' name='admin_description'></td>
												<td><input type='text' value='".$email."' name='admin_email'></td>
												<td><input type='text' value='".$time."' name='admin_time'></td>
												<td><input type='submit' value='Izmeni' name='izmeni_podatke' id='izmeni_podatke'/></td>
												<input type='hidden' name='id' value='".$id."'/>
											</form>
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
        

