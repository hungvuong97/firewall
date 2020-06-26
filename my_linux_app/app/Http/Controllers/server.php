<?php

/*Create a server variable with the link to the tcp IP and custom port you need to
specify the Homestead IP if you are using homestead or, for local environment using
WAMP, MAMP, ... use 127.0.0..1*/
require_once(__DIR__ . '/../../../vendor/autoload.php');
$websocket = new Hoa\Websocket\Server(
    new Hoa\Socket\Server('ws://127.0.0.1:5000')
);
$websocket->on('open', function (Hoa\Event\Bucket $bucket) {
    echo 'new connection', "\n";

    return;
});
$websocket->on('message', function (Hoa\Event\Bucket $bucket) {
    // $data = $bucket->getData();
    // echo '> message ', $data['message'], "\n";
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
    $bucket->getSource()->send($data['message']);
    echo '< echo', "\n";

    return;
});
$websocket->on('close', function (Hoa\Event\Bucket $bucket) {
    echo 'connection closed', "\n";

    return;
});
$websocket->run();
