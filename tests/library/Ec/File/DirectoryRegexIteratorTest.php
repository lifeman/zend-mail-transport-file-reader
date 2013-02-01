<?php
namespace Ec\File;

class DirectoryRegexIteratorTest extends \PHPUnit_Framework_TestCase
{
    public static function provider()
    {
        return array(
            array('/^abc/', 1),
            array('/ab/i', 3),
        );
    }
    
    /**
     * @dataProvider provider
     */
    public function testFilter($regexpr, $expectedCount)
    {
        $object = new DirectoryRegexIterator(
            new \DirectoryIterator(__DIR__ . '/fixtures'),
            $regexpr
        );
        $this->assertCount($expectedCount, $object);
        foreach ($object as $file) {
            $this->assertInstanceOf('SplFileInfo', $file);
        }
    }
}