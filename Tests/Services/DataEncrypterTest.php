<?php


namespace AppBundle\Tests\Services;

use CrossKnowledge\FeedbackDataEncrypterBundle\Services\DataEncrypter;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DataEncrypterTest extends WebTestCase
{
    public function testEncryptString()
    {
        $data = "This is a test";
        $encrypter = new DataEncrypter();
        $encrypted = $encrypter->encrypt($data, "test");
        $decrypted = $encrypter->decrypt($encrypted, "test");

        $this->assertEquals($data, $decrypted);
    }

    public function testEncryptStringWithMaxKey()
    {
        $data = "This is a test with a long key of 32 chars";
        $encrypter = new DataEncrypter();
        $encrypted = $encrypter->encrypt($data, "maximum_key_with_thirty_two_char");
        $decrypted = $encrypter->decrypt($encrypted, "maximum_key_with_thirty_two_char");

        $this->assertEquals($data, $decrypted);
    }

    public function testEncryptArray()
    {
        $data = array("title" => "This is a test", "description" => "This is a test about encryption");
        $encrypter = new DataEncrypter();
        $encrypted = $encrypter->encrypt($data, "test");
        $decrypted = $encrypter->decrypt($encrypted, "test");

        $this->assertEquals($data, $decrypted);
    }

    public function testEncryptStringFail()
    {
        $data = "This is a test";
        $encrypter = new DataEncrypter();
        $encrypted = $encrypter->encrypt($data, "test");
        $decrypted = $encrypter->decrypt($encrypted, "testkey");

        $this->assertNotEquals($data, $decrypted);
    }

    public function testEncryptStringEmpty()
    {
        $data = "";
        $encrypter = new DataEncrypter();
        $encrypted = $encrypter->encrypt($data, "test");
        $decrypted = $encrypter->decrypt($encrypted, "testkey");

        $this->assertEquals($data, $encrypted);
        $this->assertEquals($data, $decrypted);
    }
}