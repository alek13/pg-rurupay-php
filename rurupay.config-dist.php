<?php

return [
    'soap'        => [
        'options' => [
            'exceptions' => true,
        ],
        'wsdl'    => __DIR__ . '/wsdl/{test|prod}/TransactionService.svc.wsdl',
    ],
    'credentials' => [
        'partnerId' => 0,
        'secretKey' => '',
    ],
];
