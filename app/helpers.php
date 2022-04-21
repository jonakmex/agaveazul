<?php

function catchErrors($errors, $errorBag)
{
    foreach ($errors as $error) {
        foreach ($error as $field => $message) {
            $errorBag->add($field, __("messages.$message"));
        }
    }
}
