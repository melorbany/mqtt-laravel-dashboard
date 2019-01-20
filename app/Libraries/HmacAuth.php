<?php

namespace App\Libraries;

/**
 * User: Ahmad Haggag
 * Date: 9/7/14
 * Time: 3:07 PM
 */

define('HASH_ALGORITHM', 'sha256');
define('REQ_EXPIRATION_IN_SECS', 30);


/**
 * Class HmacAuth
 */
class HmacAuth {

    protected $_type;
    protected $_password;
    public $_server_calculated_password;
    public $_server_hash;

    public function __construct($key,$algorithm = 'sha256') {
        $this->_type = $algorithm;
        $this->_password = $key;
    }

    /**
     * @param $url
     * @param $required_params
     * @param $user_calculated_password
     * @param $user_timestamp
     * @param string $http_method
     * @return array
     */
    public function authenticateRequest($url, $required_params, $user_calculated_password, $user_timestamp, $http_method = 'POST')
    {

        //Validate the input.
        if ($this->_password) {
            //Generate the request.
            $this->generate($http_method, $url, $required_params);
            //Validate the user password with server generate password.
            if ($this->validate($user_calculated_password)) {
                //check the timestamp expiration.
                if ($this->has_expired($user_timestamp)) {
                   return array('code' => 419, 'message' => 'Expired Request.');
                }
            } else {
                return array('code' => 402, 'message' => 'Invalid password.');
            }
        } else {
            return array('code' => 402, 'message' => 'Invalid API User.');
        }

        // Success
        return array('code' => 200, 'message' => 'Success');

    }

    /**
     * @param $http_method
     * @param $resource_url
     * @param array $params
     * @param bool $debug
     * @return string
     */
    public function generate($http_method, $resource_url, array $params, $debug = false) {
        $payload = "$http_method+$resource_url";
        foreach($params as $key => $value) {
            if (!empty($value)) {
                $payload .= '+' . $value;
            }
        }

        $this->_server_calculated_password = hash_hmac($this->_type, $payload, $this->_password);

        return $this->_server_calculated_password;
    }

    public function hash($data){
        return hash_hmac($this->_type, $data, $this->_password);
    }
    /**
     * @param $user_calculated_password
     * @return bool
     */
    public function validate($user_calculated_password) {
        return $this->_server_calculated_password === $user_calculated_password;
    }

    /**
     * @param $request_timestamp
     * @return bool
     */
    public function has_expired($request_timestamp) {

        $server_time = time() ;
        $time_diff = $server_time - $request_timestamp;
        $return = $time_diff < 0 || $time_diff > REQ_EXPIRATION_IN_SECS;

        if($return){
            app('log')->error("HM-> expire user: [$request_timestamp] server: [$server_time] diff: [$time_diff]");
        }

        return   $return;
    }
} 