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
			<li class="container dl<?=$arItem["DEPTH_LEVEL"]?>">
				<div class="col-xs-1">
					<span class="plus" onclick="nodesClick(this)">
						^
					</span>
				</div>
				<div class="col-xs-11">
					
						<a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>">
							<span>
								<?=$arItem["TEXT"]?>
									
							</span>	
					
						</a>
					
				</div>
				<!-- <div class="col-xs-4">
					<span class="plus" onclick="nodesClick(this)">
						+
					</span>
				</div> -->
				<ul class="root-item">
		<?else:?>
			<li class="dl<?=$arItem["DEPTH_LEVEL"]?>">
				<div class="col-xs-1">
					<span class="plus" onclick="nodesClick(this)">
						^
					</span>
				</div>
				<div class="col-xs-11">
					<a href="<?=$arItem["LINK"]?>" class="parent<?if ($arItem["SELECTED"]):?> item-selected<?endif?>">
						<span>
								<?=$arItem["TEXT"]?>
									
						</span>	
							
					</a>
				</div>
				<!-- <div class="col-xs-4">
					<span class="plus" onclick="nodesClick(this)">+</span>
				</div> -->
				<ul>
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
	function nodesClick(el) {
		var a=$(el).parents("li");
		a=a[0];
		var b=$(el).parents("li").children('span');
		b=b['prevObject']['prevObject'][0];
		
		$(a).children('ul').slideToggle(300,function(){
			if($(b).attr('class')=='plus'){
				$(b).text('-').toggleClass('minus').toggleClass('plus');
				$(a).toggleClass('opened').removeClass('closed');

			}else if($(b).attr('class')=='minus'){
				$(b).text('+').toggleClass('plus').toggleClass('minus');
				$(a).toggleClass('closed').removeClass('opened');
			}
			
		}
		);
		
	}

</script>