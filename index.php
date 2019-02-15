<?php

$dir = __DIR__;

$sourcePath = "{$dir}\\img\\mason-jars.jpg";
$outputPath = "{$dir}\\img\\mason-jars-c.jpg";

$imageSize = getimagesize($sourcePath);

$width = $imageSize[0];
$height = $imageSize[1];

echo exec("{$dir}\\lib\\ffmpeg-20190214-f1f66df-win64-static\\bin\\ffmpeg.exe -y -i {$sourcePath} -vf scale=w={$width}:h={$height}:force_original_aspect_ratio=decrease {$outputPath}");
