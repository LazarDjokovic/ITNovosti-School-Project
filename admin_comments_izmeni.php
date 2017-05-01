
        <div id="sadrzaj">
            <?php
				$id=@$_REQUEST['id'];
				if(isset($_SESSION['email']) && $_SESSION['email']=='lakilazar1@gmail.com')
				{
					if(isset($_REQUEST['izmeni_podatke']))
					{
						$email2=$_REQUEST['admin_email'];
						$comment2=$_REQUEST['admin_comment'];
						$time2=$_REQUEST['admin_time'];
						
						$upit="UPDATE comments SET email='".$email2."', comment='".$comment2."', email='".$email2."', time='".$time2."' WHERE id_comments=$id";
						
						include('konekcija.php');
						mysql_query($upit,$konekcija);
						mysql_close($konekcija);
					}
					
					
					$upit="SELECT * FROM comments WHERE id_comments='".$id."'";
					include('konekcija.php');
					$rezultat=mysql_query($upit,$konekcija);
					mysql_close($konekcija);
		
					
			
					echo("
								<div id='admin_sredina'>
								<div id='admin_users'>
									<h2>ADMIN PANEL ZA KOMENTARE</h2>
									<table border='3px solid #FFF'>
										<tr>
											<td>Postavio</td>
											<td>Komentar</td>
											<td>Vreme</td>
											<td>Izmeni</td>
										</tr>
								");
					
					while($red=mysql_fetch_array($rezultat))
					{
						$id_comment=$red['id_comments'];
						$email=$red['email'];
						$comment=$red['comment'];
						$time=$red['time'];
						
						echo("
										<tr>
											<form action='".$_SERVER['PHP_SELF']."?page=14' method='POST'>
												<input type='hidden' name='id' value='$id'/>
												<input type='hidden' name='page' value='14'/>
												<td><input type='text' value='".$email."' name='admin_email'></td>
												<td><input type='text' value='".$comment."' name='admin_comment'></td>
												<td><input type='text' value='".$time."' name='admin_time'></td>
												<td><input type='submit' value='Izmeni' name='izmeni_podatke' id='izmeni_podatke'/></td>
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
        
