var timer = 0;
var q = '';
var path = '';

function openModal1(elem) {
    var idTarget = elem.id;
    var elemTarget = document.getElementById(idTarget + 'Id');

    if ($(elemTarget).hasClass("hiddens")) {
        console.log(elemTarget);
        $(elemTarget).removeClass('hiddens');
    } else {
        $(elemTarget).addClass('hiddens');
    }


}

$(document).ready(function () {

    $('#q').keyup(function () {
        q = this.value;

        clearTimeout(timer);
        timer = setTimeout(get_result, 1500);
    });
    $('#reset_live_search').click(function () {
        $('#search_result').html('');
    });
});

function openModal(elem) {
    let idTarget = elem.id;
    let elemTarget = document.getElementById(idTarget + 'Id');
    let pathData = $(elemTarget).attr("data-path");
    $(elemTarget).toggleClass('active').slideToggle().find('input').focus();
    if ($(elemTarget).hasClass('active')) {
        $('#search_result').html('');
        $(elemTarget).find('input').val("");
    }
    window.inputOffset = $(elemTarget).find('input').offset();
    window.paths = pathData + "/ajax/ajax_search.php";
}

function get_result() {
    //очищаем результаты поиска
    //пока не получили результаты поиска - отобразим прелоадер
    $('#search_result').html('');
    let preloader = document.getElementById('loader');

    preloader.classList.remove('hidden');
    $(preloader).offset({top: inputOffset.top, left: inputOffset.left + 50 + '%'});
    $.ajax({
        type: "POST",
        url: paths,
        data: "q=" + q,
        dataType: 'json',
        success: function (json) {
            //очистим прелоадер
            preloader.classList.add('hidden');

            $('#search_result').html('').append('<div class="live-search"></div>');

            //добавляем каждый элемент массива json внутрь div-ника с class="live-search" (вёрстку можете использовать свою)

            $.each(json, function (index, element) {

                let result = element.URL.replace(/development/g, "razrabotka");
                result = result.replace(/detail.php\?ID/g, '?ELEMENT_ID');

                $('#search_result').find('.live-search').append('<a href="' + result + '" class="live-search__item"><div class="live-search__item-inner"><h4 class="live-search__item-name"><span class="live-search__item-hl">' + element.TITLE + '</span></h4>' + element.BODY_FORMATED + '</div></a>');

            });

        }
    });
}
