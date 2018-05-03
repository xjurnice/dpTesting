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
        $('#number_defect').val($('.fail').size());
        $('#number_skip').val($('.skip').size());
        $('#number_pass').val($('.step').size());
    });


    // Function for reset test progress - default on first step
    function startAgain() {
        $('#pass').addClass('hidden');
        $('.td_steps').removeClass('active-step').removeClass('fail').removeClass('step').removeClass('skip');
        $(".td_steps:first").addClass("active-step");
        $('.def').addClass('hidden');
        scrollToactive('.active-step');
    }

    // Function for current fail step
    function failStep() {
        showButton();
        if (!$('.active-step').closest('tr').next().length) {
            // alert('last fail');
            $('.active-step').find('#defect').addClass('hidden');
            $('.steps').parents('td.active-step').removeClass('fail step skip').addClass('active-step');

        } else {
            $('.active-step').find('#defect').removeClass('hidden');
            $('.steps').parents('td.active-step').removeClass('active-step').removeClass('fail').removeClass('skip').addClass('fail').closest('tr').next().find('td').addClass('active-step');


        }
        scrollToactive('.active-step');

    }

    //function for shown exe button when you have active-step last step
    function showButton() {
        if (!$('.active-step').closest('tr').next().next().length) {
            $('#pass').removeClass('hidden');


        }
    }

    // Function for pass step
    function passStep() {
        showButton();

        if (!$('.active-step').closest('tr').next().length) {
            // alert('last');

            $('.active-step').find('#defect').addClass('hidden');
            $('.steps').parents('td.active-step').removeClass('fail step skip').addClass('active-step');

        } else {
            $('.active-step').find('#defect').addClass('hidden');
            $('.steps').parents('td.active-step').removeClass('active-step').removeClass('fail').removeClass('skip').addClass('step').closest('tr').next().find('td').addClass('active-step');
        }
        scrollToactive('.active-step');
    }

    // Function for back previous
    function previousStep() {
        if (!$('.active-step').closest('tr').prev().prev().length) {
            //alert('first');
            $('.active-step').find('#defect').addClass('hidden');
        }
        else {

            $('.steps').parents('td.active-step').removeClass('active-step').removeClass('fail step skip').closest('tr').prev().find('td').removeClass('fail step skip').addClass('active-step');
            $('.active-step').find('#defect').addClass('hidden');
        }
        scrollToactive('.active-step');
    }

    // Function for skip step
    function skipStep() {
        showButton();
        if (!$('.active-step').closest('tr').next().length) {
            //alert('last skip');
            $('.active-step').find('#defect').addClass('hidden');
            $('.steps').parents('td.active-step').removeClass('fail step skip').addClass('active-step');

        } else {
            $('.active-step').find('#defect').addClass('hidden');
            $('.steps').parents('td.active-step').removeClass('active-step').removeClass('fail').addClass('skip').closest('tr').next().find('td').addClass('active-step');
        }
        scrollToactive('.active-step');
    }


    $(".td_steps:first").addClass("active-step"); //defaultni nastaveni active-step

    function scrollToactive(atr) {
        var $window = $(window),
            $element = $(atr),
            elementTop = $element.offset().top,
            elementHeight = $element.height(),
            viewportHeight = $window.height(),
            scrollIt = elementTop - ((viewportHeight - elementHeight) / 2);

        $window.scrollTop(scrollIt);
    }


    // Keyboard control

    $(document).keydown(function (e) {

        switch (e.keyCode) {
            //Move up
            case 38:
                previousStep();
                scrollToactive('.active-step');
                return false;
                break;
            //Move down
            case 40:
                passStep();
                scrollToactive('.active-step');
                return false;
                break;
            //Fail
            case 39:
                failStep();
                scrollToactive('.active-step');
                return false;
                break;
            //Start again
            case 112:
                startAgain();
                scrollToactive('.active-step');
                return false;
                break;

            //Start again
            case 37:
                skipStep();
                scrollToactive('.active-step');
                return false;
                break;

            //Pause
            case 113:
                clock.stop();
                return false;
                break;

            //Run
            case 114:
                clock.start();
                return false;
                break;


        }
    });

    // Button control
    $('#next').click(function next() {
        passStep();
        scrollToactive('.active-step');
    });


    $('#previous').click(function () {
        previousStep();
        scrollToactive('.active-step');
    });

    $('#fail').click(function () {
        failStep();
        scrollToactive('.active-step');
    });

    $('#start_again').click(function () {
        startAgain();
        scrollToactive('.active-step');

    });
    $('#skip').click(function () {
        skipStep();
        scrollToactive('.active-step');

    });

});