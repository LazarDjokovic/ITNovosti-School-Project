<?php
    $konekcija=mysql_connect('sql203.byethost17.com','','');

   // $konekcija=new PDO('mysql:host=localhost:1234;dbname=itnovosti;', 'root', '');

    $baza=mysql_select_db('') or die ('Baza nije dostupna!');

    if(!$konekcija)
    {
        die('Istekla je konekcija sa bazom! '.mysql_error());
    }

	mysql_set_charset('utf8');
?>
