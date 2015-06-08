<?php

namespace estvoyage\http;

interface resource
{
	function httpClientIs(client $client);
	function callableIfHttpRequestMatchIs(request $request, callable $callable);
}
