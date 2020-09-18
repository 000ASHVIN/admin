$(function(){
  //for cart.blade.php incrent and decrement
    var count = $('#total-cartitems').val();
  
    for(i=1; i<=count; i++) {
      (function (i) {
  
        var quantity = '#total-product-'+i;
        var inc = '#product-increment-'+i;
        var initialprice = '#initial-price-'+i;

        initialprice = Number($(initialprice).val());
        // console.log(initialprice);
        var price = '#show-product-price-'+i;

        $(inc).click(function() {

          var quantityPrice = Number($(price).val());
          // quantityPrice += initialprice;
          

          if(Number($(quantity).val()) > 0 && Number($(quantity).val()) < 10) {
            $(quantity).val(Number($(quantity).val()) + 1);
            $(price).html(initialprice * Number($(quantity).val()));
          }
  
        });
      
        var dec = '#product-decrement-'+i;
        $(dec).click(function() {

          var quantityPrice = Number($(price).val());
          // quantityPrice -= initialprice;
          

        if(Number($(quantity).val()) > 1 && Number($(quantity).val()) < 11) {
          $(quantity).val(Number($(quantity).val()) - 1);
          $(price).html(initialprice * Number($(quantity).val()));
        }

        });
      }).call(this, i);
    }

    //for productDetails.blade.php
    var quantity = '#total-product';
    var initialprice = '#initial-price';
    var price = '#show-product-price';

    initialprice = Number($(initialprice).val());

    $('#product-increment').click(function() {

      var quantityPrice = Number($('#total-product').val());
      // quantityPrice += initialprice;
      

      if(Number($(quantity).val()) > 0 && Number($(quantity).val()) < 10) {
        $(quantity).val(Number($(quantity).val()) + 1);
        $(price).html(initialprice * Number($(quantity).val()));
      }

    });
  
    $('#product-decrement').click(function() {

      var quantityPrice = Number($(price).val());
      // quantityPrice -= initialprice;
      

        if(Number($(quantity).val()) > 1 && Number($(quantity).val()) < 11) {
          $(quantity).val(Number($(quantity).val()) - 1);
          $(price).html(initialprice * Number($(quantity).val()));
        }

    });
});

// $(function () {
//   $("#order-start-date").datepicker({ 
//         autoclose: true, 
//         todayHighlight: true
//   }).datepicker('update', new Date());
// });