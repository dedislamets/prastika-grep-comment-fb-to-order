<style type="text/css">
  .media {
    border-bottom: solid 2px darkblue;
    padding-bottom: 10px;
    margin-bottom: 10px;
  }
</style>
<div class="sh-breadcrumb">
  <nav class="breadcrumb">
    <a class="breadcrumb-item" href="index.html">Home</a>
    <span class="breadcrumb-item active">Comments</span>
  </nav>
</div><!-- sh-breadcrumb -->
<div>
  <div  class="sh-pagebody">
    <div class="row row-sm">
      <div class="col-lg-8">
        <div class="card bd-primary mg-t-20">
          <div class="card-header bg-primary tx-white">Comments
            <div class="pull-right" >
              <button class="btn btn-info mg-b-10 btn-sm" @click="showModal"><i class="fa fa-cog"></i> Setup</button>
              <button class="btn btn-success mg-b-10 btn-sm" v-text="status"></button>
            </div>
          </div>
          <div class="card-body">
            <div class="media-list">
              <template>
                <div class="media">
                  <img src="<?= base_url() ?>assets/main/img/img9.jpg" class="wd-50 rounded-circle" alt="">
                  <div class="media-body mg-l-20">
                    <h6 class="tx-15 mg-b-5"><a href="#">{{ list_posting.story }}</a></h6>
                    <p class="mg-b-20">Posting date: <a href="#">{{ moment(list_posting.created_time).fromNow() }}</a></p>
                    {{ list_posting.message }}
                    <div v-if="list_posting.full_picture" class="mg-b-10">
                      <img :src="list_posting.full_picture" style="width: 200px" class="img-responsive">
                    </div>
                  </div><!-- media-body -->
                </div><!-- media -->
              </template>
            </div>

            <div id="chatView" class="col-md-12 col-lg-12 d-none d-md-block">

              <div class="card bd-gray-400">
                <div class="card-header pd-20 bd-b">
                  <div class="d-md-flex justify-content-between">
                    <div class="media align-items-center">
                      <!-- <img src="<?= base_url() ?>assets/main/img/img1.jpg" class="wd-40 rounded-circle" alt="">
                      <div class="media-body mg-l-15">
                        <div class="d-flex align-items-center justify-content-between">
                          <div>
                            <h6 class="tx-inverse tx-14 mg-b-2">Kevin Douglas</h6>
                            <p class="tx-12 mg-b-0 tx-success">Active now</p>
                          </div>
                          <a id="showContactList" href="#" class="btn btn-secondary btn-icon rounded-circle d-md-none">
                            <div><i class="icon ion-android-people tx-18"></i></div>
                          </a>
                        </div>
                      </div> -->
                    </div><!-- media -->
                    <div class="mg-t-20 mg-md-t-0 tx-12 d-flex align-items-center">
                      <a href="#" class="mg-r-10">Report</a>
                      <a href="#"><i class="icon ion-more tx-16"></i></a>
                    </div>
                  </div><!-- d-flex -->
                </div><!-- card-header -->
                <div class="card-body" style="overflow-y: scroll;height: 500px;">
                  <div class="media-list">
                    <template v-for="(log, index) in list_comment">
                      <div class="media mg-t-20">
                        <!-- <img src="<?= base_url() ?>assets/main/img/img10.jpg" class="wd-40 rounded-circle mg-r-20" alt=""> -->
                        <div class="media-body tx-13">
                          <div class="pd-10 bg-gray-200 d-inline-block" style="border-radius: 10px;">
                            <div style="font-weight: bold;">{{ log.id }} : </div> {{ log.message }}
                          </div>
                          
                          <span class="tx-11 tx-gray-500 mg-l-5">{{ moment(log.created_time).fromNow() }}</span>
                        </div>
                      </div>
                    </template>
                    
                  </div><!-- media-list -->
                </div><!-- card-body -->

              </div><!-- card -->
            </div>
          </div><!-- card-body -->
        </div>

      </div>
      <div class="col-lg-4 mg-t-20 mg-lg-t-0">

        <div class="card bd-primary mg-t-20">
          <div class="card-header bg-primary tx-white">
            Book Order
          </div><!-- card-header -->
          <div class="card-body tab-content">
            <div class="media-list">
              <template v-for="(log, index) in list_rekap">
                <div class="media" style="border-bottom: solid 2px darkblue;padding-bottom: 10px;margin-bottom: 10px;">
                  <div style="padding-right: 10px;">{{ log.status }}</div>
                  <div class="media-body">
                    <h6 style="margin-bottom: 0;">{{ log.nama_facebook }} - {{ log.nama_lengkap }}</h6>
                    <h6 style="margin-bottom: 0;">{{ log.kota }}</h6>
                    <p style="margin-bottom: 0;">{{ log.nomor_wa }}</p>
                    <p style="margin-bottom: 0;">{{ log.kode_product}} - {{ log.nama_barang}}</p>
                    <p style="margin-bottom: 0;">Qty : {{ log.qty}}</p>
                  </div>
                  <div>ID MEMBER:<br>
                    <div style="font-size: 29px;font-weight: bold;">{{log.id_member}}</div>
                  </div>
                </div>
              </template>
            </div>
          </div>
        </div>
      </div>
    </div><!-- row -->
  </div><!-- sh-pagebody -->
  <div class="modal fade" id="Modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content bd-0">
        <div class="modal-header pd-y-20 pd-x-25">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Setup Posting</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body pd-25">
          <div class="form-group">
            <label>Format Order</label>
            <input type="text" id="format_order" name="format_order" class="form-control" v-model:value="format_order"  />
          </div>  
          <div class="form-group">
            <label>Aktif</label><br>
            <input type="checkbox" id="status" name="status" v-model="selected"/>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success pd-x-20" @click="saveData">Simpan</button>
        </div>
      </div>
    </div><!-- modal-dialog -->
  </div>
</div>