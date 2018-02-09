$(function(){

	setInterval(() => {
		let d = new Date();
		$.ajax({
			'url':'/messages/ajaxGetMessages',
			'data': '&time='+d.getTime(),
			'type': 'post',
			'dataType':'json',
			'success':(d) => {
				var str = "";
				for(el in d)
				{
					let arr = $.cookie('ids').split(',');
					if(!arr)
						arr = [];

					if ($('#messages div[data-id='+d[el].id+']').length == 0 && $.inArray(d[el].id, arr) == -1)
					{
						str = "<div data-id="+d[el].id+"><div>"+d[el].title+"</div>"+
							"<div>"+d[el].text+"</div></div>"+str;
					}
				}
				$('#messages').append(str);
			}
		});
	}, 5000);

	setInterval(() => {

		if($('#messages').find(' > div:visible').length == 0)
		{
			var el = $('#messages > div:eq(0)');
			el.show('slow', function(){
				setTimeout(function() {

					el.hide('slow', function(){

						let arr = $.cookie('ids').split(',');
						if(!arr)
							arr = [];
						arr.push= el.data('id');
						$.cookie('ids', arr.join(','), { expires: 1 });

						$.ajax({
							'url':'/messages/ajaxSetShowMessage',
							'data': '&id='+el.data('id'),
							'type': 'post',
							'dataType':'json',
							'success':(d) => {
								var str = "";
								for(el in d)
								{
									if ($('#messages div[data-id='+d[el].id+']').length == 0)
									{
										str = "<div data-id="+d[el].id+"><div>"+d[el].title+"</div>"+
											"<div>"+d[el].text+"</div></div>"+str;
									}
								}
								$('#messages').append(str);
							}
						});
						el.remove();
					});
				}, 5000);
			});
		}
	}, 1000);
})