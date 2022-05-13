<?php return array(
    'root' => array(
        'pretty_version' => '1.0.0+no-version-set',
        'version' => '1.0.0.0',
        'type' => 'metapackage',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'reference' => NULL,
        'name' => 'elsheref/pdf',
        'dev' => true,
    ),
    'versions' => array(
        'elsheref/pdf' => array(
            'pretty_version' => '1.0.0+no-version-set',
            'version' => '1.0.0.0',
            'type' => 'metapackage',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'reference' => NULL,
            'dev_requirement' => false,
        ),
        'tecnickcom/tcpdf' => array(
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'type' => 'library',
            'install_path' => __DIR__ . '/../tecnickcom/tcpdf',
            'aliases' => array(
                0 => '9999999-dev',
            ),
            'reference' => '42cd0f9786af7e5db4fcedaa66f717b0d0032320',
            'dev_requirement' => false,
        ),
    ),
);
