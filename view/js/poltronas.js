 $(document).ready(function () {
    $(".container1").hide();
    $(".poltrona").click(
        function () {
            $(this).css("background-color", "red");
        });
    $(".poltrona").dbclick(function () {
        $(this).css("background-color", "green");

    });
});

$(document).ready(function () {
    $("#botao1").on({
        click: function () {
            $(".container1").show();
        }
    });
});

$(document).ready(function () {
    $(".container2").hide();
    $(".poltrona").click(
        function () {
            $(this).css("background-color", "red");
        });
    $(".poltrona").dbclick(function () {
        $(this).css("background-color", "green");
    });
});

$(document).ready(function () {
    $("#botao2").on({
        click: function () {
            $(".container2").show();
        }
    });
});

