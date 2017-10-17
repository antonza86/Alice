$(document).ready(function() {
	$('.btn_top').click(function(){
		$('.infos').hide();
		$('#' + $(this).attr("redirect")).show();
	});

	$('#add_new_cat').click( function(){
		var num = $(this).attr("num");
		$(this).attr("num", parseInt(num)+1);
		$('hr:last').after('<input name="id[' + num + ']" value="new" style="display: none;"></input>'
			+ '<table style="width: 650px;">'
				+ '<tr>'
					+ '<td>'
						+ '<strong>Nome:</strong>'
					+ '</td>'
					+ '<td style="width: 250px;">'
						+ '<input style="width: 100%;" value="" name="name[' + num + ']"></input>'
					+ '</td>'
					+ '<td rowspan="3" valign="top" style="width: 320px;">'
						+ 'Preview:'
						+ '<ul class="main_menu" style="border: 1px solid black;">'
			          + '</ul>'
					+ '</td>'
				+ '</tr>'
				+ '<tr>'
					+ '<td>'
						+ '<strong>Image:</strong>'
					+ '</td>'
					+ '<td style="width: 250px;">'
						+ '<input style="width: 100%;" value="" name="image[' + num + ']"></input>'
					+ '</td>'
				+ '</tr>'
				+ '<tr>'
					+ '<td>'
						+ '<strong>Type:</strong>'
					+ '</td>'
					+ '<td style="width: 250px;">'
						+ '<select name="type[' + num + ']">'
							+ '<option>1</option>'
							+ '<option>2</option>'
						+ '</select>'
					+ '</td>'
				+ '</tr>'
			+ '</table>'
			+ '<hr>');
	});

	setLang();

	$('#lang').change( function(){
		setLang();
    });

    function setLang(){
    	$( ".langs" ).each(function( index ) {
			$(this).val($('.'+$(this).attr("langId")+'.'+$( "select option:selected").val()).attr("value"));
			$( ".li_name."+$(this).attr("langId") ).text($(this).val());
		});
    }
});