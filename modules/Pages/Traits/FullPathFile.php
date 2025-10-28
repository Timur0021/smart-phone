<?php

namespace Modules\Pages\Traits;

use Illuminate\Support\Facades\Storage;

trait FullPathFile
{
    /**
     *
     * @param array $data
     * @param string $key
     *
     * @return void
     */
    public function getFullPathByKey(array &$data, string $key): void
    {
        array_walk_recursive($data, function (&$value, $fileKey) use ($key) {
            if ($fileKey === $key && !empty($value) && !str_starts_with($value, "http")) {
                $value = url('storage/' . ltrim($value, "/"));
            }
        });
    }

    /**
     *
     * @param array $data
     * @param array $keys
     *
     * @return void
     */
    public function getFullPathByKeys(array &$data, array $keys): void
    {
        array_walk_recursive($data, function (&$value, $fileKey) use ($keys) {
            if (in_array($fileKey, $keys, true) && !empty($value) && !str_starts_with($value, "http")) {
                $value = url('storage/' . ltrim($value, "/"));
            }
        });
    }

    /**
     *
     * @param array $data
     * @param array $keys
     *
     * @return void
     */
    public function updateImagePathsRecursive(array &$data, array $keys = ['image']): void
    {
        foreach ($data as $key => &$value) {
            if (is_array($value)) {
                $this->updateImagePathsRecursive($value, $keys);
            } elseif (in_array($key, $keys, true) && !empty($value) && !str_starts_with($value, 'http')) {
                $value = url('storage/' . ltrim($value, '/'));
            }
        }
    }
}
