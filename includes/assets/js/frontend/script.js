jQuery(document).ready(function() {
	jQuery( "div.currency" ).first().show();
	jQuery( "input.devise" ).first().prop('checked', true);
	jQuery( "div.currency input.montant" ).first().prop('checked', true);
	jQuery( "input[name=type_don]" ).first().prop('checked', true);
    jQuery(".montant").change(function() {
		var devise = jQuery('input[name=symbolCur]:checked').val();
		var montant = jQuery('input[name=montant_'+devise+']:checked').val();
		jQuery( ".montant" ).each(function() {
			if(montant=="autres"){
				jQuery("#autres_montant_"+devise).show();
				jQuery("#autres_montant_"+devise).prop('required',true);
			} else {
				jQuery("#autres_montant_"+devise).hide();
				jQuery("#autres_montant_"+devise).val('');
				jQuery("#autres_montant_"+devise).prop('required',false);
			}
		});
	});
	jQuery(".devise").change(function() {
		var devise = jQuery('input[name=symbolCur]:checked').val();
		jQuery( "input.montant" ).each(function() {
				jQuery("#autres_montant_"+devise).hide();
			jQuery("#autres_montant_"+devise).val('');
			jQuery("#autres_montant_"+devise).prop('required',false);
			jQuery( this ).prop('checked', false);
		});
		jQuery('input[name=montant_'+devise+']').first().prop('checked', true);
		jQuery( "div.currency" ).each(function() {
		  jQuery( this ).hide();
		});
		jQuery("#div_"+ devise).show();
	});
	jQuery("input[name=type_don]").change(function() {
		var type_don = jQuery('input[name=type_don]:checked').val();
		if(type_don=="anonyme") {
			jQuery(".infoDonor").hide();
			jQuery( ".infoDonor input" ).each(function() {
				jQuery( this ).prop('required',false);
				jQuery( this ).val("");
			});
		} else { 
			jQuery(".infoDonor").show();
			jQuery( ".infoDonor input" ).each(function() {
				jQuery( this ).prop('required',true);
			});
		}
		
	});
});