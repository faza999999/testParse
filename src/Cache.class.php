<?php
class Cache {
    protected $_filename;
    private static function getCacheFolder(){
        if (!file_exists(ROOT_DIR.'cacheParseResults')) {
            mkdir(ROOT_DIR.'cacheParseResults', 0777, true);
        }
        return ROOT_DIR.'cacheParseResults';
    }
    public function __construct($fileName)
    {
        $this->_filename = $fileName;
    }

    function read() {
        $fileName = self::getCacheFolder().DIRECTORY_SEPARATOR.$this->_filename;
        if (file_exists($fileName)) {
            $handle = fopen($fileName, 'rb');
            $variable = fread($handle, filesize($fileName));
            fclose($handle);
            return unserialize($variable);
        } else {
            return null;
        }
    }

    function write($variable) {
        $fileName = self::getCacheFolder().DIRECTORY_SEPARATOR.$this->_filename;
        $handle = fopen($fileName, 'a');
        fwrite($handle, serialize($variable));
        fclose($handle);
    }

    function delete() {
        $fileName = self::getCacheFolder().DIRECTORY_SEPARATOR.$this->_filename;
        @unlink($fileName);
    }
}
