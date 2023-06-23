<?php
include __DIR__ . '/../vendor/autoload.php';

$filename = tempnam(sys_get_temp_dir(), 'Tux');
file_put_contents($filename, \PhpWebConfig\Tests\BaseTest::$xml, LOCK_EX);

$inst = new \PhpWebConfig\WebServer\UrlCompression($filename);

if (isset($_GET['disableDynamic']))
{
    $inst->disableDynamic();
} elseif (isset($_GET['disableStatic'])) {
    $inst->disableStatic();
} elseif (isset($_GET['disableDynamicBeforeCache'])) {
    $inst->disableDynamicBeforeCache();
} elseif (isset($_GET['enableDynamic'])) {
    $inst->enableDynamic();
} elseif (isset($_GET['enableStatic'])) {
    $inst->enableStatic();
} elseif (isset($_GET['enableDynamicBeforeCache'])) {
    $inst->enableDynamicBeforeCache();
}
$inst->save();
?>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>">Init</a> |
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?disableDynamic">Disable dynamic compression</a> |
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?disableStatic">Disable static compression</a> |
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?disableDynamicBeforeCache">Disable dynamic compression before cache</a> |
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?enableDynamic">Enable dynamic compression</a> |
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?enableStatic">Enable static compression</a> |
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?enableDynamicBeforeCache">Enable dynamic compression before cache</a>
<pre><?php echo htmlspecialchars($inst->toString()); ?></pre>
