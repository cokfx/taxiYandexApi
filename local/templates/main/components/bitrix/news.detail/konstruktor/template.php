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
/**<?= SITE_TEMPLATE_PATH ?>*/
$this->setFrameMode(true);
?>
<!--  баннер,калькулятор -->

<section>
    <div class="uk-grid-collapse uk-grid">
        <div class="uk-width-1-6 uk-background-primary uk-visible@l uk-first-column"></div>
        <div class="uk-width-expand" data-src="<?= SITE_TEMPLATE_PATH ?>/img/banner/kitchen.jpg" uk-img>
            <div class="uk-width-3-4@xl">
                <div class="uk-grid uk-flex-middle uk-grid-collapse">
                    <div class="uk-hidden@m uk-width">
                        <img alt="" class="uk-width" data-src="<?= SITE_TEMPLATE_PATH ?>/img/pan.svg" uk-img>
                    </div>
                    <div class="uk-width-3-5@m uk-padding">
                        <div class="">
                            <h1 class="uk-h1 uk-text-primary">
                                Пластиковые окна на кухню - особенности выбора
                            </h1>
                            <p>Выбирай лучшее – расширяй горизонты!</p>
                            <ul class="uk-list">
                                <li>
                                    <svg fill="none" height="24" viewBox="0 0 24 24" width="24"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.2537 7.74604C15.1743 6.66667 13.6505 5.96826 11.9997 5.96826C10.3489 5.96826 8.82513 6.63493 7.74577 7.74604C6.6664 8.82541 5.96799 10.3492 5.96799 12C5.96799 13.6508 6.6664 15.1746 7.74577 16.254C8.82513 17.3333 10.3489 18.0318 11.9997 18.0318C13.6505 18.0318 15.1743 17.3651 16.2537 16.254C17.3331 15.1746 18.0315 13.6508 18.0315 12C18.0315 10.3492 17.3648 8.82541 16.2537 7.74604Z"
                                              fill="#E70E07"/>
                                        <path d="M12 4.09524C12.4444 4.09524 12.8254 3.71429 12.8254 3.26984V0.825397C12.8254 0.380952 12.4444 0 12 0C11.5555 0 11.1746 0.380952 11.1746 0.825397V3.26984C11.1746 3.71429 11.5555 4.09524 12 4.09524Z"
                                              fill="#E70E07"/>
                                        <path d="M18.7619 6.41288L20.5079 4.66684C20.8254 4.34938 20.8254 3.84144 20.5079 3.52398C20.1904 3.20652 19.6825 3.20652 19.365 3.52398L17.619 5.27002C17.3016 5.58748 17.3016 6.09542 17.619 6.41288C17.9047 6.73034 18.4127 6.73034 18.7619 6.41288Z"
                                              fill="#E70E07"/>
                                        <path d="M23.1746 11.1746H20.7301C20.2857 11.1746 19.9047 11.5555 19.9047 12C19.9047 12.4444 20.2857 12.8254 20.7301 12.8254H23.1746C23.619 12.8254 24 12.4444 24 12C24 11.5555 23.619 11.1746 23.1746 11.1746Z"
                                              fill="#E70E07"/>
                                        <path d="M18.7304 17.5872C18.413 17.2698 17.905 17.2698 17.5876 17.5872C17.2701 17.9047 17.2701 18.4126 17.5876 18.7301L19.3336 20.4761C19.6511 20.7936 20.159 20.7936 20.4765 20.4761C20.7939 20.1586 20.7939 19.6507 20.4765 19.3332L18.7304 17.5872Z"
                                              fill="#E70E07"/>
                                        <path d="M12 19.9048C11.5555 19.9048 11.1746 20.2857 11.1746 20.7302V23.1746C11.1746 23.6191 11.5555 24 12 24C12.4444 24 12.8254 23.6191 12.8254 23.1746V20.7302C12.8254 20.2857 12.4444 19.9048 12 19.9048Z"
                                              fill="#E70E07"/>
                                        <path d="M5.23794 17.5872L3.49191 19.3332C3.17445 19.6507 3.17445 20.1586 3.49191 20.4761C3.80937 20.7936 4.31731 20.7936 4.63477 20.4761L6.3808 18.7301C6.69826 18.4126 6.69826 17.9047 6.3808 17.5872C6.09509 17.2698 5.58715 17.2698 5.23794 17.5872Z"
                                              fill="#E70E07"/>
                                        <path d="M4.09524 12C4.09524 11.5555 3.71429 11.1746 3.26984 11.1746H0.825397C0.380952 11.1746 0 11.5555 0 12C0 12.4444 0.380952 12.8254 0.825397 12.8254H3.26984C3.71429 12.8254 4.09524 12.4444 4.09524 12Z"
                                              fill="#E70E07"/>
                                        <path d="M5.23794 6.41288C5.5554 6.73034 6.06334 6.73034 6.3808 6.41288C6.69826 6.09542 6.69826 5.58748 6.3808 5.27002L4.63477 3.52398C4.31731 3.20652 3.80937 3.20652 3.49191 3.52398C3.17445 3.84144 3.17445 4.34938 3.49191 4.66684L5.23794 6.41288Z"
                                              fill="#E70E07"/>
                                    </svg>
                                    Больше естественного света и пространства
                                </li>
                                <li>
                                    <svg fill="none" height="24" viewBox="0 0 24 24" width="24"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path clip-rule="evenodd"
                                              d="M20.2687 2.12402C19.8228 1.91108 19.2924 1.97135 18.9067 2.28072C17.2996 3.57045 14.4067 3.57045 12.8036 2.28072C12.3335 1.90304 11.6625 1.90304 11.1924 2.28072C9.58527 3.57045 6.69241 3.57045 5.08929 2.28072C4.70357 1.97135 4.17321 1.90706 3.72723 2.12402C3.28527 2.34099 3 2.79099 3 3.28518V13.5709C3 17.6008 6.23036 20.9477 11.6424 22.5187C11.7589 22.5508 11.8795 22.5709 12 22.5709C12.1205 22.5709 12.2411 22.5548 12.3576 22.5187C17.7696 20.9477 21 17.6008 21 13.5709V3.28518C21 2.79099 20.7147 2.34099 20.2687 2.12402ZM12.0018 20.9477C9.65534 20.2526 7.73883 19.1838 6.44909 17.8499C5.22767 16.5843 4.60892 15.1459 4.60892 13.5709V3.90392C5.59731 4.51865 6.82677 4.85213 8.14061 4.85213C9.59909 4.85213 10.9611 4.43829 11.9978 3.68293C13.0344 4.43829 14.3924 4.85213 15.8549 4.85213C17.1687 4.85213 18.4022 4.51865 19.3946 3.8999V13.5709C19.3946 15.1459 18.7759 16.5843 17.5545 17.8499C16.2647 19.1838 14.3482 20.2566 12.0018 20.9477ZM7.66249 16.6807C8.66695 17.7173 10.1576 18.5771 12.0018 19.1838C13.846 18.5731 15.3406 17.7133 16.3411 16.6767C17.2611 15.7244 17.7071 14.7079 17.7071 13.5709V6.36283C17.1125 6.48738 16.4937 6.55167 15.8589 6.55167C14.4687 6.55167 13.1428 6.24229 12.0018 5.66372C10.8607 6.24229 9.53481 6.55167 8.14463 6.55167C7.50981 6.55167 6.89106 6.48738 6.29642 6.36283V13.5749C6.29642 14.7119 6.7424 15.7284 7.66249 16.6807Z"
                                              fill="#E70E07" fill-rule="evenodd"/>
                                    </svg>
                                    Долговечность – срок службы 80 лет!
                                </li>
                                <li>
                                    <svg fill="none" height="24" viewBox="0 0 24 24" width="24"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path clip-rule="evenodd"
                                              d="M4.59961 2H7.59961L6.6283 2.97131L13 9.343V2H15V22H13V15.657L6.58594 22.0711L5.58594 21.0711L11.657 15L10.6875 14.0306L11.6875 13.0306L13 14.343V10.657L6.58594 17.0711L5.58594 16.0711L11.657 10L5.6283 3.97131L4.59961 5V2ZM20 2H16V22H20V2ZM5.6283 8.97131L4.59961 10V7H7.59961L6.6283 7.97131L9.61376 10.9568L8.61376 11.9568L5.6283 8.97131Z"
                                              fill="#E70E07" fill-rule="evenodd"/>
                                    </svg>
                                    Прочность – надежно держит форму
                                </li>
                                <li>
                                    <svg fill="none" height="24" viewBox="0 0 24 24" width="24"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path clip-rule="evenodd"
                                              d="M10.2363 3C10.5439 3 10.793 3.24904 10.793 3.55664V6.37695H3V3.55664C3 3.24904 3.24904 3 3.55664 3H10.2363ZM10.793 7.49023H3V10.8672H10.793V7.49023ZM6.89648 18.6602C7.20365 18.6602 7.45312 18.4107 7.45312 18.1035C7.45312 17.7963 7.20365 17.5469 6.89648 17.5469C6.58932 17.5469 6.33984 17.7963 6.33984 18.1035C6.33984 18.4107 6.58932 18.6602 6.89648 18.6602ZM10.793 18.1035C10.793 20.2518 9.04477 22 6.89648 22C4.7482 22 3 20.2518 3 18.1035V11.9805H10.793V18.1035ZM8.56641 18.1035C8.56641 17.1827 7.81726 16.4336 6.89648 16.4336C5.97571 16.4336 5.22656 17.1827 5.22656 18.1035C5.22656 19.0243 5.97571 19.7734 6.89648 19.7734C7.81726 19.7734 8.56641 19.0243 8.56641 18.1035ZM11.9062 12.8634L14.7764 15.7336L17.13 13.3799L11.9062 8.15631V12.8634ZM11.8705 18.4974C11.8882 18.3677 11.9059 18.238 11.9059 18.1035V14.4377L13.9889 16.5207L11.8496 18.6599C11.8557 18.6055 11.8631 18.5514 11.8705 18.4974ZM19.8853 10.6248C20.1026 10.4074 20.1026 10.055 19.8853 9.83769L15.1625 5.1148C14.9452 4.8975 14.5928 4.8975 14.3753 5.1148L12.4072 7.08275L17.9172 12.5928L19.8853 10.6248ZM17.4727 22H14.1328V17.9513L17.4727 14.6115V22ZM21.4434 14.207H18.5859V22H21.4434C21.751 22 22 21.751 22 21.4434V14.7637C22 14.4561 21.751 14.207 21.4434 14.207ZM13.0199 22H10.0068C10.3065 21.7604 10.3537 21.7269 10.3958 21.6879C10.4084 21.6762 10.4206 21.664 10.439 21.6456L13.0199 19.0646V22Z"
                                              fill="#E70E07" fill-rule="evenodd"/>
                                    </svg>
                                    Любой цвет из 200 вариантов палитры RAL
                                </li>
                            </ul>
                            <div class="uk-width-1-2@s">
                                <img alt="guardian glass" data-src="<?= SITE_TEMPLATE_PATH ?>/img/partners/guardian-glass-logo.svg" uk-img>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-2-5@m uk-padding uk-padding-remove-left uk-padding-remove-right">
                        <div class="uk-container" data-src="<?= SITE_TEMPLATE_PATH ?>/img/bg-calc.png" uk-img>
                            <div class="uk-padding uk-padding-remove-right uk-padding-remove-left">
                                <h3 class="uk-text-uppercase uk-text-normal" style="color: #fff;">Калькулятор Ваших окон
                                    за 30 секунд!</h3>
                                <form action="/aluminievye-okna/" data-ajax enctype="multipart/form-data" id="form_1451"
                                      method="POST" name="SIMPLE_FORM_2">
                                    <input name="WEB_FORM_ID" type="hidden" value="2">
                                    <input name="web_form_submit" type="hidden" value="Y">
                                    <input name="form_text_4" type="hidden" value="Калькулятор Ваших окон">
                                    <div class="uk-text-small" style="color: #DAE1E5;">
                                        <div class="uk-h6 uk-text-uppercase" style="color: #DAE1E5;">Тип изделия</div>
                                        <div class="uk-grid">
                                            <div>
                                                <label class="uk-display-block uk-margin-small-bottom">
                                                    <input checked class="uk-margin-small-right uk-radio" name="radio2"
                                                           type="radio"> Окна
                                                </label>
                                                <label class="uk-display-block uk-margin-small-bottom">
                                                    <input class="uk-margin-small-right uk-radio" name="radio2"
                                                           type="radio"> Окна в дом
                                                </label>
                                            </div>
                                            <div>
                                                <label class="uk-display-block uk-margin-small-bottom"><input
                                                            class="uk-margin-small-right uk-radio" name="radio2"
                                                            type="radio"> Остекление балкона</label>
                                                <label class="uk-display-block uk-margin-small-bottom"><input
                                                            class="uk-margin-small-right uk-radio" name="radio2"
                                                            type="radio"> Остекление лоджии</label>
                                            </div>
                                        </div>
                                        <div class="uk-margin">
                                            <span class="uk-h6 uk-text-uppercase uk-margin-small-right"
                                                  style="color: #DAE1E5;">Установка окон: </span>
                                            <span class="uk-width-auto uk-width-1-1@s">
                                            <label class="uk-margin-right"><input checked
                                                                                  class="uk-margin-small-right uk-radio"
                                                                                  name="radio3" type="radio"> Да</label>
                                            <label><input class="uk-margin-small-right uk-radio" name="radio3"
                                                          type="radio"> Нет</label>
                                        </span>
                                        </div>
                                        <div class="uk-child-width-1-2@m uk-grid-small" uk-grid>
                                            <div>
                                                <div class=" uk-position-relative">
                                                    <span class="uk-form-icon"
                                                          uk-icon="icon: or-ruler-height; ratio: .8;"></span>
                                                    <input class="uk-input uk-form-large uk-text-small" name="height"
                                                           placeholder="Высота, мм" required type="number">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="uk-position-relative">
                                                    <span class="uk-form-icon" uk-icon="icon: horizontal"></span>
                                                    <input class="uk-input uk-form-large uk-text-small" name="width"
                                                           placeholder="Ширина, мм" required type="number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-inline uk-width-1-1 uk-margin-top">
                                            <span class="uk-form-icon" uk-icon="icon: cus-tel"></span>
                                            <input autocomplete="tel" class="uk-input uk-form-large uk-text-small"
                                                   name="form_text_2" pattern="\+7\s\(\d{3}\)\s\d{3}-\d{2}-\d{2}"
                                                   placeholder="Телефон" required type="tel">
                                        </div>
                                        <button class="uk-button uk-button-primary uk-button-large uk-width-1-1 uk-margin-top uk-padding-remove-left uk-padding-remove-right"
                                                type="submit">
                                            <span class="uk-margin-small-right uk-display-inline-block">
                                                <svg data-svg="button-order" fill="none" height="24" viewBox="0 0 24 24"
                                                     width="24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6.078 3L3 6.114L17.166 20.2132L21 21L20.2792 17.0978L6.078 3ZM18.0375 19.1265C17.9776 19.1863 17.8964 19.2199 17.8118 19.2199C17.7271 19.2199 17.6459 19.1863 17.586 19.1265L4.6395 6.2835C4.57943 6.22363 4.54561 6.14234 4.54547 6.05753C4.54532 5.97272 4.57888 5.89132 4.63875 5.83125C4.69881 5.77145 4.78012 5.73787 4.86488 5.73787C4.94963 5.73787 5.03094 5.77145 5.091 5.83125L18.0375 18.6757C18.1627 18.7995 18.162 19.002 18.0375 19.1265ZM19.1955 17.5275C19.32 17.652 19.32 17.8552 19.1955 17.9797C19.071 18.1035 18.8685 18.1042 18.744 17.9797L5.79675 5.13525C5.673 5.0115 5.673 4.809 5.79675 4.6845C5.922 4.56 6.12375 4.56 6.2475 4.68375L19.1955 17.5275ZM17.0543 6.97725C16.908 6.831 16.908 6.59325 17.0543 6.447C17.2005 6.30075 17.4382 6.30075 17.5845 6.447C17.7307 6.59325 17.7307 6.831 17.5845 6.97725C17.4382 7.1235 17.2013 7.12425 17.0543 6.97725ZM11.2537 16.458L6.7125 21L3 17.319L7.54425 12.7747L8.6085 13.8322L8.30325 14.1375L8.8335 14.6678L8.30325 15.198L7.773 14.6678L7.24275 15.198L7.773 15.7283L7.24275 16.2585L6.7125 15.7283L6.18225 16.2585L6.7125 16.7887L6.18225 17.319L5.652 16.7887L5.12175 17.3197L6.7125 18.9105L10.2053 15.4177L11.2537 16.458ZM12.78 7.539L17.319 3L21 6.7125L16.4902 11.223L15.4418 10.182L18.9105 6.71325L17.3197 5.1225L15.729 6.7125L16.2593 7.24275L15.7283 7.77375L15.198 7.2435L14.6678 7.77375L15.198 8.304L14.6678 8.83425L14.1375 8.30325L13.845 8.59575L12.78 7.539Z"
                                                      fill="white"></path>
                                            </svg>
                                            </span>
                                            Получить расчёт
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>