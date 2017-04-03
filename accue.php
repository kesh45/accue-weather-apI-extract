<?php
class AccuWeather {
    //$apikey = "jwfhhGNmrrPC45kf2fUnj3n6IUsG8nEs"
    
    function CurrentWeather($query){
        $service_url = 'http://dataservice.accuweather.com/currentconditions/v1/1122763.json?apikey=' . apikey .'getphotos=true'

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $service_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_TRANSFERTEXT, TRUE);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT,3);
        curl_setopt($curl, CURLOPT_USERAGENT,"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.57 Safari/537.36");
        
        
        $curl_response = curl_exec($curl);
        
        
        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('error occured during curl exec. Additioanl info: ' . var_export($info));
        }
        
        curl_close($curl);
        
        $decoded = $curl_response;
        
        if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
            die('error occured: ' . $decoded->response->errormessage);
        }
        
        return $decoded;
    }
    
}
?>
