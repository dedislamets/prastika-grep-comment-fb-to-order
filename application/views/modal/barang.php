<div class="modal" id="ModalAdd">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header back-green" >
	        	
	        	<h4 class="modal-title" id="myModalLabel"><label id="lbl-title"></label> <label> Upload Template</label></h4>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
	      	</div>
			<form id="Form" name="Form" method="POST" class="grab form-horizontal" action="<?= base_url() ?>barang/upload" role="form" enctype="multipart/form-data" target="_blank">
				<div class="modal-body">
			
					<div class="form-group">
						<label>File</label>
						<input type="file" id="file" name="file" class="form-control" />
					</div>	
					
									
					<input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
				</div>
				<div class="modal-footer">
		        	<div class="pull-right">
			            <button type="submit" id="btnSubmit" class="btn btn-primary btn-block">Submit</button>
			        </div>
		        </div>
			</form>
		</div>
	</div>
</div>