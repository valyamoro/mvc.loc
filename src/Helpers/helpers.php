<?php
declare(strict_types=1);

if (!\function_exists('dump')) {
    function dump(mixed $data): void
    {
        echo '<pre>'; print_r($data); echo '</pre>';
    }
}
