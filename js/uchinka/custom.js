jQuery(function($) {
    $('.custom-grid-btn.btn-delete').click(function(e) {
        confirm('Do you want to delete row id '+ $(e.target).attr('data-id'))
    })

    $('#u-add-column-form').submit(function(e) {
        e.preventDefault();
        var form = $(e.target);

    })
})


var showCreateColumn = function () {
    jQuery('.u-form-add-new-column').toggle();
}