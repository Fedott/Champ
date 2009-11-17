jQuery( function($) {
	$(document).ready( function() {
//		$('#content').height($('#center').height()-250);
//		$('#vmenu').height($('#center').height()-250);

//		colums();
//
//		$(window).resize(colums());
		var i_players_adds = 2;
		var plform;

		

		$('#add_player_button').click(function addplayerform()
		{
			plform = '';
			plform += '<li class="">';
			plform += '<div class="input_left">';
			plform += '<label class="desc" for="last_name['+ i_players_adds +']">';
			plform += 'Фамилия';
			plform += '</label>';
			plform += '<div>';
			plform += '<input class="field text lite" type="text" name="last_name['+ i_players_adds +']" id="last_name['+ i_players_adds +']">';
			plform += '</div>';
			plform += '</div>';
			plform += '<div class="input_right">';
			plform += '<label class="desc" for="first_name['+ i_players_adds +']">';
			plform += 'Имя';
			plform += '</label>';
			plform += '<div>';
			plform += '<input class="field text lite" type="text" name="first_name['+ i_players_adds +']" id="first_name['+ i_players_adds +']">';
			plform += '</div>';
			plform += '</div>';
			plform += '</li>';
			i_players_adds++;
			$('ul#players').append(plform);
		});
	});
});