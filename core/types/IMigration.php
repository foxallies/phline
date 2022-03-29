<?php

namespace FOXALLIES\Types;

interface IMigration
{
    public function boot();

    public function down();
}