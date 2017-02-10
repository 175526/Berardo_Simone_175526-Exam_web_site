function checkInputQty(qty){
	reg = /^[0-9]$/;
	if(reg.test(trim(qty)))
		return true;	
	else{
		window.alert("Devi inserire la quantita' desiderata per selzionare il prdotto (deve essere maggiore di 0)");
		return false;
	}
}