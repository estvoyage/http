<?php

namespace estvoyage\http;

interface resource
{
	function httpServerReceiveHttpRequestFromHttpClient(server $server, request $request, client $client);
}
