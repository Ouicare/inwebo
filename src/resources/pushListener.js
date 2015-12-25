function checkPushAjax(checkURL) {
    $.ajax({
        type: "GET",
        cache: false,
        url: checkURL,
        data: '',
        success: function(data) {
            var response = $.parseJSON(data);

            if (response.result == 'OK') {
                $('#authenticationSuccess').show();
            }
            
            else if (response.result == 'WAITING') {
                startPushListener(checkURL)
            }
            
            else if (response.result == 'NOK') {
                $('#authenticationError').show();
            }
        }
    });
}

function startPushListener(checkURL) {
    setTimeout(function() {
        checkPushAjax(checkURL);
    },500);
}


$(document).ready(function() {
    $('#sendPush').live("click", function() {
        $('#authenticationSuccess').hide();
        $('#authenticationError').hide();
    });
});