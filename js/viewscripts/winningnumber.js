/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var ajaxinprogress=false;
$('.invoice-input').keyup(function(e){
        
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
function doprocessnumber(number, obj){
 	
	if(!ajaxinprogress){
            ajaxinprogress = true;
        
	$.ajax({
		  url: 'ajaxchecknumberisvalid',
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
                                  if(data.status == 'used'){
                                       $('#winning_number_1_invoice_no_error').html('done');
                                      $('#'+id + '_error').html(' This number has already been used please choose another');
                                  }
		  }},
		  complete: function() {ajaxinprogress=false;},
                  
                  error: function (xhr, ajaxOptions, thrownError) //use the codes
                  { ajaxinprogress=false;
                      alert('ouch');}
                 
                        
                    
		});
        }

} // dosavepairing

    
