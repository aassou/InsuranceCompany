<?php
class OpenSSLEncryption {
    
    //attributes
    private $_password = "@RN20i0n1eVoN7!?KOrickM0oL9eRTv?";
    private $_method = "aes128";
    private $_iv = "612kjOKL23423X?@cEv7";
    private $_mutation = 123456789;
    
    //constructor
    public function __construct(){}
    
    //methods
    public function openssl_encrypt($data){
        return openssl_encrypt($data, $this->_method, $this->_password, true, $this->_iv);
    }
    
    public function openssl_decrypt($data){
        return openssl_decrypt($data, $this->_method, $this->_password, true, $this->_iv);
    }
    
    public function number_forward($number){
        return $number - $this->_mutation;
    }
    
    public function number_backward($number){
        return $number + $this->_mutation;
    }
}
