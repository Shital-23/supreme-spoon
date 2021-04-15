jQuery( document ).ready(function($) {
  
  $(document).on('click', '.wp-lbs-search-btn', function(){

    var form_data = $(this).closest("form#lbs_search_form").serialize();

    var data = {
        action      : 'wp_lbs_search_results',
        form_data   : form_data,
    };

    $.post(WpLbs.ajaxurl, data, function(response) {

      //if( response.data == '' ) {
    
        // console.log($(this).parents('.search-container-wrap'));
        $('.search-result-wrap').html(response.data);
      //}
    });
  });
    
});