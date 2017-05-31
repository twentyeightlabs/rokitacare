<?php
/**
 * @uathor <lukasz.maslowski@netart.pl>
 */
class Application_Datasource_File
{
    /**
     * @var string
     */
    private $dataSourceFile;

    /**
     * @param string $dataSourceFile
     */
    public function __construct($dataSourceFile)
    {
        $this->setupDataSourceFileName($dataSourceFile);
    }

    /**
     * @param $string
     * @return void
     */
    public function save($string)
    {
        $this->throwExceptionIfFileIsNotWritable();

        $fileOpenResource = fopen($this->dataSourceFile, "w");
        flock($fileOpenResource, LOCK_EX);
        fwrite($fileOpenResource, $string);
        flock($fileOpenResource, LOCK_UN);
        fclose($fileOpenResource);
    }

    /**s
     * @return string
     */
    public function get()
    {
        $this->throwExceptionIfFileIsNotReadable();

        $fileOpenResource = fopen($this->dataSourceFile, "r");
        flock($fileOpenResource, LOCK_SH);
        $contents = fread($fileOpenResource, filesize($this->dataSourceFile));
        flock($fileOpenResource, LOCK_UN);
        fclose($fileOpenResource);

        return $contents;
    }

    private function setupDataSourceFileName($dataSourceFile)
    {
        $this->throwExceptionIfFileNotExits($dataSourceFile);
        $this->dataSourceFile = $dataSourceFile;
    }

    private function throwExceptionIfFileNotExits($dataSourceFile)
    {
        if(!file_exists($dataSourceFile)){
            throw new Exception($dataSourceFile . ' do not exists');
        }
    }

    private function throwExceptionIfFileIsNotReadable()
    {
        if(!is_readable($this->dataSourceFile)){
            throw new Exception($this->dataSourceFile . ' do not readable');
        }
    }

    private function throwExceptionIfFileIsNotWritable()
    {
        if(!is_writable($this->dataSourceFile)){
            throw new Exception($this->dataSourceFile . ' is not writable');
        }
    }
}