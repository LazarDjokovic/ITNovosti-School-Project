<?php
	session_start();
	
	if(isset($_REQUEST['anketa_glasaj']))
	{
		$upit="SELECT * FROM poll WHERE email='".$_SESSION['email']."'";
		include('konekcija.php');
		$rezultat=mysql_query($upit,$konekcija);
		mysql_close($konekcija);
						
		if(mysql_num_rows($rezultat)==0)
		{
			$glas=$_REQUEST['anketa_radio'];
							
			$upit_upis_glasa="INSERT INTO poll VALUES('','".$glas."','".$_SESSION['email']."')";
			include('konekcija.php');
			mysql_query($upit_upis_glasa,$konekcija);
			mysql_close($konekcija);
								
			echo("
				<p style='color:#00FF00;'>Hvala sto ste glasali!</p>
			");
		}
		else
		{
			echo("
					<p style='color:#FF0000;'>Vec ste glasali!</p>
				");
		}
	}
	
	
	
	echo("
		<h1>Da li vam se svidja sajt?</h1><br/>
		<form action='' method='GET' name='anketa_form'>
			<input type='hidden' name='page' value='3'/>
			<input type='radio' name='anketa_radio' value='1' id='anketa_da'/>Da <br/>
			<input type='radio' name='anketa_radio' value='2' id='anketa_ne'/>Ne <br/><br/>
			<input type='button' value='Glasaj' name='anketa_glasaj' id='anketa_glasaj' style='background-color:#404040;color:#FFF;' onClick='anketa_glasanje()'/> &nbsp;&nbsp; <input type='submit' value='Vidi rezultate glasanja' name='rezultati_glasanja' id='rezultati_glasanja' style='background-color:#404040;color:#FFF;' onClick='anketa_rezultat()'/>
		</form>
	");
	
	
?>