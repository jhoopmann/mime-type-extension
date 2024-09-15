<?php

namespace Jhoopmann\MimeTypeExtension;

use InvalidArgumentException;

class ApacheParser
{
    protected array $mimeTypes = [];

    public function __construct(string $mimeTypeFile)
    {
        $this->importMimeTypes($mimeTypeFile);
    }

    public function getExtension(string $mimeType): string
    {
        return $this->mimeTypes[$mimeType] ??
            explode('/', $mimeType)[1] ??
            $mimeType;
    }

    protected function importMimeTypes(string $mimeTypeFile): void
    {
        if (!file_exists($mimeTypeFile)) {
            throw new InvalidArgumentException(sprintf('File %s does not exist', $mimeTypeFile));
        }

        $file = fopen($mimeTypeFile, 'r');
        if ($file === false) {
            throw new InvalidArgumentException(sprintf('File %s is not readable', $mimeTypeFile));
        }

        while (!feof($file)) {
            $line = fgets($file);
            $parts = preg_split('/\s+/', trim($line));
            if (count($parts) > 1 && !str_starts_with($line, '#')) {
                $this->mimeTypes[$parts[0]] = $parts[array_key_last($parts)];
            }
        }

        fclose($file);
    }
}