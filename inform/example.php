<?php

include 'shoutcast.php';

$s = new Shoutcast('10.211.55.3', '8000');

if (!$s->server_online()) {
	echo 'Server offline';
} else {
	if (0 == $s->get('STATION_STATUS')) {
		echo 'Transmition off';
	} else {
		$format = '<strong>%s:</strong> %s <br />';

		//Print Current Listeners
		printf($format, 'Current Listeners', $s->get('CURRENT_LISTENERS'));

		//Print Current Song
		printf($format, 'Current Song', $s->get('CURRENT_SONG'));

		//Print Song History
		if ($s->admin_mode()) {
			$str_history = '';
			foreach ($s->get('SONG_HISTORY') as $song) {
				$str_history .= '<br />' . $song['TITLE'];
			}

			printf($format, 'Song History', $str_history);
		}
	}
}
