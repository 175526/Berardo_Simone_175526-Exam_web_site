function validateNewInput(user, pass, repeat){
			
			var rePass = /^[0-9]{4,}$/;
			
			if(user==""){
			  window.alert("Attenzione! Nome utente non inserito!");
			return false;
			}
			else if(pass==""){
			  window.alert("Attenzione! Password non inserita!");
			return false;
			}
			else if(pass!=repeat){
			  window.alert("Attenzione! Le due password inserite devono essere UGUALI!");
			return false;
			}
			else if(checkUsername(user)!=true){
				window.alert("Attenzione! Username non e' nel formato corretto!");
				return false;
			}else if( rePass.test(pass)!=true){
				window.alert("Attenzione! Password non e' nel formato corretto");
				return false;
			}else
				return true;	
		}  
		
		function validateLoginInput(user, pass){
			
			var rePass = /^[0-9]{4,}$/;
			
			if(user==""){
			  window.alert("Attenzione! Nome utente non inserito!");
			return false;
			}
			else if(pass==""){
			  window.alert("Attenzione! Password non inserita!");
			return false;
			}
			else if(checkUsername(user)!=true){
				window.alert("Attenzione! Username non e' nel formato corretto!");
				return false;
			}else if( rePass.test(pass)!=true){
				window.alert("Attenzione! Password non e' nel formato corretto");
				return false;
			}else
				return true;	
		}  
		
	 function checkUsername(user){
		var flag = false
		var reUser_first_control = /^[a-zA-Z\$]{1,1}[a-zA-Z0-9\$]+$/;
		var reUser_number_control = /[0-9]+/;
		var reUser_lenght_control = /^[a-zA-Z0-9\$]{3,8}$/;
		var reUser_alfa_control = /[A-z\$]+/;
		
	
		if(reUser_first_control.test(user)==true){
			if(reUser_lenght_control.test(user)==true){
				if(reUser_number_control.test(user)==true){
					if(reUser_alfa_control.test(user)==true)
						flag=true;
				}
			}
		}
		return flag;
	 }
	 
	 function info_pass(){
		window.alert("La password deve contenere solo numeri e non avere lunghezza inferiore a 4");
	 }
	 function info_user(){
		window.alert("Il nickname deve essere lungo minimo 3 massimo 8 caratteri, deve cominciare con una lettera o con$ e puo' contenere sia lettere che numeri (almeno uno per tipo)");
	 }
	 
	 function clearNewText()
        {
		  var nomeutente = document.getElementById('user');
		  var password = document.getElementById('pass');
		  var repeat = document.getElementById('repeat'); 
		  nomeutente.value ='';
		  password.value='';
		  repeat.value='';
		  }
	function clearLoginText()
        {
		  var nomeutente = document.getElementById('user');
		  var password = document.getElementById('pass'); 
		  nomeutente.value ='';
		  password.value='';
		  }