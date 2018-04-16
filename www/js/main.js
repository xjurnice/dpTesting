$.nette.ext('bs-modal', {

    init: function() {
        // if the modal has some content, show it when page is loaded
        var $modal = $('#modal');
        if ($modal.find('.modal-content').html().trim().length !== 0) {
            $modal.modal('show');
        }
    },
    success: function (jqXHR, status, settings) {

        if (typeof settings.responseJSON.snippets != 'undefined') {
            var $snippet = settings.responseJSON.snippets['snippet--modal'];
        }
        if (!$snippet) {
            return;
        }

        var $modal = $('#modal');
        if ($modal.find('.modal-content').html().trim().length !== 0) {
            $modal.modal('show');
        } else {
            $modal.modal('hide');
        }
    }
});



    $(".flash").first().hide().fadeIn(200).delay(2000).fadeOut(1000, function () { $(this).remove()});
