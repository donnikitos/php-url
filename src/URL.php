<?php
class URL {
	public $protocol = null;
	public $username = null;
	public $password = null;
	public $hostname = null;
	public $port = null;
	public $pathname = null;
	public $searchParams = null;
	public $hash = null;

	public function __construct(null | string $url) {
		$this->parse($url);
	}

	public function __get(string $name) {
		return match ($name) {
			'host' => $this->hostname . ($this->port ? ':' . $this->port : ''),
			'origin' => $this->protocol . '://' . $this->host,
			'search' => $this->searchParams->toString() ?: null,
			'href' => $this->toString(),
			default => null,
		};
	}

	public function __set(string $name, string $value) {
		if ($name === 'host') {
			$parsed = parse_url($value);

			$this->hostname = $parsed['host'];
			$this->port = $parsed['port'];
		} elseif ($name === 'origin') {
			$parsed = parse_url($value);

			$this->protocol = $parsed['scheme'];
			$this->hostname = $parsed['host'];
			$this->port = $parsed['port'];
		} elseif ($name === 'search') {
			$this->searchParams = new URLSearchParams($value);
		} elseif ($name === 'href') {
			$this->parse($value);
		}
	}

	private function parse(string $url) {
		$parsed = parse_url($url);

		$this->protocol = $parsed['scheme'];
		$this->username = $parsed['user'];
		$this->password = $parsed['pass'];
		$this->hostname = $parsed['host'];
		$this->port = $parsed['port'];
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

		$out .= $this->host;

		$out .= $this->pathname ?? '';

		$search = $this->search;
		if ($search) {
			$out .= '?' . $search;
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
