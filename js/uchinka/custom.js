let showColumnsPopup = function (url) {
    jQuery('.u-popup-content').html(`<iframe src="${url}"></iframe>`)
    jQuery('.u-popup-overlay').show();
}

jQuery(function($) {
    $('.u-tooltip-media').tooltip({
        items: '[data-url]',
        content: function () {
            let url = $(this).attr('data-url');
            return `<img class="u-img-tooltip" src="${url}"></img>`
        }
    })
});


addEventListener("message", function (message) {
   if (message.data === 'close_popup') {
       jQuery('.u-popup-overlay').hide();
   }
   if (message.data === 're_order') {
       productGridJsObject.reload();
   }
}, false);