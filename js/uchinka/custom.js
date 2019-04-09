jQuery(function($) {
    $('.custom-grid-btn.btn-delete').click(function(e) {
        confirm('Do you want to delete row id '+ $(e.target).attr('data-id'))
    })
})