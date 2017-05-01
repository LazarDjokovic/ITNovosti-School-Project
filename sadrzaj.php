
<div class="slajder">
	<ul>
		<li><img src='slike/laptop.jpg' width='100%' height='300px'/></li>
		<li><img src='slike/programing.jpg' width='100%' height='300px'/></li>
        <li><img src='slike/komponente.png' width='100%' height='300px'/></li>
	</ul>
</div>   

<div id='vesti'>
    
	<h1>NAJNOVIJE VESTI</h1><br/>
    <?php
    
        if(isset($_REQUEST['btnPostavi']))
        {
            $tbNaslov=$_REQUEST['tbNaslov'];
            $taSadrzaj=$_REQUEST['taSadrzaj'];
            
            
            
            $upit="INSERT INTO news (title, description, email) VALUES ('".$tbNaslov."','".$taSadrzaj."','".$_SESSION['email']."')";
            
            include('konekcija.php');
            $rezultat=mysql_query($upit,$konekcija);
            mysql_close($konekcija);
            
            
        }
    
        
/////////////////////////////// PAGINACIJA /////////////////////////////////////////////////////////////////////////////////////////
	
		include('konekcija.php');
		$sql=mysql_query("SELECT * FROM news ORDER BY time DESC",$konekcija); //uzimamo sve vesti izz baze
		mysql_close($konekcija);
		
		$nr=mysql_num_rows($sql); //prebrojimo redove
		if(isset($_GET['pn'])) //uzmemo vrednost iz URL adrese
		{
			$pn=preg_replace('#[^0-9]#i','',$_GET['pn']); //stavimo samo broj iz te vrednosti u promenljivu
		}
		else
		{
			$pn=1; //ako nema vrednosti znaci da je korisnik prvi put tu i dolazimo na prvo stranu
		}
		
		$items_per_page=5; 
		
		$last_page=ceil($nr/$items_per_page); //broj redova kroz broj vesti po strani
		if($pn<1)
		{
			$pn=1;
		}
		else if($pn>$last_page)
		{
			$pn=$last_page;
		}
		
		
		//////////////////////////////////////////////
		
		$center_pages=''; //prikaz brojeva stranica
		$sub1=$pn-1; //jedna manje
		$sub2=$pn-2;
		$add1=$pn+1; //jedna vise
		$add2=$pn+2;
		
		if($pn == 1)  //ako je na prvoj strani
		{
			$center_pages.="&nbsp; <span class='page_num_active'>$pn</span>&nbsp;"; //prikazemo taj broj gde se nalazi
			$center_pages.="&nbsp; <a style='color:#FFF;' href='".$_SERVER['PHP_SELF']."?page=0&pn=$add1'>$add1</a> &nbsp;"; //i opciju da doda jos jednu stranicu
		}
		else if($pn == $last_page) //ako je na zadnjoj strani
		{
			$center_pages.="&nbsp; <a style='color:#FFF;' href='".$_SERVER['PHP_SELF']."?page=0&pn=$sub1'>$sub1</a> &nbsp;"; //prikazemo opciju za jednu manje
			$center_pages.="&nbsp; <span class='page_num_active'>$pn</span>&nbsp;"; //i stranicu gde se sad nalazi
		}
		else if($pn > 2 && $pn < ($last_page-1))
		{
			$center_pages.="&nbsp; <a style='color:#FFF;' href='".$_SERVER['PHP_SELF']."?page=0&pn=$sub2'>$sub2</a> &nbsp;";
			$center_pages.="&nbsp; <a style='color:#FFF;' href='".$_SERVER['PHP_SELF']."?page=0&pn=$sub1'>$sub1</a> &nbsp;";
			$center_pages.="&nbsp; <span class='page_num_active'>$pn</span>&nbsp;";
			$center_pages.="&nbsp; <a style='color:#FFF;' href='".$_SERVER['PHP_SELF']."?page=0&pn=$add1'>$add1</a> &nbsp;";
			$center_pages.="&nbsp; <a style='color:#FFF;' href='".$_SERVER['PHP_SELF']."?page=0&pn=$add2'>$add2</a> &nbsp;";
		}
		else if($pn > 1 && $pn < $last_page)
		{
			$center_pages.="&nbsp; <a style='color:#FFF;' href='".$_SERVER['PHP_SELF']."?page=0&pn=$sub1'>$sub1</a> &nbsp;";
			$center_pages.="&nbsp; <span class='page_num_active'>$pn</span>&nbsp;";
			$center_pages.="&nbsp; <a style='color:#FFF;' href='".$_SERVER['PHP_SELF']."?page=0&pn=$add1'>$add1</a> &nbsp;";
		}
		
		/////////////////////////////////////////////////////
		
		//$limit="LIMIT ".($pn-1)*$items_per_page.",$items_per_page"; //stranica gde se nalazimo minus 1 puta broj vesti na jednojh stranici, od tog broja prikazi sledecih 10 vesti tj. items_per_page. Da je recimo broj bi 70, limit je 10 vesti pocevsi od 70-te vesti

		include('konekcija.php');
		$sql2=mysql_query("SELECT * FROM news ORDER BY time DESC LIMIT ".($pn-1)*$items_per_page.",$items_per_page",$konekcija); //uzimamo iste podatke iz baze sa limit
		mysql_close($konekcija);
		
		$pagination_display=''; //setujemo promenljivu
		
		if($last_page != "1") //ako ima vise od jedne strane, ako nema nista od ovoga se nece prikazati
		{
			$pagination_display.="Strana <strong>$pn</strong> od $last_page"; //prikaze stranu gde se nalazimo od kolikog broja strana
			
			if($pn != 1) //ako nismo na prvoj strani
			{
				$previous=$pn - 1;
				$pagination_display.="&nbsp; <a style='color:#FFF;' href='".$_SERVER['PHP_SELF']."?page=0&pn=$previous' class='nazad'>Nazad</a>"; //dodajemo na prethodni pagination_display, prikazacemo dugme nazad koje nas vodi na prethodnu stranicu
			}
			
			$pagination_display.="<span class='pagination_numbers'>$center_pages<span>"; //broj strane gde se nalazimo uvek ce biti u sredini
			
			if($pn != $last_page) //ako nismo na zadnjoj strani
			{ 
				$next_page=$pn+1;
				$pagination_display.="&nbsp; <a style='color:#FFF;' href='".$_SERVER['PHP_SELF']."?page=0&pn=$next_page' class='napred'>Napred</a>"; //dodajemo na prethodni pagination_display, prikazacemo dugme naprede koje nas vodi na prethodnu stranicu
			}
		}
		
		echo ("<div id='pagination'>$pagination_display</div>");
		
        while($red=mysql_fetch_array($sql2))
        {
            $id_vest=$red['id_news'];
			$title=$red['title'];
            $description=$red['description'];
            $email=$red['email'];
            $time=$red['time'];
            
            echo(
                " <div class='vest1'>
                <h2><a href='index.php?page=4&vest=$id_vest'>$title</a></h2><br/>
                <p>$description</p><br/>
				<p class='komentar_i_vreme'>Postavio: $email</p><br/>
				<p class='komentar_i_vreme'>Vreme: $time</p>
                </div>"
            );
        }
		
		if(isset($_SESSION['email']))
		{
		echo	("<div id='vest1'>
				<form action='".$_SERVER['PHP_SELF']."?page=0' method='GET' name='form_postavi_vest' id='form_postavi_vest'>
					<input type='hidden' name='page' value='0'/>
					<input type='text' name='tbNaslov' id='tbNaslov' placeholder='Unesite naslov vesti'/><br/>
					<textarea name='taSadrzaj' id='taSadrzaj' rows='5' cols='85' placeholder='Unesite vest'></textarea><br/>
					<input type='submit' name='btnPostavi' id='btnPostavi' value='Postavi vest'/>
			   </form>
		   </div>
			");
		}
        
    ?>
</div>