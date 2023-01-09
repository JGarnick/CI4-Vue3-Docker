<?php

if (! function_exists('fetched')) {
    function fetched(string $name_of_model): string
    {
       return sprintf('%s fetched successfully', $name_of_model);
    }
}
if (! function_exists('created')) {
    function created(string $name_of_model): string
    {
       return sprintf('%s created successfully', $name_of_model);
    }
}
if (! function_exists('deleted')) {
    function deleted(string $name_of_model): string
    {
       return sprintf('%s deleted successfully', $name_of_model);
    }
}
if (! function_exists('updated')) {
    function updated(string $name_of_model): string
    {
       return sprintf('%s updated successfully', $name_of_model);
    }
}