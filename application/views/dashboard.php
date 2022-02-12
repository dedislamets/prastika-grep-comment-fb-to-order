<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Prastika Collection</title>

    <!-- Vendor css -->
    <link href="<?= base_url() ?>assets/main/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/main/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/main/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">

    <!-- Shamcey CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/main/css/shamcey.css">
  </head>

  <body>

    <div class="sh-logopanel">
      <a href="#" class="sh-logo-text">Prastika Collection</a>
      <a id="navicon" href="#" class="sh-navicon d-none d-xl-block"><i class="icon ion-navicon"></i></a>
      <a id="naviconMobile" href="#" class="sh-navicon d-xl-none"><i class="icon ion-navicon"></i></a>
    </div><!-- sh-logopanel -->

    <div class="sh-sideleft-menu">
      <label class="sh-sidebar-label">Navigation</label>
      <ul class="nav">
        <li class="nav-item">
          <a href="dashboard" class="nav-link active">
            <i class="icon ion-ios-home-outline"></i>
            <span>Posting & Comment</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.html" class="nav-link">
            <i class="icon ion-ios-list-outline"></i>
            <span>Penjualan</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.html" class="nav-link">
            <i class="icon ion-ios-bookmarks-outline"></i>
            <span>Members</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="register" class="nav-link">
            <i class="icon ion-ios-bookmarks-outline"></i>
            <span>Register</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="setup" class="nav-link">
            <i class="icon ion-ios-gear-outline"></i>
            <span>Setting</span>
          </a>
        </li>
      </ul>
    </div><!-- sh-sideleft-menu -->

    <div class="sh-headpanel">
      <div class="sh-headpanel-left">

        <!-- START: HIDDEN IN MOBILE -->
        <a href="#" class="sh-icon-link">
          <div>
            <i class="icon ion-ios-folder-outline"></i>
            <span>Directory</span>
          </div>
        </a>
        <a href="#" class="sh-icon-link">
          <div>
            <i class="icon ion-ios-calendar-outline"></i>
            <span>Events</span>
          </div>
        </a>
        <a href="#" class="sh-icon-link">
          <div>
            <i class="icon ion-ios-gear-outline"></i>
            <span>Settings</span>
          </div>
        </a>
        <!-- END: HIDDEN IN MOBILE -->

        <!-- START: DISPLAYED IN MOBILE ONLY -->
        <div class="dropdown dropdown-app-list">
          <a href="#" data-toggle="dropdown" class="dropdown-link">
            <i class="icon ion-ios-keypad tx-18"></i>
          </a>
          <div class="dropdown-menu">
            <div class="row no-gutters">
              <div class="col-4">
                <a href="#" class="dropdown-menu-link">
                  <div>
                    <i class="icon ion-ios-folder-outline"></i>
                    <span>Directory</span>
                  </div>
                </a>
              </div><!-- col-4 -->
              <div class="col-4">
                <a href="#" class="dropdown-menu-link">
                  <div>
                    <i class="icon ion-ios-calendar-outline"></i>
                    <span>Events</span>
                  </div>
                </a>
              </div><!-- col-4 -->
              <div class="col-4">
                <a href="#" class="dropdown-menu-link">
                  <div>
                    <i class="icon ion-ios-gear-outline"></i>
                    <span>Settings</span>
                  </div>
                </a>
              </div><!-- col-4 -->
            </div><!-- row -->
          </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
        <!-- END: DISPLAYED IN MOBILE ONLY -->

      </div><!-- sh-headpanel-left -->

      <div class="sh-headpanel-right">
        <div class="dropdown mg-r-10">
          <a href="#" class="dropdown-link dropdown-link-notification">
            <i class="icon ion-ios-filing-outline tx-24"></i>
          </a>
        </div>
        <div class="dropdown dropdown-notification">
          <a href="#" data-toggle="dropdown" class="dropdown-link dropdown-link-notification">
            <i class="icon ion-ios-bell-outline tx-24"></i>
            <span class="square-8"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-menu-header">
              <label>Notifications</label>
              <a href="#">Mark All as Read</a>
            </div><!-- d-flex -->

            <div class="media-list">
              <!-- loop starts here -->
              <a href="#" class="media-list-link read">
                <div class="media pd-x-20 pd-y-15">
                  <img src="<?= base_url() ?>assets/main/img/img8.jpg" class="wd-40 rounded-circle" alt="">
                  <div class="media-body">
                    <p class="tx-13 mg-b-0"><strong class="tx-medium">Suzzeth Bungaos</strong> tagged you and 18 others in a post.</p>
                    <span class="tx-12">October 03, 2017 8:45am</span>
                  </div>
                </div><!-- media -->
              </a>
              <!-- loop ends here -->
              <a href="#" class="media-list-link read">
                <div class="media pd-x-20 pd-y-15">
                  <img src="<?= base_url() ?>assets/main/img/img9.jpg" class="wd-40 rounded-circle" alt="">
                  <div class="media-body">
                    <p class="tx-13 mg-b-0"><strong class="tx-medium">Mellisa Brown</strong> appreciated your work <strong class="tx-medium">The Social Network</strong></p>
                    <span class="tx-12">October 02, 2017 12:44am</span>
                  </div>
                </div><!-- media -->
              </a>
              <a href="#" class="media-list-link read">
                <div class="media pd-x-20 pd-y-15">
                  <img src="<?= base_url() ?>assets/main/img/img10.jpg" class="wd-40 rounded-circle" alt="">
                  <div class="media-body">
                    <p class="tx-13 mg-b-0">20+ new items added are for sale in your <strong class="tx-medium">Sale Group</strong></p>
                    <span class="tx-12">October 01, 2017 10:20pm</span>
                  </div>
                </div><!-- media -->
              </a>
              <a href="#" class="media-list-link read">
                <div class="media pd-x-20 pd-y-15">
                  <img src="<?= base_url() ?>assets/main/img/img5.jpg" class="wd-40 rounded-circle" alt="">
                  <div class="media-body">
                    <p class="tx-13 mg-b-0"><strong class="tx-medium">Julius Erving</strong> wants to connect with you on your conversation with <strong class="tx-medium">Ronnie Mara</strong></p>
                    <span class="tx-12">October 01, 2017 6:08pm</span>
                  </div>
                </div><!-- media -->
              </a>
              <div class="media-list-footer">
                <a href="#" class="tx-12"><i class="fa fa-angle-down mg-r-5"></i> Show All Notifications</a>
              </div>
            </div><!-- media-list -->
          </div><!-- dropdown-menu -->
        </div>
        <div class="dropdown dropdown-profile">
          <a href="#" data-toggle="dropdown" class="dropdown-link">
            <img src="<?= base_url() ?>assets/main/img/img1.jpg" class="wd-60 rounded-circle" alt="">
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="media align-items-center">
              <img src="<?= base_url() ?>assets/main/img/img1.jpg" class="wd-60 ht-60 rounded-circle bd pd-5" alt="">
              <div class="media-body">
                <h6 class="tx-inverse tx-15 mg-b-5">Kevin Douglas</h6>
                <p class="mg-b-0 tx-12">kdouglas@domain.com</p>
              </div><!-- media-body -->
            </div><!-- media -->
            <hr>
            <ul class="dropdown-profile-nav">
              <li><a href="#"><i class="icon ion-ios-person"></i> Edit Profile</a></li>
              <li><a href="#"><i class="icon ion-ios-gear"></i> Settings</a></li>
              <li><a href="#"><i class="icon ion-ios-download"></i> Downloads</a></li>
              <li><a href="#"><i class="icon ion-ios-star"></i> Favorites</a></li>
              <li><a href="#"><i class="icon ion-power"></i> Sign Out</a></li>
            </ul>
          </div><!-- dropdown-menu -->
        </div>
      </div><!-- sh-headpanel-right -->
    </div><!-- sh-headpanel -->

    <div class="sh-mainpanel" id="app">
      <?php 
          if($this->router->fetch_class() != 'dashboard'){            
              $this->load->view($main); 
          }
          else {                  
              $this->load->view('dashboard/index'); 
          } 
        ?>  
      
      <!-- <div class="sh-footer">
        <div>Copyright &copy; 2017. All Rights Reserved. Shamcey Dashboard Admin Template</div>
        <div class="mg-t-10 mg-md-t-0">Designed by: <a href="http://themepixels.me/">ThemePixels</a></div>
      </div> -->
    </div><!-- sh-mainpanel -->

    <script src="<?= base_url() ?>assets/main/lib/jquery/jquery.js"></script>
    <script src="<?= base_url() ?>assets/main/lib/popper.js/popper.js"></script>
    <script src="<?= base_url() ?>assets/main/lib/bootstrap/bootstrap.js"></script>
    <script src="<?= base_url() ?>assets/main/lib/jquery-ui/jquery-ui.js"></script>
    <script src="<?= base_url() ?>assets/main/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="<?= base_url() ?>assets/main/lib/moment/moment.js"></script>
    <script src="<?= base_url() ?>assets/main/lib/Flot/jquery.flot.js"></script>
    <script src="<?= base_url() ?>assets/main/lib/Flot/jquery.flot.resize.js"></script>
    <script src="<?= base_url() ?>assets/main/lib/flot-spline/jquery.flot.spline.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="<?= base_url() ?>assets/main/js/shamcey.js"></script>
    <!-- <script src="<?= base_url() ?>assets/main/js/dashboard.js"></script> -->
    <?php
      $this->load->view($js); 
    ?>
    <script type="text/javascript">

      Pusher.logToConsole = true;
      var pusher = new Pusher('f8ccc036c27f4bcfb7a7', {
        cluster: 'ap1'
      });

      var channel = pusher.subscribe('linen');
      channel.bind('my-event', function(data) {
        // addNotif(JSON.stringify(data));
        console.log('tess');
      });

      function addNotif(message) {
        var json = JSON.parse(message);
        $.get('<?= base_url() ?>dashboard/notifikasi/' + json.sent_to, { }, function(data){ 
          if(data.notifikasi.length > 0){   
            if($("#id_user").val() == json.sent_to){          
              $.gritter.add({
                title   : 'Notification',   
                text    : json.short_msg,      
                time    : 5000,    
              });
              $("#card-notifikasi").html('');
              $(".az-notification-list").html('');
              $("#mark").html('');
              var alert = "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Notifikasi</strong> <span id='msg_notif'>Anda mempunyai " + data.notifikasi.length +" notifikasi yang belum dibaca.</span></div>";
              $(alert).appendTo("#card-notifikasi");
              alert="";
              $.each(data['notifikasi'], function(index, obj) {
                alert += "<a href='<?= base_url()?>"+obj.url+"?rd=yes&id="+ obj.id +"'><div class='media new'><div class='media-body'><p><strong>"+ obj.short_msg +"</strong></p><span>"+ obj.insert_date+"</span></div></div></a>";
              })
              $(alert).appendTo(".az-notification-list");
              if(data['notifikasi_count'] > 0){
                $("<mark>"+data['notifikasi_count']+"</mark>").appendTo("#mark");
              }
            }
          }
        });
      }
   </script>
  </body>

</html>
