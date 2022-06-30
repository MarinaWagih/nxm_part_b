$(function() {

    var owner = $('#owner');
    var cardNumber = $('#cardNumber');
    var cardNumberField = $('#card-number-field');
    var CVV = $("#cvv");
    var mastercard = $("#mastercard");
    var confirmButton = $('#confirm-purchase');
    var visa = $("#visa");
    var amex = $("#amex");

    // Use the payform library to format and validate
    // the payment fields.

    cardNumber.payform('formatCardNumber');
    CVV.payform('formatCardCVC');


    cardNumber.keyup(function() {

        amex.removeClass('transparent');
        visa.removeClass('transparent');
        mastercard.removeClass('transparent');

        if ($.payform.validateCardNumber(cardNumber.val()) === false) {
            cardNumberField.addClass('has-error');
        } else {
            cardNumberField.removeClass('has-error');
            cardNumberField.addClass('has-success');
        }

        if ($.payform.parseCardType(cardNumber.val()) === 'visa') {
            mastercard.addClass('transparent');
            amex.addClass('transparent');
        } else if ($.payform.parseCardType(cardNumber.val()) === 'amex') {
            mastercard.addClass('transparent');
            visa.addClass('transparent');
        } else if ($.payform.parseCardType(cardNumber.val()) === 'mastercard') {
            amex.addClass('transparent');
            visa.addClass('transparent');
        }
    });

    confirmButton.click(function(e) {

        e.preventDefault();
        let cardErrorContainer=$('#credit-card-error');
        cardErrorContainer.addClass('hidden');

        var isCardValid = $.payform.validateCardNumber(cardNumber.val());
        var isCvvValid = $.payform.rvalidateCardCVC(CVV.val());

        if(owner.val().length < 5){
            cardErrorContainer.html('Wrong owner name').removeClass('hidden');
        } else if (!isCardValid) {
            cardErrorContainer.html('Wrong card number').removeClass('hidden');
        } else if (!isCvvValid) {
            cardErrorContainer.html('Wrong CVV').removeClass('hidden');
        } else {
            // Everything is correct.submit form.
            $('#register-form').append('<input type="hidden" name="is_credit_card_valid" value="1">');
            $('#register-form').submit();
        }
    });
});
