setInterval(function() {

	$.ajax({            
           url: "index.php", 
        type: "POST",          
        url: 'checkSession.php', 
            success: function( data ) { 
				console.log(data);
				if(data.trim().indexOf("fail") > -1){
					alert("Your session has expired");
					location.replace("index.php");
				}
            }
         
        }); 
  }, 2000);