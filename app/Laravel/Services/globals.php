<?php

if (!function_exists('ceiling')) {
    function ceiling($number, $significance = 1)
    {
        return (is_numeric($number) && is_numeric($significance)) ? (ceil($number / $significance) * $significance) : false;
    }
}

if( !function_exists('nice_number') ){
    function nice_number($amount)
    {
        $amount = str_replace(",", "", $amount);
        return number_format($amount, 0, '.', ',');
    }
}

if( !function_exists('nice_display') ){
    function nice_display($string)
    {
        return Str::title(str_replace("_", " ", $string));
         
    } 
}

if (!function_exists('province_format')) {
    function province_format($value)
    {
        if (!$value) {
            return null;
        }

        $formatted = preg_replace('/^NCR,\s*[^-]+-\s*/i', '', $value);

        return Str::upper($formatted);
    }
}

if (!function_exists('social_classification_format')) {
    function social_classification_format($value)
    {
        $val = strtolower($value);

        switch ($val) {
            case 'na': return 'N/A';
            case 'pwd': return 'Person with Disability (PWD)';
            case 'women_led_mesme': return 'Women-led MSME';
        }

        $known = ['abled','indigenous_people','senior_citizen'];
        if (!in_array($val, $known)) {
            return 'PWD - ' . Str::title($value);
        }

        return Str::title(str_replace('_', ' ', $value));
    }
}

if (!function_exists('asset_size_format')) {
    function asset_size_format($value)
    {
        $val = strtolower($value);

        switch ($val) {
            case 'micro_1': return '₱ 100,000 and below';
            case 'micro_2': return '₱ 100,001 - 1.5 million';
            case 'micro_3': return '₱ 1,500,001 - 3 million';
            case 'small_1': return '₱ 3,000,001 - 5 million';
            case 'small_2': return '₱ 5,000,001 - 10 million';
            case 'small_3': return '₱ 10,000,001 - 15 million';
            case 'medium': return '₱ 15,000,001 - 100 million';
            case 'large': return 'Above ₱ 100 million';
        }

        return Str::title(str_replace('_', ' ', $value));
    }
}

if (!function_exists('document_type_format')) {
    function document_type_format($value)
    {
        $val = strtolower($value);

        switch ($val) {
            case 'bir_form': return 'BIR Form';
            case 'business_registration_doc': return 'Business Registration Document';
            case 'mayors_permit': return "Mayor's Permit";
            case 'fda_cpn': return 'FDA Certificate of Product Notification';
            case 'fda_lto': return 'FDA LTO';
            case 'fda_cpr': return 'FDA Certificate of Product Registration';
            case 'halal': return 'Halal Certificate';
            case 'coc_doc': return 'Certificate of Conformity (COC)';
            case 'official_valid_receipt_doc': return 'Official Valid Receipt';
            case 'other_certificates': return 'Other Certificates';
        }

        return Str::title(str_replace('_', ' ', $value));
    }
}

if( !function_exists('designation_format') ){
    function designation_format($value)
    {
        $special_titles = [
            'chief_executive_officer_ceo' => 'Chief Executive Officer (CEO)',
            'co_owner_partner' => 'Co-Owner / Partner',
        ];

        if (array_key_exists($value, $special_titles)) {
            return $special_titles[$value];
        }

        return Str::title(str_replace('_', ' ', $value));
         
    } 
}

if (!function_exists('date_only')) {
    function date_only($time)
    {
        return date_format($time, "F d, Y"); // assuming date_format is a global helper
    }
}
    
if( !function_exists('money_db') )
{
    function money_db($amount)
    {
        $amount = str_replace(",", "", $amount);
        return (float) number_format($amount, 2, '.', '');
    }
}

if( !function_exists('money_format') ){
    function money_format($amount)
    {
        $amount = str_replace(",", "", $amount);
        return number_format($amount, 2, '.', ',');
    }
}

if (!function_exists('get_client_ip')) {
    function get_client_ip()
    {
        $client_ip = request()->header('X-Forwarded-For');

        if (!$client_ip) {
            $client_ip = request()->ip();
        }
        return $client_ip;
    }
}

