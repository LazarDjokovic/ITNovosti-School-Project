<?php
    if(isset($_REQUEST['prijaviSe']))
    {
        $email=strip_tags($_REQUEST['email']);
        $lozinka=strip_tags($_REQUEST['lozinka']);
        
        $email=stripslashes($email);
        $lozinka=stripslashes($lozinka);
		
        $lozinka=md5($lozinka);
		
        $upit="SELECT * FROM users WHERE email='".$email."' AND password='".$lozinka."' LIMIT 1";
        
		
        include('konekcija.php');
        $rezultat=mysql_query($upit, $konekcija);
        mysql_close($konekcija);
        
        $id='';
        $db_lozinka='';
		$db_email='';
		$db_active='';
		
        while($red=mysql_fetch_array($rezultat))
        {
            $id=$red['id_users'];
            $db_lozinka=$red['password'];
			$db_email=$red['email'];
			$db_active=$red['active'];
        }
        
	    if($db_lozinka=='' && $db_email=='')
        {
            header("location:index.php?page=11&message=<div id='greske'>Logovanje nije uspelo!</div>");
        }
        else if($lozinka==$db_lozinka && $email==$db_email && $db_active==1)
        {
            $_SESSION['email']=$email;  //ovde smo napravili globalne promenljive
            $_SESSION['id_users']=$id;
            header("location:index.php?page=0");
        }
		else
		{
			header("location:index.php?page=11&message=<div id='greske'>Logovanje nije uspelo!</div>");
		}
    }
?>
