<?php

if (! function_exists('fetched')) {
    function fetched(string $name_of_model): string
    {
       return sprintf('%s fetched successfully', $name_of_model);
    }
}