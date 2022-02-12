<style type="text/css">
  .card-content{
    padding: 15px;
  }
</style>
<div class="sh-breadcrumb">
  <nav class="breadcrumb">
    <a class="breadcrumb-item" href="index.html">Home</a>
    <span class="breadcrumb-item active">Dashboard</span>
  </nav>
</div><!-- sh-breadcrumb -->
<div class="sh-pagetitle">
  <div class="input-group">
    
  </div><!-- input-group -->
  <div class="sh-pagetitle-left">
    <div class="sh-pagetitle-icon"><i class="icon ion-ios-gear"></i></div>
    <div class="sh-pagetitle-title">
      <h2>Setting</h2>
    </div><!-- sh-pagetitle-left-title -->
  </div><!-- sh-pagetitle-left -->
</div><!-- sh-pagetitle -->

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-content" >
        <?php echo $this->session->flashdata('message'); ?>
        <form method="post" action="<?php echo base_url() ?>setup/simpan" class="form-horizontal">
          <fieldset>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Token</label>
              <div class="col-sm-10">
                <input type="text" id="token" name="token" class="form-control" value="<?php echo $setup[0]->token ?>">
              </div>
              
            </div>
            <!-- <div class="form-group row">
              <label class="col-sm-2 col-form-label">Power</label>
              <div class="col-sm-4">
                <input type="text" id="power" name="power" class="form-control" value="<?php echo $setup[0]->power ?>">
              </div>
              <label class="col-sm-2 col-form-label">Speed</label>
              <div class="col-sm-4">
                <input type="text" id="speed" name="speed" class="form-control" value="<?php echo $setup[0]->speed ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">IP Address</label>
              <div class="col-sm-4">
                <input type="text" id="ip" name="ip" class="form-control" value="<?php echo $setup[0]->ip ?>">
              </div>
              <label class="col-sm-2 col-form-label">Port</label>
              <div class="col-sm-4">
                <input type="text" id="port_ip" name="port_ip" class="form-control" value="<?php echo $setup[0]->port_ip ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Default Scan</label>
              <div class="col-sm-10">
                
                <div class="row mg-t-10">
                  <div class="col-lg-3">
                    <label class="rdiobox">
                      <input name="default_scan" type="radio" value="0" <?php echo ($setup[0]->default_scan==0 ? "checked": "") ?>>
                      <span>COM</span>
                    </label>
                  </div>
                  <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                    <label class="rdiobox">
                      <input name="default_scan" type="radio" value="1" <?php echo ($setup[0]->default_scan==1 ? "checked": "") ?>>
                      <span>TCP</span>
                    </label>
                  </div><
                </div>
              </div>

            </div> -->

          </fieldset>
          <fieldset>
            <div class="form-group">
              <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
              <button type="submit" class="btn btn-fill btn-info" style="margin-left: 10px">Submit</button>
            </div>
          </fieldset>
        </form>
      </div>
    </div>  <!-- end card -->
  </div> <!-- end col-md-12 -->
</div>