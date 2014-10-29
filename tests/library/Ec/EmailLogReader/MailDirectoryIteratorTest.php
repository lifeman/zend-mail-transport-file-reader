<?php
namespace Ec\EmailLogReader;

use Ec\File\DirectoryRegexIterator;

class MailDirectoryIteratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MailIterator
     */
    private $object;
    
    public function setUp()
    {
        // this can be mocked, but easier to show its usage by using a real directory
        $iterator = new DirectoryRegexIterator(
            new \DirectoryIterator(__DIR__ . '/fixtures'),
            '#^ZendMail_#'
        );
        
        $this->object = new MailDirectoryIterator($iterator);
    }
    
    public function testIteratorReturnsMailEntriesWithValidEmailAddress()
    {
        $this->assertCount(2, $this->object);
        foreach ($this->object as $entry) {
            $this->assertInstanceOf(__NAMESPACE__ . '\\MailEntry', $entry);
            $this->assertRegExp('/@/', $entry->getTo());
        }
    }
    
    public function testgetFilePathsReturns2ExistingFiles()
    {
        $actual = $this->object->getFilePaths();
        $this->assertCount(2, $actual);
        foreach($actual as $filePath) {
            $this->assertTrue(file_exists($filePath));
        }
    }
    
}