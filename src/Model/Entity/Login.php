<?php
/**
 * Created by PhpStorm.
 * User: jonasdegauquier
 * Date: 15/03/18
 * Time: 22:35
 */

namespace App\Model\Entity;


class Login
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