<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message error" onclick="this.classList.add('hidden');"><div class="icon"><i class="fa-solid fa-circle-xmark"></i></div><div class="text"><?= $message ?></div></div>
