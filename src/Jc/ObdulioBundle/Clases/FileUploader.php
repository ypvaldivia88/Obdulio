<?php
namespace Jc\ObdulioBundle\Clases;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader{    
    private $targetDir;

    public function __construct($targetDir){
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file, $cid){//$nombre, $apellidos){
        $fileName = md5($cid).'.'.$file->guessExtension();//$nombreTemp.$apellidosTemp.'.'.$file->guessExtension();//md5()
        $file->move($this->targetDir, $fileName);
        return $fileName;
    }
}
?>
