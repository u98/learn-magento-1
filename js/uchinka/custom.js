let showColumnsPopup = function (url) {
    jQuery('.u-popup-content').html(`<iframe src="${url}"></iframe>`)
    jQuery('.u-popup-overlay').show();
}

jQuery(function($) {

});


addEventListener("message", function (message) {
    console.log(message.data);
}, false);