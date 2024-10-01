<?php
// config.php

if (getenv('DOCUMENT_ROOT')) {
    $_SERVER['DOCUMENT_ROOT'] = getenv('DOCUMENT_ROOT');
} else {
    $_SERVER['DOCUMENT_ROOT'] = __DIR__;
}
