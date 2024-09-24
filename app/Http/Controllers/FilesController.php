<?php

namespace App\Http\Controllers;

use App\Services\FileUploads\FileUploadService;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class FilesController extends Controller
{
    public function uploadFile(Request $request): JsonResponse
    {
        // upload the receipt files
        try {
            if (empty($request->file())) {
                return response()->json(array(
                        'state' => 'error',
                        'message' => "File failed to upload: No File to upload")
                );
            }
            $files = $request->allFiles();
            $fileKey = 'file';
            $fileUploadFolder = $request->folder;

            $modelId = $request->modelId;
            $modelCode = $request->modelCode;
            $fileType =  $request->file_type;
            $formType = $request->form_type;

            $filesUploaded  = FileUploadService::uploadFile(
                $files,
                $fileKey,
                $fileUploadFolder,
                $modelId,
                $modelCode,
                $fileType,
                $formType);

            if(!$filesUploaded){
                return response()->json(
                    array('state' => 'error',
                        'message' => "File upload Failed")
                );
            }

            return response()->json(
                array(
                    'state' => 'success',
                    'message' => "File Has Been Attached Successfully",
                )
            );

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(array('state' => 'error', 'message' => "File upload Failed"));
        }

    }
}
