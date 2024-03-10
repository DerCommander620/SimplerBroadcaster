<?php

namespace DerCommander610\Broadcast;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use DerCommander610\FormAPI\CustomForm;

class Main extends PluginBase implements Listener {

    public function onEnable(): void {
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->getResource("config.yml");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{

        switch($command->getName()){
            case "broadcast":
             if($sender->hasPermission("broadcast.cmd")){
                if($sender instanceof Player){
                    $this->broadcast($sender);
                }
             } else {
                $sender->sendMessage("§cYou have not permission to use this command!!");
             }
        }
    return true;
    }

    public function broadcast($player){
        $form = new CustomForm(function (Player $player, array $data = null){
            if(!isset($data)){
                return true;
            }
            if(!isset($data[0])){
                $player->sendMessage("§cYou need to write a Message to send it to all Players!");
                return true;
            }
            if($data[1] == "§aGreen") {
                $this->getServer()->broadcastMessage("§6Server>> §a" . $data[0]);
                return true;
            }
            if($data[1] == "§bBlue"){
                $this->getServer()->broadcastMessage("§6Server>> §b" . $data[0]);
                return true;
            }
            if($data[1] == "§cRed"){
                $this->getServer()->broadcastMessage("§6Server>> §c" . $data[0]);
                return true;
            }
            if($data[1] == "§eYellow"){
                $this->getServer()->broadcastMessage("§6Server>> §e" . $data[0]);
                return true;
            }
            if($data[1) == "§6Orange"){
                $this->getServer()->broadcastMessage("§6Server>> §6" . $data[0]);
                return true;
            }
            if(!isset($data[1])){
                $this->getServer()->broadcastMessage("§6Server>> §f" . §data[0])
            }
        });
        $form->setTitle($this->getConfig()->get("title"));
        $form->addInput("§a>> §bWrite a Message!");
        $form->addDropDown("§aTake an Color Option!", ["§aGreen", "§bBlue", "§cRed", "§eYellow", "§6Orange"])
        $form->sendToPlayer($player);
        return $form;
    }

}
