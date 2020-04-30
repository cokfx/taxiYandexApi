<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); //echo '<pre>';print_r($arResult);echo '<pre>';?>
<?
//echo "<pre>Template arParams: "; print_r($arParams); echo "</pre>";
//echo "<pre>Template arResult: "; print_r($arResult); echo "</pre>";
//exit();
?>

<div class="feedback" id="feedback<?=$arParams['COMPONENT_ID']?>">
	<?if($arParams["FORM_NAME"]):?>
		<h2 class="caption"><?=$arParams["FORM_NAME"]?></h2>
	<?endif?>

	<?if (!$arParams["FIELD_ERROR_POSITION"] && count($arResult["ERRORS"])):?>	
		<div class="error-text show">
			<div class="message">
			<?=implode("<br />", $arResult["ERRORS"])?>
			</div>
		</div>	
		<br/>
	<?endif?>
	<?if (count($arResult["MAIN_ERRORS"])):?>
		<div class="error-text show">
			<div class="message">
			<?=implode("<br />", $arResult["MAIN_ERRORS"])?>
			</div>
		</div>
		<br/>
	<?endif?>
	<?if (strlen($arResult["MESSAGE"]) > 0):?>
		<?=ShowNote($arResult["MESSAGE"])?>
	<?endif?>

	<form name="iblock_add" action="<?=$APPLICATION->GetCurPageParam("", array("strIMessage"), $get_index_page=false)//POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
		<?=bitrix_sessid_post()?>
		<input type="hidden" name="component_id" value="<?=$arParams['COMPONENT_ID']?>">

		<?if ($arParams["MAX_FILE_SIZE"] > 0):?><input type="hidden" name="MAX_FILE_SIZE" value="<?=$arParams["MAX_FILE_SIZE"]?>" /><?endif?>

		<table class="data-table" width="<?=$arParams['DATA-TABLE-WIDTH']?>" cellspacing="0" cellpadding="0">
			<colgroup>
				<col width="<?=$arParams['DATA-TABLE-COL1-WIDTH']?>">
				<col width="<?=$arParams['DATA-TABLE-COL2-WIDTH']?>">
			</colgroup>
			<?if (is_array($arResult["PROPERTY_LIST"]) && count($arResult["PROPERTY_LIST"] > 0)):?>
			<tbody>
				<?$z_index = 100;?>
				<?foreach ($arResult["PROPERTY_LIST"] as $propertyID):?>
					<tr>
						<td class="label <?=$arParams['DATA-TABLE-LABEL-ALIGN-H']?> <?=$arParams['DATA-TABLE-LABEL-ALIGN-V']?>"><?
							if (strpos($propertyID, 'PROP_') === 0):?>
								<?$label = !empty($arParams["CUSTOM_TITLE_".$propertyID]) ? $arParams["CUSTOM_TITLE_".$propertyID] : $arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"];?>
							<?else:?>
								<?$label = !empty($arParams["CUSTOM_TITLE_".$propertyID]) ? $arParams["CUSTOM_TITLE_".$propertyID] : GetMessage("IBLOCK_FIELD_".$propertyID)?>
							<?endif?>
							<?=$label;?>
							<?if(in_array($propertyID, $arResult["PROPERTY_REQUIRED"])):?><span class="starrequired">*</span><?endif?>
						</td>
						<td class="data" id="<?=$propertyID?>">
							<div class="wrapper" style="z-index:<?=$z_index--?>">
							<?
							if (strpos($propertyID, 'PROP_') === 0)
							{
								if(in_array($propertyID, $arParams['USE_TEXT_FOR_HTML'])){	
									$arResult["PROPERTY_LIST_FULL"][$propertyID]["USER_TYPE"] = "";
									$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "T";
									$arResult["PROPERTY_LIST_FULL"][$propertyID]["~DEFAULT_VALUE"] = $arResult["PROPERTY_LIST_FULL"][$propertyID]["~DEFAULT_VALUE"]['TEXT'];
									$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] = 5;
									unset($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"]);
								}
								elseif (
									$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "T"
									&&
									$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] == "1"
								)
									$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "S";
								elseif (
									(
										$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "S"
										||
										$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "N"
									)
									&&
									$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] > "1"
								)
									$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "T";
							}
							elseif (($propertyID == "TAGS") && CModule::IncludeModule('search'))
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "TAGS";

							if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y")
							{
								$inputNum = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE_CNT"];

								switch($arResult["PROPERTY_LIST_FULL"][$propertyID]['USER_TYPE']){
									case 'EList': if($arResult["PROPERTY_LIST_FULL"][$propertyID]['USER_TYPE_SETTINGS']['multiple'] == 'Y')	$inputNum = 1;
										break;
									case 'DateTime':
										break;
									default:
										switch($arResult["PROPERTY_LIST_FULL"][$propertyID]['PROPERTY_TYPE']){
											case 'F':
												if(isset($arParams["FILES_MIN_CNT_$propertyID"])) $inputNum = $arParams["FILES_MIN_CNT_$propertyID"];
												$inputNum = max(count($arParams['PREDEFINED'][$propertyID]), $inputNum);
												break;										
										}
								}
							}
							else
							{
								$inputNum = 1;
							}

							if($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"])
								$INPUT_TYPE = "USER_TYPE";
							else
								$INPUT_TYPE = $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"];

							switch ($INPUT_TYPE):
								case "USER_TYPE":?>
									<div class="user-type">
								<?
									for ($i = 0; $i<$inputNum; $i++)
									{
										if ($arResult['HAS_ERROR'])
										{
											$value = (strpos($propertyID, 'PROP_') === 0) ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["~VALUE"] : $arResult["ELEMENT"][$propertyID];
											$description = (strpos($propertyID, 'PROP_') === 0) ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["DESCRIPTION"] : "";
										}
										else
										{
											if(isset($arParams['PREDEFINED'][$propertyID][$i]) && $arParams['PREDEFINED'][$propertyID][$i])
												$value = $arParams['PREDEFINED'][$propertyID][$i];
											elseif($i == 0){
												$value = (strpos($propertyID, 'PROP_') !== 0) ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["~DEFAULT_VALUE"];
											}else $value = '';	
											
											$description = "";
										}

										switch($arResult["PROPERTY_LIST_FULL"][$propertyID]['USER_TYPE']){
											case 'HTML':
												if(is_array($value)){
													$value['TYPE'] = ($value['TYPE']) ? $value['TYPE']: '';
													$value['TEXT'] = ($value['TEXT']) ? $value['TEXT']: '';
													$prop_val = array(
														"VALUE" => $value,
														"DESCRIPTION" => $description,
													);
												}else{
													$prop_val = array(
														"VALUE" => array('TYPE' => 'html', 'TEXT' => ($value) ? $value: ''),
														"DESCRIPTION" => $description,
													);
												}									

												break;
											default:	
												if($arResult["PROPERTY_LIST_FULL"][$propertyID]['MULTIPLE'] == 'Y' && is_array($value)){
													foreach($value as $key => $val){
														$prop_val[] = array(
															"VALUE" => $val,
															"DESCRIPTION" => $description[$key],
														);
													}										
												}else
													$prop_val = array(
														"VALUE" => $value,
														"DESCRIPTION" => $description,
													);											
										}

										$user_type_class = '';
										if($arResult["PROPERTY_LIST_FULL"][$propertyID]['USER_TYPE'] == 'DateTime') $user_type_class = 'DateTime';
										echo '<span class="UT'.$user_type_class.'">';										
										echo call_user_func_array($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"],
											array(
												$arResult["PROPERTY_LIST_FULL"][$propertyID],
												$prop_val,
												array(
													"VALUE" => "PROPERTY[".$propertyID."][".$i."][VALUE]",
													"DESCRIPTION" => "PROPERTY[".$propertyID."][".$i."][DESCRIPTION]",
													"FORM_NAME"=>"iblock_add",
												),
											));
										echo '</span>';																							
										if($i<($inputNum-1)):?><br /><?endif;
									}?>
									</div>
									<?
								break;
								case "TAGS":?>
									<?
									if($arResult['HAS_ERROR'])
										$value = $arResult["ELEMENT"][$propertyID];
									elseif(isset($arParams['PREDEFINED'][$propertyID][0]) && $arParams['PREDEFINED'][$propertyID][0])
										$value = $arParams['PREDEFINED'][$propertyID][0];
									else	
										$value = '';
									?>
								
									<div class="tags">
									<?$APPLICATION->IncludeComponent(
										"bitrix:search.tags.input",
										"",
										array(
											"VALUE" => $value,
											"NAME" => "PROPERTY[".$propertyID."][0]",
											"TEXT" => 'size="'.$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"].'"',
										), null, array("HIDE_ICONS"=>"Y")
									);?>
									</div>
									<?break;
								case "HTML":?>
									<div class="lhe">
								<?
									if($arResult['HAS_ERROR'])
										$value = $arResult["ELEMENT"][$propertyID];
									elseif(isset($arParams['PREDEFINED'][$propertyID][0]) && $arParams['PREDEFINED'][$propertyID][0])
										$value = $arParams['PREDEFINED'][$propertyID][0];
									else	
										$value = '';
								
									$LHE = new CLightHTMLEditor;
									$LHE->Show(array(
										'id' => preg_replace("/[^a-z0-9]/i", '', "PROPERTY[".$propertyID."][0]"),
										'width' => '100%',
										'height' => '200px',
										'inputName' => "PROPERTY[".$propertyID."][0]",
										'content' => $value, //$arResult["ELEMENT"][$propertyID],
										'bUseFileDialogs' => false,
										'bFloatingToolbar' => false,
										'bArisingToolbar' => false,
										'toolbarConfig' => array(
											'Bold', 'Italic', 'Underline', 'RemoveFormat',
											'CreateLink', 'DeleteLink', 'Image', 'Video',
											'BackColor', 'ForeColor',
											'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyFull',
											'InsertOrderedList', 'InsertUnorderedList', 'Outdent', 'Indent',
											'StyleList', 'HeaderList',
											'FontList', 'FontSizeList',
										),
									));?>
									</div>
									<?break;
								case "T":
									for ($i = 0; $i<$inputNum; $i++)
									{

										if ($arResult['HAS_ERROR'])
										{
											$value = (strpos($propertyID, 'PROP_') === 0) ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
										}
										else
										{
											if(isset($arParams['PREDEFINED'][$propertyID][$i]) && $arParams['PREDEFINED'][$propertyID][$i])
												$value = $arParams['PREDEFINED'][$propertyID][$i];
											elseif($i == 0){											
												$value = $arResult["PROPERTY_LIST_FULL"][$propertyID]["~DEFAULT_VALUE"];
											}else $value = '';
										}
									?>
							<textarea class="textarea" cols="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]?>" rows="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"]?>" name="PROPERTY[<?=$propertyID?>][<?=$i?>]"><?=$value?></textarea>
									<?
									}
								break;

								case "S":
								case "N":
									for ($i = 0; $i<$inputNum; $i++)
									{
										if ($arResult['HAS_ERROR'])
										{
											$value = (strpos($propertyID, 'PROP_') === 0) ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
										}
										else
										{
											if(isset($arParams['PREDEFINED'][$propertyID][$i]) && $arParams['PREDEFINED'][$propertyID][$i])
												$value = $arParams['PREDEFINED'][$propertyID][$i];
											elseif($i == 0){	
												$value = (strpos($propertyID, 'PROP_') !== 0) ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["~DEFAULT_VALUE"];
											}else $value = '';	
										}

										if($propertyID == $arParams['INPUT_AS_PASSWORD']){
									?>
									<input id="<?=$propertyID.'_'.$i?>" class="inputtext" type="password" name="PROPERTY[<?=$propertyID?>][<?=$i?>]" size="25"/>
									<?if($arParams['INPUT_AS_PASSWORD_CONFIRM']):?>
										</td>
									</tr>
									<tr>
										<td class="label <?=$arParams['DATA-TABLE-LABEL-ALIGN-H']?> <?=$arParams['DATA-TABLE-LABEL-ALIGN-V']?>">
										<?=$label.GetMessage('CT_INPUT_ONE_MORE')?>
										<?if(in_array($propertyID, $arResult["PROPERTY_REQUIRED"])):?><span class="starrequired">*</span><?endif?>
										</td>
										<td class="data" id="<?=$propertyID?>_CONFIRM">
									<input id="<?=$propertyID.'_CONFIRM_'.$i?>" class="inputtext" type="password" name="PROPERTY[<?=$propertyID?>_CONFIRM][<?=$i?>]" size="25"/>
									<?endif?>
									<?	
										}else{										
									?>
									<input id="<?=$propertyID.'_'.$i?>" class="inputtext <?if($arResult["PROPERTY_LIST_FULL"][$propertyID]["USER_TYPE"] == "DateTime"):?>datetime<?endif?>" type="text" name="PROPERTY[<?=$propertyID?>][<?=$i?>]" size="25" value="<?=$value?>" /><?
									if($arResult["PROPERTY_LIST_FULL"][$propertyID]["USER_TYPE"] == "DateTime"):?><?
										$APPLICATION->IncludeComponent(
											'bitrix:main.calendar',
											'',
											array(
												'FORM_NAME' => 'iblock_add',
												'INPUT_NAME' => "PROPERTY[".$propertyID."][".$i."]",
												'INPUT_VALUE' => $value,
											),
											null,
											array('HIDE_ICONS' => 'Y')
										);
										?><br /><small class="note"><?=GetMessage("CT_EFBF_FORM_DATE_FORMAT")?><?=FORMAT_DATETIME?></small><?
									endif;
										}
									if($i<($inputNum-1)):?><br /><?endif;
									}
								break;

								case "F":		
									for ($i = 0; $i<$inputNum; $i++)
									{
										if(isset($arParams['PREDEFINED'][$propertyID][$i]) && $arParams['PREDEFINED'][$propertyID][$i])
										{
											$value = $arParams['PREDEFINED'][$propertyID][$i];
											$value_id = $arResult["ELEMENT_FILES_ID"][$value];
										}else{
											$value = "";
											$value_id = 0;
										}
										?>										
							<input type="hidden" name="PROPERTY[<?=$propertyID?>][<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUED"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $i?>]" value="<?=$value_id?>" />
							
							<input class="inputfile" type="file" size="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]?>"  name="PROPERTY_FILE_<?=$propertyID?>_<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>" />
										<?

										if (!empty($value) && is_array($arResult["ELEMENT_FILES"][$value]))
										{
											?><br />
						<input type="checkbox" name="DELETE_FILE[<?=$propertyID?>][<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>]" id="file_delete_<?=$propertyID?>_<?=$i?>" value="Y" /><label for="file_delete_<?=$propertyID?>_<?=$i?>"><?=GetMessage("CT_EFBF_FORM_FILE_DELETE")?></label><br />
											<?

											if ($arResult["ELEMENT_FILES"][$value]["IS_IMAGE"])
											{
												?>
						<img src="<?=$arResult["ELEMENT_FILES"][$value]["SRC"]?>" height="<?=$arResult["ELEMENT_FILES"][$value]["HEIGHT"]?>" width="<?=$arResult["ELEMENT_FILES"][$value]["WIDTH"]?>" border="0" /><br />
												<?
											}
											else
											{
												?>
						<?=GetMessage("CT_EFBF_FORM_FILE_NAME")?>: <?=$arResult["ELEMENT_FILES"][$value]["ORIGINAL_NAME"]?><br />
						<?=GetMessage("CT_EFBF_FORM_FILE_SIZE")?>: <?=$arResult["ELEMENT_FILES"][$value]["FILE_SIZE"]?> b<br />
						[<a href="<?=$arResult["ELEMENT_FILES"][$value]["SRC"]?>"><?=GetMessage("CT_EFBF_FORM_FILE_DOWNLOAD")?></a>]<br />
												<?
											}
										}
										?>
										<br/>
										<?
									}
									if($arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y"):?>										
										<button onclick="return AddMoreFiles(this,'<?=$propertyID?>');"><?=GetMessage("CT_EFBF_MORE_FILES");?></button>
									<?endif;
								break;
								case "E":
								case "G":
									$type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "multiselect" : "dropdown";
									$row_cnt = ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] == 1) ? 5: $arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"];

									?>
									<select id="select_<?=$propertyID?>" class="select " name="PROPERTY[<?=$propertyID?>]<?=$type=="multiselect" ? "[]\" size=\"".$row_cnt."\" multiple=\"multiple" : ""?>">								
											<?if($type == 'dropdown' && $arParams['LIST_NOT_ESTABLISHED_'.$propertyID] == 'Y'):?>	
									<option value=""><?=GetMessage('CT_EFBF_NOT_ESTABLISHED')?></option>
											<?endif;
											
												if (strpos($propertyID, 'PROP_') === 0) $sKey = "ELEMENT_PROPERTIES";
												else $sKey = "ELEMENT";

												foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum)
												{
													$checked = false;
													if ($arResult['HAS_ERROR'])
													{
														foreach ($arResult[$sKey][$propertyID] as $elKey => $arElEnum)
														{
															if ($key == $arElEnum["VALUE"]) {$checked = true; break;}
														}
													}
													else
													{
														if(isset($arParams['PREDEFINED'][$propertyID]) && in_array($arEnum['ID'], $arParams['PREDEFINED'][$propertyID])){
															$checked = true;
														}elseif ($arEnum["DEF"] == "Y") 
															$checked = true;
													}
													?>
										<option value="<?=$key?>" <?=$checked ? " selected=\"selected\"" : ""?>><?=$arEnum["NAME"]?></option>
													<?
												}
											?>
									</select>								
									<?
									break;
								case "L":

									if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["LIST_TYPE"] == "C")
										$type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "checkbox" : "radio";
									else
										$type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "multiselect" : "dropdown";

									switch ($type):
										case "checkbox":
										case "radio":
											if($type == 'radio' && $arParams['LIST_NOT_ESTABLISHED_'.$propertyID] == 'Y'):?>	
									<input class="niceRadio" type="<?=$type?>" name="PROPERTY[<?=$propertyID?>]<?=$type == "checkbox" ? "[".$key."]" : ""?>" value="" id="property_<?=$key?>"/><label for="property_<?=$key?>"><?=GetMessage('CT_EFBF_NOT_ESTABLISHED')?></label><br />		
											<?endif;		

											foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum)
											{
												$checked = false;
												if ($arResult['HAS_ERROR'])
												{
													if (is_array($arResult["ELEMENT_PROPERTIES"][$propertyID]))
													{
														foreach ($arResult["ELEMENT_PROPERTIES"][$propertyID] as $arElEnum)
														{
															if ($arElEnum["VALUE"] == $key) {$checked = true; break;}
														}
													}
												}
												else
												{
													if(isset($arParams['PREDEFINED'][$propertyID]) && in_array($arEnum['ID'], $arParams['PREDEFINED'][$propertyID])){
														$checked = true;
													}elseif ($arEnum["DEF"] == "Y") $checked = true;
												}

												?>
								<input class="<?=$type == "checkbox" ? 'niceCheck' : 'niceRadio'?>" type="<?=$type?>" name="PROPERTY[<?=$propertyID?>]<?=$type == "checkbox" ? "[".$key."]" : ""?>" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label><br />
												<?
											}
										break;

										case "dropdown":
										case "multiselect":
										?>
								<select id="select_<?=$propertyID?>" class="select" name="PROPERTY[<?=$propertyID?>]<?=$type=="multiselect" ? "[]\" size=\"".$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"]."\" multiple=\"multiple" : ""?>">
											<?if($type == 'dropdown' && $arParams['LIST_NOT_ESTABLISHED_'.$propertyID] == 'Y'):?>	
									<option value=""><?=GetMessage('CT_EFBF_NOT_ESTABLISHED')?></option>
											<?endif;											
										
											if (strpos($propertyID, 'PROP_') === 0) $sKey = "ELEMENT_PROPERTIES"; else $sKey = "ELEMENT";

											foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum)
											{
												$checked = false;
												if ($arResult['HAS_ERROR'])
												{
													foreach ($arResult[$sKey][$propertyID] as $elKey => $arElEnum)
													{
														if ($key == $arElEnum["VALUE"]) {$checked = true; break;}
													}
												}
												else
												{
													if(isset($arParams['PREDEFINED'][$propertyID]) && in_array($arEnum['ID'], $arParams['PREDEFINED'][$propertyID])){
														$checked = true;
													}elseif ($arEnum["DEF"] == "Y") $checked = true;												
												}
												?>
									<option value="<?=$key?>" <?=$checked ? " selected=\"selected\"" : ""?>><?=$arEnum["VALUE"]?></option>
												<?
											}
										?>
								</select>
										<?
										break;

									endswitch;
								break;
							endswitch;?>

							<?
								$show_error = ($arParams["FIELD_ERROR_POSITION"] && isset($arResult['ERRORS'][$propertyID]) && !empty($arResult['ERRORS'][$propertyID])) ? 'show' : 'hide';
								$err_msg_pos = ($arParams["ERROR_MESSAGES_POSITION"] == 'FLOAT') ? 'float': '';
							?>
							
							<div class="error-text <?=$err_msg_pos?> <?=$show_error?>">
								<?if($show_error):?>
									<div class="message">
										<?=str_replace('\n', '<br/>', $arResult['ERRORS'][$propertyID]);?>
									</div>
								<?endif?>
							</div>						
							
							</div><!-- wrapper -->
						</td>
					</tr>
				<?endforeach;?>
				<?if($arParams["USE_CAPTCHA"] == "Y" && !$USER->IsAuthorized()):?>
					<tr>
						<td class="label <?=$arParams['DATA-TABLE-LABEL-ALIGN-H']?> <?=$arParams['DATA-TABLE-LABEL-ALIGN-V']?>">
							<?=!empty($arParams["CUSTOM_TITLE_CAPTCHA"]) ? $arParams["CUSTOM_TITLE_CAPTCHA"] : GetMessage("CT_EFBF_FORM_CAPTCHA_TITLE")?>
						</td>
						<td class="data">
							<div id="captcha_block">
								<div class="ajax_loader"></div>
								<input id="captcha_sid" type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
								<img id="captcha_img" src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
								<?if($arParams['USE_CAPTCHA_REFRESH']):?>
								<a id="reload_captcha" href="javascript:void(0)"><?=GetMessage('CT_EFBF_RELOAD_CAPTCHA')?></a>
								<?endif?>
							</div>
						</td>
					</tr>
					<tr>
						<td class="label <?=$arParams['DATA-TABLE-LABEL-ALIGN-H']?> <?=$arParams['DATA-TABLE-LABEL-ALIGN-V']?>">
							<?=!empty($arParams["CUSTOM_TITLE_CAPTCHA_INPUT"]) ? $arParams["CUSTOM_TITLE_CAPTCHA_INPUT"] : GetMessage("CT_EFBF_FORM_CAPTCHA_PROMPT")?><span class="starrequired">*</span>:
						</td>
						<td class="data" id="CAPTCHA">
							<div class="wrapper">
								<input class="inputtext" type="text" name="captcha_word" maxlength="50" value="">
						
								<?
								$show_error = ($arParams["FIELD_ERROR_POSITION"] && isset($arResult['ERRORS']['CAPTCHA']) && !empty($arResult['ERRORS']['CAPTCHA'])) ? 'show' : 'hide';
								$err_msg_pos = ($arParams["ERROR_MESSAGES_POSITION"] == 'FLOAT') ? 'float': '';
								?>
								<div class="error-text <?=$err_msg_pos?> <?=$show_error?>">
									<?if($show_error):?>
										<div class="message">
											<?=str_replace('\n', '<br/>', $arResult['ERRORS']['CAPTCHA']);?>
										</div>
									<?endif?>									
								</div>					
							</div>	
						</td>
					</tr>
				<?endif?>
			</tbody>
			<?endif?>
			<tfoot>
				<tr>
					<td colspan="2" class="submit-td">
						<div class="button-wrap btn1 btn1-item">
							<input class="button btn1 btn1-item-inner" type="submit" name="efbf_submit" value="<?=GetMessage("CT_EFBF_FORM_SUBMIT")?>" />
						</div>
					</td>
				</tr>
			</tfoot>
		</table>

	</form>

	<style type="text/css">	
		#feedback<?=$arParams['COMPONENT_ID']?>{
		<?if($arParams['EFBF_FORM_WIDTH']):?>
			width:<?=$arParams['EFBF_FORM_WIDTH']?>;
		<?endif?>
		}
	</style>
</div>
<script type="text/javascript">

   $(document).ready(function(){
      //$('.bxlhe-editor-buttons').parent('tr').height('14px');
   });
   
   function AddMoreFiles(t, prop){
		var form = $(t).parents('form').eq(0);
		var cnt = $('[type="hidden"][name*="PROPERTY['+prop+']"]', form).size();
		
		$(t).before($('<input type="hidden" name="PROPERTY['+prop+']['+cnt+']" value="0">')).before($('<input class="inputfile" type="file" size="30" name="PROPERTY_FILE_'+prop+'_'+cnt+'">')).before('<br/>');
		return false;
   }
   
<?if($arParams['USE_CAPTCHA_REFRESH']):?>
   $(document).ready(function(){
      $('#reload_captcha').click(function(){
         $('#captcha_block .ajax_loader').show();
         $.getJSON('<?=$this->__folder?>/reload_captcha.php', function(data) {
            $('#captcha_img').attr('src','/bitrix/tools/captcha.php?captcha_sid='+data);
            $('#captcha_sid').val(data);
            $('#captcha_block .ajax_loader').hide();
         });
         return false;
      });
   });
<?endif?>
</script>