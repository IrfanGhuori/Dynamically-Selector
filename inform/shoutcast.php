<?php

/*


*/

class Shoutcast
{
	/**
	 * @var string Server Host
	 **/
	private $server_host;

	/**
	 * @var string Server Port
	 **/
	private $server_port;

	/**
	 * @var int Stream ID
	 **/
	private $stream;

	/**
	 * @var int Connection Time Out
	 **/
	private $conn_timeout;

	/**
	 * @var string Administrator Password
	 **/
	private $adm_password;

	/**
	 * @var resource Connection Handler
	 **/
	private $fp;

	/**
	 * @var array User Vars
	 **/
	private $vars;

	/**
	 * @var bool Work in admin mode
	 **/
	private $admin_mode = false;

	/**
	 * Constructor.
	 **/
	public function __construct($server_host, $server_port, $adm_password = null, $stream = 1, $conn_timeout = 10)
	{

		/* Check Data */
		if (empty($server_host) || empty($server_port)) {
			die('Error: Server Host and Server Port are needed');
		}

		/* If Admin mode */
		if (is_string($adm_password)) {
			$this->adm_password = $adm_password;
			$this->admin_mode = true;
		}

		/* Set data */
		$this->server_host = $server_host;
		$this->server_port = $server_port;
		$this->stream = $stream;
		$this->conn_timeout = $conn_timeout;

		/* Connect to server */
		$this->trace_connection();

		if ($this->server_online()) {
			$this->parse_data();
		}
	}

	/**
	 * Destruct.
	 **/
	public function __destruct()
	{
		if (is_resource($this->fp)) {
			fclose($this->fp);
		}
	}

	/**
	 * Trace Connection.
	 **/
	private function trace_connection()
	{
		$this->fp = @fsockopen($this->server_host, $this->server_port, $errno, $errstr, $this->conn_timeout);
	}

	/**
	 * Select the parser to use.
	 **/
	private function parse_data()
	{
		if ($this->admin_mode()) {
			fputs($this->fp, 'GET /admin.cgi?mode=viewxml&pass=' . $this->adm_password . '&sid=' . $this->stream . " HTTP/1.0\r\n");
		} else {
			fputs($this->fp, "GET /stats HTTP/1.0\r\n");
		}

		fputs($this->fp, "User-Agent: Mozilla\r\n");
		// fputs($this->fp, "Authorization: Basic " . base64_encode ($this->adm_username . ":" . $this->adm_password) . "\r\n");
		fputs($this->fp, "\r\n");

		$plain_txt = '';

		//Buffering data
		while (!feof($this->fp)) {
			$plain_txt .= @fgets($this->fp, 1024);
		}

		preg_match("/<SHOUTCASTSERVER>(.*)<\/SHOUTCASTSERVER>/", $plain_txt, $matches);

		$xml = @simplexml_load_string($matches[0]);

		if (!is_object($xml)) {
			$this->vars['STATION_STATUS'] = 0;

			return;
		}
		//print_r($xml);

		$data = self::simplexml_to_array($xml); //To array;

		$this->vars['CURRENT_LISTENERS'] = $data['CURRENTLISTENERS'];
		$this->vars['CURRENT_SONG'] = $data['SONGTITLE'];
		$this->vars['NEXT_SONG'] = $data['NEXTTITLE'];

		$this->vars['LISTENERS_PEAK'] = $data['PEAKLISTENERS'];
		$this->vars['LISTENERS_LIMIT'] = $data['MAXLISTENERS'];
		$this->vars['UNIQUE_LISTENERS'] = $data['UNIQUELISTENERS'];

		$this->vars['STATION_STATUS'] = $data['STREAMSTATUS'];
		$this->vars['STATION_GENRE'] = $data['SERVERGENRE'];
		$this->vars['STATION_URL'] = $data['SERVERURL'];
		$this->vars['STATION_TITLE'] = $data['SERVERTITLE'];

		$this->vars['DJ'] = $data['DJ'];

		$this->vars['CONTENT_TYPE'] = $data['CONTENT'];

		$this->vars['BITRATE'] = $data['BITRATE'];
		$this->vars['SERVER_VERSION'] = $data['VERSION'];

		if ($this->admin_mode()) {
			//Save song history
			if (isset($data['SONGHISTORY']['SONG']['TITLE'])) {
				$tmp_data = $data['SONGHISTORY'];
			} else {
				$tmp_data = $data['SONGHISTORY']['SONG'];
			}

			$song_history = array();
			foreach ((array)$tmp_data as $song) {
				$song_history[] = array(
					'TIMESTAMP' => intval($song['PLAYEDAT']),
					'TITLE' => $song['TITLE'],
				);
			}

			//Save listeners list
			if (isset($data['LISTENERS']['LISTENER']['HOSTNAME'])) {
				$tmp_data = $data['LISTENERS'];
			} else {
				$tmp_data = $data['LISTENERS']['LISTENER'];
			}

			$listeners = array();
			foreach ((array)$tmp_data as $listener) {
				$listeners[] = array(
					'HOST' => $listener['HOSTNAME'],
					'PLAYER' => $listener['USERAGENT'],
					'CONNECT_TIME' => $listener['CONNECTTIME'],
					'UID' => $listener['UID'],
				);
			}

			//here continue vars
			$this->vars['SONG_HISTORY'] = $song_history;
			$this->vars['LISTENERS'] = $listeners;
		}
	}

	/**
	 * Check if server is offline or not!
	 *
	 * @return bool If server online
	 **/
	public function server_online()
	{
		return is_resource($this->fp);
	}

	/**
	 * Check is admin mode is actived.
	 *
	 * @return bool If active mode actived
	 **/
	public function admin_mode()
	{
		return $this->admin_mode;
	}

	/**
	 * Get a var value.
	 *
	 * @return mixed
	 **/
	public function get($var_name)
	{
		if (isset($this->vars[$var_name])) {
			return $this->vars[$var_name];
		} else {
			return '';
		}
	}

	public static function simplexml_to_array($object)
	{
		if (!is_object($object) && !is_array($object)) {
			return $object;
		}

		if (is_object($object)) {
			$object = get_object_vars($object);
		}

		if (count($object) === 0) {
			return '';
		}

		return array_map(array(
			__CLASS__,
			'simplexml_to_array',
		), $object);
	}
}
