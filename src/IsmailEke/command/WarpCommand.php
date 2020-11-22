<?php

namespace IsmailEke\command;

use IsmailEke\Warp;
use IsmailEke\form\WarpForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\MainLogger;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class WarpCommand extends Command
{
	
	public function __construct ()
	{
		parent::__construct("warp", "Warp Command", "/warp");
	}
	
	/**
	 * @param CommandSender $sender
	 * @param string $commandLabel
	 * @param array $args
	*/
	
	public function execute (CommandSender $sender, string $commandLabel, array $args)
	{
		if ($sender instanceof Player) {
			if (empty($args[0])) {
				if (empty($args[1])) {
					$sender->sendForm(new WarpForm());
				}
			} else {
				if ($sender->isOp()) {
					if ($args[0] === "create") {
						if (!empty($args[1])) {
							$warps = [];
					  foreach (Warp::$warpConfig->get("Warps") as $key => $value) {
						$warps[] = $key;
					}
					$array_search = array_search($args[1], $warps);
							if ($array_search !== false) {
								$sender->sendMessage(TextFormat::RED."Such a place name is used.");
					  } else {
						  Warp::$warpConfig->setNested("Warps.".$args[1], [
						  "PositionX" => $sender->getX(),
						  "PositionY" => $sender->getY(),
						  "PositionZ" => $sender->getZ(),
						  "Level_Name" => $sender->getLevel()->getName()
						  ]);
						  Warp::$warpConfig->save();
						  $sender->sendMessage(TextFormat::GREEN."The location has been saved.");
					  }
						} else {
							$sender->sendMessage(TextFormat::RED."Usage: /warp <create-remove> <warpName>");
						}
				 } elseif ($args[0] === "remove") {
				 	 if (!empty($args[1])) {
				 	 	 $warps = [];
					  foreach (Warp::$warpConfig->get("Warps") as $key => $value) {
						$warps[] = $key;
					}
					$array_search = array_search($args[1], $warps);
					if($array_search !== false) {
						Warp::$warpConfig->removeNested("Warps.".$args[1]);
						$sender->sendMessage(TextFormat::GREEN."".$args[1]." §alocation successfully deleted.");
					} else {
						$sender->sendMessage(TextFormat::RED."No such place name was found.");
					}
				  } else {
				  	$sender->sendMessage(TextFormat::RED."Usage: /warp <create-remove> <warpName>");
				  }
				 } else {
					 $sender->sendMessage(TextFormat::RED."Usage: /warp <create-remove> <warpName>");
				 }
				}
			}
		} else {
			MainLogger::getLogger()->error("Please Use This Command In-Game!");
		}
	}
}
?>