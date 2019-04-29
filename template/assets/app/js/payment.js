function cardValidation () {
var ErrorArr = {
              'card_name':'Card Holder Name',
              'card_number':'Card Number',
              'expire':'Expiry Month / Year',
              'cvv':'CVV'
            };
  for (var key in ErrorArr) {
    $('#'+key+'_error').html(ErrorArr[key]);
    $('#'+key+'_error').removeClass('success_error');
  }
  if($('#name').val()==''){
    $('#card_name_error').html('Enter Cardholder Name');
    $('#card_name_error').addClass('success_error');

    $('#name').focus();
    return false;
  }
  else if($('#card-number').val()==''){
    $('#card_number_error').html('Enter Valid Card Number');
    $('#card_number_error').addClass('success_error');
    $('#card-number').focus();
    return false;
  }
  else if($('#month').val()==''){
    $('#month_error').html('Enter Valid Expiry Month / Year');
    $('#month_error').addClass('success_error');
    $('#month').focus();
    return false;
  }
  else if($('#cvv').val()==''){
    $('#cvv_error').html('Enter Valid CVV');
    $('#cvv_error').addClass('success_error');
    $('#cvv').focus();
    return false;
  }
  return true;
}


//callback to handle the response from stripe
function stripeResponseHandler(status, response) {
  if (response.error) {
      //enable the submit button
      $("#submit-btn").show();
      $( "#loader" ).css("display", "none");
      //display the errors on the form
      $("#error-message").html(response.error.message).show();
  } else {
      //get token id
      var token = response['id'];
      //insert the token into the form
      $("#frmStripePayment").append("<input type='hidden' name='token' value='" + token + "' />");
      //submit form to the server
      $("#frmStripePayment").submit();
  }
}
function stripePay(e) {

  e.preventDefault();
  var valid = cardValidation();

  if(valid == true) {
    Stripe.setPublishableKey($('#publishableKey').val());
      $("#submit-btn").hide();
      $( "#loader" ).css("display", "inline-block");
      Stripe.createToken({
          number: $('#card-number').val(),
          cvc: $('#cvc').val(),
          exp_month: $('#month').val(),
          exp_year: $('#year').val()
      }, stripeResponseHandler);

      //submit from callback
      return false;
  }
}
$('.monthly_yearly span').on('click',function(){
    if($(this).attr('id')=='monthly'){
      $('#amount').val($('#subscriptionMonthly').val());
      $('#yearly').removeClass('selected');
      $('#monthly').addClass('selected');
      $('#subscription_type').val('monthly');
    }else if($(this).attr('id')=='yearly'){
      $('#amount').val($('#subscriptionYearly').val());
      $('#yearly').addClass('selected');
      $('#monthly').removeClass('selected');
      $('#subscription_type').val('yearly');
    }
    $('.selected_plan_desc').html('Your '+$(this).attr('id')+' Subscription cost will be '+ $('#amount').val()+' '+$('#currency').val())
})
$(document).ready(function(){
  $('#amount').val($('#subscriptionMonthly').val());
  $('#currency').val($('#currency_code').val());
  $('#product_name').val($('#product_desc').val());
  $('.selected_plan_desc').html('Your Monthly Subscription cost will be '+ $('#amount').val()+' '+$('#currency').val())
})