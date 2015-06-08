<?php

namespace estvoyage\http\server;

use
	estvoyage\http
;

class iterative implements http\server
{
	private
		$resource
	;

	function __construct(http\resource $resource)
	{
		$this->resource = $resource;
	}

	function httpClientDoHttpRequest(http\client $httpClient, http\request $httpRequest)
	{
		$this->resource->httpServerReceiveHttpRequestFromHttpClient($this, $httpRequest, $httpClient);

		return $this;
	}
}
