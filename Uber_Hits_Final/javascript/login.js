// James Ricci N00411900 

$(document).ready(init); 


function init(){ 


	$("button").click(validate); 
	

}

function validate(event){
	
	//Retrieve values from input fields and store them in variables
	var username = $("input#username").val();
	var password = $("input#password").val();
	
	//Keeps track of validation
	var valid = true;
	
	
	//Checks for null and numeric values in string
	if (username == "" || /^[a-zA-Z][a-zA-Z0-9]+/.test(username) != true){ 

		//Returns focus to field
		$("input#username").focus();
		//Changes class to error which is defined in style.css
		$("input#username").addClass("error");
		
		//Determines if null or numeric, clears field if required and displays appropriate text
		if(username==""){
			
			$("input#username").attr("placeholder", "Required");
		}
		else{
			
			$("input#username").val("");
			$("input#username").attr("placeholder", "Must begin with letter, alphanumeric only, no spaces");
		}
		 	
		valid = false;
		
		//Removes error class when user clicks to fill in field
		$( "input#username" ).click(function() {
			$( this ).removeClass("error");
		});

	}
	
	//Uses RegExp to check for letters, numbers, special characters and minimum length
	//Changes placeholder message accordingly
	if (password == "" || 
		/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,16}$/.test(password) != true){ 

		$("input#name").focus(); 
		$("input#password").addClass("error");
		
		if(password == ""){
			
			$("input#password").attr("placeholder", "Required");
		}
		else if (password.length < 8){
			
			$("input#password").val("");
			$("input#password").attr("placeholder", "Must be 8-16 characters");
		}
		else{
			
			$("input#password").val("");
			$("input#password").attr("placeholder", "Must contain at least one number, letter and special character");
		}
		

		valid = false;
		
		$( "input#password" ).click(function() {
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