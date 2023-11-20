<?php
return [
    'newsfeed_read' => [
        'class' => Modules\Newsfeed\Entities\Newsfeed::class,
        'method' => 'groupsRead',
    ],
    'newsfeed_write' => [
        'class' => Modules\Newsfeed\Entities\Newsfeed::class,
        'method' => 'groupsWrite',
    ],
    'newsfeed_publish' => [
        'class' => Modules\Newsfeed\Entities\Newsfeed::class,
        'method' => 'groupsPublish',
    ],
];