// code using for running case, change color steps, key control etc.

var clock;

$(document).ready(function () {


    clock = $('.clock').FlipClock(0, {
        clockFace: 'MinuteCounter',
        countdown: false,
        autoStart: true,
        minimumDigits: 2,
        language: "Czech",
        callbacks: {
            start: function () {
                $('#message').html('Test byl spuštěn');


            }
        }
    });

    $('#start').click(function (e) {

        clock.start();
        $('#spend_time').val(clock.getTime());
    });

    $('#stop').click(function (e) {

        clock.stop();

    });

    $('#pass').click(function (e) {

        clock.start();

        $('#spend_time').val(clock.getTime());
    });

    // Function for reset test progress - default on first step
    function startAgain() {
        $('#pass').addClass('hidden');
        $('.td_steps').removeClass('active').removeClass('fail').removeClass('step').removeClass('skip');
        $(".td_steps:first").addClass("active");
        scrollToActive();
    }

    // Function for current fail step
    function failStep() {
        showButton();
        if (!$('.active').closest('tr').next().length){
            // alert('last fail');

            $('.steps').parents('td.active').removeClass('fail step skip').addClass('active');

        } else {
            $('.steps').parents('td.active').removeClass('active').removeClass('fail').removeClass('skip').addClass('fail').closest('tr').next().find('td').addClass('active');
        }
        scrollToActive();


    }

    //function for shown exe button when you have active last step
    function showButton() {
        if (!$('.active').closest('tr').next().next().length){
            $('#pass').removeClass('hidden');
        }
    }

    // Function for pass step
    function passStep() {
        showButton();

        if (!$('.active').closest('tr').next().length){
            // alert('last');


            $('.steps').parents('td.active').removeClass('fail step skip').addClass('active');

        } else {
            $('.steps').parents('td.active').removeClass('active').removeClass('fail').removeClass('skip').addClass('step').closest('tr').next().find('td').addClass('active');
        }
        scrollToActive('.active');
    }

    // Function for back previous
    function previousStep() {
        if (!$('.active').closest('tr').prev().prev().length){
            //alert('first');
        }
        else {
            $('.steps').parents('td.active').removeClass('active').removeClass('fail step skip').closest('tr').prev().find('td').removeClass('fail step skip').addClass('active');
        }
        scrollToActive('.active');
    }

    // Function for skip step
    function skipStep() {
        showButton();
        if (!$('.active').closest('tr').next().length){
            alert('last skip');

            $('.steps').parents('td.active').removeClass('fail step skip').addClass('active');

        } else {
            $('.steps').parents('td.active').removeClass('active').removeClass('fail').addClass('skip').closest('tr').next().find('td').addClass('active');
        }
        scrollToActive('.active');
    }


    $(".td_steps:first").addClass("active"); //defaultni nastaveni active

    function scrollToActive(atr) {
        var $window = $(window),
            $element = $(atr),
            elementTop = $element.offset().top,
            elementHeight = $element.height(),
            viewportHeight = $window.height(),
            scrollIt = elementTop - ((viewportHeight - elementHeight) / 2);

        if($(".active")[0]) {
            $window.scrollTop('#');

        }
        $window.scrollTop(scrollIt);
    }

    //funkce na kliknuti na urcity prvek
    $(".steps").click(function () {
        $('.steps:first').parents('td').removeClass('active fail step skip');
        $('.steps').parents('td').removeClass('active');
        $(this).parents('td').addClass('active');
    });

    // Keyboard control

    $(document).keydown(function (e) {

        switch (e.keyCode) {
            //Move up
            case 38:
                previousStep();
                scrollToActive('.active');
                return false;
                break;
            //Move down
            case 40:
                passStep();
                scrollToActive('.active');
                return false;
                break;
            //Fail
            case 39:
                failStep();
                scrollToActive('.active');
                return false;
                break;
            //Start again
            case 83:
                startAgain();
                scrollToActive('.active');
                return false;
                break;

            //Start again
            case 37:
                skipStep();
                scrollToActive('.active');
                return false;
                break;

            //Pause
            case 80:
                clock.stop();
                return false;
                break;

            //Run
            case 82:
                clock.start();
                return false;
                break;


        }
    });

    // Button control
    $('#next').click(function next() {
        passStep();
        $(".active").get(0).scrollIntoView();
    });


    $('#previous').click(function () {
        previousStep();
    });

    $('#fail').click(function () {
        failStep();
    });

    $('#start_again').click(function () {
        startAgain();

    });
    $('#skip').click(function () {
        skipStep();

    });

});