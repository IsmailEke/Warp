<?php

/*
*
* Warp Plugin
*
* Author: IsmailEke (İsmail Eke)
* GitHub: IsmailEke
* Poggit: IsmailEke
* YouTube: İsmail Eke
* Discord: IsmailEke#0236
* Instagram: _ismail.eke
* Messenger: İsmail Lnd
*
*/

namespace IsmailEke;

use IsmailEke\manager\CommandManager;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\MainLogger;
use pocketmine\utils\Config;

class Warp extends PluginBase
{
	
	/** @var Config */
	
	public static $warpConfig;
	
	public function onEnable ()
	{
		MainLogger::getLogger()->notice("Warp Plugin Online");
		CommandManager::register();
		if (file_exists($this->getDataFolder() ."warp.yml")) {
		    self::$warpConfig = new Config($this->getDataFolder() . "warp.yml", Config::YAML);
		} else {
		    @mkdir($this->getDataFolder());
		    self::$warpConfig = new Config($this->getDataFolder() . "warp.yml", Config::YAML);
		    self::$warpConfig->set("Warps", []);
		    self::$warpConfig->save();
		}
    }
	
	public function onDisable ()
	{
		MainLogger::getLogger()->alert("Warp Plugin Offline");
	}
}
?>
