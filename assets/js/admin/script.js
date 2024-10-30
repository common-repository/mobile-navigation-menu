/**
 * Script for Admin
 *
 */ 


jQuery(document).ready(function($){
    $(".mnm-color-field").wpColorPicker();
    $(".mnm-plus").click(function(){
        $(".form-table-mnm-3 tbody").append($(".form-table-mnm-3 tbody tr:first").clone(true));
    });
    $(".mnm-no").click(function(){ 
        this.closest( ".form-table-mnm-3 tbody tr" ).remove();
    });
	
	// Icon Settings Validity check
	/*
	 * param String fieldName
	 * param Object event
	 */
	var mnmValidityCheck = function(fieldName, event){
		$('input.mnm_option_12_'+fieldName).each(function(index){
			var me = $(this);
			if(!me.val() && index != 0){
				event.preventDefault();
				if( !$(".mnm-required-"+fieldName+index).length > 0){
					me.closest( ".form-table-mnm-3 tbody tr td" ).append('<span class="mnm-required mnm-required-'+fieldName+index+'">*</span>');
			  		// console.log(fieldName+' input #'+index+' is missing');
		  		}
	  		} else {
	  			$( '.mnm-required-'+fieldName+index ).remove();
	  			// console.log(fieldName+' input #'+index+' has value');
	  		}
		}); 
	}
	$('#mnm-setting-page input[name=submit]').click(function(event){ 
		mnmValidityCheck('label', event);
		mnmValidityCheck('icon', event);
		mnmValidityCheck('url', event);
	})
});




