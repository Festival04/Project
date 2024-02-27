<?php
// 02.2024 Artur Z (HUSKI3@GitHub)

class NoPHP {
    private $host;
    public function __construct($host){
        $this->host = $host;
    }

    public function new_resource($url) {
        return new Resource("http://" . $this->host . "/" . $url);
    }

    public function snappy($route, $MIXINS=[]) {
        return function () use ($route, $MIXINS) {
            $page = new Page("AUTO", "AUTO", $this->new_resource($route));
            return $page->render($MIXINS);
        };
    }
}

class Mixin {
    protected $affects;
    private $_can_affect = ["body", "head", "header"];

    public function __construct() {
        assert($this->_can_affect.contains($this->affects));
    }

    protected function _body($dom, $body) {}
    protected function _head($dom, $head) {}
    protected function _headers($dom, $headers) {} // IDK

    private function _manipulate_head($dom) {
        $head = $dom->getElementsByTagName('head')->item(0);
        if (!$head) {
            $head = $dom->createElement('head');
            $dom->documentElement->insertBefore($head, $dom->documentElement->firstChild);
        }
        $this->_head($dom, $head);
    }

    public function mutate($base) {
        $dom = new DomDocument();
        $dom->strictErrorChecking = false; // Because HTML can be broken...
        @$dom->loadHTML($base);

        switch ($this->affects) {
            case "head":
                $this->_manipulate_head($dom); // Maybe we need to overwrite dom?
                break;
            default:;
        }
        return $dom->saveHTML();
    }
}

class Resource {
    private $url;
    public function __construct($url) {
        $this->url = $url;
    }
    public function getURL() { return $this->url; }
}

class Rendereable {
    private $resource = null;
    public function __construct($resource) {
        $this->resource = $resource;
    }

    protected function mutate($base, $modifiers) {
        foreach ($modifiers as $modifier) {
            $base = $modifier->mutate($base);
        }
        return $base;
    }

    /**
     * @param string $METHOD - Method name, e.g. GET, POST
     * @param array $DATA - Data to be sent, e.g. [ "foo" => "bar" ]
     */
    protected function _fetch($METHOD, $DATA) {

        // use key 'http' even if you send the request to https://...
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => $METHOD,
                'content' => http_build_query($DATA),
            ],
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($this->resource->getURL(), false, $context);
        if ($result === false) {
            throw new \RuntimeException("NoPHP failed to contact the server. The request has failed.");
        }

        return $result;
    }

    /**
     * @param array $MIXINS
     * 
     * The render method calls _fetch safely and returns 
     * the result. This function can raise a RuntimeException
     * 
     * By default, the result will NOT be mutated by the mixins.
     * Override this method to do otherwise.
     */
    public function render($MIXINS) {
        // TODO: safely display the resource contents?
        return $this->_fetch("GET", []);
    }
}

class Page extends Rendereable {
    public $title;
    public $description;
    private $view;

    public function __construct($title, $description, $resource, $view=null) {
        $this->title = $title;
        $this->description = $description;
        $this->view = $view; // View is not part of the NoPHP renderable, therefore we keep it in the page
        parent::__construct($resource);
    }
    
    public function render($MIXINS = []) {
        if (isset($this->view)) {
            $result = $this->view;
        } else {
            try {
                $result = $this->_fetch("GET", []);
            } catch (\Exception $e) {
                $result = "Failed to fetch from NoPHP server. Is it running?";
            }
        }
        return $this->mutate($result, $MIXINS);
    }

    public static function from_view($view) {
        # Make this safe mb
        $page = new Page("_VIEW_", "_VIEW_", null, $view);
        return $page;
    }
}

?>