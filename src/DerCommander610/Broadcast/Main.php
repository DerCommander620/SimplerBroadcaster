<?php

namespace DerCommander610\Broadcast;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use jojoe77777\FormAPI;

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
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createCustomForm(function (Player $player, array $data = null){
            if($data === null){
                return true;
            }
            if($data[0] == null){
                $player->sendMessage("§cYou need to write a Message to send it to all Players!");
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
            $this->getServer()->broadcastMessage("§6Server>> ");
        });
        $form->setTitle($this->getConfig()->get("title"));
        $form->addInput("§a>> §bWrite a Message!");
        $form->addToggle("§aGreen", false);
        $form->addToggle("§bBlue", false);
        $form->addToggle("§cRed", false);
        $form->addToggle("§eYellow", false);
        $form->sendToPlayer($player);
        return $form;
    }

}
