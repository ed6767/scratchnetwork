<?php
//STANDALONE FILE - used to export user files :)
if (!isset($_SESSION['username'])) {
    echo 'Please login.';
    die();
}
if (isset($_GET['sessiondump'])) {
    echo json_encode($_SESSION);
    die();
}
if (isset($_GET['userpackage'])) {

 $rootPath = realpath('users/'. $_SESSION['username']);

// Initialize archive object
$zip = new ZipArchive();
    $filename = 'lib/assets/SN'.$_SESSION['username'].'.zip';
$zip->open($filename, ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}

// Zip archive will be created only after closing object
$zip->close();
echo 'Created your download package. <a href="index.php">Click to return</a> (don\'t press back, that restarts the download.) <meta http-equiv="refresh" content="0; url='. $filename .'" />
';
    die();
}
?>
