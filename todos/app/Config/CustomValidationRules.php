<?php 

namespace Config;

class CustomValidationRules {
    public function inrange($value, ?string &$error = null): bool {
        if(! in_array($value, range(1, 4))) {
            $error = "Todo Priority must be from 1 to 4 - 1 being the most important.";

            return false;
        }
        return true;
    }
}