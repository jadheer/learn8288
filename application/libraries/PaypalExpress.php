<?php

class PaypalExpress
{
    public function paypalCheck($paymentID, $pid, $payerID, $paymentToken){

        $CI =& get_instance();
        $pay_url = $CI->config->item('api_url');
        $clientId = $CI->config->item('clientId');
        $secret = $CI->config->item('secret');
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $pay_url."v1/oauth2/token");
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $clientId . ":" . $secret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        $result = curl_exec($ch);
        $accessToken = null;


        if (empty($result)){
            return false;
        }
        
        else {
            $json = json_decode($result);
            $accessToken = $json->access_token;
            $curl = curl_init($pay_url.'v1/payments/payment/' . $paymentID);
            curl_setopt($curl, CURLOPT_POST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $accessToken,
            'Accept: application/json',
            'Content-Type: application/xml'
            ));
            $response = curl_exec($curl);
             
            curl_close($ch);
            curl_close($curl);

            return $response;
            
        }
        
    }
    
    
}


?>