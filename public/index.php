<?php

use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Http\Response\Cookies;

try {

    //Register an autoloader
    $loader = new \Phalcon\Loader();
    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/',
        '../app/library/'
    ))->register();

    $di = new Phalcon\DI\FactoryDefault();

    $di->set('view', function(){
        $view = new \Phalcon\Mvc\View();
        $view->setViewsDir('../app/views/');

        $view->registerEngines([
            '.volt' => function ($view, $di)
            {
                $volt = new VoltEngine($view, $di);
                $volt->setOptions([
                    'compiledPath'      => '../cache/',
                    'compiledSeparator' => '_',
                    'compileAlways'     => true
                ]);
                return $volt;
            },
            '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
        ]);
        return $view;
    });

    $di->set('db', function(){
        return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
            "host" => "localhost",
            "username" => "avto_db_u",
            "password" => "D0k9D4s4",
            "dbname" => "avto_db"
        ));
    });
    $di->set('session', function()
    {
        $session = new SessionAdapter();
        $session->start();
        return $session;
    });

    $di->set(
        "cookies",
        function () {
            $cookies = new Cookies();
            $cookies->useEncryption(false);
            return $cookies;
        }
    );
    $di->set('modelsManager', function() {
      return new Phalcon\Mvc\Model\Manager();
    });

    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();

} catch(\Phalcon\Exception $e) {
     echo "PhalconException: ", $e->getMessage();
}

