<!-- <script src="https://www.paypal.com/sdk/js?client-id=Aa7Qr7Pd_qx66x3l9Lo52jkdMf9jYyxM3SwOYo4n9qioRCuZKlO_J7LP8jPUJHKq4lHB1VyPOFgYeuNs"></script> -->
<div id="paypal-button"></div>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
  paypal.Button.render({
    // Configure environment
    env: 'sandbox',
    client: {
      sandbox: 'AQlnOfBSkyuuKsp1uofxtAgfPGXXg521uY3ENv2143mT4ZrZInv22g9l-guhZ6djZG5MYz2QoaR963YR',
      production: 'demo_production_client_id'
    },
    // Customize button (optional)
    locale: 'en_US',
    style: {
      size: 'small',
      color: 'gold',
      shape: 'pill',
    },

    // Enable Pay Now checkout flow (optional)
    commit: true,

    // Set up a payment
    payment: function(data, actions) {
      return actions.payment.create({
        redirect_urls:{
          retunr_url:"http://127.0.0.1:8000/execute-payment"
        },
        transactions: [{
          amount: {
            total: '0.01',
            currency: 'USD'
          }
        }]
      });
    },
    // Execute the payment
    onAuthorize: function(data, actions) {
      return actions.redirect();
    }
  }, '#paypal-button');

</script>