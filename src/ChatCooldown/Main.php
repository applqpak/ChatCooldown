<?php

  namespace ChatCooldown;

  use pocketmine\plugin\PluginBase;
  use pocketmine\event\Listener;
  use pocketmine\event\player\PlayerChatEvent;
  use pocketmine\utils\TextFormat as TF;
  use pocketmine\utils\Config;

  class Main extends PluginBase implements Listener
  {

    public function dataPath()
    {

      return $this->getDataFolder();

    }

    public function server()
    {

      return $this->getServer();

    }

    public function onEnable()
    {

      @mkdir($this->dataPath());

      $this->cfg = new Config($this->dataPath() . "config.yml", Config::YAML, array("cooldown" => 5));

    }

    public function onChat(PlayerChatEvent $event)
    {

    }

  }

?>
