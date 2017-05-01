
        <div id="sredina_galerija">
			<div id='galerija_sadrzaj'>
						<h2>Slike naših korisnika</h2>
						<?php
							$upit="SELECT * FROM users";
							include('konekcija.php');
							$rezultat=mysql_query($upit,$konekcija);
							mysql_close($konekcija);
							
							while($r=mysql_fetch_array($rezultat))
							{
								echo("
									<div id='slika_korisnika'>
										<a href='slike/profilne/".$r['profile_picture']."' class='example-image-link' data-lightbox='example-set' data-title='T".$r['first_name']."'><img src='slike/profilne/".$r['profile_picture']."' width='150px' height='150px' class='example-image' alt='slika_korisnika'/></a><br/>
										".$r['first_name']."
									</div>
								");
							}
						?>
			</div>
        </div>
        