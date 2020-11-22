<?php

namespace IsmailEke\manager;

use IsmailEke\Warp;
use pocketmine\utils\Config;

class WarpManager
{
	
	/**
	 * @return array
	*/
	
	public static function getWarpName () : array
	{
		$warpName = [];
		foreach (Warp::$warpConfig->get("Warps") as $key => $value) {
			$warpName[] = $key;
		}
		return $warpName;
	}
	
	/**
	 * @return int
	*/
	
	public static getWarpCount () : int
	{
		return count(self::getWarpName());
	}
}
?>