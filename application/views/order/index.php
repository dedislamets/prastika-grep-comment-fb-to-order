<style type="text/css">
    #ViewTable td {
        padding: 0.45rem;
    }
    .status-wa{
        text-align: center;
        font-weight: 300;
        font-style: italic;
        padding-top: 6px;
    }

    
</style>
<div class="sh-pagetitle">
    <div class="input-group"></div>
    <div class="sh-pagetitle-left">
        <div class="sh-pagetitle-icon"><i class="icon ion-ios-list"></i></div>
        <div class="sh-pagetitle-title">
            <h2>Data Rekapan</h2>
        </div>
    </div>
</div>

<div class="sh-pagebody">
    <div class="card bd-primary card-tab mg-t-20">
      <div class="card-header bg-primary">
        <nav class="nav">
          <a href="#rekapan" class="nav-link active" data-toggle="tab">Rekapan</a>
          <a href="#invoice" class="nav-link" data-toggle="tab">Invoice</a>
        </nav>
      </div><!-- card-header -->
      <div class="card-body tab-content">
        <div id="rekapan" class="tab-pane pd-10 active">
            <div style="padding: 10px;">
                <div class="form-group row">
                  <label class="col-sm-1 col-form-label" style="font-weight: bold;">TANGGAL </label>
                  <div class="col-sm-3">
                    <input class="form-control" type="date" id="tanggal" name="tanggal" v-model="tanggal" @change="ganti" />
                  </div>
                </div>
            </div>
            <div class="table-wrapper">
                <table id="ViewTable" class="table">
                    <thead class="text-primary">
                        <tr>
                            <th style="width: 100px">
                              ID Posting
                            </th>
                            <th style="width: 190px;">
                              Tgl Order
                            </th>
                            <th>
                              Nama Pemesan
                            </th>
                            <th>
                              Qty
                            </th>
                            <th>
                              Berat
                            </th>
                            <th>
                              Total
                            </th>
                            <th>
                              Ongkir
                            </th>
                          
                            <th style="width: 100px;">
                              Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(log, index) in list_rekap">
                            <tr>
                                <td>{{log.id_posting}}</td>
                                <td>{{log.tgl_order}}</td>
                                <td>{{log.id_member}} - {{log.nama_lengkap}}</td>
                                <td>{{log.qty}}</td>
                                <td>{{log.berat}}</td>
                                <td>{{ Number(log.Total).toLocaleString() }}</td>
                                <td>{{ Number(log.ongkir).toLocaleString() }}</td>
                                <!-- <td><i class='icon ion-checkmark' style='color: green'></i></td> -->
                                <td><a href='#' class='btn btn-warning btn-sm' @click="saveData(log.id_posting,log.id_member)">Kirim Notifikasi</a></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td style='font-weight:bold;background-color: #f7f7f7;'>Kode Order</td>
                                <td style='font-weight:bold;background-color: #f7f7f7;'>Barang</td>
                                <td style='font-weight:bold;background-color: #f7f7f7;'>Qty</td>
                                <td style='font-weight:bold;background-color: #f7f7f7;'>Berat</td>
                                <td style='font-weight:bold;background-color: #f7f7f7;'>Harga</td>
                            </tr>
                            <tr v-for="(row, i) in log.detail">
                                <td></td>
                                <td>{{row.kode_order}}</td>
                                <td>{{row.nama_barang}}</td>
                                <td>{{row.qty}}</td>
                                <td>{{row.berat}}</td>
                                <td>{{Number(row.harga).toLocaleString()}}</td>
                            </tr>
                        </template>
                        
                </table>
            </div>
        </div>
        <div id="invoice" class="tab-pane pd-10">
            <div class="table-wrapper">
                <table id="InvoiceList" class="table table-striped" width="100%">
                    <thead class="text-primary">
                        <tr>
                            <th style="width: 100px">
                              No Invoice
                            </th>
                            <th>
                              Tgl Invoice
                            </th>
                            <th>
                              Expired
                            </th>
                            <th>
                              Nama Pemesan
                            </th>
                            
                            <th>
                              Qty
                            </th>
                            <th>
                              Berat
                            </th>
                            <th>
                              Ongkir
                            </th>
                            <th>
                              Subtotal
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
        

      </div><!-- card-body -->
    </div>

</div>

