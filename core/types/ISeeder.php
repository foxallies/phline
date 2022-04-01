<?php

namespace FOXALLIES\types;


use Illuminate\Database\Schema\Builder as Manager;

interface ISeeder
{
    public function boot(Manager $manager);
}
