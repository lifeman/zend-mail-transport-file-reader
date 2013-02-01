<?php
namespace Ec\File;

/**
 * FilterIterator that only return files (\SplFileInfo)
 * matching the given Regexpr
 */
class DirectoryRegexIterator extends \FilterIterator 
{
    /**
     * @var string
     */
    protected $filePattern;
    
    /**
     * @param \DirectoryIterator $iterator
     * @param string $filePattern
     */
    public function __construct(\DirectoryIterator $iterator, $filePattern = '#^ZendMail_#')
    {
        parent::__construct($iterator);
        
        $this->filePattern = $filePattern;
    }
    
    /**
     * @return boolean
     */
    public function accept()
    {
        $file = $this->getInnerIterator()->current(); /* @var $file \SplFileInfo */
        
        return preg_match($this->filePattern, $file->getFilename());
    }
}