# URL

The URL class is used to parse, construct, normalize, and encode URLs. It works by providing properties which allow you to easily read and modify the components of a URL.

You normally create a new URL object by specifying the URL as a string when calling its constructor, or by providing a relative URL and a base URL. You can then easily read the parsed components of the URL or make changes to the URL.

### Instance properties

##### `hash`

A string containing the fragment identifier of the URL.

##### `host`

A string containing the domain (that is the hostname) followed by (if a port was specified) a ':' and the port of the URL.

##### `hostname`

A string containing the domain of the URL.

##### `href`

A stringifier that returns a string containing the whole URL.

##### `origin`

Returns a string containing the origin of the URL, that is its scheme, its domain and its port.

##### `password`

A string containing the password specified before the domain name.

##### `pathname`

A string containing an initial '/' followed by the path of the URL, not including the query string or fragment.

##### `port`

A string containing the port number of the URL.

##### `protocol`

A string containing the protocol scheme of the URL.

##### `search`

A string indicating the URL's parameter string; if any parameters are provided, this string includes all of them.

##### `searchParams`

A URLSearchParams object which can be used to access the individual query parameters found in search.

##### `username`

A string containing the username specified before the domain name.

### Instance methods

##### `toString()`

Returns a string containing the whole URL. It is a synonym for URL.href, though it can't be used to modify the value.

##### `toJSON()`

Returns a JSON string containing a serialized version of the URL object.

# URLSearchParams

The URLSearchParams interface defines utility methods to work with the query string of a URL.

### Instance properties

##### `size`

Indicates the total number of search parameter entries.

### Instance methods

##### `append(string $name, string | int | bool $value)`

Appends a specified key/value pair as a new search parameter.

##### `delete(string $name, null | string | int | bool $value = null)`

Deletes search parameters that match a name, and optional value, from the list of all search parameters.

##### `entries()`

Returns an iterator allowing iteration through all key/value pairs contained in this object in the same order as they appear in the query string.

##### `get(string $name)`

Returns the first value associated with the given search parameter.

<!-- ##### `getAll()`

Returns all the values associated with a given search parameter. -->

##### `has(string $name)`

Returns a boolean value indicating if a given parameter, or parameter and value pair, exists.

##### `keys()`

Returns an iterator allowing iteration through all keys of the key/value pairs contained in this object.

##### `set(string $name, string | int | bool $value)`

Sets the value associated with a given search parameter to the given value. If there are several values, the others are deleted.

##### `toString()`

Returns a string containing a query string suitable for use in a URL.

##### `values()`

Returns an iterator allowing iteration through all values of the key/value pairs contained in this object.
