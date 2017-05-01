
    <?php
	
	$zola = @$_REQUEST['promenljiva'];
	if($zola == 'zola')
	{
		move_uploaded_file($_FILES['upload_slike']['tmp_name'],"slike/profilne/".$_FILES['upload_slike']['name']);
		$upit = "UPDATE users SET profile_picture = '".$_FILES['upload_slike']['name']."' WHERE email = '".$_SESSION['email']."'";
		include("konekcija.php");
		$rezultat = mysql_query($upit, $konekcija);  
		mysql_close($konekcija);
		header('Location:index.php?page=5');
	}
	
    $upit_kom="SELECT * FROM comments c JOIN news n ON c.id_news=n.id_news WHERE c.email='".$_SESSION['email']."' ORDER BY c.time DESC LIMIT 3";
	
	include('konekcija.php');
	$rezultat_kom=mysql_query($upit_kom,$konekcija);
    mysql_close($konekcija);
	
	$komentari_pom='';
	while($red=mysql_fetch_array($rezultat_kom))
	{
		$comment=$red['comment'];
		$time=$red['time'];
		$id_news=$red['id_news'];
		$title=$red['title'];
				
		$komentari_pom.="
			<div id='vasi_komentari2'>
				<p>$comment</p><br/>
				<p class='komentar_i_vreme'>Link ka vesti:<a href='index.php?page=4&vest=$id_news' style='color:#FFCC00;text-decoration:none'>$title</a></p></br>
				<p class='komentar_i_vreme'>Vreme: $time</p>
			</div>";
	}
	
	$user_desc='';
	
	if(isset($_REQUEST['promeni_opis']))
	{
		$user_desc=$_REQUEST['novi_opis'];
		
		$upit="UPDATE users SET profile_description='".$user_desc."' WHERE email='".$_SESSION['email']."' LIMIT 1";
		
		include('konekcija.php');
		$rezultat=mysql_query($upit,$konekcija);
		mysql_close($konekcija);
	}
	
    if(isset($_REQUEST['postavi_opis']))
    {
        $ta_opis_profila=$_REQUEST['ta_opis_profila'];
        
        $upit="UPDATE users SET profile_description='".$ta_opis_profila."' WHERE email='".$_SESSION['email']."' LIMIT 1";
            
        include('konekcija.php');
        $rezultat=mysql_query($upit,$konekcija);
        mysql_close($konekcija);    
    }
	
	$upit = "SELECT * FROM users WHERE email = '".$_SESSION['email']."'";
			include("konekcija.php");
			$rezultat = mysql_query($upit, $konekcija);  
			mysql_close($konekcija);
			
		
	
	$slika = ''; 
	while($red = mysql_fetch_array($rezultat))
	{
		$slika .= $red['profile_picture'];  
	} 
	
	if($slika == ''){ 
		$mala_slika = "<img src='slike/profilne/default.png' alt='Vaša slika' name='profilna_slika' id='profilna_slika' width='100px' height='100px'/>";   
	}else{ 
		$mala_slika = "<img src='slike/profilne/$slika' alt='Vaša slika' name='profilna_slika' id='profilna_slika' width='100px' height='100px'/>";   
	} 
	
	include('konekcija.php');
	$rezultat_opis=mysql_query("SELECT profile_description FROM users WHERE email='".$_SESSION['email']."'",$konekcija);
	mysql_close($konekcija);
	
	$user_desc = mysql_fetch_array($rezultat_opis)['profile_description'];
	if(strlen($user_desc)==0){
		echo ("
        <div id='sadrzaj_profil'>
        <div id='div_za_profil'>
                <div id='gore_za_profil'>
                    <div id='slika_i_dugme'>
                        <form action='".$_SERVER['PHP_SELF']."' method='POST' enctype='multipart/form-data'>
							<input type='hidden' name='page' value='5'/>
							<input type='hidden' name='promenljiva' value='zola'/>
							$mala_slika<br/>
							<input type='file' name='upload_slike' id='upload_slike' class='izaberi_sliku' style='background-color: #404040;color:#FFF;'/>
							<input type='submit' value='Postavite profilnu sliku' name='btn_za_profilnu' id='btn_za_profilnu' class='izaberi_sliku'/>
						</form>
                    </div>
                    <div id='opis_profila'>
                        <form action='' method='GET'>
						  <input type='hidden' name='page' value='5'/>
                          <textarea id='ta_opis_profila' name='ta_opis_profila' placeholder='Postavite vaš opis' cols='60' rows='3'></textarea><br/>
                          <input type='submit' name='postavi_opis' id='postavi_opis' value='Postavite opis'/>
                        </form>
                    </div>
                </div>
                <div id='dole_za_profil'>
                    <div id='vasi_komentari'>
                        <h2>Vaši komentari</h2>
						$komentari_pom
                    </div>
                </div>
            </div>
            </div>
        ");
	}
	else{
		echo("
        <div id='sadrzaj_profil'>
			<div id='div_za_profil'>
                <div id='gore_za_profil'>
                    <div id='slika_i_dugme'>
                       <form action='".$_SERVER['PHP_SELF']."' method='POST' enctype='multipart/form-data'>
							<input type='hidden' name='page' value='5'/>
							<input type='hidden' name='promenljiva' value='zola'/>
							$mala_slika<br/>
							<input type='file' name='upload_slike' id='upload_slike' class='izaberi_sliku'>
							<input type='submit' value='Postavite profilnu sliku' name='btn_za_profilnu' id='btn_za_profilnu' class='izaberi_sliku'/>
						</form>
                    </div>
                    <div id='opis_profila'>
                        <h2>Vaš opis</h2>
						<form action='' method='POST'>
							<input type='hidden' name='page' value='5'/>
							<input type='text' value='".$user_desc."'style='width:585px;height:50px;margin-left:15px;background-color:#101010;color:#FFF;border:none;' id='novi_opis' name='novi_opis'/><br/><br/>
							<input type='submit' value='Promeni opis' style='margin-left:15px;background-color:#404040;color:#FFF;' name='promeni_opis' id='promeni_opis'/>
						</form>
                    </div>
                </div>
                <div id='dole_za_profil'>
                    <div id='vasi_komentari'>
                        <h2>Vaši komentari</h2>
						$komentari_pom
                    </div>
                </div>
            </div>
        </div>
        ");
	}
	
	
	
?>
            
       
        