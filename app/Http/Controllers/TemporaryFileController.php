<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TemporaryFileController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'file.*' => 'required'
        ]);

        try {
            if ($request->hasfile('file')) {
                $temporaryFile = TemporaryFile::query()->create();
                $temporaryFile->addMedia($request->file)->toMediaCollection('temporary_files');
            }

            return response()->json([
                'status' => 'success',
                'temporaryFile' => $temporaryFile->id,
                'error' => null
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'temporaryFile' => null,
                'error' => $ex->getMessage()
            ], 422);
        }
    }

    public function delete(Request $request)
    {
        try {
            $media = Media::query()->findOrFail($request->file_id);
            $media->delete();

            return response()->json([
                'status' => 'success',
                'error' => null,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e->getMessage(),
            ], 422);
        }
    }
}
