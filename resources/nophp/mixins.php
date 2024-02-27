<?php
// 02.2024 Artur Z (HUSKI3@GitHub)

include_once "core.php";

class TailwindMixin extends Mixin {
    // This class only modifies the head
    protected $affects = "head";
    
    protected function _head($dom, $head) {
        $CSS = file_get_contents( __DIR__ . "/../css/tailwind.css");

        // Create a new style element
        $styleElement = $dom->createElement('style');
        $styleElement->setAttribute('type', 'text/css');
        
        $cssContent = $dom->createTextNode($CSS);
        $styleElement->appendChild($cssContent);

        $head->appendChild($styleElement);
    }
}