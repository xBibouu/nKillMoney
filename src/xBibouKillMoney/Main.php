<?php

namespace xBibouKillMoney;

use pocketmine\plugin\PluginBase;
use xBibouKillMoney\Listeners\KillListeners;

class Main extends PluginBase{

    public static Main $instance;

    public function onEnable(): void
    {
        self::$instance = $this;
        $this->getServer()->getPluginManager()->registerEvents(new KillListeners(),$this);
        $this->saveDefaultConfig();
    }
    public static function getInstance(): Main
    {
        return self::$instance;
    }
}