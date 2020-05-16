<?php

namespace View;

/**
 * Class View
 * Templating system syntax
 * Supports:
 *          {{variable}}                    =>      $variable
 *          {{object.property}}             =>      $object->property
 *          {{object:method}}               =>      $object->method()
 *          {%:{{iterate}}
 *              {{variable}}
 *              or something static         =>      for($i=0;$i<iterate;$i++)
 *          %}
 *
 * @package View
 */
class View {
    private const OBJECT_REGEX = "@{{(?P<object>[\w_-]+)" . "(?P<punct>[:.]?)" . "(?P<prop>[\w_-]*)}}@";
    private const ITERATE_REGEX = "@{%(?P<number>[\d]+)(?P<html>[^%]*)%}@";
    private const GET_ITERATE_NUM = "@:{{(?P<number>[\w_-]+)}}:@";

    private string $templatePath;
    protected array $params;

    public function __construct(string $templateName) {
        $this->templatePath = __DIR__ . "/../Templates/" . $templateName . ".html";
        $this->params = [];
    }

    public function outputHTML(): void {
        echo $this->HTML();
    }

    /**
     * Radi se zamjena meta jezika za htmlß
     *
     * @return string
     */
    private function HTML(): string {

        if(!is_readable($this->templatePath)) {
            throw new  \Exception("Problem with reading file: " . $this->templatePath);
        }

        $file = file_get_contents($this->templatePath);

        $objectReplace = function ($match) {

            if(!isset( $this->params[$match["object"]] )) {
                throw new \Exception("Parameter " . $match["object"] . " missing");
            }
            $object = $this->params[$match["object"]];

            if(empty($match["punct"]) || empty($match["prop"])){
                return $object;
            }
            $prop = $match["prop"];

            if($match["punct"] === ".") {
                return (new $object())->$prop;
            } else if ($match["punct"] === ":") {
                return (new $object())->$prop();
            }
            return $object;
        };

        $iterateNumberReplace = function ($match) {
            return $this->params[$match["number"]];
        };

        $iterateReplace = function ($match) {
            $iterationNumber = intval($match["number"]);
            $html = "";
            for ($i=0;$i<$iterationNumber;$i++){
                $s = preg_replace("@{{([\w_]+)}}@", "{{" . "$1_" . $i . "}}", $match["html"]);
                $html .= $s;
            }
            return $html;
        };

        $html = preg_replace_callback(self::GET_ITERATE_NUM, $iterateNumberReplace, $file);
        $html = preg_replace_callback(self::ITERATE_REGEX, $iterateReplace, $html);
        $html = preg_replace_callback(self::OBJECT_REGEX, $objectReplace, $html);

        return $html;
    }

    public function addParam(string $key, $value): void {
        $this->params[$key] = $value;
    }
}