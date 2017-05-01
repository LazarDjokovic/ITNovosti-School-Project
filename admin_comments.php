
        <div id="sadrzaj">
            <?php
				if(isset($_SESSION['email']) && $_SESSION['email']=='lakilazar1@gmail.com')
				{
					if(isset($_REQUEST['admin_obrisi']))
					{
						$upit="DELETE FROM comments WHERE id_comments='".$_REQUEST['admin_obrisi']."'";
						
						include('konekcija.php');
						$rezultat=mysql_query($upit,$konekcija);
						mysql_close($konekcija);
					}
					
					
					$upit_comments="SELECT * FROM comments";
					
					include('konekcija.php');
					$rezultat_comments=mysql_query($upit_comments,$konekcija);
					mysql_close($konekcija);
					
					
						echo("
							<div id='admin_sredina'>
							<div id='admin_users'>
								<h2>ADMIN PANEL ZA TABELU COMMENTS</h2><br/>
								<table border='3px solid #FFF'>
									<tr>
										<td>Postavio</td>
										<td>Komentar</td>
										<td>Vreme</td>
										<td>Izmeni</td>
										<td>Obriši</td>
									</tr>
							");
					
					while($red=mysql_fetch_array($rezultat_comments))
					{
						$id_comment=$red['id_comments'];
						$email=$red['email'];
						$comment=$red['comment'];
						$time=$red['time'];
					
						echo("
									<tr>
										<td>".$email."</td>
										<td>".$comment."</td>
										<td>".$time."</td>
										<td><a href='index.php?page=14&id=$id_comment'><img src='slike/admin_panel/edit.png' name='admin_izmeni'></a></td>
										<td>
											<form action='".$_SERVER['PHP_SELF']."?page=9' method='POST'>
												<input type='hidden' name='page' value='9'/>
												<a href='index.php?page=9&admin_obrisi=$id_comment'><img src='slike/admin_panel/error.png'></a>
											</form>
										</td>
									</tr>
						");
					}
					echo("
							</table>
							<br/>
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
    