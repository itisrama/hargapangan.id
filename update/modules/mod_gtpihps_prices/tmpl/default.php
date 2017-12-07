<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('bootstrap.tooltip');
?>
<div id="pricelist-<?php echo $module->id?>" class="mod_gtpihps_prices pricelist">
	<h3><?php echo JText::_('MOD_GTPIHPS_PRICES_H3')?> <small id="pricelist_date" class="date" date=""></small>&nbsp;&nbsp;<?php echo JHtml::_('select.genericlist', $provinces, 'pricelist_province_id', 'style="margin:0"');?>
		<?php echo JHtml::_('select.genericlist', $priceTypes, 'pricelist_price_type_id', 'style="margin:0"');?>
		&nbsp;&nbsp;<span class="slidecontrol"><i class="fa fa-chevron-up" style="cursor: pointer"></i>  <i class="fa fa-chevron-down" style="cursor: pointer"></i></span>
		<input type="hidden" id="pricelist_layout" value="" />
	</h3>
	<ul class="pricelist template" style="display:none">
		<li><a href="javascript:void(0)" commodityID=""><div>
			<div class="title"></div>
			<div class="desc">
				<div class="price_now"><span></span><div></div></div>
				<div class="price_desc" title="">
					<i class=""></i>&nbsp;
					<span></span>
				</div>
			</div>
			<div class="spark raw"></div>
		</div></a></li>
	</ul>
	<ul class="pricelist list_all"></ul>
	<ul class="pricelist list_price_unknown" style="display:none"></ul>
	<ul class="pricelist list_price_still" style="display:none"></ul>
	<ul class="pricelist list_price_up" style="display:none"></ul>
	<ul class="pricelist list_price_down" style="display:none"></ul>
</div>