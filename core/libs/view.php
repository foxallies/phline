<?php
function view($path, $data = [])
{
    global $blade;
    echo $blade->run($path, $data);
    return null;
}
