<?php

return [
    '__name' => 'admin-me-setting-address',
    '__version' => '0.0.2',
    '__git' => 'git@github.com:getmim/admin-me-setting-address.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'http://iqbalfn.com/'
    ],
    '__files' => [
        'modules/admin-me-setting-address' => ['install','update','remove'],
        'theme/admin/me/setting/address.phtml' => ['install','update','remove']
    ],
    '__dependencies' => [
        'required' => [
            [
                'admin-me-setting' => NULL
            ],
            [
                'user-address' => NULL
            ],
            [
                'lib-form' => NULL
            ]
        ],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'AdminMeSettingAddress\\Library' => [
                'type' => 'file',
                'base' => 'modules/admin-me-setting-address/library'
            ],
            'AdminMeSettingAddress\\Controller' => [
                'type' => 'file',
                'base' => 'modules/admin-me-setting-address/controller'
            ]
        ],
        'files' => []
    ],
    'routes' => [
        'admin' => [
            'adminMeSettingAddress' => [
                'path' => [
                    'value' => '/me/address'
                ],
                'method' => 'GET|POST',
                'handler' => 'AdminMeSettingAddress\\Controller\\Address::update'
            ]
        ]
    ],
    'adminMeSetting' => [
        'menus' => [
            'user-address' => 'AdminMeSettingAddress\\Library\\Menu'
        ]
    ],
    'libForm' => [
        'forms' => [
            'admin.me.setting.address' => [
                'country' => [
                    'label' => 'Country',
                    'type' => 'select',
                    'sl-filter' => [
                        'route' => 'adminObjectFilter',
                        'params' => [],
                        'query' => ['type' => 'addr-country']
                    ],
                    'rules' => [
                        'exists' => [
                            'model' => 'LibAddress\\Model\\AddrCountry',
                            'field' => 'id'
                        ]
                    ]
                ],
                'state' => [
                    'label' => 'State',
                    'type' => 'select',
                    'sl-filter' => [
                        'route' => 'adminObjectFilter',
                        'params' => [],
                        'query' => [
                            'type' => 'addr-state',
                            'parent' => '#country'
                        ]
                    ],
                    'rules' => [
                        'exists' => [
                            'model' => 'LibAddress\\Model\\AddrState',
                            'field' => 'id'
                        ]
                    ]
                ],
                'city' => [
                    'label' => 'City',
                    'type' => 'select',
                    'sl-filter' => [
                        'route' => 'adminObjectFilter',
                        'params' => [],
                        'query' => [
                            'type' => 'addr-city',
                            'parent' => '#state'
                        ]
                    ],
                    'rules' => [
                        'exists' => [
                            'model' => 'LibAddress\\Model\\AddrCity',
                            'field' => 'id'
                        ]
                    ]
                ],
                'district' => [
                    'label' => 'District',
                    'type' => 'select',
                    'sl-filter' => [
                        'route' => 'adminObjectFilter',
                        'params' => [],
                        'query' => [
                            'type' => 'addr-district',
                            'parent' => '#city'
                        ]
                    ],
                    'rules' => [
                        'exists' => [
                            'model' => 'LibAddress\\Model\\AddrDistrict',
                            'field' => 'id'
                        ]
                    ]
                ],
                'village' => [
                    'label' => 'Village',
                    'type' => 'select',
                    'sl-filter' => [
                        'route' => 'adminObjectFilter',
                        'params' => [],
                        'query' => [
                            'type' => 'addr-village',
                            'parent' => '#district'
                        ]
                    ],
                    'rules' => [
                        'exists' => [
                            'model' => 'LibAddress\\Model\\AddrVillage',
                            'field' => 'id'
                        ]
                    ]
                ],
                'zipcode' => [
                    'label' => 'Zip Code',
                    'type' => 'select',
                    'sl-filter' => [
                        'route' => 'adminObjectFilter',
                        'params' => [],
                        'query' => [
                            'type' => 'addr-zip',
                            'parent' => '#village'
                        ]
                    ],
                    'rules' => [
                        'exists' => [
                            'model' => 'LibAddress\\Model\\AddrZipcode',
                            'field' => 'id'
                        ]
                    ]
                ],
                'street' => [
                    'type' => 'textarea',
                    'label' => 'Street',
                    'rules' => []
                ]
            ]
        ]
    ]
];