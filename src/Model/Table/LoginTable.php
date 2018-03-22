<?php
/**
 * Created by PhpStorm.
 * User: jonasdegauquier
 * Date: 13/03/18
 * Time: 20:01
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class LoginTable extends Table
{

    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('username', 'An username is required')
            ->notEmpty('password', 'A password is required');
    }

}