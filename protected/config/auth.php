<?php
/**
 * Created by PhpStorm.
 * User: lokirew
 * Date: 04.06.15
 * Time: 1:29
 */

return array(
    'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'guest',
        'bizRule' => null,
        'data' => null
    ),
    'user' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'user',
        'children' => array(
            'guest',
        ),
        'bizRule' => null,
        'data' => null
    ),
    'admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'admin',
        'children' => array(
            'user',
        ),
        'bizRule' => null,
        'data' => null
    ),
);