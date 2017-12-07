jQuery.noConflict();
(function($) {
	var up_count		= 0;
	var down_count		= 0;
	var still_count		= 0;
	var unknown_count	= 0;
	var row_show_count 	= 0;
	var max_count 		= 12;
	$(function() {
		var all_list = $('.module-ct .pricelist ul.list_all');
		var up_list = $('.module-ct .pricelist ul.list_price_up');
		var down_list = $('.module-ct .pricelist ul.list_price_down');
		var still_list = $('.module-ct .pricelist ul.list_price_still');
		var unknown_list = $('.module-ct .pricelist ul.list_price_unknown');
		var i = 0;
		
		function shuffleRow() {
			$('li', up_list).slice(0, up_count).appendTo(up_list);
			$('li', down_list).slice(0, down_count).appendTo(down_list);
			$('li', still_list).slice(0, still_count).appendTo(still_list);
			$('li', unknown_list).slice(0, unknown_count).appendTo(unknown_list);

			$('li', up_list).slice(0, up_count).clone().appendTo(all_list);
			$('li', down_list).slice(0, down_count).clone().appendTo(all_list);
			$('li', still_list).slice(0, still_count).clone().appendTo(all_list);
			$('li', unknown_list).slice(0, unknown_count).clone().appendTo(all_list);
		}

		function shuffleRowDown() {
			$('li', up_list).slice(-up_count).prependTo(up_list);
			$('li', down_list).slice(-down_count).prependTo(down_list);
			$('li', still_list).slice(-still_count).prependTo(still_list);
			$('li', unknown_list).slice(-unknown_count).prependTo(unknown_list);

			$('li', up_list).slice(0, up_count).clone().appendTo(all_list);
			$('li', down_list).slice(0, down_count).clone().appendTo(all_list);
			$('li', still_list).slice(0, still_count).clone().appendTo(all_list);
			$('li', unknown_list).slice(0, unknown_count).clone().appendTo(all_list);
		}

		function setSparkline() {
			$('.spark.raw', all_list).sparkline('html', {
				type: 'line',
				width: '100',
				height: '60',
				lineColor: '#ffffff',
				fillColor: '#0f334e',
				lineWidth: 2,
				spotColor: '#ffffff',
				minSpotColor: '#27ae60',
				maxSpotColor: '#c0392b',
				highlightSpotColor: '#ffffff',
				highlightLineColor: '#ffffff',
				spotRadius: 5
			}).removeClass('raw');
		}

		$(".pricelist .list_all").on( "click", "a", function() {
			if($('#provinceModal').length > 0) {
				var provName = $('#pricelist_province_id option:selected').html();
				var provID = $('#pricelist_province_id').val();
				var priceType = $('#pricelist_price_type_id').val();
				var layout = $('#pricelist_layout').val();
				var comID = $(this).attr('commodityID');
				var listDate = $('#pricelist_date').attr('date');
				var comTitle = $('.title', this).html();

				$('#provinceModal .modal-title').html(provName+' - '+comTitle);
				$('#provinceModal').modal('show');
				$('#contentLoad').show();
				getProvinceDetail(provID, comID, priceType, listDate, layout);
			}
			
		});

		function getData(province_id, price_type_id) {
			$('.pricelist .list_all').block({ 
				message: '<i class="fa fa-refresh fa-spin"></i> '+Joomla.JText._('MOD_GTPIHPS_PRICES_LOADING')
			}); 
			$.ajax({
				url: component_url,
				data: {
					"task": "json.commodityPrices",
					"province_id": province_id,
					"price_type_id": price_type_id
				},
				dataType: 'json',
				cache: false
			}).done(function(data) {
				$('.pricelist .list_all').unblock();
				$('#pricelist_layout').val(data.layout);
				all_list.html('');
				up_list.html('');
				down_list.html('');
				still_list.html('');

				var count = {};
				count['price_still'] = 0;
				count['price_down'] = 0;
				count['price_up'] = 0;
				count['price_unknown'] = 0;
				
				$.each(data.prices, function(k, v) {
					var item = $('.pricelist.template li').eq(0).clone();

					$('.title', item).html(v.title);
					$('.price_now span', item).html(v.price);
					$('.price_now div', item).html(v.denom);
					$('.price_desc span', item).html(v.desc);
					$('.price_desc', item).addClass(v.class);
					$('.price_desc', item).attr('title', v.status);

					$('.price_desc i', item).addClass(v.icon);	
					$('.spark', item).html(v.prices);
					$('a', item).attr('commodityID', k);

					item.appendTo($('.module-ct .pricelist ul.list_'+v.class));
					count[v.class]++;
				});

				countKeys		= Object.keys(count).sort(function(a,b){return count[a]-count[b]})
				total_rows		= Object.keys(data.prices).length;
				row_show_count	= total_rows > max_count ? max_count : total_rows;

				var total = row_show_count;
				$.each(countKeys, function(k, v) {
					var keyCount = Math.round((count[v] / total_rows) * row_show_count);
					count[v] = keyCount > total ? total : keyCount;
					total -= count[v];
				});

				up_count		= count['price_up'];
				down_count		= count['price_down'];
				still_count		= count['price_still'];
				unknown_count	= count['price_unknown'];

				$('.pricelist .date').html(data.date);
				$('.pricelist .date').attr('date', data.dateSQL);
				sliderDown();
			});
		}
		
		getData(0, 1);

		var slider = function(){
			shuffleRow();
			setSparkline();
			$('li', all_list).slice(0, row_show_count).fadeOut('fast', function(){
				$(this).remove();
			});
			
		};

		var sliderDown = function(){
			shuffleRowDown();
			setSparkline();
			$('li', all_list).slice(row_show_count).hide().prependTo(all_list).fadeIn('slow', function(){
				$('li', all_list).slice(row_show_count).remove();
			});
			
		};
		
		/*
		var interval_time	= 15000;
		var interval		= setInterval(sliderDown, interval_time);
		*/
		
		/*$('.module-ct .pricelist').hover(function() {
			clearInterval(interval);
		}, function() {
			interval = setInterval(sliderDown, interval_time);
		});*/

		$('#pricelist_province_id, #pricelist_price_type_id').change(function() {
			var provID		= $('#pricelist_province_id').val();
			var priceTypeID	= $('#pricelist_price_type_id').val();
			getData(provID, priceTypeID);
		});
		$('.module-ct .pricelist .slidecontrol .fa-chevron-up').click(function() {
			if(row_show_count == max_count) {
				slider();
			}
		});
		$('.module-ct .pricelist .slidecontrol .fa-chevron-down').click(function() {
			if(row_show_count == max_count) {
				sliderDown();
			}
		});
	});
})(jQuery);