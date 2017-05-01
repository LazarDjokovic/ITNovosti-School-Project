<div id='meniFooter'>
     <ul>
        <?php
			@session_start();
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
		?>
		<li><a href='dokumentacija.pdf'>Dokumentacija</a></li>
    </ul>
</div>
<div id='drustveneMreze'>
    <a href='https://www.facebook.com/'><img src='slike/fblogo.png' width='30px' height='30px'/></a>
    <a href='https://www.twitter.com/'><img src='slike/twitterlogo.png' width='30px' height='30px' class='logo'/></a>
    <a href='https://www.youtube.com/'><img src='slike/youtubelogo.png' width='30px' height='30px' class='logo'/></a>
</div>
<div id='copyright'>
    Copyrights &copy; All Rights Reserved. Designed by: <a href='index.php?page=3'>Lazar Đoković</a>
</div>