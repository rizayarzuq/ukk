( function( $ ) {
    var last_valid_selection = null;

          $('#first_post').change(function(event) {

            if ($(this).val().length > 2) {

              $(this).val(last_valid_selection);
               alert('You can select upto 2 pages only');
            } else {
              last_valid_selection = $(this).val();

            }
          });

          $('#blog-select').change(function(event) {

            if ($(this).val().length > 3) {

              $(this).val(last_valid_selection);
              alert('You can select upto 3 posts only');
            } else {
              last_valid_selection = $(this).val();
            }
          });
} )( jQuery );