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
 **/
// TODO создаем страницу и туда /stream/taxi/index.php
// TODO в /bitrix/modules/ ставим модуль cab.extfeedbackform и ставим его же в /local/modules/
// TODO http://caytex.ru/bitrix/admin/partner_modules.php?lang=ru устанавливаем
// TODO ставим в /local/components/ папку taxi
// TODO ставим папку /local/vendor/ файлы composer.json и composer.lock в папку local
// TODO подключить /local/vendor/autoload.php в init.php
// TODO тестить на id=562

$this->setFrameMode(true);

include_once __DIR__ . '/Driver.php';


Driver::addDrivers($arResult);
Driver::getArrayApiAllDrivers();
Driver::getArrayApiDriverById();


$arrDriversIds = array(568, 476);


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
            <td> <?= $item['PROPERTY_71']; ?></td>
            <td>
                <span class="nameDriver" data-id="<?= $item['ID']; ?>" onclick="modalOpen(this)">
                    <?= $item['NAME'] ?>
                </span>
            </td>

            <td>
                <?
                $phones = $item['PROPERTY_72'];

                foreach ($phones as $i => $phone) {

                    echo $phone;
                } ?>

            </td>
            <td>
                <? if ($item['PROPERTY_70'] != "") {
                    echo $item['PROPERTY_70'];
                } else {
                    echo "Договор не заполнен";
                }

                ?>

            </td>
            <td><a download href="/local/text.txt">Скачать</a></td>
            <td>
                <? if ($item['PROPERTY_70'] != "") { ?>
                    <a download href="/local/components/taxi/contracts/createContract.php?id=<?= $item['ID']; ?>">
                        Скачать
                    </a>
                <? } else {
                    echo "Договор не заполнен";
                }

                ?>


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

