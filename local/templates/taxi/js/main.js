
$(document).mouseup(function (e){ // событие клика по веб-документу
    var div = $("#js-sectionsBlockId"); // тут указываем ID элемента
    var div1 = $("#btn1"); // тут указываем ID элемента
    if (!div.is(e.target)&& !div1.is(e.target) && div.has(e.target).length === 0) { // и не по его дочерним элементам
        div.hide(); // скрываем его
        $("#btn1").removeClass('active').addClass('not-active');
    }
});



function closeModal(elem) {
    let idTarget = elem.id;
    let elemTarget = document.getElementById(idTarget + 'Id');
    $(elemTarget).slideToggle().find('input').focus();
}

jQuery(document).ready(function () {
    var btn = $('.btn1');

    btn.on('click', function () {
        $(this).toggleClass('active');
        $(this).toggleClass('not-active');
    });

    $(document).on('click', '#myModal', function () {
        $('#myModal').modal({
            show: true,
            width: 950
        })
    });
    var $w = $(window).width();
    var $h = $(window).height();


    $(window).resize(function () {
        var $w = $(window).width();
        var $h = $(window).height();


    });


    $(window).scroll(function () {
        setHeader();
        /*setTimeout(function () {
            $(window).trigger('resize.px.parallax');
        }, 375);*/
    });

    function setHeader() {
        var header = $('.header');
        if ($(window).scrollTop() > 100) {
            header.addClass('fixed');
        } else {
            header.removeClass('fixed');
        }
    }
});
