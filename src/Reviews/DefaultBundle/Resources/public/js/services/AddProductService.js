/**
 * Created by george on 6/8/2016.
 */
var AddProductService = function () {
    this.init();
    this.bindActions();
};

AddProductService.prototype.model = null;
AddProductService.prototype.view = null;
AddProductService.prototype.init = function () {
    this.view = new AddProductView();
    this.model = new AddProductModel();
};

AddProductService.prototype.bindActions = function () {
    var _this = this;
    var events = {
        'add-product': 'addProduct',
        'save-product': 'saveProduct'
    };

    function registerListener(evtName, callbackName) {
        if (typeof _this[callbackName] === "function") {
            $(document).on(evtName, function (e, eventData) {
                _this[callbackName](eventData);
            });
        }
    }

    for (var i in events) {
        if (typeof events[i] === "object") {
            for (var j in events[i]) {
                registerListener(i, events[i][j]);
            }
        } else {
            registerListener(i, events[i]);
        }
    }
};

AddProductService.prototype.addProduct = function (data) {
    var _this = this;
    this.model.postProduct(data, function (ajaxResponse) {
        if (typeof ajaxResponse.response.error !== "undefined" && ajaxResponse.response.error == 1) {
            _this.view.showErrorResponse(ajaxResponse.response)
            return;
        }
        _this.view.renderProducts(ajaxResponse);
    }, function (ajaxResponse) {
        _this.view.showErrorResponse(ajaxResponse);
    });
};


AddProductService.prototype.saveProduct = function (data) {
    var _this = this;
    this.model.saveProduct(data, function (ajaxResponse) {
        if (ajaxResponse.error == 1) {
            _this.view.saveProductError(ajaxResponse);
            return;
        }
        _this.view.saveProductSuccess(ajaxResponse);
    }, function (ajaxResponse) {
        _this.view.saveProductError(ajaxResponse);
    });
};

var obj = new AddProductService();