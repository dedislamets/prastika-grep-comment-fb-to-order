<script type="text/javascript">

	$(document).ready(function(){  

		$('#ViewTable').DataTable({
			dom: 'frtip',
			ajax: {		            
	            "url": "pesan/dataTable",
	            "type": "GET"
	        },
	        processing	: true,
			serverSide	: true,			
			"bPaginate": true,	
			// "ordering": false,
			"autoWidth": true,
			
	    });

	    
	})


	
</script>
