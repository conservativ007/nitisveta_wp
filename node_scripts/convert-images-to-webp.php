<?php

if (PHP_SAPI !== 'cli') {
    fwrite(STDERR, "Run this script from CLI.\n");
    exit(1);
}

$scriptDir = __DIR__;
$defaultRoots = [
    realpath($scriptDir . '/../theme/images') ?: $scriptDir . '/../theme/images',
    realpath($scriptDir . '/../../../uploads') ?: $scriptDir . '/../../../uploads',
];

$roots = [];
$quality = 82;
$force = in_array('--force', $argv, true);
$dryRun = in_array('--dry-run', $argv, true);

foreach (array_slice($argv, 1) as $arg) {
    if ($arg === '--force' || $arg === '--dry-run') {
        continue;
    }

    if (strpos($arg, '--quality=') === 0) {
        $quality = (int) substr($arg, strlen('--quality='));
        continue;
    }

    $roots[] = $arg;
}

if (!$roots) {
    $roots = $defaultRoots;
}

if ($quality < 1 || $quality > 100) {
    fwrite(STDERR, "Quality must be between 1 and 100.\n");
    exit(1);
}

if (!$dryRun && !function_exists('imagewebp')) {
    fwrite(STDERR, "PHP GD with WebP support is required.\n");
    exit(1);
}

$extensions = ['jpg', 'jpeg', 'png'];
$converted = 0;
$skipped = 0;
$missing = 0;

foreach ($roots as $root) {
    $rootPath = realpath($root);
    if (!$rootPath || !is_dir($rootPath)) {
        fwrite(STDERR, "Directory not found, skipped: {$root}\n");
        $missing++;
        continue;
    }

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($rootPath, FilesystemIterator::SKIP_DOTS)
    );

    foreach ($iterator as $file) {
        if (!$file->isFile()) {
            continue;
        }

        $extension = strtolower($file->getExtension());
        if (!in_array($extension, $extensions, true)) {
            continue;
        }

        $source = $file->getPathname();
        $output = preg_replace('/\.(jpe?g|png)$/i', '.webp', $source);

        if (!$force && file_exists($output) && filemtime($output) >= filemtime($source)) {
            $skipped++;
            continue;
        }

        if ($dryRun) {
            $converted++;
            echo "would convert {$source} -> {$output}\n";
            continue;
        }

        $image = null;
        if ($extension === 'jpg' || $extension === 'jpeg') {
            $image = imagecreatefromjpeg($source);
        }

        if ($extension === 'png') {
            $image = imagecreatefrompng($source);
            if ($image) {
                imagepalettetotruecolor($image);
                imagealphablending($image, true);
                imagesavealpha($image, true);
            }
        }

        if (!$image) {
            fwrite(STDERR, "Failed to read: {$source}\n");
            continue;
        }

        if (!imagewebp($image, $output, $quality)) {
            fwrite(STDERR, "Failed to write: {$output}\n");
            imagedestroy($image);
            continue;
        }

        imagedestroy($image);
        $converted++;
        echo "converted {$source} -> {$output}\n";
    }
}

$action = $dryRun ? 'Would convert' : 'Converted';
echo "Done. {$action}: {$converted}. Skipped: {$skipped}. Missing roots: {$missing}.\n";
