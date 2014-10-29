<?php
namespace Ec\EmailLogReader;

class MailEntryTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyMail()
    {
        $object = new MailEntry('');
        $this->assertEquals('', $object->getSubject());
        $this->assertEquals('', $object->getTo());
    }
    
    public static function mailContentProvider()
    {
        return array(
            array('', '', ''),
            array("To : x", '', ''),
            array("To: x  \r\nSubject:    y   \n   ", 'x', 'y'),
            array("To: to1 \nTo: to2", 'to1', null) //take first valid value
        );
    }
    
    /**
     * @dataProvider mailContentProvider
     */
    public function testMail($content, $expectedTo, $expectedSubject)
    {
        $object = new MailEntry($content);
        $this->assertEquals($expectedTo, $object->getTo());
        $this->assertEquals($expectedSubject, $object->getSubject());
    }
    
    
    public function testMailValidFromFixture()
    {
        $object = new MailEntry(
            file_get_contents(__DIR__ . '/fixtures/ZendMail_example')        
        );
        $this->assertEquals('Email Subject !', $object->getSubject());
        $this->assertEquals('test@site.com', $object->getTo());
        $this->assertEquals(675, strlen($object->getRaw()));
    }
    
//    public function testAttachment()
//    {
//        $object = new MailEntry(
//            file_get_contents(__DIR__ . '/fixtures/ZendMail_example')        
//        );
//        $this->assertEquals('Email Subject !', $object->getSubject());
//        $this->assertEquals('test@site.com', $object->getTo());
//    }
    
}