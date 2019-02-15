<?php 

namespace LordDashMe\ImageSqueezer\Tests\Unit;

use Mockery as Mockery;
use PHPUnit\Framework\TestCase;
use LordDashMe\ImageSqueezer\ImageSqueezer;
use LordDashMe\ImageSqueezer\Exception\OperatingSystemException;
use LordDashMe\ImageSqueezer\Exception\ImageSqueezerException;

class ImageSqueezerTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_load_image_squeezer_class()
    {
        $this->assertInstanceOf(ImageSqueezer::class, new ImageSqueezer());
    }

    /**
     * @test
     */
    public function it_should_throw_exception_operating_system_not_supported()
    {
        $this->expectException(OperatingSystemException::class);
        $this->expectExceptionCode(OperatingSystemException::IS_NOT_SUPPORTED);

        $imageSqueezer = new ImageSqueezer();
        $imageSqueezer->setOperatingSystem('OpenBSD');
        $imageSqueezer->load();
    }

    /**
     * @test
     */
    public function it_should_provide_correct_binary_path_base_on_the_given_operating_system()
    {
        $imageSqueezer = new ImageSqueezer();
        $imageSqueezer->setOperatingSystem('WINNT');
        $imageSqueezer->load();

        $this->assertTrue((strpos($imageSqueezer->getFFMpegBin(), 'ffmpeg.exe') !== false));
    }

    /**
     * @test
     */
    public function it_should_throw_exception_image_squeezer_source_file_path_empty()
    {
        $this->expectException(ImageSqueezerException::class);
        $this->expectExceptionCode(ImageSqueezerException::EMPTY_SOURCE_FILE_PATH);

        $imageSqueezer = new ImageSqueezer();
        $imageSqueezer->load(); 
        $imageSqueezer->compress(); 
    }

    /**
     * @test
     */
    public function it_should_throw_exception_image_squeezer_output_file_path_empty()
    {
        $this->expectException(ImageSqueezerException::class);
        $this->expectExceptionCode(ImageSqueezerException::EMPTY_OUTPUT_FILE_PATH);

        $imageSqueezer = new ImageSqueezer();
        $imageSqueezer->load(); 
        $imageSqueezer->setSourceFilePath('/tmp/examplefile.jpg');
        $imageSqueezer->compress(); 
    }

    /**
     * @test
     */
    public function it_should_compress_image()
    {
        $directoryPath = dirname(__DIR__) . '/Mocks/images';

        $imageSqueezer = new ImageSqueezer();
        $imageSqueezer->load();
        $imageSqueezer->setSourceFilePath($directoryPath . '/uncompressed.jpg');
        $imageSqueezer->setOutputFilePath($directoryPath . '/compressed.jpg');
        $imageSqueezer->compress();

        $this->assertTrue(\file_exists($directoryPath . '/compressed.jpg'));
    }
}
