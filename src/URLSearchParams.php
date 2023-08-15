<?php
class URLSearchParams {
	private $data = [];

	public function __construct(null | string $query) {
		parse_str($query, $this->data);
	}

	public function append(string $name, string | int | bool $value) {
		if (isset($this->data[$name])) {
			if (is_array($this->data[$name])) {
				$this->data[$name][] = $value;
			} else {
				$this->data[$name] = [$this->data[$name]];
			}
		} else {
			$this->data[$name] = $value;
		}
	}

	public function delete(
		string $name,
		null | string | int | bool $value = null,
	) {
		if ($this->data[$name] && ($value === null || $this->data[$name] === $value)) {
			unset($this->data[$name]);
		}
	}

	public function entries() {
		return array_map(
			fn ($key) => [$key, $this->data[$key]],
			array_keys($this->data),
		);
	}

	public function get(string $name) {
		return $this->data[$name] ?? null;
	}

	public function has(string $name) {
		return in_array($name, $this->data);
	}

	public function keys() {
		return array_keys($this->data);
	}

	public function set(
		string $name,
		string | int | bool $value,
	) {
		$this->data[$name] = $value;
	}

	public function values() {
		$values = [];

		array_walk_recursive($this->data, function ($val) use (&$values) {
			$values[] = $val;
		});

		return $values;
	}

	public function toString() {
		return http_build_query($this->data);
	}

	public function __toString() {
		return $this->toString();
	}
}
