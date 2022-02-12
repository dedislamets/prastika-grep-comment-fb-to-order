<div class="sh-breadcrumb">
  <nav class="breadcrumb">
    <a class="breadcrumb-item" href="index.html">Home</a>
    <span class="breadcrumb-item active">Comments</span>
  </nav>
</div><!-- sh-breadcrumb -->

<div  class="sh-pagebody">
  <div class="row row-sm">
    <div class="col-lg-8">
      <div class="card bd-primary mg-t-20">
        <div class="card-header bg-primary tx-white">Comments</div>
        <div class="card-body">
          <div class="media-list">
            <template>
              <div class="media">
                <img src="<?= base_url() ?>assets/main/img/img9.jpg" class="wd-50 rounded-circle" alt="">
                <div class="media-body mg-l-20">
                  <h6 class="tx-15 mg-b-5"><a href="#">{{ list_posting.story }}</a></h6>
                  <p class="mg-b-20">Posting date: <a href="#">{{ moment(list_posting.created_time).fromNow() }}</a></p>
                  <h3>{{ list_posting.message }}</h3>
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
                    <a href="#" class="mg-r-10">Chat History</a>
                    <a href="#" class="mg-r-10">Report</a>
                    <a href="#"><i class="icon ion-more tx-16"></i></a>
                  </div>
                </div><!-- d-flex -->
              </div><!-- card-header -->
              <div class="card-body">
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
                  <!-- <div class="media mg-t-20">
                    <img src="<?= base_url() ?>assets/main/img/img1.jpg" class="wd-40 rounded-circle mg-r-20" alt="">
                    <div class="media-body tx-13">
                      <div class="pd-10 bg-gray-200 d-inline-block">
                        So you want to eat snow? is it safe?
                      </div>
                      <span class="tx-11 tx-gray-500 mg-l-5">3:10pm</span>
                      <hr class="invisible mg-y-2">

                      <div class="pd-10 bg-gray-200 d-inline-block">
                        Hahahaah!
                      </div>
                      <span class="tx-11 tx-gray-500 mg-l-5">3:12pm</span>
                      <hr class="invisible mg-y-2">

                      <div class="pd-10 bg-gray-200 d-inline-block mx-wd-85p">
                        Researchers are generally less concerned about what's in the snow
                        than the fact that climate change may be causing it to rapidly disappear.
                      </div>
                      <span class="tx-11 tx-gray-500 mg-l-5">3:12pm</span>
                    </div>
                  </div> -->
        
                </div><!-- media-list -->
              </div><!-- card-body -->

            </div><!-- card -->
          </div>
        </div><!-- card-body -->
      </div>

    </div>
    <div class="col-lg-4 mg-t-20 mg-lg-t-0">

      <div class="card bd-primary card-tab mg-t-20">
        <div class="card-header bg-primary">
          <nav class="nav">
            <a href="#tabUsers" class="nav-link active" data-toggle="tab"><i class="icon ion-ios-contact-outline"></i></a>
          </nav>
        </div><!-- card-header -->
        <div class="card-body tab-content">
          <div id="tabUsers" class="tab-pane active">
            <label class="card-tab-label">Recent Users</label>
            <div class="media-list">
              <a href="#" class="media">
                <img src="<?= base_url() ?>assets/main/img/img2.jpg" alt="">
                <div class="media-body">
                  <h6>Rowella Sombrio</h6>
                  <p>Executive Director</p>
                </div><!-- media-body -->
              </a><!-- media -->
              <a href="#" class="media">
                <img src="<?= base_url() ?>assets/main/img/img4.jpg" alt="">
                <div class="media-body">
                  <h6>Mary Grace Ceballos</h6>
                  <p>Sales Supervisor</p>
                </div><!-- media-body -->
              </a><!-- media -->
              <a href="#" class="media">
                <img src="<?= base_url() ?>assets/main/img/img5.jpg" alt="">
                <div class="media-body">
                  <h6>Archie Cantones</h6>
                  <p>Software Engineer</p>
                </div><!-- media-body -->
              </a><!-- media -->
              <a href="#" class="media">
                <img src="<?= base_url() ?>assets/main/img/img6.jpg" alt="">
                <div class="media-body">
                  <h6>Raffy Godinez</h6>
                  <p>Full-Stack Developer</p>
                </div><!-- media-body -->
              </a><!-- media -->
              <a href="#" class="media">
                <img src="<?= base_url() ?>assets/main/img/img7.jpg" alt="">
                <div class="media-body">
                  <h6>Allan Cadungog</h6>
                  <p>Sales Supervisor</p>
                </div><!-- media-body -->
              </a><!-- media -->
            </div><!-- media-list -->

          </div>
        </div>
      </div>
    </div>
  </div><!-- row -->
</div><!-- sh-pagebody -->