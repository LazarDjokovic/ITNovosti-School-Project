<?php
	$page='';
	if(isset($_REQUEST['vest']))
	{
		$vest=$_REQUEST['vest'];
	}
	else if(isset($_REQUEST['vest_c']))  //ako smo vec zakomentarisali
	{
		$vest=$_REQUEST['vest_c'];
	}
?>

        <div id="sadrzaj_komentari">
            <?php
				$upit="SELECT * FROM news WHERE id_news='".$vest."'";
				include('konekcija.php');
				$rezultat=mysql_query($upit,$konekcija);
				mysql_close($konekcija);
				
				$title='';
				$description='';
				
				while($red=mysql_fetch_array($rezultat))
				{
					$title=$red['title'];
					$description=$red['description'];
					$email=$red['email'];
					$time=$red['time'];
				}
				
				
				if(isset($_REQUEST['postavi_komentar']))
				{
					$upit = "INSERT INTO comments (id_news, email, comment) VALUES ('".$_REQUEST['vest_c']."', '".$_SESSION['email']."', '".$_REQUEST['komentar']."')";
					include("konekcija.php");
					$rezultat = mysql_query($upit, $konekcija); 
					mysql_close($konekcija);
					//header("Location: $_SERVER[PHP_SELF]?vest=".$_REQUEST['vest_c']);
				}
				
				$upit = "SELECT  c.email  email, c.comment  comment, c.time  time, c.id_comments id_comments FROM comments c  INNER JOIN news n ON c.id_news=n.id_news WHERE c.id_news= $vest ORDER BY time DESC LIMIT 4";
				include('konekcija.php');
				$rezultat=mysql_query($upit,$konekcija);
				mysql_close($konekcija);
				
				$komentari_pom='';
				
				
				
				while($red=mysql_fetch_array($rezultat))
				{
					$email=$red['email'];
					$comment=$red['comment'];
					$time_comments=$red['time'];
				
					$komentari_pom.="<div id='postavljeni_komentari'>
										<p>$comment</p><br/>
										<p class='komentar_i_vreme'>Postavio: $email</p><br/>
										<p class='komentar_i_vreme'>Vreme: $time_comments</p>
									</div>";
							
				}
	
				if(isset($_SESSION['email']))
				{
					
					
					echo(
						" <div id='kliknuta_vest'>
							<h2>$title</h2><br/>
							<p>$description</p>
							$komentari_pom
							<form action='".$_SERVER['PHP_SELF']."?page=4' method='GET' id='forma_komentar' id='forma_komentar'>
								<input type='hidden' name='page' value='4'/>
								<textarea name='komentar' id='komentar' placeholder='Komentariši'></textarea><br/>
								<input type='hidden' name='vest_c' value='".$vest."'>
								<input type='submit' value='Postavi komentar' name='postavi_komentar' id='postavi_komentar'>
							</form>
						  </div>"
					);
					
					
				}
				else
				{
					echo(
						" <div id='kliknuta_vest'>
						<h2>$title</h2><br/>
						<p>$description</p>
						$komentari_pom <br/>
						<h2 id='moras_biti'>Moraš biti ulogovan da bi komentarisao</h2>
						</div>"
					);
				}
				
			?>
        </div>
        