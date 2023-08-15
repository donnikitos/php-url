<?php
class URL {
	public $hash = null;
	public $host = null;
	public $hostname = null;
	public $href = null;
	public $origin = null;
	public $password = null;
	public $pathname = null;
	public $port = null;
	public $protocol = null;
	public $search = null;
	public $searchParams = null;
	public $username = null;

	public function __construct(null | string $url) {
		$parsed = parse_url($url);

		$this->protocol = $parsed['scheme'];
		$this->username = $parsed['user'];
		$this->password = $parsed['pass'];
		$this->hostname = $parsed['host'];
		$this->port = $parsed['port'];
		$this->host = $this->hostname;
		if ($this->port) {
			$this->host .= ':' . $this->port;
		}
		$this->pathname = $parsed['path'];
		$this->hash = $parsed['fragment'];
		$this->searchParams = new URLSearchParams($parsed['query']);
	}

	public function toString() {
		$out = '';

		if (isset($this->protocol)) {
			$out .= $this->protocol . '://';
		}

		$auth = [];
		if ($this->username) {
			$auth[] = $this->username;
		}
		if ($this->password) {
			$auth[] = $this->password;
		}
		if (count($auth) > 0) {
			$out .= implode(':', $auth) . '@';
		}

		$out .= $this->host ?? '';

		if ($this->port) {
			$out .= ':' . $this->port;
		}

		$out .= $this->pathname ?? '';

		$searchParams = $this->searchParams->toString();
		if ($searchParams) {
			$out .= '?' . $searchParams;
		}

		if ($this->hash) {
			$out .= '#' . $this->hash;
		}

		return $out;
	}

	public function __toString() {
		return $this->toString();
	}

	public function toJSON() {
		return json_encode(
			[
				'hash' => $this->hash,
				'host' => $this->host,
				'hostname' => $this->hostname,
				'href' => $this->href,
				'origin' => $this->origin,
				'password' => $this->password,
				'pathname' => $this->pathname,
				'port' => $this->port,
				'protocol' => $this->protocol,
				'search' => $this->search,
				'searchParams' => $this->searchParams,
				'username' => $this->username,
			],
			JSON_NUMERIC_CHECK | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
		);
	}
}
