<?php
$waiting = $status === 'waiting' ? true : false;
$delivery = $status === 'delivery' ? true : false;
$cancel = $status === 'cancel' ? true : false;
$paid = $status === 'paid' ? true : false;

$class = $waiting ? 'warning' : ($delivery ? 'info' : ($cancel ? 'danger' : 'success'));
?>

<span class="badge text-bg-<?= $class ?>"><?= ucfirst($status) ?></span>