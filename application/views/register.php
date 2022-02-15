
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url(); ?>assets/img//apple-icon.png">
  <link rel="icon" type="image/png" href="<?= base_url(); ?>assets/img//favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Prastika Collection
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!-- Extra details for Live View on GitHub Pages -->

 
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?= base_url(); ?>assets/css/paper-dashboard.min.css?v=2.1.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?= base_url(); ?>assets/demo/demo.css" rel="stylesheet" />
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Google Tag Manager -->
  <style type="text/css">
    .full-page:after {
        background-color: rgb(252, 239, 239);
    }
  </style>
</head>

<body class="login-page">

  <!-- End Google Tag Manager (noscript) -->
  <!-- Navbar -->
  
  <!-- End Navbar -->
  <div class="wrapper wrapper-full-page ">
    <div class="full-page section-image">
      <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
      <div class="content">
        <div class="container">
          <div class="col-lg-6 col-md-8 ml-auto mr-auto">
            <div style="margin-bottom: 10px;">
              <img  src="<?= base_url()?>assets/images/banner.png" />
            </div>
          	<?php if(isset($error)) { echo $error; }; ?>
            <form method="POST" action="<?php echo base_url() ?>index.php/register/daftar">
              <div class="card card-login">
                <div class="card-header ">
                  <div class="card-header ">

                    <h3 class="header text-center">DAFTAR CUSTOMER BARU PRASTIKA COLLECTION</h3>
                    <p style="text-align: center;">Formulir Pendaftaran Prastika Collection</p>
                    <?php if ($this->session->flashdata('message')) { ?>
                      <div class="alert alert-success" style="font-size: 20px;color: navy;"> <?= $this->session->flashdata('message') ?> </div>
                    <?php } ?>
                  </div>
                </div>
                <div class="card-body ">
                  <div class="input-group">
                    <!-- <label style="padding: 10px;font-weight: 500;font-size: 16px;">Email *</label> -->
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <!-- <i class="nc-icon nc-single-02"></i> -->
                      </span>
                    </div>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan Email Anda" required />
                    <?php echo form_error('email'); ?>
                  </div>
                  <div class="input-group">
                    <!-- <label style="padding: 10px;font-weight: 500;font-size: 16px;">Nama Facebook *</label> -->
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <!-- <i class="nc-icon nc-key-25"></i> -->
                      </span>
                    </div>
                    <input type="text" name="nama_facebook" class="form-control" placeholder="Nama Facebook" required />
                    <?php echo form_error('nama_facebook'); ?>
                  </div>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <!-- <i class="nc-icon nc-key-25"></i> -->
                      </span>
                    </div>
                    <input type="text" name="nomor_wa" class="form-control" placeholder="Nomor Whatsapp" required />
                    <?php echo form_error('nomor_wa'); ?>
                  </div>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <!-- <i class="nc-icon nc-key-25"></i> -->
                      </span>
                    </div>
                    <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap" required />
                    <?php echo form_error('nama_lengkap'); ?>
                  </div>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <!-- <i class="nc-icon nc-key-25"></i> -->
                      </span>
                    </div>
                    <textarea rows="2" name="alamat_lengkap" class="form-control" placeholder="Alamat Lengkap" required></textarea>
                    <?php echo form_error('alamat_lengkap'); ?>
                  </div>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <!-- <i class="nc-icon nc-key-25"></i> -->
                      </span>
                    </div>
                    <select name="provinsi" id="provinsi" class="form-control">
                      <option value="">Pilih Provinsi</option>
                      <?php 
                      foreach($provinsi as $row)
                      { 
                        echo '<option value="'.$row->province.'">'.$row->province.'</option>';
                      }
                      ?>
                    </select>
                    <!-- <input type="text" name="provinsi" class="form-control" placeholder="Provinsi" required/> -->
                    <?php echo form_error('provinsi'); ?>
                  </div>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <!-- <i class="nc-icon nc-key-25"></i> -->
                      </span>
                    </div>
                    <select name="kota" id="kota" class="form-control">
                      <option value="">Pilih Kota</option>
                      <?php 
                      foreach($kota as $row)
                      { 
                        echo '<option value="'.$row->kota.'">'.$row->kota.'</option>';
                      }
                      ?>
                    </select>
                    <?php echo form_error('kota'); ?>
                  </div>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <!-- <i class="nc-icon nc-key-25"></i> -->
                      </span>
                    </div>
                    <!-- <input type="text" name="kecamatan" class="form-control" placeholder="Kecamatan" required /> -->
                    <select name="kecamatan" id="kecamatan" class="form-control">
                      <option value="">Pilih Kecamatan</option>
                      <?php 
                        foreach($kecamatan as $row)
                        { 
                          echo '<option value="'.$row->kecamatan.'">'.$row->kecamatan.'</option>';
                        }
                        ?>
                    </select>
                    <?php echo form_error('kecamatan'); ?>
                  </div>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <!-- <i class="nc-icon nc-key-25"></i> -->
                      </span>
                    </div>
                    <select name="kelurahan" id="kelurahan" class="form-control">
                      <option value="">Pilih Kelurahan</option>
                      <?php 
                      foreach($kelurahan as $row)
                      { 
                        echo '<option value="'.$row->kelurahan.'">'.$row->kelurahan.'</option>';
                      }
                      ?>
                    </select>
                    <!-- <input type="text" name="kelurahan" class="form-control" placeholder="Kelurahan" required /> -->
                    <?php echo form_error('kelurahan'); ?>
                  </div>
                  
                  
                  
                  <!-- <div style="border: solid 1px grey;border-radius: 10px;padding: 10px;background-color: #ececec ">
                    LANJUT ORDER DI LIVE, KETIK DEAL-CLUE-ADMIN SINAR. PELANGGAN BARU MAKSIMAL ORDER 2 BARANG JIKA LEBIH DARI 2 WAJIB DEPOSIT KE REK AN. SATYA ANDRIANA ADNAN. REKAPAN AKAN KITA KIRIM H+1 SETELAH LIVE OLEH ADMIN RESMI, KARENA LINK INI KHUSUS DAFTAR. *
                  </div> -->
                  <br />
                  
                </div>
                <div class="card-footer ">
                	<button type="submit" class="btn btn-warning btn-round btn-block mb-3">
						        <!-- <i class="ace-icon fa fa-key"></i> -->
						        <span class="bigger-110">Submit</span>
					        </button>
                  
                </div>
              </div>
              <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
            </form>
          </div>
        </div>
      </div>
      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="<?= base_url(); ?>assets/js/core/jquery.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/core/popper.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/core/bootstrap.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script src="<?= base_url(); ?>assets/js/plugins/bootstrap-switch.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="<?= base_url(); ?>assets/js/plugins/sweetalert2.min.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="<?= base_url(); ?>assets/js/plugins/jquery.validate.min.js"></script>
  <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="<?= base_url(); ?>assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="<?= base_url(); ?>assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="<?= base_url(); ?>assets/js/plugins/bootstrap-datetimepicker.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
  <script src="<?= base_url(); ?>assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="<?= base_url(); ?>assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="<?= base_url(); ?>assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="<?= base_url(); ?>assets/js/plugins/fullcalendar/fullcalendar.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/plugins/fullcalendar/daygrid.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/plugins/fullcalendar/timegrid.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/plugins/fullcalendar/interaction.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="<?= base_url(); ?>assets/js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Bootstrap Table -->
  <script src="<?= base_url(); ?>assets/js/plugins/nouislider.min.js"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Chart JS -->
  <script src="<?= base_url(); ?>assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="<?= base_url(); ?>assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?= base_url(); ?>assets/js/paper-dashboard.min.js" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="<?= base_url(); ?>assets/demo/demo.js"></script>
  <!-- Sharrre libray -->
  <script src="<?= base_url(); ?>assets/js/plugins/jquery.sharrre.js"></script>
  <script>
    $(document).ready(function() {
      $.get('http://pro.rajaongkir.com/api/province?key=6257ae210b00dfa4d6cda76747341c7a', null, function(data){ 

        $('#provinsi').empty();
        $.each(data,function(i,value){
              $('#provinsi').append('<option value="'+value.province+'">'+value.province+'</option>');
          })
      });
      
      $("#provinsi").change(function(e, params){ 
          getKota($('#provinsi').val(),'kota');
      });
      $("#kota").change(function(e, params){   
          getKecamatan($('#kota').val(),'kecamatan');
      });
      $("#kecamatan").change(function(e, params){   
          getKelurahan($('#kecamatan').val(),'kelurahan');
      });

      function getKota(val,name){
        $.get('<?= base_url()?>register/getKota', { prov: val  }, function(data){ 

          $('#' + name).empty();
            $.each(data,function(i,value){
                  $('#' + name).append('<option value="'+value.kota+'">'+value.kota+'</option>');
              })
          });
      }
      function getKecamatan(val,name){
        $.get('<?= base_url()?>register/getKecamatan', { kota: val  }, function(data){ 

          $('#' + name).empty();
            $.each(data,function(i,value){
                  $('#' + name).append('<option value="'+value.kecamatan+'">'+value.kecamatan+'</option>');
              })
          });
      }
      function getKelurahan(val,name){
        $.get('<?= base_url()?>register/getKelurahan', { kec: val  }, function(data){ 

          $('#' + name).empty();
            $.each(data,function(i,value){
                  $('#' + name).append('<option value="'+value.kelurahan+'">'+value.kelurahan+'</option>');
              })
          });
      }
    });
  </script>
  <script>
    $(document).ready(function() {

      $sidebar = $('.sidebar');
      $sidebar_img_container = $sidebar.find('.sidebar-background');

      $full_page = $('.full-page');

      $sidebar_responsive = $('body > .navbar-collapse');
      sidebar_mini_active = false;

      window_width = $(window).width();

      fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

      // if( window_width > 767 && fixed_plugin_open == 'Dashboard' ){
      //     if($('.fixed-plugin .dropdown').hasClass('show-dropdown')){
      //         $('.fixed-plugin .dropdown').addClass('show');
      //     }
      //
      // }

      $('.fixed-plugin a').click(function(event) {
        // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
        if ($(this).hasClass('switch-trigger')) {
          if (event.stopPropagation) {
            event.stopPropagation();
          } else if (window.event) {
            window.event.cancelBubble = true;
          }
        }
      });

      $('.fixed-plugin .active-color span').click(function() {
        $full_page_background = $('.full-page-background');

        $(this).siblings().removeClass('active');
        $(this).addClass('active');

        var new_color = $(this).data('color');

        if ($sidebar.length != 0) {
          $sidebar.attr('data-active-color', new_color);
        }

        if ($full_page.length != 0) {
          $full_page.attr('data-active-color', new_color);
        }

        if ($sidebar_responsive.length != 0) {
          $sidebar_responsive.attr('data-active-color', new_color);
        }
      });

      $('.fixed-plugin .background-color span').click(function() {
        $(this).siblings().removeClass('active');
        $(this).addClass('active');

        var new_color = $(this).data('color');

        if ($sidebar.length != 0) {
          $sidebar.attr('data-color', new_color);
        }

        if ($full_page.length != 0) {
          $full_page.attr('filter-color', new_color);
        }

        if ($sidebar_responsive.length != 0) {
          $sidebar_responsive.attr('data-color', new_color);
        }
      });

      $('.fixed-plugin .img-holder').click(function() {
        $full_page_background = $('.full-page-background');

        $(this).parent('li').siblings().removeClass('active');
        $(this).parent('li').addClass('active');


        var new_image = $(this).find("img").attr('src');

        if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
          $sidebar_img_container.fadeOut('fast', function() {
            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $sidebar_img_container.fadeIn('fast');
          });
        }

        if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
          var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

          $full_page_background.fadeOut('fast', function() {
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
            $full_page_background.fadeIn('fast');
          });
        }

        if ($('.switch-sidebar-image input:checked').length == 0) {
          var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
          var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

          $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
          $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
        }

        if ($sidebar_responsive.length != 0) {
          $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
        }
      });

      $('.switch-sidebar-image input').on("switchChange.bootstrapSwitch", function() {
        $full_page_background = $('.full-page-background');

        $input = $(this);

        if ($input.is(':checked')) {
          if ($sidebar_img_container.length != 0) {
            $sidebar_img_container.fadeIn('fast');
            $sidebar.attr('data-image', '#');
          }

          if ($full_page_background.length != 0) {
            $full_page_background.fadeIn('fast');
            $full_page.attr('data-image', '#');
          }

          background_image = true;
        } else {
          if ($sidebar_img_container.length != 0) {
            $sidebar.removeAttr('data-image');
            $sidebar_img_container.fadeOut('fast');
          }

          if ($full_page_background.length != 0) {
            $full_page.removeAttr('data-image', '#');
            $full_page_background.fadeOut('fast');
          }

          background_image = false;
        }
      });


      $('.switch-mini input').on("switchChange.bootstrapSwitch", function() {
        $body = $('body');

        $input = $(this);

        if (paperDashboard.misc.sidebar_mini_active == true) {
          $('body').removeClass('sidebar-mini');
          paperDashboard.misc.sidebar_mini_active = false;
        } else {
          $('body').addClass('sidebar-mini');
          paperDashboard.misc.sidebar_mini_active = true;
        }

        // we simulate the window Resize so the charts will get updated in realtime.
        var simulateWindowResize = setInterval(function() {
          window.dispatchEvent(new Event('resize'));
        }, 180);

        // we stop the simulation of Window Resize after the animations are completed
        setTimeout(function() {
          clearInterval(simulateWindowResize);
        }, 1000);

      });

    });
  </script>
  <script>
    $(document).ready(function() {
      demo.checkFullPageBackgroundImage();
    });
  </script>
</body>

</html>