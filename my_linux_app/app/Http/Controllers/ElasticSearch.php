<?php

namespace App\Http\Controllers;

use Elasticsearch\ClientBuilder;


class ElasticSearch extends Controller
{
    public function search()
    {
        $hosts = [
            '192.168.151.11:9200',         // IP + Port
            '192.168.151.11',              // Just IP
            // 'mydomain.server.com:9201', // Domain + Port
            // 'mydomain2.server.com',     // Just Domain
            // 'https://localhost',        // SSL to localhost
            // 'https://192.168.1.3:9200'  // SSL to IP + Port
        ];
        $client = ClientBuilder::create()
            ->setHosts($hosts)      // Set the hosts
            ->build();
        $params = [
            'index' => 'metromind-raw-day2*',
            'body' => [
                'query' => [
                    'match' => [
                        'track_type' => 0,
                        // 'track_type' => 1
                    ]
                ]
            ]
        ];
        $response = $client->search($params);
        $result = $response['hits']['hits'];
        // dd(gettype($result));
        return $result;
    }

    public function getData()
    {
        return view('client');
    }

    // public function cassandra()
    // {

    // }
}
