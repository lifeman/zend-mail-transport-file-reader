Zend Mail Transport File Reader
===============================

Utility to read emails written by Zend Framework File Mail Transport (a transport to write mails into files rather than sending them).
Scenario: set the Zend testing environment to use the file transport, 
then assert that mails have been sent using these libraries.

Compatible with ZF1 and ZF2
 * [Zend_Mail_Transport_File](http://framework.zend.com/manual/1.12/en/zend.mail.different-transports.html) 
 * [Zend\Mail\Transport\File](http://framework.zend.com/manual/2.0/en/modules/zend.mail.transport.html)

Valid to read any email with headers written in separate files inside a directory

## Install with composer
Get composer [here](http://getcomposer.org/) and run
    
    composer install

the autoloader will be created into the `vendor` directory

## Tests

    phpunit

## Example of usage
    
    <?php
    use Ec\File\DirectoryRegexIterator;
    use Ec\EmailLogReader\MailEntry;
    use Ec\EmailLogReader\MailDirectoryIterator;

    $itFiles = new DirectoryRegexIterator(
        new \DirectoryIterator('/path/to/saved-mails'),
        '#^ZendMail_#' //this is the default prefix used by Zend_Mail_Transport_File 
    );
    $itMails = new MailDirectoryIterator($itFiles);
    
    foreach ($itMails as $mail) { /* @var $mail MailEntry */
        echo "Mail for {$entry->getTo()} with subject {$entry->getSubject()} \n";
    }