<div class="sh-breadcrumb">
    <nav class="breadcrumb">
      <a class="breadcrumb-item" href="#">Barang</a>
    </nav>
</div>
<div class="sh-pagetitle">
    <div class="input-group"></div>
    <div class="sh-pagetitle-left">
        <div class="sh-pagetitle-icon"><i class="icon ion-ios-list"></i></div>
        <div class="sh-pagetitle-title">
            <h2>Data Barang</h2>
        </div>
    </div>
</div>

<div class="sh-pagebody">

    <div class="card bd-primary">
        <div class="card-header bg-primary tx-white">List Data Members
            <div class="pull-right">
                <a class="btn btn-block btn-dark btn-rounded" id="btnAdd" href="<?= base_url() ?>barang/create"><i class="fa fa-plus"></i>&nbsp; Tambah</a>
            </div>
        </div>
        <div class="card-body pd-sm-30">

            <div class="table-wrapper">
                <table id="ViewTable" class="table table-striped">
                    <thead class="text-primary">
                        <tr>
                            <th style="width: 100px">
                              Kode Barang
                            </th>
                            <th style="width: 250px">
                              Nama Barang
                            </th>
                            <th>
                              Warna
                            </th>
                            <th>
                              Spesifikasi
                            </th>
                            <th>
                              Stok
                            </th>
                            <th>
                              Berat(Kg)
                            </th>
                            <th>
                              Harga
                            </th>
                            <th>
                              Status
                            </th>
                            <th>
                              Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
  $this->load->view($modal); 
?>
