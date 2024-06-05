<?php
// app/Helpers/CustomConfigHandler.php

namespace App\Helpers;

use UniSharp\LaravelFilemanager\Handlers\ConfigHandler as BaseConfigHandler;

class CustomConfigHandler extends BaseConfigHandler
{
    // Your custom implementation here
    public function userField()
    {
        //return auth()->id();
    }
}