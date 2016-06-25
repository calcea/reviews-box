/**
 * Created by george on 6/23/2016.
 */

var ProductPage = Backbone.View.extend({
    el: 'body',
    events: {
        'submit .review-form': 'addReview'
    },
    render: function () {
        $('img').each(function (el) {
            var src = $(this).data('src');
            if (typeof src !== "undefined" && src !== '') {
                $(this).attr('src', src);
            }
        });
        this.removeTextFromParagraphs();
    },
    removeTextFromParagraphs: function () {
        $('p, td').not('.search-column-1, .search-column-2').each(function (el) {
            var text = $(this).text();
            if(text.trim().length <= 2 && $(this).find('img').length == 0){
                $(this).text('');
            }
        });
    },
    addReview: function(e){

        var textEl = $('#review-textarea');
        if(textEl.val().length <= 0){
           textEl.after(
                $('<span></span>').addClass('error-message').text("Va rugam sa scrieti review-ul in acest camp.")
            );
            setTimeout(function(){
                $('.error-message').remove();
            }, 10000);
            e.preventDefault();
        }
    }
});

var obj = new ProductPage();
obj.render();