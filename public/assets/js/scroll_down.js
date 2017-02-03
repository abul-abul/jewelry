$(document).ready(function () {

    $(document).on('click', '.header_fac', function(){
        if($(this).hasClass('open'))
            $('.login-wrapper').removeClass('open');
            $('.navbar-toggle').addClass('collapsed');
            $('.navbar-collapse1').removeClass('in');
    });

    function removeParam(key, sourceURL) {
        var rtn = sourceURL.split("?")[0],
            param,
            params_arr = [],
            queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
        if (queryString !== "") {
            params_arr = queryString.split("&");
            for (var i = params_arr.length - 1; i >= 0; i -= 1) {
                param = params_arr[i].split("=")[0];
                if (param === key) {
                    params_arr.splice(i, 1);
                }
            }
            rtn = rtn + "?" + params_arr.join("&");
        }
        return rtn;
    }

    // var originalURL = window.location.href;
    $(document).on('click', 'ul.dropdown-menu.sort li a', function(){
        window.location.search = jQuery.query.set("page", 1);
    });

    // $('ul.dropdown-menu.sort li a').click(function(e){
    //     $( "ul.dropdown-menu.sort li:nth-child(2)").trigger('click');
    //     return false;
    //     location.href=location.href.replace(/&?((crop-image)|(subscription))=([^&]$|[^&]*)/gi, "");
    //     originalURL = removeParam("page", window.location.href);
    //     window.location.href = originalURL;
    // });

    $(document).on('click', '.header_login', function(){
        if($('.login-wrapper').hasClass('open'))
            $('.header_fac').removeClass('open');
            $('.navbar-toggle').addClass('collapsed');
            $('.navbar-collapse1').removeClass('in');
    });

    $(document).on('click', '.navbar-toggle', function(){
        if($('.navbar-toggle').hasClass('collapsed'))
            $('.header_fac').removeClass('open');
            $('.login-wrapper').removeClass('open');
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $('.form-newsletter').submit(function(e) {
        e.preventDefault();
        var current = $(this);
        $.ajax({
            url: '/get-newsletter',
            type: "post",
            data: {
                user_email: $('input[name=user_email]').val(),
                _token: CSRF_TOKEN
            },
            dataType: 'JSON'
        }).done(function (data) {
            var parsed = jQuery.parseJSON(JSON.stringify(data));
            $('.newsletter-success').hide();
            $('.newsletter-danger').hide();
            if(current.parent().hasClass('not-footer-letter')) {
                if(parsed.success){
                    $('.not-footer-letter .newsletter-success').show();
                    $('.not-footer-letter .newsletter-success').html(parsed.message);
                } else {
                    $('.not-footer-letter .newsletter-danger').show();
                    $('.not-footer-letter .newsletter-danger').html(parsed.error);
                }
            } else {
                if(parsed.success){
                    $('.newsletter-success.footer-one').show();
                    $('.newsletter-success.footer-one').html(parsed.message);
                } else {
                    $('.newsletter-danger.footer-one').show();
                    $('.newsletter-danger.footer-one').html(parsed.error);
                }
            }


        });
        return false;
    });

    $.fn.exists = function () {
        return this.length !== 0;
    };

    function setHeader(xhr) {
        xhr.setRequestHeader('Authorization', sessionId);
        xhr.setRequestHeader('X-PrettyPrint', '1');
    }

    $('li.dropdown.megamenu').hover(
        function() {
            $(this).addClass('open');
        },
        function() {
            $(this).removeClass('open');
        }
    );
    $('li.dropdown.megamenu').click(
        function(){
            var url = $(this).children('a').attr('href');
            window.location.href = url;
        }
    );
});