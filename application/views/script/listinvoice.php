<script type="text/javascript">
	var oTable;
	$(document).ready(function(){  
		
	 	oTable = $('#InvoiceList').DataTable({
			dom: 'frtip',
			ajax: {		            
	            "url": "<?= base_url() ?>order/dataTable",
	            "type": "GET"
	        },
	        processing	: true,
			serverSide	: true,			
			"bPaginate": true,	
			"autoWidth": true,

	    });

		
	})

</script>
