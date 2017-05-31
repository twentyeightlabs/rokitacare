<?php
/**
 * Class Application_Service_Template
 */
class Application_Service_Template
{
    private $templatesRepositoryDirectory;
    private $imgSrcPattern;

    /**
     * @param $templatesRepositoryDirectory
     * @param $pattern
     * @throws Exception
     */
    public function __construct($templatesRepositoryDirectory)
    {
        $this->throwExceptionIfDirNoExists($templatesRepositoryDirectory);
        $this->templatesRepositoryDirectory = $templatesRepositoryDirectory;
    }

    private function throwExceptionIfDirNoExists($templatesRepositoryDirectory)
    {
        if (!is_dir($templatesRepositoryDirectory)) {
            throw new Exception('dir ' . $templatesRepositoryDirectory . ' do not exists');
        }
    }

    public function getTemplateList()
    {
        $iterator = new DirectoryIterator($this->templatesRepositoryDirectory);
        $templates = array();

        foreach ($iterator as $name => $dir) {
            if(!$this->isTemplateDir($dir)){
                continue;
            }
            $templates[] = (string)$dir;
           }
        sort($templates);
        return $templates;
    }

    public function getTemplateListWithPreviewImgPattern($imgSrcPattern)
    {
        $templateList = $this->getTemplateList();
        $templatesListWithPreviewImgPattern = array();

        foreach ($templateList as $templateName) {

            $templatesListWithPreviewImgPattern[$templateName] = $imgSrcPattern;
        }
        return $templatesListWithPreviewImgPattern;
    }

    public function isTemplateDir(SplFileInfo $file)
    {
        if(in_array($file, array('.', '..'))){
            return false;
        }
        return true;
    }

    public function isMetaFile(SplFileInfo $file)
    {
        if(!$file->isFile()){
            return false;
        }
        $pattern = "/.*meta\/*/";
        return (bool)preg_match($pattern, $file->getPathname());
    }
}