$(document).ready(function(){
    $('#desno ul li').hover(function(){
        $(this).find('ul>li').stop(true,true).fadeToggle(400);
    });
});

//----------------------KONTAKT FORMA--------------------------------------------------------------------------------------------------------
function imeProvera()
		{
			var ime=document.getElementById("ime").value;
			var regIme=/^[A-Z]{1}[a-z]{2,20}$/;
			
			if(!regIme.test(ime)) 
			{ 
				document.getElementById("ime").style.borderColor="red";
			}
			else
			{
				document.getElementById("ime").style.borderColor="";
			}
		}
		
		function prezimeProvera()
		{
			var prezime=document.getElementById("prezime").value;
			var regPrezime=/^[A-Z]{1}[a-z]{2,20}$/;
			
			if(!regPrezime.test(prezime)) 
			{ 
				document.getElementById("prezime").style.borderColor="red";
			}
			else
			{
				document.getElementById("prezime").style.borderColor="";
			}
		}
		
		function emailProvera()
		{
			var email=document.getElementById("email_kontakt").value;
			var regEmail=/^[\w\.]+[\d]*@[\w]+\.\w{2,3}(\.[\w]{2})?$/; 
			
			if(!regEmail.test(email)) 
			{ 
				document.getElementById("email_kontakt").style.borderColor="red";
			}
			else
			{
				document.getElementById("email_kontakt").style.borderColor="";
			}
		}
		
		function datumProvera()
		{
			var datum=document.getElementById("datum").value;
			var regDatum=/^(19[5-9][0-9]|20[0-1][0-5])\-([1-9]|1[0-2])\-([1-9]|1[0-9]|2[0-9]|3[0-1])$/;
			
			if(!regDatum.test(datum)) 
			{ 
				document.getElementById("datum").style.borderColor="red";
			}
			else
			{
				document.getElementById("datum").style.borderColor="";
			}
		}
		
		
		
		
	
	function provera() {
		var ime=document.getElementById("ime").value;
		var prezime=document.getElementById("prezime").value;
		var email=document.getElementById("email_kontakt").value;
		var datum=document.getElementById("datum").value;
		var pol=document.getElementsByName("pol");
		var drzava=document.getElementById("drzava");
		var prostor=document.getElementById("prostor").value;
		
		
		var regIme=/^[A-Z]{1}[a-z]{2,20}$/;
		var regPrezime=/^[A-Z]{1}[a-z]{2,20}$/;
		var regEmail=/^[\w\.]+[\d]*@[\w]+\.\w{2,3}(\.[\w]{2})?$/; 
		var regDatum=/^(19[5-9][0-9]|20[0-1][0-5])\-([1-9]|1[0-2])\-([1-9]|1[0-9]|2[0-9]|3[0-1])$/;
		
		var greske=new Array();
		var brojac=0;
		
		if(!regIme.test(ime)) 
		{ 
			document.getElementById("ime").style.borderColor="red";
			brojac++;
		}
		else
		{
			document.getElementById("ime").style.borderColor="";
		}
		
		if(!regPrezime.test(prezime))
		{
			document.getElementById("prezime").style.borderColor="red";
			brojac++;
		}
		else
		{
			document.getElementById("prezime").style.borderColor="";
		}
		 
		
	/*-------------------------------------*/
		if(!regEmail.test(email))
		{
			document.getElementById("email_kontakt").style.borderColor="red";
			brojac++;
		}
		else
		{
			document.getElementById("email_kontakt").style.borderColor="";
		}
		
	/*----------------------------------------------------*/
		if(!regDatum.test(datum))
		{
			document.getElementById("datum").style.borderColor="red";
			brojac++;
		}
		else 
		{
			document.getElementById("datum").style.borderColor="";
		}
	/*--------------------------------------------------*/
		var izabrano="";
		for(var i=0;i<pol.length;i++) 
		{
			if(pol[i].checked)
			{
				izabrano=pol[i].value;
				break;
			}
		}
		if(izabrano=="") 
		{	
			document.getElementById("zvezda1").innerHTML="*";
			document.getElementById("zvezda2").innerHTML="*";
			brojac++;
		}
		else 
		{
			document.getElementById("zvezda1").innerHTML="";
			document.getElementById("zvezda2").innerHTML="";
		}
	/*---------------------------------------------------------*/
		if(drzava.selectedIndex=="0")
		{
			document.getElementById("drzava").style.borderColor="red";
			brojac++;
		}
		else 
		{
			document.getElementById("drzava").style.borderColor="";
		}
	/*--------------------------------------------------*/
		if(prostor=="")
		{
			document.getElementById("prostor").style.borderColor="red";
			brojac++;
		}
		else 
		{
			document.getElementById("prostor").style.borderColor="";
		}

		

		
		if(brojac!=0){
			return false;
		}else{
			return true;
		}

	}
	
//----------------------KONTAKT FORMA--------------------------------------------------------------------------------------------------------

//----------------------O AUTORU ANKETA------------------------------------------------------------------------------------------------------

var http;
function ajax_anketa()
{
	if(window.XMLHttpRequest)
	{
		http=new XMLHttpRequest();
	}
	else
	{
		http=new ActiveXObejct("Microsoft.XMLHTTP");
	}
	http.open("GET","poll.php",true);
	http.send();
	http.onreadystatechange=ispisi_anketu; //samo se ovde funkcija pise bez ()
}

function ispisi_anketu()
{
	if(http.readyState==4)
	{
		document.getElementById("anketa").innerHTML=http.responseText; //ono sto je dovukao iz poll.php tj sa servera, kod XML-a je bilo responseXML
	}
}

function anketa_glasanje()
{
	if(window.XMLHttpRequest)
	{
		http=new XMLHttpRequest;
	}
	else
	{
		http=new ActiveXObejct("Microsoft.XMLHTTP");
	}
	http.open("GET","poll.php?anketa_radio="+uzmi_broj()+"&anketa_glasaj=Glasaj",true);
	http.send();
	http.onreadystatechange=ispisi_anketu;
}

function uzmi_broj()
{
	var broj=0;
	
	if(document.getElementById("anketa_da").checked)
	{
		broj=document.getElementById("anketa_da").value;
	}
	else
	{
		broj=2;
	}
	
	return broj;
}



//----------------------O AUTORU ANKETA------------------------------------------------------------------------------------------------------