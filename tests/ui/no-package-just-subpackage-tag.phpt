--TEST--
docblox project:run -f tests/data/NoPackageDocBlock.php -t build
--FILE--
<?php
$_SERVER['argc']    = 8;
$_SERVER['argv'][1] = 'project:run';
$_SERVER['argv'][2] = '-f';
$_SERVER['argv'][3] = dirname(__FILE__) . '/../data/NoPackageDocBlock.php';
$_SERVER['argv'][4] = '-t';
$_SERVER['argv'][5] = dirname(__FILE__) . '/../../build/';
$_SERVER['argv'][6] = '--config';
$_SERVER['argv'][7] = 'none';

// determine base include folder, if @php_bin@ contains @php_bin then we do not install via PEAR
if (strpos('@php_bin@', '@php_bin') === 0) {
    set_include_path(dirname(__FILE__) . PATH_SEPARATOR . get_include_path());
}

if (!class_exists('Zend_Loader_Autoloader'))
{
  require_once 'Zend/Loader/Autoloader.php';
}
$autoloader = Zend_Loader_Autoloader::getInstance();
$autoloader->registerNamespace('DocBlox_');

$application = new DocBlox_Core_Application();
$application->main();
?>
--EXPECTF--
DocBlox version %s

%s ERR (3): No Page-level DocBlock was found for NoPackageDocBlock.php on line: 2
%s CRIT (2): File cannot have a @subpackage when a @package tag is not present
Starting transformation of files (this could take a while depending upon the size of your project)
Finished transformation in %s seconds
