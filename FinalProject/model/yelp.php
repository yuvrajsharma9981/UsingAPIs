<?php

require('../lib/OAuth.php');

class Yelp {

    private $CONSUMER_KEY;
    private $CONSUMER_SECRET;
    private $TOKEN; 
    private $TOKEN_SECRET; 
    private $API_HOST = 'api.yelp.com';
    private $DEFAULT_TERM = 'dinner';
    private $DEFAULT_LOCATION = 'San Francisco, CA';
    private $SEARCH_LIMIT = 20;
    private $SEARCH_PATH = '/v2/search/';

    /**
     * Makes a request to the Yelp API and returns the response
     * 
     * @param    $host    The domain host of the API 
     * @param    $path    The path of the APi after the domain
     * @return   The JSON response from the request      
     */
    function request($host, $path) {
        $this->CONSUMER_KEY = getenv('CONSUMER_KEY');
        $this->CONSUMER_SECRET = getenv('CONSUMER_SECRET');
        $this->TOKEN = getenv('TOKEN');
        $this->TOKEN_SECRET = getenv('TOKEN_SECRET');
        $unsigned_url = "https://" . $host . $path;
// Token object built using the OAuth library
        $token = new OAuthToken($this->TOKEN, $this->TOKEN_SECRET);
// Consumer object built using the OAuth library
        $consumer = new OAuthConsumer($this->CONSUMER_KEY, $this->CONSUMER_SECRET);
// Yelp uses HMAC SHA1 encoding
        $signature_method = new OAuthSignatureMethod_HMAC_SHA1();
        $oauthrequest = OAuthRequest::from_consumer_and_token(
                        $consumer, $token, 'GET', $unsigned_url
        );

// Sign the request
        $oauthrequest->sign_request($signature_method, $consumer, $token);

// Get the signed URL
        $signed_url = $oauthrequest->to_url();

// Send Yelp API Call
        try {
            $ch = curl_init($signed_url);
            if (FALSE === $ch)
                throw new Exception('Failed to initialize');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $data = curl_exec($ch);
            if (FALSE === $data)
                throw new Exception(curl_error($ch), curl_errno($ch));
            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (200 != $http_status)
                throw new Exception($data, $http_status);
            curl_close($ch);
        } catch (Exception $e) {
            trigger_error(sprintf(
                            'Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()), E_USER_ERROR);
        }

        return $data;
    }

    /**
     * Query the Search API by a search term and location 
     * 
     * @param    $term        The search term passed to the API 
     * @param    $location    The search location passed to the API 
     * @return   The JSON response from the request 
     */
    function search($term, $location) {
        $url_params = array();

        $url_params['term'] = $term ? : $this->DEFAULT_TERM;
        $url_params['location'] = $location? : $this->DEFAULT_LOCATION;
        $url_params['limit'] = $this->SEARCH_LIMIT;
        $search_path = $this->SEARCH_PATH . "?" . http_build_query($url_params);


        return $this->request($this->API_HOST, $search_path);
    }

    /**
     * Queries the API by the input values from the user 
     * 
     * @param    $term        The search term to query
     * @param    $location    The location of the business to query
     */
    function query_api($term, $location) {
        $response = json_decode($this->search($term, $location));

        //var_dump($response);
        $names = $response->businesses;
        return $names;
    }

}


