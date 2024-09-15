# MimeType Extension

## ApacheParser

Parses Apache2 ```mime.types``` file to determine file name extension for specific mime-type.

## Usage

```
$mimeTypes = new ApacheParser(MIME_TYPES_PATH);
$extensionM4v = $mimeTypes->getExtension('video/mp4');
```