<?php
include __DIR__ . '/../vendor/autoload.php';

$filename = tempnam(sys_get_temp_dir(), 'Tux');
file_put_contents($filename, \PhpWebConfig\Tests\BaseTest::$xml, LOCK_EX);

$inst = new \PhpWebConfig\WebServer\HttpCompression($filename);

if (isset($_GET['addDynamic']))
{
    $inst->addDynamic('text/html', true);
} elseif (isset($_GET['addStatic'])) {
    $inst->addStatic('text/html', true);
} elseif (isset($_GET['unmountDynamic'])) {
    $inst->unmountDynamic('text/css');
} elseif (isset($_GET['unmountStatic'])) {
    $inst->unmountStatic('application/javascript');
}
$inst->save();
?>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>">Init</a> |
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?addDynamic">Add dynamic</a> |
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?addStatic">Add static</a> |
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?unmountDynamic">Unmount Dynamic</a> |
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?unmountStatic">Unmount Static</a>
<pre><?php echo htmlspecialchars($inst->toString()); ?></pre>
