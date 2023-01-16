<?php namespace Dimsog\Blocks\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Blocks Backend Controller
 */
class Blocks extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
    ];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Dimsog.Blocks', 'blocks', 'blocks');
    }
}
