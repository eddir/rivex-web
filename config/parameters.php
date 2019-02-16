<?php

return [

    'users' => [
        'order' => 'created_at',
        'direction' => 'desc',
        'role' => 'all',
        'valid' => false,
        'confirmed' => false,
        'new' => false,
    ],
    'posts' => [
        'order' => 'created_at',
        'direction' => 'desc',
        'new' => false,
        'active' => false,
    ],
    'contacts' => [
        'new' => false,
    ],
    'comments' => [
        'new' => false,
        'valid' => false,
    ],
    'bugs' => [
         'new' => false,
         'direction' => 'desc',
         'order' => 'created_at',
    ],
    'bug_comments' => [
         'new' => false,
         'direction' => 'desc',
         'order' => 'created_at',
    ],
    'violations' => [
         'new' => false,
         'direction' => 'desc',
         'order' => 'created_at',
    ],
    'laws' => [
         'new' => false,
         'direction' => 'desc',
         'order' => 'created_at',
    ],
    'scores' => [
         'new' => false,
         'direction' => 'desc',
         'order' => 'created_at',
    ],
];
