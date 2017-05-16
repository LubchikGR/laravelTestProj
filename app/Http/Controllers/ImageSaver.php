<?php
/**
 * Created by PhpStorm.
 * User: l.Hruzinskyi
 * Date: 15/03/2017
 * Time: 16:18
 */

namespace fileSaver\Controllers;

use Gregwar\Image\Image;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageSaver
{
    private $file;
    private $year;
    private $month;
    private $quality;
    private $saveType;
    private $fileName;
    private $extension;
    private $folderName;
    private $absolutePath;

    public function __construct()
    {
        $date = new \DateTime();
        $this->year = $date->format('Y');
        $this->month = $date->format('m');
    }

    public function upload($file, $folderName, $saveType, $quality)
    {
        if (null === $file) {
            return false;
        } else {
            $this->file = $file;
            $this->folderName = $folderName;
            $this->saveType = $saveType;
            $this->quality = $quality;
            $this->absolutePath = $this->getAbsolutePath($this->folderName);
            $this->extension = $this->getExtension();
            $this->fileName = $this->getFileName(); //function use $this->extension // call after getExtension()

            if (is_object($file)) {
                return $this->saveObjectFile();
            } else {
                return $this->saveFromLink();
            }
        }
    }

    private function saveObjectFile()
    {
        $this->file->move(
            $this->absolutePath,
            $this->fileName
        );

        $this->convertMediaFile();

        return $this->getRelativePath();
    }

    private function saveFromLink()
    {
        $fs = new Filesystem();

        $fs->copy($this->file, $this->absolutePath . $this->fileName);
        $this->convertMediaFile();

        return $this->getRelativePath();
    }

    private function convertMediaFile()
    {
        $gregImage = Image::open($this->absolutePath . $this->fileName);

        if ($gregImage->correct()) {
            $gregImage->save(
                $this->absolutePath . $this->fileName,
                $this->saveType ? $this->saveType : $this->extension,
                $this->quality
            );
        }
    }

    private function getExtension()
    {
        if ($this->file instanceof UploadedFile) {
            /*TODO not sure mb need refactor */
            return $this->file->getClientOriginalExtension();
        } else {
            $ext = explode('?', $this->file);
            $extension = pathinfo($ext[0], PATHINFO_EXTENSION);
            return empty($extension) ? 'jpg' : $extension;
        }
    }

    /* old path */
    public function removeFile($path)
    {
        if (is_null($path) || empty($path)) {
            return false;
        }

        $absoluteImagePath = __DIR__ . '/../../../public' . $path;

        if (file_exists($absoluteImagePath)) {
            @unlink($absoluteImagePath);
            return true;
        }

        return false;
    }

    public function getAbsolutePath($folderName)
    {
        return base_path() . '/public/uploads/' . $folderName . '/' . $this->year . '/' . $this->month . '/';
    }

    public function getFileName()
    {
        return sha1(uniqid(mt_rand(), true)) . '.' . $this->extension;
    }

    public function getRelativePath()
    {
        return '/uploads/' . $this->folderName . '/' . $this->year . '/' . $this->month . '/' . $this->fileName;
    }
}