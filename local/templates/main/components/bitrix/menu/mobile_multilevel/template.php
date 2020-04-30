<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul id="vertical-multilevel-menu1">

<?
$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li >
				
				<div onclick="nClick(this);" class="col-xs-12">
					
						 <span id="ps"  class="cl">></span>

						 <a onclick="return false" href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>">
							<span>
								<?=$arItem["TEXT"]?>
									
							</span>	
					
						</a> 
					
				</div>
				
				<ul class="root-item">
				<!-- // Все -->
					<a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>">
							<span >
								Все <?=$arItem["TEXT"]?>
									
							</span>	
					
					</a> 
					<!-- //========= -->	
		<?else:?>
			<li>
				
				<div onclick="nClick(this);" class="col-xs-12">
					<span id="ps"  class="cl">></span>
					<a onclick="return false;" href="<?=$arItem["LINK"]?>" class="parent<?if ($arItem["SELECTED"]):?> item-selected<?endif?>"> 
						<span>
								<?=$arItem["TEXT"]?>
									
						</span>	
							
					</a>
				</div>
				
				<ul>
					<!-- // All 2 -->
					<a onclick="return false" href="<?=$arItem["LINK"]?>" class="parent<?if ($arItem["SELECTED"]):?> item-selected<?endif?>">
						<span>
							Все <?=$arItem["TEXT"]?>
									
						</span>	
							
					</a>
					<!-- //====== -->
		<?endif?>

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li class="dl<?=$arItem["DEPTH_LEVEL"]?>">
					<div class="col-xs-8">
						<a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>">
							<span>
								<?=$arItem["TEXT"]?>
									
							</span>	
							
						</a>
					</div>
					<div class="col-xs-4"></div>
				</li>
			<?else:?>
				<li class="dl<?=$arItem["DEPTH_LEVEL"]?>">
					<div class="col-xs-8">
						<a href="<?=$arItem["LINK"]?>" <?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>>
							<span>
								<?=$arItem["TEXT"]?>
									
							</span>	
							
						</a>
					</div>
					<div class="col-xs-4"></div></li>
			<?endif?>

		<?else:?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li class="dl<?=$arItem["DEPTH_LEVEL"]?>">
					<div class="col-xs-8">
						<a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>">
							<span>
								<?=$arItem["TEXT"]?>
									
							</span>	
							
						</a>
					</div>
					<div class="col-xs-4">
						<span class="plus" onclick="nodesClick(this)">+</span>
					</div>
				</li>
			<?else:?>
				<li class="dl<?=$arItem["DEPTH_LEVEL"]?>">
					<div class="col-xs-8">
						<a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>">
							<span>
								<?=$arItem["TEXT"]?>
									
							</span>	
							
						</a>
					</div>
					<div class="col-xs-4">
						<span class="plus" onclick="nodesClick(this)">
							+
						</span>
					</div>
				</li>
			<?endif?>

		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
<?endif?>


<script>
	function nClick(el) {
		var a=$(el);//.parents("li");
		a=a[0];
		var sblDiv = $(a).parents("li").siblings('li.open').children('div.opened').removeClass('opened');
		var sblLi = $(a).parents("li").siblings('li.open');

		$(a).toggleClass('opened').siblings('ul').slideToggle(300).parents("li").addClass('open');
		$(a).find('#ps').toggleClass('cl').toggleClass('op');
		$(sblDiv).find('#ps').toggleClass('cl').toggleClass('op');
		$(sblDiv).siblings('ul').slideUp(300);
	}
	

</script>