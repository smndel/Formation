$(document).ready(function(){

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('.published').click(function(event){

    event.preventDefault();

    let url = window._url_change_status;

    // console.log('ici', url)
    
        id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                'id': id
            },
            success: function(data) {

                console.log(data);

                $('.checkbox').each(function(index){

                     if( data['id'] === $(this).data('id') )
                     {
                      let checked = ($(this).is( ":checked" ) == true)? false : true;

                      $(this).prop('checked', checked);


                      if($(this).is( ":checked" )){
                        $(this).parent().next('p').text('published');
                        console.log('ici');
                      }else{     
                        $(this).parent().next('p').text('unpublished');
                        console.log('la');
                      }
                        
                     }
                  });
            },
        });
    });
});
