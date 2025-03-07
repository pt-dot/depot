<?php

return [
    'Perusahaan' => [
        'children' => [
            'Profile' => 'docs/company/profile',
            'Departemen & Divisi' => 'docs/company/department',
            'Ranger dan Peran' => 'docs/company/people-title',
            'Publikasi & Sosial Media' => 'docs/company/publications',
        ],
    ],
    'Engineering' => [
        'children' => [
            'General Standards & Best Practice' => [
                'children' => [
                    'Development Stack & Tools' => 'docs/engineering/stack-tools',
                    'RESTFul API Standard' => 'docs/engineering/restful-api-standard',
                    'Penggunaan Git' => 'docs/engineering/gitflow',
                    'Klasifikasi Isu' => 'docs/engineering/issue-classifications',
                    'Code Review' => 'docs/engineering/code-review',
                    'Error Monitoring' => 'docs/engineering/error-monitoring',
                ]
            ],
            'Panduan Divisi' => [
                'children' => [
                    'Backend Engineering' => [
                        'children' => [
                            'Panduan Database Engineering' => 'docs/engineering/database-guidelines',
                            'Panduan PHP & Laravel' => 'docs/engineering/php-laravel-guidelines',
                            'Panduan .NET' => 'docs/engineering/backend/dotnet-core-guidelines',
                            'Panduan Nest JS Typescript' => 'docs/engineering/backend/nestjs-typescript-guidelines',
                        ]
                    ],
                    'Frontend Engineering' => [
                        'children' => [
                            'Panduan Frontend Engineering' => 'docs/engineering/frontend-guidelines',
                            'Panduan React JS' => 'docs/engineering/reactjs-guidelines',
                        ]
                    ],
                    'Mobile Engineering' => [
                        'children' => [
                            'Panduan Flutter' => 'docs/engineering/mobile-guidelines',
                        ]
                    ],
                    'Quality Assurance' => [
                        'children' => [
                            'Panduan Quality Assurance' => 'docs/engineering/quality-assurance-guidelines',
                        ]
                    ],
                    'DevOps' => [
                        'children' => [
                            'Deployment' => 'docs/engineering/deployment',    
                            'SOP Deployment APP' => 'docs/engineering/sop-deployment',
                            'Permintaan Deploy APP' => 'docs/engineering/permintaan-deploy'
                        ]
                    ],
                ]
            ]    
        ]
    ],
    'DOT Indonesia' => 'https://dot.co.id/',
    'Career' => 'https://career.dot.co.id/',
    'Blog' => 'https://blog.dot.co.id/',
];
