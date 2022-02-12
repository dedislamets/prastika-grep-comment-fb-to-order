<script type="text/javascript">
  var app = new Vue({
    el: "#app",
    mounted: function () {
      this.loadPosting();
      this.loadComment();
      this.loadRekap();
      this.loadinit();
      this.loadData();
    },
    updated: function () {
      var that = this;
      
    },
    data: {
      mode:'new',
      id: '<?= $this->input->get("id", TRUE) ?>', 
      list_posting: [],
      list_comment: [],
      list_rekap: [],
      status: 'Non Aktif',
      selected: false,
      format_order: ''
    },
    methods: {
      loadinit: function(){
        // setInterval(function () {
        //   app.loadComment();
        //   app.loadRekap();
        // }, 10000);
      },
      showModal: function(){
        $("#Modal").modal({backdrop: 'static', keyboard: false}) ;  
      },
      loadPosting: function(){
        var that = this;
        var sParam = { access_token : 'EAAFJSY5KpxkBAJoZAfubgjlrZAu3V6zXGZA7a6oeiYjrWA4VZAivwx4slQLiOQaZBuEZCjRCcNeiMt5GT6npbSrBa1PKaLhgpOvdctw2VeMgOZBemO4qlJGfo8ZCWFt5TZBAKeCZAmvX2pOlo0nZAFXnJZBuKTE9WIRE7ZAdIpMLABqwC2sFHfh8gu0qp'};
        var link = 'https://graph.facebook.com/' + that.id + '?fields=full_picture,message,story,created_time';
        $.get(link,sParam, function(data){
          that.list_posting=data;
        },'json');
      },
      loadRekap: function(){
        var that = this;
        $.get('<?= base_url()?>comment/rekap', null, function(data){ 
          that.list_rekap = data.data;
        })
      },
      saveData: function(){
        var that = this;
        const status = (that.selected ? 'Aktif' : 'Non Aktif');
        const param = { id: that.id, format_order: that.format_order, status: status };
        axios.post("<?= base_url()?>comment/update", param)
        .then(response => {
          $("#Modal").modal('hide');
          that.loadData();
        });
      },
      loadData: function(){
        var that = this;
        var article = { id: that.id };
  
        axios.get("<?= base_url()?>comment/data", { params: article })
        .then(response => {
          // debugger;
          that.status = response.data.status;
          that.format_order = response.data.format_order;
          if(response.data.status == 'Aktif'){
            that.selected = true;
          }else{
            that.selected = false;
          }
        });

        // $.get('<?= base_url()?>comment/data', {id: that.id}, function(data){ 
        //   that.status = data.status;
        //   that.format_order = data.format_order;
        //   if(data.status == 'Aktif'){
        //     that.selected = true;
        //   }else{
        //     that.selected = false;
        //   }
        // })
      },
      nextComment: function(url){
        var that = this;
        $.get(url, null,function(next_data){
            that.list_comment = that.list_comment.concat(next_data.data);
            if(next_data.paging.next != undefined){
              that.nextComment(next_data.paging.next);
            }else{
              $.each(that.list_comment, function(_, obj) {
                if(obj.message.includes('#')){
                  var arr = obj.message.split("#");
                  $.each(arr, function(i, row) {
                    if(row.includes('XYZ')){
                      $.get('<?= base_url() ?>register/rekap',{ kode : row, pesan : obj.message }, function(result){
                        // alert(result);
                      })
                    }
                  })
                }
              })
            }
        })
      },
      loadComment: function(){
        var that = this;
        var sParam = { access_token : 'EAAFJSY5KpxkBAJoZAfubgjlrZAu3V6zXGZA7a6oeiYjrWA4VZAivwx4slQLiOQaZBuEZCjRCcNeiMt5GT6npbSrBa1PKaLhgpOvdctw2VeMgOZBemO4qlJGfo8ZCWFt5TZBAKeCZAmvX2pOlo0nZAFXnJZBuKTE9WIRE7ZAdIpMLABqwC2sFHfh8gu0qp'};
        var link = 'https://graph.facebook.com/' + that.id + '/comments';
        $.get(link,sParam, function(data){
          that.list_comment=data.data;
          if(data.paging != undefined){
            that.nextComment(data.paging.next);
          }else{
            $.each(that.list_comment, function(_, obj) {
              if(obj.message.includes('#')){
                var arr = obj.message.split("#");
                $.each(arr, function(i, row) {
                  if(row.includes('XYZ')){
                    $.get('<?= base_url() ?>register/rekap',{ kode : row, pesan : obj.message }, function(result){
                      // alert(result);
                    })
                  }
                })
              }
            })
          }

          
        },'json');
      },
    
    }
  });
</script>