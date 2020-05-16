<?php

namespace Routing;

interface IRoute{
    public function match(string $input): bool;
    public function generate(array $params = []): string;
    public static function register(string $name, Route $route): void;
    public function getParam(string $name): ?string;
    public static function get(string $name = null);
}
