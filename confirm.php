<?php
	$email2=$_REQUEST['email'];
    $code=$_REQUEST['code'];

    include('konekcija.php');
    $upit1="SELECT email, password FROM users WHERE email='".$email2."' AND password='".$code."'";
    $rezultat=mysql_query($upit1, $konekcija);

    if($rezultat)
    {
		include('konekcija.php');
		$upit = "UPDATE users SET active='1' WHERE email='".$email2."'";
		$rezultat2=mysql_query($upit, $konekcija); 
		mysql_close($konekcija);
		if($rezultat2)
		{
			header("location:index.php?page=11&message=<div id='uspesno'>Uspešno ste se registrovali, sade se možete ulogovati.</div>");
		}
		else
		{
			header("location:index.php?page=11&message=<div id='uspesno'>TEST</div>");
		}
    }
?>