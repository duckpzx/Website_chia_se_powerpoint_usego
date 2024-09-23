<?php 
    // Define link Website root
    if(!empty($_SERVER['HTTPS']))
    {
        $webSiteRoot = 'https://'. $_SERVER['HTTP_HOST'];
    } else {
        $webSiteRoot = 'http://'. $_SERVER['HTTP_HOST'];
    }

    // Set define template 
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $folderPath = trim($scriptName, '/');
    $folderPath = explode('/', $folderPath);

    define('_WEB_PATH_ROOT', __DIR__);

    // config url Root 
    $configUrlRoot = $webSiteRoot . '/' . $folderPath[0] . '/';
    define('_ROOT_URL', $configUrlRoot);
    // Vd: http || https ://.../usego/

    // config url Templates 
    $folderPathTempalte = $webSiteRoot . '/' . $folderPath[0] . '/mvc/views/cpanel/templates/';
    $folderPathTempalte = str_replace('/index.php', '', $folderPathTempalte);
    define('_TEMPLATE', $folderPathTempalte);

    $templatePath = './mvc/views/cpanel/templates/';
    define('_PATH_TEMPLATE', $templatePath);
    
    // Upload file 
    define('_WEB_PATH_UPLOADS', _WEB_PATH_ROOT.'/views/cpanel/templates/images/uploads/');


    define('_GOOGLE_APP_ID', '179223748770-0e7obr9nju0v5p0h4kv3fnlrnptl5mhd.apps.googleusercontent.com');
    define('_GOOGLE_APP_SECRET','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');
    define('_GOOGLE_APP_CALLBACK_URL','http://localhost/usego/account/google');
    // Setting google login parameters