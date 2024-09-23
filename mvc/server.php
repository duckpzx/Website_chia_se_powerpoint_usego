<?php 
    require_once __DIR__ . '\..\vendor\autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    // Set default time live Vietnamese
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    session_start();

    // Define Database 
    define('_HOST', $_ENV['_HOST']);
    define('_USER', $_ENV['_USER']);
    define('_PASS', $_ENV['_PASS']);
    define('_DB', $_ENV['_DB']);
    define('_DRIVER', $_ENV['_DRIVER']);

    // Set Define text alert render interface 
    define('_no_data', 'Không có dữ liệu');
    define('_on_error', 'Xảy ra lỗi, Thử lại sau!');

    // Check Https & config Templates 
    require_once ( __DIR__ . '/configurations.php');

    // Auto load folder core
    class CoreLoader
    {
        private static $instance;
        private $coreFilesLoaded = false;
    
        private function __construct() {}
    
        public static function getInstance()
        {
            if (self::$instance === null) {
                self::$instance = new self();
            }
            return self::$instance;
        }
    
        public function loadCoreFiles()
        {
            if (!$this->coreFilesLoaded) {
                $fileCores = scandir(__DIR__ . '/core');
                $removeValues = array('.', '..');
                $fileCoresRemoveDot = array_diff($fileCores, $removeValues);
                $fileCoresRemoveDot = array_values($fileCoresRemoveDot);
                $filteredFilesfileCores = array_filter($fileCoresRemoveDot, function ($fileCore) {
                    return strpos($fileCore, '.php') !== false;
                });
                foreach ($filteredFilesfileCores as $file) {
                    if (file_exists((__DIR__ . "/core/" . $file))) {
                        require_once(__DIR__ . "/core/" . $file);
                    }
                }
                $this->coreFilesLoaded = true;
            }
        }
    }
    CoreLoader::getInstance()->loadCoreFiles();

    // The default setting is the maximum number of pages
    define('_MAXIMUM_PAGE', 20);
    define('_NUMBER_PAGINATION', 12);
