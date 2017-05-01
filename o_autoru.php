
        <div id="sredina_o_autoru">
           <div id='sadrzaj_o_autoru'>
				<div id="moja_slika">
					<img src="slike/lazar.jpg" id="lazar" width="300px" height="300px" title="lazar" alt="lazar"/>
				</div>
				<div id="o_autoru_opis">
					<p>Zovem se Lazar Đoković (13/14). Završio sam Srednju tehničku PTT školu smer 
					elektrotehničar telekomunikacija-ogled.
					Posle toga sam upisao Visoku ICT školu smer internet tehnologije.
					Trenutno sam na drugoj godini osnovnih studija. U dosadašnjem školovanju 
					najviše su mi se svideli predmeti vezani za web programiranje.
					<br/>
					<br/>
					<b>email:</b><a href="mailto:lazar.djokovic.13.14@ict.edu.rs?subject=Lotr site&body=Hi Lazar, " title="email"> lazar.djokovic.13.14@ict.edu.rs</a>
					</p>
				</div>
					<div id='rezultati_anketa'>
						<?php
							@session_start();
							if(isset($_REQUEST['rezultati_glasanja']))
								{
									$upit_da="SELECT id_poll FROM poll WHERE voted='1'";
									$upit_ne="SELECT id_poll FROM poll WHERE voted='2'";
									include('konekcija.php');
									$rezultat_da=mysql_query($upit_da,$konekcija);
									$rezultat_ne=mysql_query($upit_ne,$konekcija);
									mysql_close($konekcija);
											
									$red_da=mysql_num_rows($rezultat_da);
									$red_ne=mysql_num_rows($rezultat_ne);
										
											
									echo("
										<b><p style='color:#00FF00;'>Da $red_da glas(a)</p></b>
										<b><p style='color:#FF0000;'>Ne $red_ne glas(a)</p></b>
									");
								}
						?>
					</div>
					<?php
						if(isset($_SESSION['email']))
						{
							echo("
								<div id='anketa'>
								</div>
							");
						}
					?>
			
		   </div>
        </div>
        