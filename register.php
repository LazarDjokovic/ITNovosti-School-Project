<?php
    if(isset($_REQUEST['registracija']))
    {
        $ime=trim($_REQUEST['ime']);
        $prezime=trim($_REQUEST['prezime']);
        $email2=trim($_REQUEST['email2']);
        $lozinka2=trim($_REQUEST['lozinka2']);
        $lozinkaPonovo=trim($_REQUEST['lozinkaPonovo']);
        $greske=array();
        
        $regIme="/^[A-Z]{1}[a-z]{2,20}$/";
        $regPrezime="/^[A-Z]{1}[a-z]{2,30}$/";
        $regEmail="/^[\w\.]+[\d]*@[\w]+\.\w{2,3}(\.[\w]{2})?$/";
        $regLozinka2="/^[\w\s\/\.\_\d]{4,}$/";
        
        if(!preg_match($regIme, $ime))
        {   
            $greske[]="Ime nije u dobrom formatu, mora  početi sa velikm slovom!";
        }
        
        if(!preg_match($regPrezime, $prezime))
        {
            $greske[]="Prezime nije u dobrom formatu, mora  početi sa velikm slovom!";
        }
        
        if(!preg_match($regEmail, $email2))
        {
            $greske[]="Email nije u dobrom formatu!";
        }
        
        if(!preg_match($regLozinka2, $lozinka2))
        {
            $greske[]="Loznika nije u dobro formatu. Mora imati slova i broj!";
        }
        
        if($lozinka2!=$lozinkaPonovo)
        {
            $greske[]="Lozinke se ne poklapaju!";
        }
        
        if(empty($greske))
        {   
            $lozinka2=md5($lozinka2);
            $upit="SELECT * FROM users WHERE email='".$email2."'";
            include("konekcija.php");
            $rezultat=mysql_query($upit, $konekcija);
            mysql_close($konekcija);
            
            if(mysql_num_rows($rezultat) == 0)
            {
                $upit="INSERT INTO users (id_users, first_name, last_name, email, password, profile_picture, id_role, active) VALUES (NULL, '".$ime."', '".$prezime."', '".$email2."', '".$lozinka2."','default.png', 1, 0)";
                
                include("konekcija.php");
                $rezultat=mysql_query($upit, $konekcija);
                mysql_close($konekcija);
                
                if(!$rezultat)
                {
                    header("location:index.php?page=11&message=Error: ".mysql_error());
                }
                else
                {
                    $to=$email2;
                    $subject='Registracija';
                    $message="<html><head></head><body style='font-family: Arial;'>
					<h1 style='text-align:center;'>Kliknite da potvrdite registraciju</h1>
					<div style='margin:0 auto;background-color:#006699;border-radius:5px;width:250px;height:50px;'>
						<p style='text-align:center;padding-top:15px;'><a href='http://lazardjokovic.byethost17.com/index.php?page=10&email=".$email2."&code=".$lozinka2."' style='color:#FFF;text-decoration:none'>POTVRDITE</p></a>
					</div>
					<p style='text-align:center;'>----------------ITNOVOSTI----------------</p>
					</body></html>
					";
                    
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;" . "\r\n";
					
                    if(mail($to,$subject,$message,$headers))
                    {
                        header("location:index.php?page=11&message=<div id='greske'>Aktivacioni link je poslat na vašu email adresu, kliknite i potvrdite vašu email adresu!</div>");
                    }
                    else
                    {
                        header("location:index.php?page=11&message=<div id='greske'>Registracija nije uspela!</div>");
                    }
                }
                
                
            }else
                {
                    header("location:index.php?page=11&message=<div id='greske'> Korisnik sa ovom email adresom već postoji, <br/> pokušajte sa nekom drugom email adresom!</div>");
                }
        }
        else
        {
            foreach($greske as $value)   
            {
                $pom_greske.="<div id='greske'>".$value."</div>";
                header("location:index.php?page=11&message=$pom_greske");
            }
        }
    }
?>
        <div id="sadrzaj">
            <header><?php if(isset($_REQUEST['message'])) echo $_REQUEST['message']; ?></header><br/>
            <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='POST'>
				<input type='hidden' name='page' value='11'/>
                <table id='tabelaRegistracija'>
                    <tr>
                        <th colspan='2'>Forma za registraciju</th>
                    </tr>
                    <tr>
                        <td>Ime: </td>
                        <td><input type='text' id='ime' name='ime'></td>
                    </tr>
                    <tr>
                        <td>Prezime: </td>
                        <td><input type='text' id='prezime' name='prezime'></td>
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td><input type='text' id='email2' name='email2'></td>
                    </tr>
                    <tr>
                        <td>Lozinka: </td>
                        <td><input type='password' id='lozinka2' name='lozinka2'></td>
                    </tr>
                    <tr>
                        <td>Lozinka ponovo: </td>
                        <td><input type='password' id='lozinkaPonovo' name='lozinkaPonovo'></td>
                    </tr>
                    <tr>
                        <td colspan='2' id='tdRegistracija'>
                            <input type='submit' value='Registruj se' name='registracija' id='registracija'/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>