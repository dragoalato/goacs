<?php
declare(strict_types=1);

namespace App\ACS\Entities\Tasks;

use App\ACS\Context;
use App\ACS\Request\ACSRequest;
use App\ACS\Request\DownloadRequest;
use App\Models\File;
use App\Models\Log;

class DownloadTask extends Task implements WithRequest
{

    public function toRequest(Context $context): ACSRequest
    {
        $fileData = $this->getFileData($context, $this->payload['filename']);
        return new DownloadRequest($context, $this->payload['filetype'], $fileData['url'], $fileData['size']);
    }

    private function getFileData(Context $context, string $filename): array {
        $file = File::whereName($filename)->first();
        if($file === false || \Storage::disk($file->disk)->exists($file->filepath) === false) {
            Log::logError($context, "Cannot find file in store: ".$filename);
            //TODO: Throw ACS Exception, then catch in ExceptionHandler and respond with some error to device.
        }
        return [
            'url' => \Storage::disk($file->disk)->url($file->filepath),
            'size' => $file->size,
        ];
    }
}
