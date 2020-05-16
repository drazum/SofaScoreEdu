<?php

namespace Routing;

class DefaultRoute extends Route{
    private string $route;
    private array $defaults;
    private array $regex;
    private array $params = [];

    public function __construct(string $route, array $defaults = [], array $regex = []) {
        $this->route = "/" . $route;
        $this->defaults = $defaults;
        $this->regex = $regex;
    }

    public function getParam(string $name, string $default = null): ?string {
        return isset($this->params[$name]) ? $this->params[$name] :
            (isset($this->defaults[$name]) ? $this->defaults[$name] : $default);
    }

    /**
     * @param string $input
     * @return bool
     */
    public function match(string $input): bool {
        $regex = $this->regex;

        $replace = function ($match) use ($regex): string {
            foreach ($match as $m) {
                $par = trim($m, "<>");
                $reg = (isset($regex[$par]) ? $regex[$par] : ".+?");
                return "(?P" . $m . $reg . ")";
            }
        };

        $regexString = preg_replace_callback("@<[a-z0-9_]+>@iu", $replace, $this->route);
        return (bool)preg_match("@^".$regexString."$@uD", $input, $this->params);
    }

    /**
     * @param array $params
     * @return string
     */
    public function generate(array $params = []): string {
        $params = array_merge($this->defaults, $params);

        $replace = function ($match) use ($params): string {
            foreach ($match as $m) {
                $par = trim($m, "<>");
                if(!isset($params[$par])) {
                    throw new \Exception("Missing parameter " . $par);
                }
                return $params[$par];
            }
        };

        return preg_replace_callback("@<[a-z\d_]+>@iu", $replace, $this->route);
    }
}