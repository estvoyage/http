<?php

namespace estvoyage\http\server;

use
	estvoyage\http
;

class iterative
{
	private
		$resources = []
	;

	function __construct(http\resource... $resources)
	{
		$this->resources = $resources;
	}

	function httpClientDoHttpRequest(http\client $httpClient, http\request $httpRequest)
	{
		$ifMatch = function() use ($httpClient, & $resource, & $break) {
			$break = true;

			$resource->httpClientIs($httpClient);
		};

		foreach ($this->resources as $resource)
		{
			$resource->callableIfHttpRequestMatchIs($httpRequest, $ifMatch);

			if ($break)
			{
				break;
			}
		}

		return $this;
	}

	function newHttpResource(http\resource $httpResource)
	{
		$this->resources[] = $httpResource;

		return $this;
	}
}
