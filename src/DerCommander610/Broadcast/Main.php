<?php

namespace DerCommander610\Broadcast;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use jojoe77777\FormAPI;

class Main extends PluginBase implements Listener{

    public function onEnable(): void {

    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{

        switch($command->getName()){
            case "broadcast":
             if($sender->hasPermission("broadcast.cmd")){
                if($sender instanceof Player){
                    $this->broadcast($sender);
                }
             } else {
                $sender->sendMessage("§cDu hast keine rechte dazu!");
             }
        }
    return true;
    }

    public function broadcast($player){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createCustomForm(function (Player $player, array $data = null));
            if($data === null){
                return true;
            }
            if($data[0] == null){
                $player->sendMessage("§cDu musst eine nachricht schreiben um alle eine nachricht zu senden!");
                return true;
            }
            if($data[1] == true) {
                $this->getServer()->broadcastMessage("§6Server>> §a$data[0]");
                return true;
            }
            if($data[2] == true){
                $this->getServer()->broadcastMessage("§6Server>> §b$data[0]");
                return true;
            }
            if($data[3] == true){
                $this->getServer()->broadcastMessage("§6Server>> §c$data[0]");
                return true;
            }
            if($data[4] == true){
                $this->getServer()->broadcastMessage("§6Server>> §e$data[0]");
                return true;
            }
            $this->getServer()->broadcastMessage("§6Server>> $data[0]");
        });
        $form->setTitle("§6Broadcast §eGUI");
        $form->addInput("§a>> §bSchreibe eine nachricht hier rein");
        $form->addToggle("§aGrün", false);
        $form->addToggle("§bBlau", false);
        $form->addToggle("§cRot",false);
        $form->addToggle("§eGelb", false);
        $form->sendToPlayer($player);
        return $form;
    }

}
