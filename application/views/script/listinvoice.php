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

	function hapus(val) {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			
			$.get('<?= base_url() ?>order/delete', { id: $(val).data('id') }, function(data){ 
				window.location.reload();
			})
		
		}
	}
</script>
