var waitForProcessCarrierButton = function (callback) {
    var selector = $('button[name="processCarrier"]');
    if (jQuery(selector).length) {
        callback();
    } else {
        setTimeout(function () {
            waitForProcessCarrierButton(callback);
        }, 500);
    }
};

function shippingMethodChange() {
    var activeRadio = $(".delivery_option_radio input[type='radio']:checked");
    var elValue = parseInt(activeRadio.val());
    var carrierCode = $("#dhlassistant_carrier_code_" + elValue).val();
    var requireSelection = $('#dhlassistant_need_selection_' + elValue).val();
    var parcelIdent = $('#dhlassistant_parcel_ident_value_' + carrierCode).val();

    if (requireSelection && (typeof parcelIdent === 'undefined' || "" === parcelIdent)) {
        waitForProcessCarrierButton(function () {
            $('button[name="processCarrier"]').attr('disabled', true);
        });
    } else {
        waitForProcessCarrierButton(function () {
            $('button[name="processCarrier"]').attr('disabled', false);
        });
    }
}

function parcelMapChange() {
        waitForProcessCarrierButton(function () {
            $('button[name="processCarrier"]').attr('disabled', true);
            $( ".current-address" ).hide();
        });
}

$(".delivery_option_radio input[type='radio']").change(function (e) {
    shippingMethodChange();
});

$('#dhlassistant_ps_checkbox').bind('change', parcelMapChange);
$('#dhlassistant_pl_checkbox').bind('change', parcelMapChange);

shippingMethodChange();
parcelMapChange();
