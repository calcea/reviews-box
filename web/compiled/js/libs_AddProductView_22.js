/**
 * Created by george on 6/8/2016.
 */

var AddProductView = Backbone.View.extend({
    el: 'body',
    template: '',
    url: '',
    events: {
        'click .add-product': 'addProduct',
        'click .submit-url': 'submitUrl',
        'click .not-found-url': 'saveProduct'
    },
    initialize: function () {
        this.template = new AddProductTemplate();
    },
    addProduct: function (e) {
        this.initModal();
    },
    initModal: function () {
        $('.add-product-modal').dialog({
            resizable: false,
            height: 700,
            width: 1100,
            modal: true,
        });
        $('not-found').hide();
    },
    submitUrl: function (e) {
        var el = $(e.target);
        var inputValue = el.parent().parent().find('input').val();
        $('.error').remove();
        var error = this.validateUrl(inputValue);
        if (error !== '') {
            var errorEl = $('<span></span>').addClass('error').text(error);
            el.parent().parent().find('input').after(errorEl);
            return;
        }
        this.url = inputValue;
        $('.loader').show();
        $(document).trigger('add-product', {url: inputValue});
    },
    validateUrl: function (url) {
        var regex = /\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i;
        if (typeof url === "undefined" || url === '') {
            return 'Va rugam adaugati un url';
        }
        if (!regex.test(url)) {
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
        $('.not-found').show();
    },
    showErrorResponse: function (ajaxResponse) {
        this.showErrorMessage(ajaxResponse);

    },
    saveProduct: function (e) {
        $('.loader').show();
        $(document).trigger('save-product', {url: this.url});
    },
    saveProductSuccess: function (ajaxResponse) {
        if (typeof ajaxResponse.product_url !== "undefined") {
            window.location = ajaxResponse.product_url;
        }
    },
    saveProductError: function (ajaxResponse) {
        this.showErrorMessage(ajaxResponse);
    },
    showErrorMessage: function(ajaxResponse){
        $('.loader').hide();
        if (typeof ajaxResponse.code !== "undefined") {
            var message = this.getErrorMessageByCode(ajaxResponse.code);
            $('.error-message').text(message);
            setTimeout(function () {
                $('.error-message').text('');
            }, 10000);
        }
    },
    getErrorMessageByCode: function (code) {
        switch (code) {
            case 101:
                return "Url-ul introdus nu este valid!";
            case 102:
                return "Url-ul introdus nu apartine unui produs!";
            case 103:
                return "Url-ul introdus apartine unui site necunoscut de catre aplicatie.";
            case 104:
                return "A fost o eroare la salvarea produsului in platforma!";
            default:
                return "Aplicatia a intampinat o eroare. Va rugam incercati din nou.";
        }
    }
});
