<?php
include __DIR__ . '/../vendor/autoload.php';

$filename = tempnam(sys_get_temp_dir(), 'Tux');
file_put_contents($filename, \PhpWebConfig\Tests\BaseTest::$xml, LOCK_EX);

$inst = new \PhpWebConfig\WebServer\CustomHeaders($filename);

if (isset($_GET['reset']))
{
    $inst->reset();
} elseif (isset($_GET['add'])) {
    $inst->add('X-Riverside', '123');
} elseif (isset($_GET['remove'])) {
    $inst->remove('X-Riverside');
}
$inst->save();
?>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>">Init</a> |
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?add">Add</a> |
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?remove">Remove</a> |
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?reset">Reset</a>
<pre><?php echo htmlspecialchars($inst->toString()); ?></pre>
