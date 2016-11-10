<?php
/**
 * Created by PhpStorm.
 * User: SuperMason
 * Date: 2016/3/29
 * Time: 16:18
 */

return [
    'title' => '异常列表',
    'table' => [
        'header' => [
            'device' => '设备名称',
            'systemVersion' => '系统版本',
            'occurDate' => '发生时间',
        ],
        'tableRow' => [
            'empty' => '暂时没有任何异常信息',
            'show' => '详情',

        ],
        'pagination' => '每页显示@条，共#条异常信息',
    ],
    'newException' => [
        'title' => '数据测试',
        'device' => '设备型号',
        'system_version' => '系统版本',
        'exp_title' => '异常标题',
        'exception' => '异常信息'
    ],
    'reg' => [
        'validation_code_tip' => '验证码：:code，3分钟内有效，请妥善保管！【全民篮球联赛】',
        'cd_not_over' => '距离下一次获取验证码还需等待:leftSec秒'
    ],

    'statistic' => [
        'notFount' => '您查找的统计数据不存在!',
        'head' => [
            'suffix' => '技术统计'
        ]
    ],

    'log' => [
        'update_player' => '成功修改了编号为[:id]的球员信息',
        'delete_player' => '成功删除了编号为[:id]的球员信息',
        'delete_team' => '成功删除了编号为[:id]球队的相关数据',
    ]
];