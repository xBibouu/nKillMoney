<?php

namespace xBibouKillMoney\Listeners;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use onebone\economyapi\EconomyAPI;
use pocketmine\player\Player;
use xBibouKillMoney\Main;

class KillListeners implements Listener
{
    public function onDeath(PlayerDeathEvent $event): void
    {
        $player = $event->getEntity();
        $cause = $player->getLastDamageCause();
        if ($cause instanceof EntityDamageByEntityEvent) {
            $sender = $cause->getDamager();
            if ($sender instanceof Player) {
                $money = Main::getInstance()->getConfig()->get("money");
                EconomyAPI::getInstance()->addMoney($sender, $money);
                $sender->sendPopup(str_replace("{money}",$money,Main::getInstance()->getConfig()->get("message")));
            }
        }
    }
}