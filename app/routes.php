<?php

return [
    '~^link/(\w+)$~' => [\App\Controllers\MainController::class, 'link'],
    '~^$~' => [\App\Controllers\MainController::class, 'main'],
    '~^get_link/$~' => [\App\Controllers\MainController::class, 'getLink'],
];
