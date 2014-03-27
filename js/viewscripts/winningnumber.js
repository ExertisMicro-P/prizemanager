/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var ajaxinprogress=false;

function changetoinvalid(id){
    $('#'+id).removeClass('valid');
            $('#'+id + '_error').removeClass('valid');
            $('#'+id).addClass('invalid');
            $('#'+id + '_error').addClass('invalid');
            $('#'+id + '_error').html('');
}

function changetovalid(id){
        $('#'+id).removeClass('invalid');
            $('#'+id + '_error').removeClass('invalid');
            $('#'+id).addClass('valid');
            $('#'+id + '_error').addClass('valid');
            $('#'+id + '_error').html('');
}

$('.invoice-no').keyup(function(e){
        
	var number = $(this).val();
        
        var imeiRegex = '^[0-9]{8}$';
        var match = number.match(imeiRegex); 
        id = $(this).attr('id');
        
	if (match) {//this is a possible invoice number send to server
            //$('#scanerror').hide();
            doprocessnumber(number, id);
            
        }  
        else{
            if($(this).val() == ''){
                changetovalid(id);
            }
            else{
                changetoinvalid(id);
            }
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
                                      if(data.status != 'valid'){
                                      
                                           changetoinvalid(id);
                                           $('#'+id + '_error').html(data.status);
                                    }
                                    else    {
                                            changetovalid(id);
                                        $('#'+id + '_error').html(data.status);
                                    }
                                 }
                                  
                                  
		  }},
		  complete: function() {ajaxinprogress=false;},
                  
                  error: function (xhr, ajaxOptions, thrownError) //use the codes
                  { ajaxinprogress=false;
                      alert('ouch');}
                 
                        
                    
		});
        }

} // dosavepairing

$(document).ready(function(){
    $('#create').click(function(e){
     
    //check all inputs are valid
    
    var error = false;
    $("input[type='text']").each(function(){
        if($(this).hasClass('invalid')){
            error = true;
            var id = $(this).attr('id');
            $('#'+id + '_error').html('Invalid Number please chooose another or delete it');
            
            $('.submiterrors').html('Please correct errors and resubmit');
            $('.submiterrors').show();
            event.preventDefault();
        }
        
    }) ;
    
});
});