<?php
/**
 * Created by PhpStorm.
 * User: igatea
 * Date: 17/11/28
 * Time: 14:53
 */

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