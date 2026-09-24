<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Log\Handlers\FileHandler;
use CodeIgniter\Log\Handlers\HandlerInterface;

class Logger extends BaseConfig
{
    
    public $threshold = (ENVIRONMENT === 'production') ? 4 : 9;

    
    public string $dateFormat = 'Y-m-d H:i:s';

    
    public array $handlers = [
        
        FileHandler::class => [
            // The log levels that this handler will handle.
            'handles' => [
                'critical',
                'alert',
                'emergency',
                'debug',
                'error',
                'info',
                'notice',
                'warning',
            ],

            
            'fileExtension' => '',

            
            'filePermissions' => 0644,

            
            'path' => '',
        ],

        
        // 'CodeIgniter\Log\Handlers\ChromeLoggerHandler' => [
        //     
        //     'handles' => ['critical', 'alert', 'emergency', 'debug',
        //                   'error', 'info', 'notice', 'warning'],
        // ],

        
        // 'CodeIgniter\Log\Handlers\ErrorlogHandler' => [
        //     
        //     'handles' => ['critical', 'alert', 'emergency', 'debug', 'error', 'info', 'notice', 'warning'],
        //
        //     
        //     'messageType' => 0,
        // ],
    ];
}
