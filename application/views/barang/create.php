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
    <div class="card-header bg-primary tx-white"><?= $title ?>
    </div>
    <div class="card-body pd-sm-30">
      <form id="form-barang" name="form-wizard" action="" method="" style="padding-top: 20px;">

        <div class="form-group row">
          <label class="col-sm-2 col-form-label" style="font-weight: bold;">Kode Barang *</label>
          <div class="col-sm-10">
            <input class="form-control" type="text" id="kode_barang" name="kode_barang" value="<?= empty($barang)? '' : $barang['kode_barang'] ?>" required <?= ($mode == 'Edit' ? 'readonly' : '') ?> />
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label" style="font-weight: bold;">Nama Barang *</label>
          <div class="col-sm-10">
            <input class="form-control" type="text" id="nama_barang" name="nama_barang" value="<?= empty($barang)? '' : $barang['nama_barang'] ?>" required />
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label" style="font-weight: bold;">Warna </label>
          <div class="col-sm-10">
            <input class="form-control" type="text" id="warna" name="warna" value="<?= empty($barang)? '' : $barang['warna'] ?>" placeholder="Isi dengan warna" />
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label" style="font-weight: bold;">Spesifikasi </label>
          <div class="col-sm-10">
            <textarea id="spesifikasi" name="spesifikasi" rows="3" class="form-control" placeholder="Isi dengan ukuran, bahan atau keterangan lainnya" value="<?= empty($barang)? '' : $barang['spesifikasi'] ?>"><?= empty($barang)? '' : $barang['spesifikasi'] ?></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label" style="font-weight: bold;">Stok </label>
          <div class="col-sm-10">
            <input class="form-control" type="number" id="stok" name="stok" value="<?= empty($barang)? '' : $barang['stok'] ?>" />
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label" style="font-weight: bold;">Berat(Kg) </label>
          <div class="col-sm-10">
            <input class="form-control" type="number" id="berat" name="berat" value="<?= empty($barang)? '' : $barang['berat'] ?>" />
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label" style="font-weight: bold;">Harga </label>
          <div class="col-sm-10">
            <input class="form-control" type="text" id="harga" name="harga" value="<?= empty($barang)? '' : $barang['harga'] ?>" />
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label" style="font-weight: bold;">Status</label>
          <div class="col-sm-10">
            <select id="status" name="status" class="form-control" >
              <option value="Aktif" <?= empty($barang)? '' : ($barang['status'] == 'Aktif' ? 'selected' : '') ?>>Aktif</option>
              <option value="Non Aktif" <?= empty($barang)? '' : ($barang['status'] == 'Non Aktif' ? 'selected' : '') ?>>Non Aktif</option>
            </select>
          </div>
        </div>
        <div class="form-group row" style="margin-top: 10px;">
          <div class="col-sm-2">
            <input type="hidden" name="mode" id="mode" value="<?= $mode ?>">
            <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
            <button class="btn btn-success btn-sm btn-block" id="btnSave" ><i class="fa fa-save"></i> Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
