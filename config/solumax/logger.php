<?php

return [

    'http' => [
        'routes' => [
            'middlewares' => ['auth.db.overwrite']
        ]
    ]
];