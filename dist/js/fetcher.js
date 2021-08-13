$(document).ready( function(){
    


		jQuery('#country').change(function(){
			var id=jQuery(this).val();
			if(id=='-1'){
				jQuery('#state').html('<option value="-1">Select State</option>');
			}else{
				$("#divLoading").addClass('show');
				jQuery('#state').html('<option value="-1">Select State</option>');
				jQuery('#city').html('<option value="-1">Select City</option>');
				jQuery.ajax({
					type:'post',
					url:'app/search_area.php',
					data:'id='+id+'&type=state',
					success:function(result){					
						 jQuery('#state').append(result);
					
					}
				});
			}
		});

        
		jQuery('#state').change(function(){
			var id=jQuery(this).val();
			if(id=='-1'){
				jQuery('#city').html('<option value="-1">Select City</option>');
			}else{
				$("#divLoading").addClass('show');
				jQuery('#city').html('<option value="-1">Select City</option>');
				jQuery.ajax({
					type:'post',
					url:'app/search_area.php',
					data:'id='+id+'&type=city',
					success:function(result){
					
						 jQuery('#city').append(result);
					
					}
				});
			}
		});
});