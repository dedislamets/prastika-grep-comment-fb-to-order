<script type="text/javascript">
  var app = new Vue({
    el: "#app",
    mounted: function () {
      this.loadPosting();
    },
    updated: function () {
      var that = this;
      
    },
    data: {
      mode:'new',
      list_posting: [],
      list_scan: [],
      token: '<?= $config['token'] ?>',
      id_group: '<?= $config['id_group'] ?>'
    },
    methods: {
      loadPosting: function(){
        var that = this;
        var sParam = { access_token : that.token};
        var link = 'https://graph.facebook.com/' + that.id_group + '/feed?fields=message,story,id,created_time,full_picture';
        $.get(link,sParam, function(data){  
          that.list_posting=data.data;
        },'json');
      },
    
    }
  });
</script>