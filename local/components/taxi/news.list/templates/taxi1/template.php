<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
/** @var IB=26 */
/** @var $arResult drivers from base
 * @var $arrApiAll drivers from base
 */

$this->setFrameMode(true);


include_once __DIR__ . '/Driver.php';

Driver::addDrivers($arResult);
Driver::getArrayApiAllDrivers();
Driver::getArrayApiDriverById();


$arrDriversIds = array(568, 476);
\Cab\Tools\CBTools::pretty_print(Driver::getBaseDriverById(568));
//\Cab\Tools\CBTools::pretty_print($arrApiAllKeys);// from API


//$result = array_diff_key($arrBaseAllKeys, $arrApiAllKeys);

//\Cab\Tools\CBTools::pretty_print($arrDif);

?>
<style>
    .modal .modal-title {
        display: inline-block;
        color: #fff;
    }

    .modal .label {
        color: #555555 !important;
    }

    .modal .modal-backdrop {
        height: 100% !important;
        position: fixed !important;
    }


</style>
<!--// TODO rest with data Bank by BIK-->

<!--// TODO создание файла договора из данных водилы и банка и тела договора-->

<!--// TODO ссылка на скачивание-->
<!--// TODO скрипт на перевод денег в 12 и 16 запрос на сравнение баланса водилы и 100р, остальное создание платежки-->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 50%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div id="modal-body" class="modal-body">

            </div>

        </div>
    </div>
</div>

<table id="example1" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>ID водителя</th>
        <th>ФИО</th>
        <th>Телефон</th>
        <th>Дата подписания</th>
        <th>Оферта</th>
        <th>Агентский договор</th>
    </tr>
    </thead>

    <tbody>
    <? foreach ($arResult['ITEMS'] as $i => $item): ?>

        <tr>
            <td> <?= $item['PROPERTY_103']; ?></td>
            <td>
                <span data-id="<?= $item['ID']; ?>" onclick="modalOpen(this)">
                    <?= $item['NAME'] ?>
                </span>
            </td>

            <td>
                <?
                $phones = $item['PROPERTY_101'];

                foreach ($phones as $i => $phone) {

                    echo $phone;
                } ?>

            </td>
            <td>
                <? if ($item['PROPERTY_102'] != "") {
                    echo $item['PROPERTY_102'];
                } else {
                    echo "Договор не заполнен";
                }

                ?>

            </td>
            <td><a download href="/local/text.txt">Скачать</a></td>
            <td><a download
                   href='http://sokolru.ru/taxi/taxilist/index.php'>Скачать</a>
            </td>
        </tr>=
    <? endforeach; ?>

    </tbody>
</table>


<script src="<? /*= SITE_DIR*/ ?>/local/components/taxi/momentjs/moment.min.js"></script>

<? $this->addExternalJS($templateFolder . "/js.js"); ?>
<script>
    function modalOpen(elem) {
        //e.preventDefault();

        const idElem = $(elem).attr("data-id");
        const url = '<?=$templateFolder?>/ajaxElemForm.php';
        $.ajax({
            type: 'POST',
            url: url,
            data: "act=update&id=" + idElem,
            //dataType: 'json',
            success: function (result) {
                $('#modal-body').html(result);//PROPERTY[PROP_DRIVER_DATE_AGREE][0][VALUE]
                $('#exampleModal').modal('show');//moment().format('MMMM Do YYYY');
            }

        });

    }

    function onBank(t) {
        if ($(t).val().length == 9) {
            // очищаем форму и ошибки
            document.getElementById('error').innerHTML = '';
            $('input#PROP_DRIVER_BANK_0').val("");

            $('input#PROP_DRIVER_KOR_SCHET_0').val("");
            // отправляем запрос на сервер и обрабатываем результат
            fetch('https://htmlweb.ru/json/service/bic/' + $(t).val())
                .then(
                    function (data) { // обрабатываем ответ от сервера
                        if (data.status !== 200) {
                            return Promise.reject(new Error(data.statusText));
                        }

                        return data.json(); // раскодируем json в объект
                    })
                .then(
                    function (data) {
                        console.log('data:', data);
                        $('input#PROP_DRIVER_BANK_0').val(data.name);
                        $('input#PROP_DRIVER_KOR_SCHET_0').val(data.ks);
                        $('#PROP_DRIVER_DATE_AGREE_0').val(moment().format('YYYY-MM-DD'));
                    })
                .catch(
                    function (error) {
                        console.error(error)
                    });
        } else {
            document.getElementById('error').innerHTML = 'Неверный БИК';
        }
    }

    $('document').ready(function () {
        $('#example1').DataTable({
            "language": {
                "lengthMenu": "Выводить _MENU_ записей на страницу",
                "zeroRecords": "Ничего не найдено, извините",
                "info": "Показано страниц _PAGE_ из _PAGES_",
                "infoEmpty": "Нет данных",
                "infoFiltered": "(фильтр по _MAX_ кол-ву записей)"
            }
        });
        $("#exampleModal").draggable({
            handle: ".modal-header"
        });

    });

</script>

