<?php
	@session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
    <head>
        <title>ITNOVOSTI</title>
		
		<meta name="author" content="Lazar Đoković"/>
		<meta name="description" content="IT Novosti"/>
		<meta name="keywords" content="it,novosti,promene,komponente,kompjuteri"/>
        <link rel="stylesheet" href="lightbox.min.css">
		<script type="text/javascript" src="lightbox-plus-jquery.min.js"></script>
        <link rel="shortcut icon" href="slike/logo.png"/>
        <script type="text/javascript" src="jquery-1.12.1.min.js" ></script>
        <script type="text/javascript" src="mainJS.js" ></script>
		
		
        <link rel="stylesheet" href="unslider-master/dist/css/unslider.css">
        <link rel="stylesheet" href="unslider-master/dist/css/unslider-dots.css">
        

        <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="main.css">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    </head>
    <body  onLoad='ajax_anketa()'>
        <div id="header">
            <?php
                include('header.php');
            ?>
        </div>
        <div id="sadrzaj">
            <?php
				if(isset($_REQUEST['page']))
				{ 
					$page=$_REQUEST['page'];
				}else
				{
					$page=100;
				} 
                switch($page)
				{
					 case "0": include("sadrzaj.php");break;
					 case "1": include("galerija.php"); break; //galerija
					 case "2": include("kontakt.php"); break; //kontakt
					 case "3": include("o_autoru.php"); break; //o_autoru
					 case "4": include("vesti.php"); break; //vesti
					 case "5": include("profil.php"); break; 
					 case "6": include("jon_snow_is_allive.php"); break; 
					 case "7": include("admin_users.php"); break; 
					 case "8": include("admin_news.php"); break; 
					 case "9": include("admin_comments.php"); break; 
					 case "10": include("confirm.php"); break; 
					 case "11": include("register.php"); break; 
					 case "12": include("logout.php"); break; 
					 case "13": include("login.php"); break; 
					 case "14": include("admin_comments_izmeni.php"); break; 
					 case "15": include("admin_news_izmeni.php"); break; 
					 case "16": include("admin_users_izmeni.php"); break;
					 case "18": include("admin_dodaj_novog_korisnika.php"); break; 					 
					 default: include("sadrzaj.php");break;
				}
    
			?>
            
        </div>
        <div id="footer">
            <?php
                include('footer.php');
            ?>
        </div>
        <script src="lightbox-plus-jquery.min.js"></script>
        <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="unslider-master/dist/js/unslider-min.js"></script>
        <script>
		jQuery(document).ready(function($) {
			$('.slajder').unslider({
                    
                    autoplay:true,
                    speed: 0,
                    delay: 4000,
                    fluid: true,
                    dots: true,
                    arrows: true,
                    pause: true
                });
            self.animateFade = function(to) {
			//  If we want to change the height of the slider
			//  to match the current slide, you can set
			//  {animateHeight: true}
			self.animateHeight(to);

			var $active = self.$slides.eq(to).addClass(self.options.activeClass);

			//  Toggle our classes
			self._move($active.siblings().removeClass(self.options.activeClass), {opacity: 0});
			self._move($active, {opacity: 1}, false);
		};
		  });
	   </script>
    </body>
</html>