/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var Prize = {

    unavailable: PrizeDates.unavailable //not the best way to do this. The value is brought through by the main form.
};

 $(function() {
        $("#start_date").datepicker({
            dateFormat: 'dd-mm-yy',
             beforeShowDay: function(date){
        var string = jQuery.datepicker.formatDate('dd-mm-yy', date);
        return [ Prize.unavailable.indexOf(string) === -1 ];
        },
                altField: "#offer_date"
        });     
   
 });
 
