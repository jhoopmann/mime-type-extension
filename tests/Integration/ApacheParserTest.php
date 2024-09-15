<?php

namespace Jhoopmann\MimeTypeExtension\Tests\Integration;

use Jhoopmann\MimeTypeExtension\ApacheParser;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionException;

class ApacheParserTest extends TestCase
{
    private const string MIME_TYPES_FILE = __DIR__ . '/../resources/mime.types';

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @throws ReflectionException
     */
    public function testInitialization()
    {
        // when
        $mimeTypes = new ApacheParser(self::MIME_TYPES_FILE);

        // assert
        $mimeTypes = (new ReflectionClass(ApacheParser::class))
            ->getProperty('mimeTypes')
            ->getValue($mimeTypes);

        $this->assertNotEmpty($mimeTypes);
        $this->assertCount(777, $mimeTypes);
    }

    public function testGetExtension()
    {
        // given
        $mimeTypes = new ApacheParser(self::MIME_TYPES_FILE);

        // when
        $extensionPng = $mimeTypes->getExtension('image/png');
        $extensionPdf = $mimeTypes->getExtension('application/pdf');
        $extensionM4v = $mimeTypes->getExtension('video/mp4');

        // assert
        $this->assertEquals('png', $extensionPng);
        $this->assertEquals('pdf', $extensionPdf);
        $this->assertEquals('m4v', $extensionM4v);
    }

}