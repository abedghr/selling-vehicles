<?php

namespace common\components;

use frostealth\yii2\aws\s3\Service as s3Service;

class S3 extends s3Service
{
    public function upload($filename, $source)
    {
//            /$command->inBucket('new-vehicles')->byFilename($this->imageFile)->saveAs('uploads/' . time() . '_' . $this->imageFile);
//            $result = $s3->execute($command);
        parent::upload($filename, $source);
    }
}