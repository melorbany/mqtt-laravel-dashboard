<?php

namespace App\Libraries;

use Carbon\Carbon;
use Firebase\JWT\ExpiredException;
use Hashids\Hashids;
use \Firebase\JWT\JWT;
use Illuminate\Support\Facades\Mail;

class Helpers
{
    const JWT_EXPIRY_SECS = 300;

    public static function getUser($user_id)
    {
        // if not exists return false else return the user object.
        return true;
    }

    /**
     * @param $type
     * @param $uid
     * @param int $length
     * @return string
     */
    public static function encryptId($type,$uid , $length = 6)
    {
        $key = $type . env('HI_KEY_ID',"");
        $hashids = new Hashids($key , $length);
        return $hashids->encode($uid);
    }

    /**
     * @param $hashed_uid
     * @return bool
     */
    public static function decryptId($type, $hashed_uid)
    {
        $key = $type . env('HI_KEY_ID',"");
        $hashids = new Hashids($key);
        try{
            return $hashids->decode($hashed_uid)[0];
        }
        catch(\Exception $e){
            return false;
        }
    }




    /**
     * @param $token
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public static function validateJwtToken($token)
    {
        if (empty($token)) {
            return response()->json(['error' => 'token not found'], 402);
        }

        try {
            $decoded = JWT::decode($token, env('TOKEN_KEY'), ['HS256']);
            return true;
        }
        catch(ExpiredException $e) {
            return response()->json(['error' => 'token expired'], 401);
        }
        catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 402);
        }
    }

    /**
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    public static function get_hashed_id($token)
    {
        if (empty($token)) {
            return response()->json(['error' => 'token not found'], 402);
        }

        try {
            $decoded = JWT::decode($token, env('TOKEN_KEY'), ['HS256']);
            if(isset($decoded->sub)){
                return $decoded->sub;
            }
        }
        catch(ExpiredException $e) {
            return response()->json(['error' => 'token expired'], 401);
        }
        catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 402);
        }
    }


    /**
     * @param $hashed_uid
     * @return string
     */
    public static function createJwtToken($hashed_uid)
    {
        $now = time();

        $payload = [
            "iss" => 'http://wls.e-sealed.com',
            'exp' => $now + self::JWT_EXPIRY_SECS,
            "iat" => $now, //The time the JWT was issued. Can be used to determine the age of the JWT
            'sub' => $hashed_uid,
        ];

        $jwt_token = \Firebase\JWT\JWT::encode($payload, env('TOKEN_KEY'), 'HS256');

        return $jwt_token;
    }

    /**
     * @param $token
     * @return array
     */
    public static function decodeToken($token)
    {
        try {
            $decoded = JWT::decode($token, env('TOKEN_KEY'), ['HS256']);
            if(isset($decoded->sub)){
                return ['decode' => $decoded->sub];
            }else return ['error' => 'token decode problem' ,'code' => 512 ];
        }
        catch(ExpiredException $e) {
            return ['error' => 'token expired' ,'code' => 401 ];
        }catch(\Exception $e) {
            return ['error' => 'token exception' ,'code' => 512 ];
        }
    }



    public static function verifyToken($token , $user_id , $account_id = null)
    {

        $result = self::decodeToken($token);
        if(isset($result['decode'])){

//            $user = app('db')->table('users')
//                ->where('id', $user_id)
//                ->first();


            $decode = $result['decode'];

            if(isset($decode->user_id) && $decode->user_id == $user_id){

//                if(isset($account_id) && $decode->account_id != $user->account_id){
//                    return ['error' => 'token account mismatch' ,'code' => 417 ];
//                }

                return 'OK';

            }else{
                return ['error' => 'unverified token' ,'code' => 416 ];
            }

        }else return $result;

    }


    /**
     * @param $part
     * @param $total
     * @return float
     */
    public static function percentage($part, $total)
    {
        $percent = $part / $total;
        $percent_friendly = round($percent * 100, 1) ;
        return $percent_friendly;
    }

    /**
     * @param $given_password
     * @param $device_id
     * @return bool
     */
    public static function verifyAdminPassword($given_password, $device_id)
    {
        $calc_password = getAdminPassword($device_id);
        return $calc_password == $given_password;
    }


    /**
     * @param $device_id
     */
    private static function getAdminPassword($device_id)
    {

        //TODO: CALCULATE ADMIN PASSWORD
    }


    /**
     * @param $email
     * @param $code
     */
    public static function sendForgetPasswordEmail($email , $code)
    {

        try{

            Mail::send('password_reset_ar', ['email' => $email , 'code' => $code], function ($m) use ($email) {
                $m->to($email)
                    ->from('raqeb@e-sealed.com')
                    ->subject('إعادة تعيين كلمة الدخول - نظام راقب');
            });

        }catch (\Exception $ex){
            app('log')->error("sendForgetPasswordEmail ".$ex->getMessage());
        }


    }



    public static function getTimeDiffInSeconds($time){
        return Carbon::now()->diffInSeconds(Carbon::parse($time));
    }


    /**
     * @param $key
     * @return null|string
     */

    public static function getRedisValue($key,$field){

        $value = 0;

        try{

            $client = new \Predis\Client();
            $value = $client->hget($key,$field);

        }catch (\Exception $ex){
            app('log')->error("getRedisValue ".$ex->getMessage());
        }


        return (int)$value;
    }


    /**
     * @param $key
     * @param $value
     */
    public static function setRedisValue($key,$field,$value){

        try{

            $client = new \Predis\Client();
            $client->hset($key,$field,$value);

        }catch (\Exception $ex){
            app('log')->error("setRedisValue ".$ex->getMessage());
        }

    }
}