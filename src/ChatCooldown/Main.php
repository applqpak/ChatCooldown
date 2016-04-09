<?php

  namespace ChatCooldown;

  use pocketmine\plugin\PluginBase;
  use pocketmine\event\Listener;
  use pocketmine\event\player\PlayerChatEvent;
  use pocketmine\utils\TextFormat as TF;
  use pocketmine\utils\Config;

  class Main extends PluginBase implements Listener
  {

    private $cooldown = array();

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

      $this->cfg = new Config($this->dataPath() . "config.yml", Config::YAML, array("cooldown" => 5, "cooldown_message" => "Woah, Do not chat so quickly {name}! You may chat in {time} more second(s)."));

    }

    public function onChat(PlayerChatEvent $event)
    {

      $player = $event->getPlayer();

      $player_name = $player->getName();

      $cooldown = $this->cfg->get("cooldown");

      $cooldown_message = $this->cfg->get("cooldown_message");

      if(isset($this->cooldown[$player_name]))
      {

        $last_chat_time = $this->cooldown[$player_name];

        if((time() - $last_chat_time) <= $cooldown)
        {

          $timeDifference = (time() - $last_chat_time);

          $player->sendMessage(str_replace(array("{name}", "{time}"), array($player_name, $timeDifference), $cooldown_message));

          $event->setCancelled();

        }

      }
      else
      {

        $this->cooldown[$player_name] = time();

      }

    }

  }

?>
