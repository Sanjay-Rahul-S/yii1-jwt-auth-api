<?php
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'My Web Application',

    'import'=>array(
        'application.models.*',
        'application.components.*',
    ),

    'components'=>array(
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=AuthApi',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'password',
            'charset' => 'utf8',
        ),

        'urlManager'=>array(
            'urlFormat'=>'path',
            'rules'=>array(),
        ),
    ),
);

