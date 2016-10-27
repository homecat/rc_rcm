//牌照、结算货币、杠杆选项

function license_change()
{
	
	var txta = document.getElementsByName("b");
	var txtb = document.getElementsByName("a");
	var txtc = document.getElementsByName("c");
	if(document.getElementById("license").value== "")
	{
		txtc[0].selected="selected";
		txtc[1].selected="selected";
		 for(i = 0; i < txtb.length; i++) {
		        if(txtb[i].value != "") {
		          txtb[i].style.display="none";
		        }

		    }
		  for(i = 0; i < txta.length; i++) {
		        if(txta[i].value != "") {
		          txta[i].style.display="none";
		        }

		    }
	}  
	if(document.getElementById("license").value== "AU")
	{
		 for(i = 0; i < txtb.length; i++) {
		        if(txtb[i].value != "") {
		          txtc[0].selected="selected";
		          txtc[1].selected="selected";
		          txtb[i].style.display="block";
		        }

		    }
		  for(i = 0; i < txta.length; i++) {
		        if(txta[i].value != "") {
		          txta[i].style.display="none";
		        }

		    }
		
	}
	if(document.getElementById("license").value== "CP")
	{

		
		for(i = 0; i < txta.length; i++) {
        if(txta[i].value != "") {
        		txtc[0].selected="selected";
        		txtc[1].selected="selected";
	            txta[i].style.display="block";
	        }

	    }
		  for(i = 0; i < txtb.length; i++) {
		        if(txtb[i].value != "") {
		          txtb[i].style.display="none";
		        }

		    }
		
	}
	

}

function get_license_change()
{
	
	var txta = document.getElementsByName("b");
	var txtb = document.getElementsByName("a"); 
	
	if(document.getElementById("license").value == "AU")
	{
		 for(i = 0; i < txtb.length; i++) {
		        if(txtb[i].value != "") {
		          txtb[i].style.display="block";
		        }
		    }
		  for(i = 0; i < txta.length; i++) {
		        if(txta[i].value != "") {
		          txta[i].style.display="none";
		        }
		    }
	}
	if(document.getElementById("license").value == "CP")
	{
		for(i = 0; i < txta.length; i++) {
        if(txta[i].value != "") {
	            txta[i].style.display="block";
	        }
	    }
	  for(i = 0; i < txtb.length; i++) {
	        if(txtb[i].value != "") {
	          txtb[i].style.display="none";
	        }
	    }
	}
}

function set_license_change()
{
	var txta = document.getElementsByName("b");
	var txtb = document.getElementsByName("a"); 
	

	 for(i = 0; i < txtb.length; i++) {
	        if(txtb[i].value != "") {
	          txtb[i].style.display="none";
	        }
	    }
	  for(i = 0; i < txta.length; i++) {
	        if(txta[i].value != "") {
	          txta[i].style.display="none";
	        }
	    }	
}