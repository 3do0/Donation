<?php

return [

    'temporary_file_upload' => [
        'disk' => 'public',
        'rules' => null,
        'directory' => null,
        'middleware' => ['web'],
        'preview_mimes' => [
            'png', 'jpg', 'jpeg', 'gif', 'bmp', 'svg', 'webp',
            'mp4', 'mov', 'avi', 'wmv', 'flv', 'mkv', 'webm',
            'pdf',
        ],
    ],

];
