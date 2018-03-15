<?php
/**
 * Created by PhpStorm.
 * User: jonasdegauquier
 * Date: 13/03/18
 * Time: 19:46
 */

namespace App\Model;

use Cake\Core\App;

class User
{
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A password is required'
            )
        )
    );
}
