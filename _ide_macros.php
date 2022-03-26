<?php

namespace Illuminate\Routing {
    class Router {
        public static function inertia($uri, $component, $props = array (
)) {

        }
    }
}

namespace Illuminate\Http {
    class Request {
        public static function validate(array $rules, ...$params) {

        }
        public static function validateWithBag(string $errorBag, array $rules, ...$params) {

        }
        public static function hasValidSignature($absolute = true) {

        }
        public static function hasValidRelativeSignature() {

        }
        public static function hasValidSignatureWhileIgnoring($ignoreQuery = array (
), $absolute = true) {

        }
        public static function inertia() {

        }
    }
}

namespace Illuminate\Testing {
    class TestResponse {
        public static function assertInertia(?Closure $callback = NULL) {

        }
        public static function inertiaPage() {

        }
    }
}
