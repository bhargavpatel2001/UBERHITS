// James Ricci N00411900 

$(document).ready(init); 


function init(){ 


	$("button").click(validate); 
	

}

function validate(event){
	
	var language = $("input#lang").val();
	var valid = true;
	
	if(language == ""){
		
		$("input#lang").focus();
		$("input#lang").addClass("error");
		$("input#lang").attr("placeholder", "Required");
		valid = false;
		
		$( "input#lang" ).click(function() {
			$( this ).removeClass("error");
		});
		
	}
	
	if(valid){
		return true;
	}
	else{
		return false;
	}
	
}