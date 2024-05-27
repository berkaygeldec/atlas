jQuery(function($){
  var page = loadmore_params.current_page;
  var max_page = loadmore_params.max_page;

  $('.load-more').click(function(){
      if(page < max_page) {
          page++;
          var data = {
              'action': 'loadmore',
              'page': page
          };

          $.ajax({
              url : loadmore_params.ajaxurl,
              data : data,
              type : 'POST',
              beforeSend : function ( xhr ) {
                  $('.load-more').text('Yükleniyor...'); // Butona "Loading..." metni ekle
              },
              success : function( data ) {
                  if( data ) {
                      $('#load-content').append(data); // Yeni içerikleri id'si 'load-content' olan div'e ekle
                      $('.load-more').text('Daha fazla yükle');
                      if(page >= max_page) $(".load-more").remove(); // Daha fazla sayfa yoksa butonu kaldır
                  } else {
                      $('.load-more').remove(); // Hata durumunda butonu kaldır
                  }
              }
          });
      } else {
          $('.load-more').remove(); // Daha fazla sayfa yoksa butonu kaldır
      }
  });
});
