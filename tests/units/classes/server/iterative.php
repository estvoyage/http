<?php

namespace estvoyage\http\tests\units\server;

require __DIR__ . '/../../runner.php';

use
	estvoyage\http\tests\units,
	mock\estvoyage\http as mockOfHttp
;

class iterative extends units\test
{
	function testHttpClientDoHttpRequest()
	{
		$this
			->given(
				$httpClient = new mockOfHttp\client,
				$httpRequest = new mockOfHttp\request
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->httpClientDoHttpRequest($httpClient, $httpRequest))->isTestedInstance

			->given(
				$httpResource = new mockOfHttp\resource,
				$this->calling($httpResource)->callableIfHttpRequestMatchIs = function($httpRequest, $callable) {
					$callable();
				}
			)
			->if(
				$this->newTestedInstance
					->newHttpResource($httpResource)
						->httpClientDoHttpRequest($httpClient, $httpRequest)
			)
			->then
				->mock($httpResource)
					->receive('httpClientIs')
						->withArguments($httpClient)
							->once

			->given(
				$otherHttpResource = new mockOfHttp\resource,
				$this->calling($otherHttpResource)->callableIfHttpRequestMatchIs = function($httpRequest, $callable) {
					$callable();
				}
			)
			->if(
				$this->newTestedInstance
					->newHttpResource($httpResource)
						->newHttpResource($otherHttpResource)
							->httpClientDoHttpRequest($httpClient, $httpRequest)
			)
			->then
				->mock($otherHttpResource)
					->receive('httpClientIs')
						->never
		;
	}

	function testNewHttpResource()
	{
		$this
			->given(
				$httpResource = new mockOfHttp\resource
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->newHttpResource($httpResource))->isEqualTo($this->newTestedInstance($httpResource))
		;
	}
}
