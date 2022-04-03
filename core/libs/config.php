<?php
function config($path)
{
    $data = $GLOBALS['config'];
    foreach (explode('.', $path) as $item) {
        $data = $data[$item];
    }
    return $data;
}