if (!function_exists('create_filename')) {

    function create_filename($extension)
    {
        return strtolower(hash('sha256', Str::random(10)) . "." . $extension);
    }

}

if (!function_exists('card_issuer')) {
    function card_issuer($cardNumber) {
        $cardNumber = preg_replace('/\D/', '', $cardNumber); // Remove non-digit characters

        if (preg_match('/^4\d{12}(\d{3})?$/', $cardNumber)) {
            return 'VISA';
        } elseif (preg_match('/^5[1-5]\d{14}$/', $cardNumber) || preg_match('/^2(2[2-9][1-9]|2[3-9]\d\d|[3-6]\d{3}|7[01]\d{2}|720)\d{12}$/', $cardNumber)) {
            return 'Mastercard';
        } elseif (preg_match('/^3[47]\d{13}$/', $cardNumber)) {
            return 'American Express';
        } elseif (preg_match('/^6011\d{12}$/', $cardNumber) || preg_match('/^65\d{14}$/', $cardNumber) || preg_match('/^64[4-9]\d{13}$/', $cardNumber)) {
            return 'Discover';
        } elseif (preg_match('/^35\d{14}$/', $cardNumber)) {
            return 'JCB';
        } elseif (preg_match('/^3(0[0-5]|[68]\d)\d{11}$/', $cardNumber)) {
            return 'Diners Club';
        } else {
            return 'Unknown';
        }
    }
}

if (!function_exists('is_uuid')) {
    function is_uuid($value) {
        return preg_match('/^[0-9a-f\-]{36}$/i', $value)?:false;
    }
}

