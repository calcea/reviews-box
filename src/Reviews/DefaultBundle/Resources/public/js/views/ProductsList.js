/**
 * Created by george on 6/26/2016.
 */

var ProductsList = Backbone.View.extend({
    el: 'body',
    events:{
        'change .chosen-select': 'orderList'
    },
    orderList: function(){
        $('.products-filters').submit();
    }
});

var obj = new ProductsList();