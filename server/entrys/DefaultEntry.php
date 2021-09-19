<?php

namespace server\entrys;

use \server\RestEntry;

/**
 * Description of DefaultEntry
 *
 * @author sascha
 */
class DefaultEntry extends RestEntry {

    private function getEntrys(string $path = ""): array {
        $dir = dir(__DIR__ . "/" . $path);
        $rc = [];
        
        $uri = $_SERVER["REQUEST_URI"];
        
        // truncate GET parameter
        if (($pos = strpos($uri, "?")) !== false) {
            $uri = substr($uri, 0, $pos);
        }
        
        // truncate .php file
        if (endsWith($uri, ".php")) {
            $uri =  dirname($uri);
        }
        
        while ($file = $dir->read()) {
            if ($file[0] === '.' || in_array($file, ["DefaultEntry.php", "Error404Entry.php"])) {
                continue;
            }
            if (is_dir(__DIR__.$path."/".$file)) {
                $rc = array_merge($rc, $this->getEntrys($path . "/" . $file));
            } else {
                if (endsWith($file, "Entry.php")) {
                    $rc[] = $_SERVER["REQUEST_SCHEME"]."://".$_SERVER["HTTP_HOST"] .$uri. $path.substr($file, 0, -9);
                }
            }
        }
        return $rc;
    }

    protected function onGet(): array {
        return [
            "ENTRYS" => $this->getEntrys(),
        ];
    }

}
