<?php
namespace Ec\EmailLogReader;

use Ec\File\DirectoryRegexIterator;

/**
 * Iterator returning MailEntry classes for each file found in the directory
 */
class MailDirectoryIterator extends \IteratorIterator
{
    /**
     * @param DirectoryRegexIterator $iterator
     */
    public function __construct(DirectoryRegexIterator $iterator)
    {
        parent::__construct($iterator);
    }

    /**
     * @return MailEntry
     */
    public function current()
    {
        $current = $this->getInnerIterator()->current(); /* @var $current SplFileInfo*/
        $fileFullPath = $current->getPath() . '/' . $current->getFilename();
        $content = file_get_contents($fileFullPath);
        
        return new MailEntry($content);
    }
    
    /**
     * Get paths of files
     * 
     * @return array
     */
    public function getFilePaths()
    {
        $ret = array();
        foreach ($this->getInnerIterator() as $file) {
            $ret[] = $file->getPath() . '/' . $file->getFilename();
        }
        
        return $ret;
    }
    
}