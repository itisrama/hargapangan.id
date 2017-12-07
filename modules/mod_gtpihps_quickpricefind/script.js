jQuery.noConflict();
(function($) {
    $(window).load(function() {
        var loadOptions = function(el, task, options) {
            var options = jQuery.extend({ 'task' : task }, options);
            el.prev('i').remove();
            el.prev().after('&nbsp;&nbsp;<i class="fa fa-refresh fa-spin fa-lg"></i>');
            el.attr('disabled', true);
            el.load(component_url, options, function() {
                el.removeAttr('disabled');
                el.prev('i').remove();
            });

        }

        var loadRegion = function() {
            loadOptions($('#filter_qp_commodity_ids'), 'province_statistics.loadCommodities', { 'filter_region_id' : $('#filter_qp_region_id').val() });
        }

        loadRegion();
        $('#filter_qp_region_id').change(function() {
            loadRegion();
        });
    });
})(jQuery);