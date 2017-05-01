
        <div id="sadrzaj">
            <?php
				if(isset($_SESSION['email']) && $_SESSION['email']=='lakilazar1@gmail.com')
				{
						echo("
							<div id='admin_sredina'>
								<div id='admin_sadrzaj'>
									<a href='index.php?page=7'><div class='okvir'><h1>Korisnici</h1></div></a>
									<a href='index.php?page=8'><div class='okvir'><h1>Vesti</h1></div></a>
									<a href='index.php?page=9'><div class='okvir'><h1>Komentari</h1></div></a>
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
        