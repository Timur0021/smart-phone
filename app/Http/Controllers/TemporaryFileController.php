<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Exception;

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
            $request->validate([
                'file_id' => 'exists:temporary_files,id'
            ]);
            $file = TemporaryFile::query()->find($request->file_id);
            $file->clearMediaCollection('temporary_files');
            $file->delete();
            return response()->json([
                'status' => 'success',
                'error' => null
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => 'error',
                'error' => $ex->getMessage()
            ], 422);
        }
    }
}
