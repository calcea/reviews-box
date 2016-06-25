var AddProductTemplate = function () {

};

AddProductTemplate.prototype.template = "<div class='similar-products'>" +
    "<ul class='products-list'><% _.each(products, function(product){ %>" +
        "<li class='col-lg-4 col-md-4 col-sm-4 product'><div class='product-image'>" +
            "<img src='<%= product.images[0].url_overlay_picture %>' alt='Product1'>" +
                "<a href='/product/<%= product.name %>/<%= product.product_id %>' class='product-hover'>" +
                    "<i class='icons icon-eye-1'></i> Vizualizare" +
                "</a>" +
            "</div>" +
            "<div class='product-info'><h5><a href='/product/<%= product.name %>/<%= product.product_id %>'><%= product.name %></a></h5>" +
                "<div class='rating readonly-rating' data-score='4'></div>" +
            "</div>" +
        "</li>" +
    "<% }) %></ul>" +
    "</div>";

AddProductTemplate.prototype.getTemplate = function () {
    return this.template;
};