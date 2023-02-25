jQuery(document).ready(function($) {
    calculate();
    $("#message").on("keyup", function () {
        calculate();
    });
    $("select.news_portal").change(function () {
        calculate();
    });
});

function calculate() {
    var words = 0;
    if ($("#message").val().trim()) {
        words = $("#message").val().match(/\S+/g).length;
    }
    var intPrice = $(".news_portal option:selected").attr("int_price");
    var min_word = $(".news_portal option:selected").attr("min_word");
    var perWord = $(".news_portal option:selected").attr("per_word");
    var max_word = $(".news_portal option:selected").attr("max_word");
    var vat_price = $(".news_portal option:selected").attr("vat_price");
    var paper = $(".news_portal option:selected").val();
    var extraPrice = 0;
    if (words > min_word && words <= max_word) {
        extraPrice = words - min_word;
    }
    var extraAmt = perWord * extraPrice;
    var totalAmt = parseInt(intPrice) + parseInt(extraAmt);
    var vatAmt = (totalAmt / 100) * vat_price;
    var finalAmt = parseInt(totalAmt) + parseInt(vatAmt);
    if (words > max_word) {
        var trimmed = jQuery("#message").val().split(/\s+/, max_word).join(" ");
        $("#message").val(trimmed + " ");
    } else {
        $("#display_count").text(words);
        $("#word_left").text(max_word - words);
        $("#price").val(finalAmt);
        $("#price_ui").val(finalAmt);
        $(".min_word").text(min_word);
        $(".max_word").text(max_word);
        $(".per_word").text(perWord);
        $(".vat_price").text(vat_price);
        $(".total_amt").text(intPrice);
    }
}