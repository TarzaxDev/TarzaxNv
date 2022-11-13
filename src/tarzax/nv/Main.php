<?php

namespace tarzax\nv;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;


class Main extends PluginBase implements Listener{

    public function onEnable(): void
    {
        $this->getLogger()->notice("TarzaxNv has been successfully activated");
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->getResource("config.yml");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        $commandname = $command->getName();
        if ($commandname = "nv"){
            if($sender instanceof Player){
                if($sender->getEffects()->has(VanillaEffects::NIGHT_VISION())){
                    $sender->getEffects()->remove(VanillaEffects::NIGHT_VISION());
                    $sender->sendPopup($this->getConfig()->get("NvOff"));
                }else{
                    $effect = new EffectInstance(VanillaEffects::NIGHT_VISION(), 60*100000, 1, false);
                    $sender->getEffects()->add($effect);
                    $sender->sendPopup($this->getConfig()->get("NvOn"));
                }
            }
        }
        return true;
    }
}