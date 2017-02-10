<?php 
class ImageProcessing {
    
    //attributes
    protected $_image;
    private $_extensions = null;
    const SIZE = 10000;
    
    //constructor
    public function __construct(){
        $this->_image = "";
        $this->_extensions = array('png', 'gif', 'jpeg', 'jpg', 'PNG', 'JPG', 'JPEG', 'GIF'); 
    }
    
    //Function 1 : processing image
    public function processing ( $source, $path ) {
        if ( isset($source) && $source['error'] == 0 ) {
            if ( $source['size'] <= self::SIZE ) {
                $file = pathinfo($source['name']);
                $fileExtension = $file['extension'];
                if ( in_array($fileExtension, $this->_extensions) ) {
                    $nameUpload = uniqid().basename($source['name']).$fileExtension;
                    move_uploaded_file($source['tmp_name'], '..'.$path.$nameUpload);
                    $this->_image = $path.$nameUpload;
                }
            }
        }
        return $this->_image;
    }

    //Function 2 : SimpleProcessing 
    public function simpleProcessing ( $source, $path, $name ) {
        if ( isset($source) && $source['error'] == 0 ) {
            if ( $source['size'] <= self::SIZE ) {
                $file = pathinfo($source['name']);
                $fileExtension = $file['extension'];
                if ( in_array($fileExtension, $this->_extensions) ) {
                    $nameUpload = $name.'-'.basename($source['name']);
                    move_uploaded_file($source['tmp_name'], $path.$nameUpload);
                    $this->_image = $path.$nameUpload;
                }
            }
        }
        return $this->_image;
    }    
}
