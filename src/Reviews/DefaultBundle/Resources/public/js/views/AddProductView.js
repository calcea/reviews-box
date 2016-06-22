/**
 * Created by george on 6/8/2016.
 */

var AddProductView = Backbone.View.extend({
    el: 'body',
    template: '',
    events: {
        'click .add-product': 'addProduct',
        'click .submit-url' : 'submitUrl'
    },
    initialize: function(){
      this.template = new AddProductTemplate();
    },
    addProduct: function (e) {
        this.initModal();
    },
    initModal: function(){
        $('.add-product-modal').dialog({
            resizable: false,
            height: 700,
            width: 700,
            modal: true,
        });
    },
    submitUrl: function(e){
        var el = $(e.target);
        var inputValue = el.parent().parent().find('input').val();
        $('.error').remove();
        var error = this.validateUrl(inputValue);
        if( error !== ''){
            var errorEl = $('<span></span>').addClass('error').text(error);
            el.parent().parent().find('input').after(errorEl);
            return;
        }
        $('.loader').show();
        $(document).trigger('add-product', {url: inputValue});
    },
    validateUrl: function(url){
        var regex = /\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i;
        if(typeof url === "undefined" || url === ''){
            return 'Va rugam adaugati un url';
        }
        if(!regex.test(url)){
            return 'Url-ul introdus nu este valid';
        }

        return '';
    },
    renderProducts: function (ajaxResponse) {

        var templateProduct = _.template(this.template.getTemplate());
        var html = templateProduct({
            products: ajaxResponse.products
        }).trim();


        var tpl = $(html == "" ? null : html);
        $('.similar-products-wrapper').text('');
        $('.similar-products-wrapper').append(tpl);
        $('.loader').hide();
    },
    showErrorResponse: function(ajaxResponse){
        $('.loader').hide();

    }
});
