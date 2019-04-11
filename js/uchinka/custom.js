let showColumnsPopup = function (url) {
    jQuery('.u-popup-content').html(`<iframe src="${url}"></iframe>`)
    jQuery('.u-popup-overlay').show();
}

jQuery(function($) {
   $('.u-popup-overlay').click(function (e) {
       $(this).hide();
   })
});