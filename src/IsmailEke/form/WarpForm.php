<?php

namespace IsmailEke\form;

use IsmailEke\Warp;
use pocketmine\form\Form;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use pocketmine\level\Level;
use pocketmine\level\Position;

class WarpForm implements Form
{
	
	/** @var array */
	
	public $warpData = [];
	
	/**
	 * @return array
	*/
	
	public function jsonSerialize () : array
	{
		$warps = [];
		foreach (Warp::$warpConfig->get("Warps") as $key => $value) {
			$warps[] = $key;
		}
		$form = [];
		$form["type"] = "form";
		$form["title"] = "Warp";
		$form["content"] = "With This Menu You Can Go Anywhere You Want.";
		$form["buttons"] = [];
		for ($i = 0;$i < count($warps);$i++) {
			$form["buttons"][] = ["text" => $warps[$i]];
			$this->warpData[] = $warps[$i];
		}
		return $form;
	}
	
	/**
	 * @param Player $player
	 * @param $data
	 * @return void
	*/
	
	public function handleResponse (Player $player, $data) : void
	{
		if (is_null($data)) {
			return;
		}
		$x = (int) Warp::$warpConfig->get("Warps")[$this->warpData[$data]]["PositionX"];
		$y = (int) Warp::$warpConfig->get("Warps")[$this->warpData[$data]]["PositionY"];
		$z = (int) Warp::$warpConfig->get("Warps")[$this->warpData[$data]]["PositionZ"];
		$level_name = Server::getInstance()->getLevelByName((string) Warp::$warpConfig->get("Warps")[$this->warpData[$data]]["Level_Name"]);
		$player->teleport(new Position($x, $y, $z, $level_name));
		$player->sendMessage(TextFormat::GREEN."You teleported to ".$this->warpData[$data]."§a.");
	}
}
?>