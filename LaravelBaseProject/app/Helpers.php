<?php
function hashed($filePath) {

    try {
        $outcome = $filePath;

        if (env("HASHING_ENABLED")) {
            $filename = basename($filePath);
            $dirPath = dirname($filePath);

            $path = public_path($dirPath . '/hashed.json');

            if (file_exists($path)) {
                $manifest = json_decode(file_get_contents($path), true);
            }


            if (isset($manifest[$filename])) {
                $outcome = $dirPath . "/" . $manifest[$filename];
            }
        }

        return $outcome;

    } catch (Exception $e) {
        report($e);
        return $filePath;
    }

}