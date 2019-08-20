<?php
    use GuzzleHttp\Psr7\Request;

    class GuzzleController {
        private $client;

        public function __construct()
        {
            $this->client = new GuzzleHttp\Client();
        }

        public function create_request(string $url, string $method, array $headers = [], array $body = [])
        {
            return $headers == [] && $body == [] ? new Request($method, $url) : new Request($method, $url, $headers, $body);
//            return new Request($method, $url, $headers, $body);
        }

        public function send_request(string $url, string $method = 'GET', array $headers = [], array $body = [])
        {
            $req = $this->create_request($url, $method, $headers, $body);
            try {
                $res =  $this->client->send($req);
                return $res;
            } catch(GuzzleHttp\Exception\GuzzleException $guzze) {
                return $guzze->getMessage();
            }

//            return true;
        }

    }