<?php

namespace App\Laravel\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use App\Laravel\Models\{User, Administrator, EventInterestedBuyer,MasterfileFaq,MasterfileLearnMore};

use Propaganistas\LaravelPhone\PhoneNumber;
use libphonenumber\PhoneNumberFormat;

class CustomValidator extends Validator {

    /**
     * rule name: current_password
     *
     */
    public function validateCurrentPassword($attribute, $value, $parameters){
        $user_type = (is_array($parameters) and isset($parameters[0])) ? $parameters[0] : "users";
        $user_id = (is_array($parameters) and isset($parameters[1])) ? $parameters[1] : "0";

        switch($user_type){
            case 'admin':
                $user = Administrator::find($user_id);
                break;
            default:
                $user = User::find($user_id);
                break;
        }

        return Hash::check($value, $user->password) ? true : false;
    }

    /**
     * rule name: password_format
     *
     */
    public function validatePasswordFormat($attribute,$value,$parameters){
       return preg_match(("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-.]).{8,}$/"), $value);

    }

    /**
     * rule name : new_password
     *
     */
    public function validateNewPassword($attribute, $value, $parameters)
    {
        $user_id = (is_array($parameters) and isset($parameters[0])) ? $parameters[0] : "0";
        $user = User::find($user_id);
        return !Hash::check($value, $user->password) ? true : false;
    }

    /**
     * rule name : name_format
     *
     */
    public function validateNameFormat($attribute, $value, $parameters)
    {
        // return preg_match(("/^[ A-Za-z0-9\d ,.'-]*$/"), $value);
        return preg_match("/^[A-Za-z\s'-]+$/", $value);
    }

    /**
     * rule name: username_format
     *
     */
    public function validateUsernameFormat($attribute,$value,$parameters){
        return preg_match(("/^(?=.*)[A-Za-z\d][a-z\d._+]{6,20}$/"), $value);
    }

    /**
     * rule name: unique_phone
     *
     */
    public function validateUniquePhone($attribute,$value,$parameters){
        // $contact_number = PhoneNumber::make($value,"PH")->formatE164();
        $contact_number = new PhoneNumber($value,"PH");
        $contact_number->formatE164();
        $is_unique = User::where('contact_number',$contact_number)->first();
        return $is_unique ? FALSE : TRUE;
    }

    /**
     * rule name: unique_email
     *
     */
    public function validateUniqueEmail($attribute,$value,$parameters){
        $email = strtolower($value);
        $is_unique = User::where('email',$email)->first();
        return $is_unique ? FALSE : TRUE;
    }

    /**
     * rule name : admin_new_password
     *
     */
    public function validateAdminNewPassword($attribute, $value, $parameters)
    {
        $user_id = (is_array($parameters) and isset($parameters[0])) ? $parameters[0] : "0";
        $user = Administrator::find($user_id);

        return !Hash::check($value, $user->password) ? true : false;
    }

    /**
     * rule name : date_time_schedule
     *
     */
    public function validateDateTimeSchedule($attribute, $value, $parameters)
    {

        foreach($value as $sched){
            if(
                empty($sched['schedule_date']) ||
                empty($sched['start_time']) ||
                empty($sched['end_time'])
            ){
                return false;
            }
        }

        return true;
    }

    /**
     * rule name: buyer_unique_email
     *
     */
    public function validateBuyerUniqueEmail($attribute,$value,$parameters){
            $email = strtolower($value);
            $event_id = $parameters[0] ?? null;

            $exists = EventInterestedBuyer::where('email', $email)
                ->where('event_id', $event_id)
                ->exists();

            return !$exists;
    }

    /**
     * rule name: embedded_url_checker
     *
     */
    public function validateEmbeddedUrlChecker($attribute,$value,$parameters){
        // Check for direct video file extensions
        $is_video_file = preg_match('/\.(mp4)/i', $value);

        // youTube, vimeo, facebook, tikTok
        $is_embed_url = preg_match('/(youtube\.com|youtu\.be|vimeo\.com|facebook\.com\/watch|tiktok\.com\/)/i', $value);

        return $is_video_file || $is_embed_url;
    }

    /**
     * rule name: allowed_domain
     *
     */
    public function validateAllowedDomain($attribute, $value, $parameters)
    {
        $domain = preg_replace('/.+@/', '', $value);
        $allowed_domains = explode(",", env('ALLOWED_DOMAIN'));
        return in_array($domain, $allowed_domains) ? true : false;
    }


    /**
     * rule name: scripts_checker
     *
     */
    public function validateScriptsChecker($attribute, $value, $parameters)
    {
        $pattern = '/<\s*script\b[^>]*>(.*?)<\s*\/\s*script\s*>/is';
        return preg_match($pattern, $value) ? false : true;
    }

    /**
     * rule name: display_order_unique
     *
     */
    public function validateDisplayOrderUnique($attribute, $value, $parameters)
    {
        $id = $parameters[0] ?? null;
        $table = $parameters[1] ?? null;

        if($table == 'faq'){
            $query = MasterfileFaq::where('display_order', $value);
        }
        else if($table == 'learn_more'){
            $query = MasterfileLearnMore::where('display_order', $value);
        }
        else{
            \Log::warning("display_order_unique: Unknown table '$table'");
            return true;
        }

        if($id) {
            $query->where('id', '!=', $id);
        }

        $exists = $query->exists();

        return !$exists;
    }
}
