<script type="text/javascript">
	var app = new Vue({
        el: "#app",
        mounted: function () {
	      // this.loadHistory();
	    },
	    updated: function () {
	    	var that = this;
	    	
	    },
        data: {
        	
        
        },
        methods: {
        	
		    
        }
    });

	var start=0;
    var setScan= null;
    var arr_epc= [];
    var arr_epc_scan = [];

	$(document).ready(function(){  
		
	})

    
	$('#harga').on('keyup', function (event) {
    	$(this).val(formatRupiah($(this).val()));
    });

    function formatRupiah(angka) {
	  	var number_string = angka.replace(/[^,\d]/g, "").toString(),
		    split = number_string.split(","),
		    sisa = split[0].length % 3,
		    rupiah = split[0].substr(0, sisa),
		    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

	  // tambahkan titik jika yang di input sudah menjadi angka ribuan
	  if (ribuan) {
	    separator = sisa ? "." : "";
	    rupiah += separator + ribuan.join(".");
	  }

	  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
	  if(rupiah=="") rupiah = 0;
	  return rupiah;
	}

    $('#btnSave').on('click', function (event) {
    	event.preventDefault();
		var valid = false;
    	var sParam = $('#form-barang').serialize() ;
    	var validator = $('#form-barang').validate({
							rules: {
									kode_barang: {
							  			required: true
									},
									nama_barang: {
							  			required: true
									},
								}
							});
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
 			if (confirm("Lanjutkan menyimpan data?")) {
		 		var link = '<?= base_url(); ?>Barang/Save';
		 		$.post(link,sParam, function(data){
					if(data.error==false){	
						alertOK('Data Sukses Tersimpan');
						window.location.href = '<?= base_url(); ?>barang';
					}else{	
						alertError(data.message);				  	
					}
				},'json');
			} 
		 	
	 	}
        
    });


	function validateBarang(){
    	var flag = true;
    	

    	if(app.list_scan.length==0){
    		flag = false;
    		finderr('Belum ada data linen di scan.!');
    	}else{
    		$.each(app.list_scan, function(index, obj) {
    			if(obj.status != '-' ){
    				flag = false;
    				alert(obj.jenis + '-(' + obj.serial + ') tidak valid.!');
    				finderr(obj.jenis + '-(' + obj.serial + ') tidak valid.!');
    			}
    		})
    	}

    	return flag;
    }

</script>