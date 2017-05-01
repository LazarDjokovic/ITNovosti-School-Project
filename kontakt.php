
        <div id="sredina_kontakt">
           <div id='sadrzaj_kontakt'>
		   <?php
					if(isset($_REQUEST['posalji_formu']))
					{
						$ime=$_REQUEST['ime'];
						$prezime=$_REQUEST['prezime'];
						$email_kontakt=$_REQUEST['email_kontakt'];
						$datum=$_REQUEST['datum'];
						$pol=$_REQUEST['pol'];
						$drzava=$_REQUEST['drzava'];
						$komentar=$_REQUEST['prostor'];
						
						$poruka="<html><head></head><body>
						<div style='margin:0 auto;margin-top:50px;'>
						<p style='font-size: 30px;text-align:center;margin-bottom:50px;'>Ime: ".$ime."</p>
						<p style='font-size: 30px;text-align:center;margin-bottom:50px;'>Prezime: ".$prezime."</p>
						<p style='font-size: 30px;text-align:center;margin-bottom:50px;'>Email:".$email_kontakt."</p>
						<p style='font-size: 30px;text-align:center;margin-bottom:50px;'>Datum rođenja:".$datum."</p>
						<p style='font-size: 30px;text-align:center;margin-bottom:50px;'>Pol:".$pol."</p>
						<p style='font-size: 30px;text-align:center;margin-bottom:50px;'>Država:".$drzava."</p>
						<p style='font-size: 30px;text-align:center;margin-bottom:50px;'>Komentar:".$komentar."</p>
						</div></body></html>";

						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;" . "\r\n";
						 
						mail("lakilazar1@gmail.com","Kontakt forma | ITNOVOSTI",$poruka,$headers);
					}
				?>
				
				<form action='index.php?page=2' method='POST' onSubmit="return provera();">
					<input type='hidden' name='page' value='2'/>
					<table width="600px" height="700px" border="1px">
						<tr>
							<th colspan="2" id="th_form"><h1>KONTAKT FORMA</h1></th>
						</tr>
						<tr>
							<td><label for="f_name">Ime:</label></td>
							<td><input type="text" name="ime" id="ime" onBlur="imeProvera();"/>
						</tr>
						<tr>
							<td><label for="l_name">Prezime:</label></td>
							<td><input type="text" name="prezime" id="prezime"  onBlur="prezimeProvera();"/>
						</tr>
						<tr>
							<td><label for="email">Email:</label></td>
							<td><input type="text" name="email_kontakt" id="email_kontakt" onBlur="emailProvera();"/>
						</tr>
						<tr>
							<td><label for="birth">Datum rodjenja:</label><br/>(YYYY-M-D)</td>
							<td><input type="text" name="datum" id="datum" onBlur="datumProvera();"/>
						</tr>
						<tr>
							<td>Pol:</td>
							<td>
								&nbsp;&nbsp;<input type="radio" name="pol" id="pol1" value="Muški"/><label for="gender1"> Muški</label><span style="color:#FF0000;" id="zvezda1"></span><br/>
								&nbsp;&nbsp;<input type="radio" name="pol" id="pol2" value="Ženski"/><label for="gender2"> Ženski</label><span style="color:#FF0000;" id="zvezda2"></span>
							</td>
						</tr>
						<tr>
							<td>Država:</td>
							<td>
								<select name="drzava" id="drzava">
									<option value="">Izaberi...</option>
									<?php
										$upit = "SELECT * FROM states ORDER BY state";
										include('konekcija.php');
										$rezultat=mysql_query($upit,$konekcija);
										mysql_close($konekcija);
										
										while($red=mysql_fetch_array($rezultat))
										{
											echo "<option value='".$red['id_state']."'>".$red['state']."</option>";
										}
										
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<p>Komentar:</p>
							</td>
							<td>
								<textarea name="prostor" id="prostor" rows="10" cols="30"></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center"><input type="submit" value="Pošalji" id="posalji_formu" name='posalji_formu' class="button"/>
							</td>
						</tr>
					</table>				
				</form>
		   </div>
        </div>
       