<script type="text/javascript">
	var oTable;
	$(document).ready(function(){  
		
	 oTable = $('#InvoiceList').DataTable({
			dom: 'frtip',
			ajax: {		            
	            "url": "order/dataTable",
	            "type": "GET"
	        },
	        processing	: true,
			serverSide	: true,			
			"bPaginate": true,	
			"autoWidth": true,

	    });

		
	})

	var app = new Vue({
	    el: "#app",
	    mounted: function () {
	    	this.loadRekap();
	    },
	    updated: function () {
	      var that = this;
	      
	    },
	    data: {
	      id: '', 
	      list_rekap: [],
		  tanggal:''
	    },
	    methods: {
	
	      ganti(event){
	    	this.loadRekap();
	      },
	      saveData(id_posting, id_member){
	        var that = this;
	        const param = { id_posting: id_posting, id_member: id_member};
	        axios.post("<?= base_url()?>order/kirim", param)
	        .then(response => {
	          
	          that.loadRekap();
	        });
	      },
	      
	      async loadRekap(){
	        var that = this;
	        if(that.tanggal != "") {
	        	var sParam = { tgl : that.tanggal };
	        }else{
	        	var sParam = {};
	        }
	        try {
	          await axios.get('<?= base_url()?>order/list', { params: sParam })
	          .then(response => {
	          	// debugger;
	            that.list_rekap = response.data.rekapan;
	          });

	        }catch(e) {
	          alert(e);
	        }
	      },
	    
	    }
	});

</script>
