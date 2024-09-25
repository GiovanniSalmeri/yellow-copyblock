<?php
// Copyblock extension, https://github.com/GiovanniSalmeri/yellow-copyblock

class YellowCopyblock {
    const VERSION = "0.9.1";
    const PRIORITY = "1000";
    public $yellow;         //access to API

    // Handle initialisation
    public function onLoad($yellow) {
        $this->yellow = $yellow;
        $this->yellow->language->setDefaults(array(
            "Language: it",
            "CopyblockButton: Copia il codice sorgente",
            "Language: fr",
            "CopyblockButton: Copier le code source",
            "Language: es",
            "CopyblockButton: Copiar código fuente",
            "Language: nl",
            "CopyblockButton: Broncode kopiëren",
            "Language: pt",
            "CopyblockButton: Copiar código fonte",
            "Language: en",
            "CopyblockButton: Copy source code",
            "Language: de",
            "CopyblockButton: Quelltext kopieren",
            "Language: sv",
            "CopyblockButton: Kopiera källkod"
        ));
    }

    // Handle page extra data
    public function onParsePageExtra($page, $name) {
        $output = null;
        if ($name=="header") {
            $assetLocation = $this->yellow->system->get("coreServerBase").$this->yellow->system->get("coreAssetLocation");
            $output .= "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"{$assetLocation}copyblock.css\" />\n";
            $output .= "<script type=\"text/javascript\" defer=\"defer\" src=\"{$assetLocation}copyblock.js\"></script>\n";
            $output .= "<script type=\"text/javascript\">\n";
            $output .= "// <![CDATA[\n";
            $output .= "var yellow = yellow || {};\n";
            $output .= "yellow.copyblock = ".json_encode($this->yellow->language->getSettings("copyblock", "",$page->get("language"))).";\n";
            $output .= "// ]]>\n";
            $output .= "</script>\n";
        }
        return $output;
    }
}
