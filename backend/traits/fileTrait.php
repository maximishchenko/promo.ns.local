<?php

namespace backend\traits;

use yii\web\UploadedFile;
use Yii;

/**
 * Обеспечивает операции загрузки, обновления записи и удаления файлов
 */
trait fileTrait
{
    private static $frontendPath = '../../frontend/web/';
    
    private static $frontendAlias =  '@frontend/web';

    /**
     * Загружает один файл, записывает имя файла в значение аттрибута в БД
     *
     * @param string $fileAttribute название виртуального аттрибута загруженного файла, полученного от \yii\web\UploadedFile
     * @param string $fileField название аттрибута, соответствующего полю в БД для хранения имени файла
     * @param string $uploadPath строка пути к каталогу загружаемого файла
     * 
     * @return void
     */
    public function uploadFile(string $fileAttribute, string $fileField, string $uploadPath, bool $multiple = false)
    {
        if (!$multiple) {
           $this->$fileAttribute = UploadedFile::getInstance($this, $fileAttribute);
        } 

        if ($this->$fileAttribute) {
            $file = $this->setPath($this->$fileAttribute, $uploadPath);
            Yii::debug($file);
            if(!$this->isNewRecord && $this->$fileField) {
                $filePath = $this->getPath($uploadPath, $this->$fileField);
                $this->removeSingleFileIfExist($filePath);
            }
            $this->$fileAttribute->saveAs($file);
            $this->$fileField = basename($file);
            Yii::debug(basename($file));
        }
    }

    /**
     * Undocumented function
     *
     * @param string $filesAttribute
     * @param string $fileField
     * @param string $uploadPath
     * @return void
     */
    public function deleteMultipleFiles(string $filesAttribute, string $fileField, string $uploadPath)
    {
        if ($this->$filesAttribute) {
            foreach ($this->$filesAttribute as $file) {
                $filePath = $this->getPath($uploadPath, $file->$fileField);
                $this->removeSingleFileIfExist($filePath);
            }
        }
    }

    /**
     * Undocumented function
     *
     * @param string $fileField
     * @param string $uploadPath
     * @return void
     */
    public function deleteSingleFile(string $fileField, string $uploadPath)
    {
        if($this->$fileField) {
            $filePath = $this->getPath($uploadPath, $this->$fileField);
            $this->removeSingleFileIfExist($filePath);
        }
    }


    /**
     * Возвращает полный путь к загруженному файлу или null если файл отсутствует
     *
     * @return string|null
     */
    public function getPath(string $path, string $file): ?string
    {
        return (isset($file)) ? self::$frontendPath . $path . $file : null;
    }

    /**
     * Возвращает относительный путь к файлу изображения
     *
     * @return string
     */
    public function getUrl(string $path, string $file)
    {
        return "/" . $path . $file;
    }

    /**
     * Проверяет наличие загруженного файла
     *
     * @return bool
     */
    public function isFile($attribute): bool
    {
        return isset($attribute) && !empty($attribute) ? true : false;
    }

    /**
     * Удаляет файл из файловой системы
     *
     * @param string $file абсолютный или относительный путь к файлу в файловой системе
     * @return void
     */
    public function removeSingleFileIfExist(string $file)
    {
        file_exists($file) && is_file($file) && unlink($file);
    }

    /**
     * Генерирует путь к загружаемому файлу относительно каталога @frontend
     *
     * @param UploadedFile $file загружаемый файл
     * @param string $path путь для сохранения
     * @return string относительный путь к загружаемому файлу в директории @frontend
     */
    public static function setPath(UploadedFile $file, string $path): string
    {
        $img = uniqid() . '.' . $file->extension;
        $filePath = self::$frontendPath . $path . $img;
        return $filePath;
    }
    
    public function setFileExtensionAttribute(string $file, string $attribute)
    {
        $file = UploadedFile::getInstance($this, $file);
        $this->$attribute = $file->extension;
    }

    public function setFileSizeAttribute(string $file, string $attribute)
    {
        $file = UploadedFile::getInstance($this, $file);
        $this->$attribute = $file->size;
    }
}