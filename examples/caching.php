<?php
include __DIR__ . '/../vendor/autoload.php';

$filename = tempnam(sys_get_temp_dir(), 'Tux');
file_put_contents($filename, \PhpWebConfig\Tests\BaseTest::$xml, LOCK_EX);

$inst = new \PhpWebConfig\WebServer\Caching($filename);

if (isset($_GET['reset']))
{
    $inst->reset();
} elseif (isset($_GET['add'])) {
    $inst->add('.html', 'CacheUntilChange', 'CacheForTimePeriod', '00:10:20', 'Accept-Language', 'Locale', 'Server');
} elseif (isset($_GET['remove'])) {
    $inst->remove('.html');
} elseif (isset($_GET['clear'])) {
    $inst->clear();
}
$inst->save();
?>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>">Init</a> |
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?add">Add</a> |
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?remove">Remove</a> |
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?clear">Clear</a> |
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?reset">Reset</a>
<pre><?php echo htmlspecialchars($inst->toString()); ?></pre>
