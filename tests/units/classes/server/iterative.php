<?php

namespace estvoyage\http\tests\units\server;

require __DIR__ . '/../../runner.php';

use
	estvoyage\http\tests\units,
	mock\estvoyage\http as mockOfHttp
;

class iterative extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\http\server')
		;
	}

	function testHttpClientDoHttpRequest()
	{
		$this
			->given(
				$httpClient = new mockOfHttp\client,
				$httpRequest = new mockOfHttp\request,
				$httpResource = new mockOfHttp\resource
			)
			->if(
				$this->newTestedInstance($httpResource)
			)
			->then
				->object($this->testedInstance->httpClientDoHttpRequest($httpClient, $httpRequest))->isTestedInstance
				->mock($httpResource)
					->receive('httpServerReceiveHttpRequestFromHttpClient')
						->withArguments($this->testedInstance, $httpRequest, $httpClient)
							->once
		;
	}
}
