/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var ajaxinprogress=false;
$('.invoice-no').keyup(function(e){
        
	var number = $(this).val();
        
        var imeiRegex = '^[0-9]{8}$';
        var match = number.match(imeiRegex); 
	if (match) {//this is a possible invoice number send to server
            //$('#scanerror').hide();
            id = $(this).attr('id');
            doprocessnumber(number, id);
        }      
});

var form_errors = {};
function doprocessnumber(number, id){
 	
	if(!ajaxinprogress){
            ajaxinprogress = true;
            //create url - can't trust the one browser will create for it's rest like link
            $loc = $(location).attr('href')
            $root = $loc.split('/index.php/'); 
            $controller = $root[1].split('/');
            $url = $root[0] + '/index.php/' + $controller[0];
	$.ajax({
		  url: $url + '/ajaxchecknumberisvalid',
		  context: document.body,
                  type: 'POST',
		  data : {
				number: number,
                                
		  		},
		dataType : 'json',
		
		success: function(data){
			  ajaxinprogress=false;
			  if(data) {				  
				  var obj = data;
				  if (obj.errors != undefined){
				  if(obj.errors.length>0)
					  stockcheck.showerrors(obj.errors);
                                       
				  }
                                  if(data.status != 'available'){
                                      
                                      $('#'+id + '_error').html(data.status);
                                  }
		  }},
		  complete: function() {ajaxinprogress=false;},
                  
                  error: function (xhr, ajaxOptions, thrownError) //use the codes
                  { ajaxinprogress=false;
                      alert('ouch');}
                 
                        
                    
		});
        }

} // dosavepairing

    
