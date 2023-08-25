<?php

namespace App\Services\FileUploads;

use App\Models\FileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class FileUploadService
{
    /**
     * Upload files to file system and save details to datastore
     * @param mixed $files Files Array from Http Request Object
     * @param string $fileKey property that indicates field having attachments
     * @param string $fileUploadFolder the location on the file system where files will be uploaded
     * @param string $modelId
     * @param string $modelCode
     * @param string $fileType identifies the type of document e.g contract, invoice etc.
     * @param string $formType
     * @return bool
     */
    public static function uploadFile(
        $files,
        string $fileKey,
        string $fileUploadFolder,
        string $modelId,
        string $modelCode,
        string $fileType,
        string $formType
    ): bool
    {

        try {
            if (array_key_exists($fileKey, $files)) {

                $doc_types = $files[$fileKey];

                if (is_array($doc_types)) {
                    foreach ($doc_types as $file_one) {
                        self::uploadAndSave($file_one, $fileUploadFolder, $formType, $modelId, $modelCode, $fileType);
                    }
                } else {
                    $file_one = $doc_types;
                    self::uploadAndSave($file_one, $fileUploadFolder, $formType, $modelId, $modelCode, $fileType);
                }

                return true;

            }
            return false;
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }

    /**
     * @param $file_one
     * @param string $fileUploadFolder
     * @param string $formType
     * @param string $modelId
     * @param string $modelCode
     * @param string $fileType
     */
    public static function uploadAndSave($file_one, string $fileUploadFolder, string $formType, string $modelId, string $modelCode, string $fileType): void
    {
        $filenameWithExt = preg_replace("/[^a-zA-Z]+/", "_", $file_one->getClientOriginalName());
        // Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //get size
        $size = number_format($file_one->getSize() * 0.000001, 2);
        // Get just ext
        $extension = $file_one->getClientOriginalExtension();
        // Filename to store
        $fileName = trim(preg_replace('/\s+/', ' ', $filename . '_' . time() . '.' . $extension));
        // Upload File
        $path = $file_one->storeAs('public/' . $fileUploadFolder, $fileName);

        $uuid = Str::uuid()->toString();

        DB::beginTransaction();
        $model = FileUploads::create(
            [
                'uuid' => $uuid,
                'name' => $fileName,
                'size' => $size,
                'path' => $path,
                'ext' => $file_one->extension(),
                'folder' => $formType,
                'model_id' => $modelId ?? 1,
                'modal_code' => $modelCode ?? 1,
                'type' => $fileType
            ],
            [
                'uuid' => $uuid,
                'name' => $fileName,
                'size' => $size,
                'path' => $path,
                'ext' => $file_one->extension(),
                'folder' => $formType,
                'model_id' => $modelId ?? 1,
                'modal_code' => $modelCode ?? 1,
                'type' => $fileType
            ]
        );
        DB::commit();

        Log::info('Uploaded File');
        Log::info($model->id);
    }
}
