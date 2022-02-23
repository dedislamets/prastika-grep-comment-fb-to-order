<script type="text/javascript">
	var oTable;
	$(document).ready(function(){  
		
	 // oTable = $('#InvoiceList').DataTable({
		// 	dom: 'frtip',
		// 	ajax: {		            
	 //            "url": "order/dataTable",
	 //            "type": "GET"
	 //        },
	 //        processing	: true,
		// 	serverSide	: true,			
		// 	"bPaginate": true,	
		// 	"autoWidth": true,

	 //    });

		
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
	      saveData(id_posting, id_member, kurir, admin){
	      	if(kurir == ""){
	      		alert('Kurir belum dipilih');
	      		return;
	      	}
	      	if(admin == ""){
	      		alert('Admin belum dipilih');
	      		return;
	      	}
	        var that = this;
	        const param = { id_posting: id_posting, id_member: id_member, kurir: kurir, admin: admin };
	        axios.post("<?= base_url()?>order/kirim", param)
	        .then(response => {
	          
	          that.loadRekap();
	        });
	      },
	      onChange(event, id_posting, id_member) {

            const param = { id_posting: id_posting, id_member: id_member, kurir: event.target.value };
	        axios.post("<?= base_url()?>order/kurir", param)
	        .then(response => {
	        	if(response.data.error==false){
	        		for (let val of app.list_rekap) {
	        			if(val.id_member == id_member){
	        				val.ongkir = response.data.ongkir ;
	        			}
	        		}
	        	}else{
	        		alert(response.data.msg);
	        		for (let val of app.list_rekap) {
	        			if(val.id_member == id_member){
	        				val.kurir = '' ;
	        				val.ongkir = 0 ;
	        			}
	        		}
	        	}
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
