<?php

namespace Jc\ObdulioBundle\Clases;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Jc\ObdulioBundle\Clases\FileUploader;
use Symfony\Component\HttpFoundation\File\File;

class AvatarUploadListener{
    private $uploader;
    
    public function __construct(FileUploader $uploader){
        $this->uploader = $uploader;
    }
    
    public function prePersist(LifecycleEventArgs $args){
        $entity = $args->getEntity();
        $this->uploadFile($entity);
    }
    
    public function preUpdate(PreUpdateEventArgs $args){
        $entity = $args->getEntity();
        $this->uploadFile($entity);
    }
    
    private function uploadFile($entity){
        // upload only works for Product entities
        if (!$entity instanceof Usuarios) {
            return;
        }
        
        $file = $entity->getAvatar();
        // only upload new files
        if (!$file instanceof UploadedFile) {
            return;
        }
        
        $fileName = $this->uploader->upload($file);
        $entity->setAvatar($fileName);
    }
    
    public function postLoad(LifecycleEventArgs $args){
        $entity = $args->getEntity();
        $fileName = $entity->getAvatar();
        $entity->setAvatar(new File($this->targetPath.'/'.$fileName));
    }
}
?>
