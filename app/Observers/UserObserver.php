<?php
/**
 * Created by PhpStorm.
 * User: userpc
 * Date: 25/07/2015
 * Time: 6:17 PM
 */
namespace App\Observers;

use Orchestra\Tenanti\Observer;

class UserObserver extends Observer
{
    public function getDriverName()
    {
        return 'user';
    }
}