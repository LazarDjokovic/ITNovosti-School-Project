<?php
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