<?php

namespace System\Validation;

use System\Http\Request;
use System\Session\Session;
use System\Url\Url;
use System\Validation\Rules\UniqueRule;
use System\Validation\Rules\In;
use Rakit\Validation\Validator;

class Validate {
    /**
     * Validation constructor
     */
    private function __construct() {}

    /**
     * Validate request
     *
     * @param array $rules
     * @param bool $json
     *
     * @return mixed
     */
    public static function validate(Array $rules, $json) {
        $validator = new Validator;

        $validator->addValidator('unique', new UniqueRule());
        $validator->addValidator('in', new In());
        $validation = $validator->validate($_POST + $_FILES, $rules);
        $errors = $validation->errors();

        if ($validation->fails()) {
            if ($json) {
                return ['errors' => $errors->firstOfAll()];
            } else {
                Session::set('errors', $errors);
                Session::set('old', Request::all());
                return Url::redirect(Url::previous());
            }
        }
    }
}