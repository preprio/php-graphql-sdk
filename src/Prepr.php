<?php

namespace Preprio;

use GuzzleHttp\Client;

class Prepr
{
    protected string $endpoint;
    protected array $headers = [];
    protected array $variables = [];
    protected string $query;
    protected array $response;
    protected string $rawResponse;

    public function __construct(string $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    protected function client() : Client
    {
        return new Client([
            'http_errors' => false
        ]);
    }

    public function request() : self
    {
        $headers = array_merge($this->headers, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ]);

        $request = $this->client()->request('POST', $this->endpoint, [
            'headers' => $headers,
            'body' => json_encode([
                'query' => $this->query,
                'variables' => $this->variables
            ])
        ]);

        $this->rawResponse = $request->getBody()->getContents();
        $this->response = json_decode($this->rawResponse, true);

        return $this;
    }

    public function headers(array $array) : self
    {
        $this->headers = $array;

        return $this;
    }

    public function variables(array $array) : self
    {
        $this->variables = $array;

        return $this;
    }

    public function rawQuery(string $string) : self
    {
        $this->query = $string;

        return $this;
    }

    public function query(string $string) : self
    {
        $this->query = file_get_contents($string);

        return $this;
    }

    public function getResponse() : array
    {
        return $this->response;
    }

    public function getRawResponse() : string
    {
        return $this->rawResponse;
    }
}
