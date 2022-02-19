<div class="sh-pagetitle">
  <div class="input-group">

  </div><!-- input-group -->
  <div class="sh-pagetitle-left">
    <div class="sh-pagetitle-icon"><i class="icon ion-ios-cart mg-t-3"></i></div>
    <div class="sh-pagetitle-title">
      <span>Billing Information</span>
      <h2>Invoice Page</h2>
    </div><!-- sh-pagetitle-left-title -->
  </div><!-- sh-pagetitle-left -->
</div><!-- sh-pagetitle -->

<div class="sh-pagebody">

  <div class="card bd-primary">
    <div class="card-body pd-30 pd-md-60">
      <div class="d-md-flex justify-content-between flex-row-reverse">
        <h1 class="mg-b-0 tx-uppercase tx-gray-400 tx-mont tx-bold">Invoice</h1>
        <div class="mg-t-25 mg-md-t-0">
          <h6 class="tx-primary">Prastika Collection</h6>
          <p class="lh-7">
            Jln. Rawa Situ Cibereum Kp.Pekopen Selatan RT.03/05 <br>
            Kel.Lambang Jaya Kec.Tambun Selatan Kab.Bekasi 17510<br>
            Tel No: 0856-0364-1272<br>
          Email: prastikaadnan3@gmail.com</p>
        </div>
      </div><!-- d-flex -->

      <div class="row mg-t-20">
        <div class="col-md">
          <label class="tx-uppercase tx-13 tx-bold mg-b-20">Penerima</label>
          <h6 class="tx-inverse"><?= $header['nama_lengkap'] ?></h6>
          <p class="lh-7"><?= $header['alamat'] ?><br>
            <?= $header['kelurahan'] ?>, <?= $header['kecamatan'] ?>, <?= $header['kota'] ?>, <?= $header['provinsi'] ?><br>
            <?= $header['nomor_wa'] ?><br>
        </div><!-- col -->
        <div class="col-md">
          <label class="tx-uppercase tx-13 tx-bold mg-b-20">Invoice Information</label>
          <p class="d-flex justify-content-between mg-b-5">
            <span>Invoice No</span>
            <span><?= $header['kode_inv'] ?></span>
          </p>
          <p class="d-flex justify-content-between mg-b-5">
            <span>Posting ID</span>
            <span><?= $header['id_posting'] ?></span>
          </p>
          <p class="d-flex justify-content-between mg-b-5">
            <span>Order Date:</span>
            <span><?= $header['tgl_invoice'] ?></span>
          </p>
        </div><!-- col -->
      </div><!-- row -->

      <div class="table-responsive mg-t-40">
        <table class="table">
          <thead>
            <tr>
              <th class="wd-20p">Kode</th>
              <th class="wd-40p">Nama Barang</th>
              <th class="tx-center">Qty</th>
              <th class="tx-right">Harga</th>
              <th class="tx-right">Subtotal</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($detail as $key => $value) : ?>
                <tr>
                  <td><?= $value['kode_barang'] ?></td>
                  <td class="tx-12"><?= $value['nama_barang'] ?></td>
                  <td class="tx-center"><?= $value['qty'] ?></td>
                  <td class="tx-right"><?= number_format($value['harga']) ?></td>
                  <td class="tx-right"><?= number_format($value['qty'] * $value['harga']) ?></td>
                </tr>

              <?php
              endforeach;

            ?>
            
            
            <tr>
              <td colspan="2" rowspan="4" class="valign-middle">
                <div class="mg-r-20">
                  <label class="tx-uppercase tx-13 tx-bold mg-b-10">Catatan</label>
                  <p class="tx-13">Ini adalah bukti sah transaksi anda. </p>
                </div>
              </td>
              <td class="tx-right">SubTotal</td>
              <td colspan="2" class="tx-right"><?= number_format($header['total'] - $header['ongkir'] - $header['rand']) ?></td>
            </tr>
            <tr>
              <td class="tx-right">Kode Unik</td>
              <td colspan="2"  class="tx-right"><?= $header['rand'] ?></td>
            </tr>
            <tr>
              <td class="tx-right">Ongkir</td>
              <td colspan="2"  class="tx-right"><?= number_format($header['ongkir']) ?></td>
            </tr>
            <tr>
              <td class="tx-right tx-uppercase tx-bold tx-inverse">Total</td>
              <td colspan="2" class="tx-right"><h4 class="tx-primary tx-bold tx-lato"><?= number_format($header['total']) ?></h4></td>
            </tr>
          </tbody>
        </table>
      </div><!-- table-responsive -->

      <hr class="mg-b-60">

      <a href="#" class="btn btn-primary btn-block">Cetak</a>

    </div><!-- card-body -->
  </div><!-- card -->

</div>