<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
?>
<div id="mod_gtpihps_quickpricefind-<?php echo $module->id?>" class="mod_gtpihps_quickpricefind">
	<h3><?php echo JText::_('MOD_GTPIHPS_QUICKPRICEFIND_H3')?></h3>
	<form action="<?php echo $component_url; ?>" method="post" name="adminForm" id="adminForm" role="form">
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="filter_commodity_ids[]" value="0" />
		<input type="hidden" name="filter_regency_ids[]" value="0" />
		<input type="hidden" name="filter_market_ids[]" value="0" />
		<input type="hidden" name="filter_all_commodities" value="0" />
		<?php echo JHtml::_('form.token'); ?>

		<div class="form-group">
			<label for="filter_region_id"><?php echo JText::_('MOD_GTPIHPS_QUICKPRICEFIND_FIELD_REGION'); ?></label>
			<?php echo JHtml::_('select.genericlist', $regionOptions, 'filter_region_id', 'class="form-control"', 'value', 'text', $regionID, 'filter_qp_region_id');?>
		</div>
		<div class="form-group">
			<label for="filter_commodity_ids"><?php echo JText::_('MOD_GTPIHPS_QUICKPRICEFIND_FIELD_COMMODITY'); ?></label>
			<?php echo JHtml::_('select.genericlist', array(), 'filter_commodity_ids[]', 'class="form-control" size="8" multiple="multiple"', 'value', 'text', null, 'filter_qp_commodity_ids');?>
			
			<label for="filter_all_commodities" class="checkbox">
				<input type="checkbox" id="filter_all_commodities" name="filter_all_commodities" value="1" checked="checked" />
				<?php echo JText::_('MOD_GTPIHPS_QUICKPRICEFIND_FIELD_ALL_COMMODITIES'); ?>
			</label>
		</div>
		<button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-file-text"></i> <?php echo JText::_('MOD_GTPIHPS_QUICKPRICEFIND_TOOLBAR_VIEW_REPORT');?></button>
	</form>
</div>