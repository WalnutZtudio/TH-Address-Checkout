(function( $ ) {
	$(document).ready(function() {

		 /* BILLING */
		 if ( $('#billing_district, #billing_city, #billing_postcode').length > 0 ) {

			var billing_country = $("#billing_country").val();
			if ( billing_country == 'TH' ) {
			  $.Thailand({
				database: plugin_path.url + 'database/db.json',
				type: 'billing',
				$district: $('#billing_district'),
				$amphoe: $('#billing_city'),
				$zipcode: $('#billing_postcode'),
			  });
			}
	  
		  }
	  
		  $("#billing_country").on('select2:select', function(e){
			var billing_country = $('#billing_country').val();
	  
			if ( billing_country == 'TH' ) {
	  
				$.Thailand({
				  database: plugin_path.url + 'database/db.json',
				  type: 'billing',
				  $district: $('#billing_district'),
				  $amphoe: $('#billing_city'),
				  $zipcode: $('#billing_postcode'),
				});
			  
			} else {
			  $('#billing_district, #billing_city, #billing_postcode').typeahead('destroy');
			  $('#billing_district, #billing_city, #billing_postcode').val('');
			}
		  });

		  /* SHIPPING */
		  if ( $('#shipping_district, #shipping_city, #shipping_postcode').length > 0 ) {
			var shipping_country = $("#shipping_country").val();
			if ( shipping_country == 'TH' ) {
			  $.Thailand({
				database: plugin_path.url + 'database/db.json',
				type: 'shipping',
				$district: $('#shipping_district'),
				$amphoe: $('#shipping_city'),
				$zipcode: $('#shipping_postcode'),
			  });
			}
		  }
	  
		  $("#shipping_country").on('select2:select', function(e){
			var shipping_country = $('#shipping_country').val();
	  
			if ( shipping_country == 'TH' ) {
	  
			  $.Thailand({
				database: plugin_path.url + 'database/db.json',
				type: 'shipping',
				$district: $('#shipping_district'),
				$amphoe: $('#shipping_city'),
				$zipcode: $('#shipping_postcode'),
			  });
	  
			} else {
			  $('#shipping_district, #shipping_city, #shipping_postcode').typeahead('destroy');
			  $('#shipping_district, #shipping_city, #shipping_postcode').val('');
			}
		  });

	});
})( jQuery );