if (!function_exists('reformat_card_number')) {
    function reformat_card_number($card_number,$card_format='0000 0000 0000 0000') {
        // Remove spaces from card_format to get the expected length
        $plain_format = str_replace(' ', '', $card_format);

        // Split the card_number into an array of characters to match the format
        $chars = str_split($card_number);

        // Replace '0' and 'A' with '%s' for vsprintf formatting
        $format_mask = str_replace(['0', 'A'], '%s', $card_format);

        // Format the card_number to match the card_format
        $formatted_card_number = vsprintf($format_mask, $chars);

        return $formatted_card_number;

    }

if( !function_exists('status_badge') ){
    function status_badge($status)
    {
        $result = "default";

        switch(Str::lower($status)) {
            case 'active':
            case 'available':
            case 'open':
            case 'approved': $result = "success";
                break;
            case 'pending':	 $result = "warning";
                break;
            case 'for_correction':
            case 'rejected':
            case 'closed':
            case 'inactive': 
            case 'declined': $result = "danger";
                break;
            case 'for_approval':
            case 'ongoing': $result = "info";
                break;
            case 'submitted' : $result = "secondary";
                break;
            case 'endorsed':
            case 'for_review':
            case 'assigned': $result = "primary";
                break;
        }
        return $result;
         
    } 
}

if (!function_exists('event_supplier_status_badge')) {
    function event_supplier_status_badge($status)
    {
        $result = "default";

        switch (Str::lower($status)) {
            case 'completed': 
                $result = "success";
                break;
            case 'approved': 
                $result = "primary";
                break;
            case 'pending':	 
                $result = "warning";
                break;
            case 'declined': 
                $result = "danger";
                break;
        }

        return $result;
    }
}

if (!function_exists('event_type_badge')) {
    function event_type_badge($status)
    {
        return 'danger'; 
    }
}

if (!function_exists('halal_badge')) {
    function halal_badge($value)
    {
        return (bool)$value ? 'success' : '';
    }
}


if (!function_exists('is_halal')) {
    function is_halal($value)
    {
        return (bool)$value === true ? 'Halal' : '';
    }
}

if (!function_exists('event_registation_status_badge')) {
    function event_registation_status_badge($status)
    {
        $result = "default";

        switch (Str::lower($status)) {
            case 'open': 
                $result = "success";
                break;
            case 'closed': 
                $result = "danger";
                break;
        }

        return $result;
    }
}

if( !function_exists('date_db') ){
    function date_db($time)
    {
         return $time == "0000-00-00 00:00:00" ? "" : date(env('DATE_DB', "Y-m-d"), strtotime($time));
         
    } 
}

if( !function_exists('digipep_transaction') ){
    function digipep_transaction($time,$format = "M d, Y @ h:i a")
    {
        return $time == "0000-00-00 00:00:00" ? "" : date($format,strtotime($time));
         
    } 
}

if( !function_exists('date_format') ){
    function date_format(array $param)
    {
        $trans_id = $param['trans_token'];

        $request = [
            'referenceCode' => $trans_id,
            'total' => $param['amount'],
            'firstname' => $param['first_name'],
            'middlename' => $param['middle_name'],
            'lastname' => $param['last_name'],
            'subMerchantCode' => "ZIAPAYWALLET",
            'subMerchantName' => "ZIAPAYWALLET",
            'title' => $param['title'],
            'successUrl' => $param['success_url'],
            'cancelUrl' => $param['cancel_url'],
            'returnUrl' => $param['return_url'],
            'failedUrl' => $param['failed_url'],
            'details' => [
                'particularFee' => $param['particular_fee'],
                'penaltyFee' => $param['penalty_fee'],
                'dstFee' => $param['dst_fee'],
                ]

            ];

        return $request;
         
    } 
}

if( !function_exists('create_filename') ){
    function create_filename($extension)
    {
        return Str::lower(hash('sha256', Str::random(10)).".".$extension);
    }
}
if (!function_exists('date_range')) {
    function date_range($start_date, $end_date)
    {
        $start = strtotime($start_date);
        $end = strtotime($end_date);

        $startMonth = date('F', $start);
        $startDay   = date('j', $start);
        $startYear  = date('Y', $start);

        $endMonth   = date('F', $end);
        $endDay     = date('j', $end);
        $endYear    = date('Y', $end);

        // If same day
        if ($startDay == $endDay && $startMonth == $endMonth && $startYear == $endYear) {
            return "{$startMonth} {$startDay}, {$startYear}";
        }

        if ($startYear !== $endYear) {
            return "{$startMonth} {$startDay}, {$startYear} - {$endMonth} {$endDay}, {$endYear}";
        }

        if ($startMonth === $endMonth) {
            return "{$startMonth} {$startDay} - {$endDay}, {$endYear}";
        }

        return "{$startMonth} {$startDay} - {$endMonth} {$endDay}, {$endYear}";
    }
}

if (!function_exists('date_time')) {

    function date_time($date, $format = 'F j, Y - g:iA')
    {
        if (!$date) {
            return null;
        }

        return \Illuminate\Support\Carbon::parse($date)->format($format);
    }
}

if (!function_exists('mask_email')) {
    function mask_email(?string $email): string
    {
        if (!$email) {
            return '---';
        }

        $atPos = strpos($email, '@');
        if ($atPos === false || $atPos <= 3) {
            return substr($email, 0, 2) . str_repeat('*', max(strlen($email) - 4, 2));
        }

        return substr($email, 0, 3)
            . str_repeat('*', $atPos - 3)
            . substr($email, $atPos);
    }
}

if (!function_exists('mask_contact_number')) {
    function mask_contact_number(?string $number): string
    {
        if (!$number) {
            return '---';
        }

        $len = strlen($number);
        if ($len <= 5) {
            return str_repeat('*', $len);
        }

        return substr($number, 0, 3)
            . str_repeat('*', $len - 5)
            . substr($number, -2);
    }
}

if( !function_exists('prettify_text') ){
    function prettify_text($string)
    {
        // Replace underscores with spaces, and "and" with "&"
        $string = str_replace("_", " ", $string);
        $string = str_ireplace(" and ", " & ", $string);

        return Str::title($string);
    } 
}

if (! function_exists('format_time')) {
    function format_time($time, $withMinutes = true)
    {
        if (!$time) {
            return null;
        }

        $format = $withMinutes ? 'g:iA' : 'gA'; // 12:00PM or 12PM
        return Carbon::parse($time)->format($format);
    }
}

if (! function_exists('display_gender')) {
    function display_gender($value)
    {
        $result = "N/A";

        switch ($value) {
            case 'M': 
                $result = "Male";
                break;
            case 'F': 
                $result = "Female";
                break;
        }

        return $result;
    }
}

}

