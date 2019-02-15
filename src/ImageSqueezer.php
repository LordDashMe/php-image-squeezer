<?php

namespace LordDashMe\ImageSqueezer;

use LordDashMe\ImageSqueezer\Exception\OperatingSystemException;
use LordDashMe\ImageSqueezer\Exception\ImageSqueezerException;

class ImageSqueezer
{
    const WINDOWS_OS = 'WIN';
    const LINUX_OS = 'Linux';
    const UNIX_OS = 'Unix';
    const MACOSX_OS = 'Mac OS X';

    private $operatingSystem = '';
    private $ffmpegBin = '';
    private $sourceFilePath = '';
    private $outputFilePath = '';

    public function setOperatingSystem($operatingSystem = '')
    {
        $this->operatingSystem = $operatingSystem;
    }

    public function load()
    {
        $this->verifySupportedOperatingSystem();
    }

    private function verifySupportedOperatingSystem()
    {
        $operatingSystem = $this->getOperatingSystem();

        if (strtoupper(substr($operatingSystem, 0, 3)) === self::WINDOWS_OS) {
            $this->ffmpegBin = $this->getCurrentDIR() . '/../lib/ffmpeg-20190214-f1f66df-win64-static/bin/ffmpeg.exe';
        } else if ($operatingSystem === self::LINUX_OS) {
            $this->ffmpegBin = $this->getCurrentDIR() . '/../lib/ffmpeg-4.1.1-amd64-static/ffmpeg';
        } else if ($operatingSystem === self::UNIX_OS || $operatingSystem === self::MACOSX_OS) {

        } else {
            throw OperatingSystemException::isNotSupported();
        }
    }

    private function getOperatingSystem()
    {
        if ($this->operatingSystem) {
            return $this->operatingSystem;
        }

        return PHP_OS;
    }

    private function getCurrentDIR()
    {
        return __DIR__;
    }

    public function getFFMpegBin()
    {
        return $this->ffmpegBin;
    }

    public function setSourceFilePath($sourceFilePath)
    {
        $this->sourceFilePath = $sourceFilePath;
    }

    public function setOutputFilePath($outputFilePath)
    {
        $this->outputFilePath = $outputFilePath;
    }

    public function compress()
    {
        $this->validateRequiredProperties();

        $imageSize = \getimagesize($this->sourceFilePath);

        $width = $imageSize[0];
        $height = $imageSize[1];

        exec($this->ffmpegBin . ' -y -i ' 
            . \escapeshellarg($this->sourceFilePath) 
            . ' -vf scale=w=' . $width . ':h=' . $height . ':force_original_aspect_ratio=decrease ' 
            . \escapeshellarg($this->outputFilePath)
        );
    }

    private function validateRequiredProperties()
    {
        if (empty($this->sourceFilePath)) {
            throw ImageSqueezerException::emptySourceFilePath();
        }
        if (empty($this->outputFilePath)) {
            throw ImageSqueezerException::emptyOutpuFilePath();
        }
    }
}
