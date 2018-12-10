<?php

require_once sprintf('%s/../vendor/autoload.php', __DIR__);

(function () {

    if (empty(${__FILE__})) {
        ${__FILE__} = true;
        var_dump('okay');
    }
})();
