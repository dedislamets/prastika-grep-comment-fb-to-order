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
    },
    methods: {
      loadPosting: function(){
        var that = this;
        var sParam = { access_token : 'EAAFJSY5KpxkBAJoZAfubgjlrZAu3V6zXGZA7a6oeiYjrWA4VZAivwx4slQLiOQaZBuEZCjRCcNeiMt5GT6npbSrBa1PKaLhgpOvdctw2VeMgOZBemO4qlJGfo8ZCWFt5TZBAKeCZAmvX2pOlo0nZAFXnJZBuKTE9WIRE7ZAdIpMLABqwC2sFHfh8gu0qp'};
        var link = 'https://graph.facebook.com/2398147220419202/feed?fields=message,story,id,created_time,full_picture';
        $.get(link,sParam, function(data){
          that.list_posting=data.data;
        },'json');
      },
    
    }
  });
</script>