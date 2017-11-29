<?php
namespace Tests\TestUtils;

class SetupDirectory
{
    /**
     * Clean storage/uploads directory.
     */
    public static function cleanUploads()
    {
        $files = glob(storage_path('uploads/*'));
        array_map('unlink', $files);
    }
}