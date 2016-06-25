/**
 * Created by george on 6/8/2016.
 */
var AddProductModel = Backbone.Model.extend({
    urlPostProduct: '/products/add-product',
    urlSaveProduct: '/products/save-product',
    postProduct: function (requestData, successCallback, errorCallback) {
        var data = {};
        data.format = 'json';
        data.url = requestData.url;
        var _this = this;
        var request = $.ajax({
            url: _this.urlPostProduct,
            method: "POST",
            data: data,
            dataType: "json"
        });
        request.done(function (data) {
            if (typeof successCallback === "function") {
                successCallback(data);
            }
        });

        request.fail(function (data) {
            if (typeof errorCallback === "function") {
                errorCallback(data);
            }
        });
    },
    saveProduct: function (requestData, successCallback, errorCallback) {
        var data = {};
        data.format = 'json';
        data.url = requestData.url;
        var _this = this;
        var request = $.ajax({
            url: _this.urlSaveProduct,
            method: "POST",
            data: data,
            dataType: "json"
        });
        request.done(function (data) {
            if (typeof successCallback === "function") {
                successCallback(data);
            }
        });

        request.fail(function (data) {
            if (typeof errorCallback === "function") {
                errorCallback(data);
            }
        });
    }
});
