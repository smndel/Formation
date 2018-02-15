$('a.order').click(function(e) {
  e.preventDefault();
  // Sorting direction
  var sens;
  if ($('span', this).hasClass('glyphicon-chevron-down')) sens = 'desc';
  else if ($('span', this).hasClass('glyphicon-chevron-up')) sens = 'asc';

  
  var tri;
  if(ens == 'asc') {
    $('span', this).addClass('fa fa-fw fa-sort-desc');
    tri = 'desc';
  } else if(sens == 'desc') {
    $('span', this).addClass('fa fa-fw fa-sort-asc');
    tri = 'asc';
  }
  
  // Send ajax
  $.ajax({
    url: 'post/order',
    type: 'GET',
    dataType: 'json',
    data: "name=" + $(this).attr('name') + "&sens=" + tri
  })
  .done(function(data) {
    $('tbody').html(data.view);
    $('.link').html(data.links);
    $('#tempo').remove();
  })
  .fail(function() {
    $('#tempo').remove();
    alert('{{ trans('back/post.fail') }}');
  });
})