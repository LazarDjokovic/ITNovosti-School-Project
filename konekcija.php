<?php
    $konekcija=mysql_connect('','','');

    $baza=mysql_select_db('') or die ('Baza nije dostupna!');

    if(!$konekcija)
    {
        die('Istekla je konekcija sa bazom! '.mysql_error());
    }

	mysql_set_charset('utf8');
?>
