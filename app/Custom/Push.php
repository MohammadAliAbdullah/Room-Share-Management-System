<?php
/**
 * Created by PhpStorm.
 * User: Lab-2
 * Date: 9/24/2018
 * Time: 12:56 PM
 */

namespace App\Custom;
use Pusher\Pusher;


class Push
{
public static function newPush(){
    $options = array(
        'cluster' => 'ap2',
        'useTLS' => true
    );
    return new Pusher(
        '59b6d021bad0ce5968d7',
        'e77ee1c084c1de44e119',
        '603747',
        $options
    );
}
}
