<script type="text/javascript">
	var oTable;
	$(document).ready(function(){  
		
	 oTable = $('#ViewTable').DataTable({
			dom: 'frtip',
			ajax: {		            
	            "url": "payment/dataTable",
	            "type": "GET"
	        },
	        processing	: true,
			serverSide	: true,			
			"bPaginate": true,	
			"autoWidth": true,
			// "order": [[ 4, "desc" ]],
			// columnDefs:[
			// 	{ "width": "100px", "targets": [5,4,3,6] },
				
			// ]

	    });

	})


	function hapus(val) {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			
			$.get('Barang/delete', { id: $(val).data('id') }, function(data){ 
				window.location.reload();
			})
		
		}
	}
</script>
