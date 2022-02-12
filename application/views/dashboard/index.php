<div class="sh-breadcrumb">
  <nav class="breadcrumb">
    <a class="breadcrumb-item" href="index.html">Home</a>
    <span class="breadcrumb-item active">Posting & Comment</span>
  </nav>
</div><!-- sh-breadcrumb -->
<div class="sh-pagetitle">
  <div class="input-group">
    
  </div><!-- input-group -->
  <div class="sh-pagetitle-left">
    <div class="sh-pagetitle-icon"><i class="icon ion-ios-home"></i></div>
    <div class="sh-pagetitle-title">
      <span>All Features Summary</span>
      <h2>Posting & Comment</h2>
    </div><!-- sh-pagetitle-left-title -->
  </div><!-- sh-pagetitle-left -->
</div><!-- sh-pagetitle -->

<div  class="sh-pagebody">
  <div class="row row-sm">
    <div class="col-lg-12">
      <div class="card bd-primary mg-t-20">
        <div class="card-header bg-primary tx-white">Recent Posting</div>
        <div class="card-body">
          <div class="media-list">
            <template v-for="(log, index) in list_posting">
              <div class="media">
                <img src="<?= base_url() ?>assets/main/img/img9.jpg" class="wd-50 rounded-circle" alt="">
                <div class="media-body mg-l-20">
                  <h6 class="tx-15 mg-b-5"><a href="#">{{ log.story }}</a></h6>
                  <p class="mg-b-20">Posting date: <a href="#">{{ moment(log.created_time).fromNow() }}</a></p>
                  <h3>{{ log.message }}</h3>
                  <div v-if="log.full_picture" class="mg-b-10">
                    <img :src="log.full_picture" style="width: 200px">
                  </div>
                  <p class="mg-b-0">
                    <a :href="'<?= base_url()?>comment?id=' +log.id" class="btn btn-success pd-sm-x-20 mg-sm-r-5">Lihat Comment</a>
                  </p>
                </div><!-- media-body -->
              </div><!-- media -->

              <hr class="mg-y-20">
            </template>
          </div><!-- media-list -->
        </div><!-- card-body -->
      </div>
    </div>
 
  </div><!-- row -->
</div><!-- sh-pagebody -->