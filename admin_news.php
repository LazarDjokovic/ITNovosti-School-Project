
        <div id="sadrzaj">
            <?php
				if(isset($_SESSION['email']) && $_SESSION['email']=='lakilazar1@gmail.com')
				{
					if(isset($_REQUEST['admin_obrisi']))
					{
						$upit="DELETE FROM news WHERE id_news='".$_REQUEST['admin_obrisi']."'";
						
						include('konekcija.php');
						$rezultat=mysql_query($upit,$konekcija);
						mysql_close($konekcija);
					}
					
					
					$upit_news="SELECT * FROM news";
					
					include('konekcija.php');
					$rezultat_news=mysql_query($upit_news,$konekcija);
					mysql_close($konekcija);
					
					
						echo("
							<div id='admin_sredina'>
							<div id='admin_users'>
								<h2>ADMIN PANEL ZA TABELU NEWS</h2><br/>
								<table border='3px solid #FFF'>
									<tr>
										<td>Naslov vesti</td>
										<td>Vest</td>
										<td>Postavio</td>
										<td>Vreme</td>
										<td>Izmeni</td>
										<td>Obriši</td>
									</tr>
							");
					
					while($red=mysql_fetch_array($rezultat_news))
					{
						$id_news=$red['id_news'];
						$title=$red['title'];
						$description=$red['description'];
						$email=$red['email'];
						$time=$red['time'];
					
						echo("
									<tr>
										<td>".$title."</td>
										<td>".$description."</td>
										<td>".$email."</td>
										<td>".$time."</td>
										<td><a href='index.php?page=15&id=$id_news'><img src='slike/admin_panel/edit.png' name='admin_izmeni'></a></td>
										<td><a href='index.php?page=8&admin_obrisi=$id_news'><img src='slike/admin_panel/error.png'></a></td>
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
       