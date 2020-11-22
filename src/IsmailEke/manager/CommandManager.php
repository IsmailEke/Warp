<?php

namespace IsmailEke\manager;

use IsmailEke\command\WarpCommand;
use pocketmine\Server;

class CommandManager
{
	
	/**
	 * @return void
	*/
	
	public static function register () : void
	{
		foreach (self::getCommand() as $cmdName => $cmdFile) {
			Server::getInstance()->getCommandMap()->register($cmdName, $cmdFile);
		}
	}
	
	/**
	 * @return array
	*/
	
	public static function getCommand () : array
	{
		return [
		"warp" => new WarpCommand()
		];
	}
	
	/**
	 * @return array
	*/
	
	public static function getCommandName () : array
	{
		$commandName = [];
		foreach (self::getCommand() as $cmdName => $cmdFile) {
			$commandName[] = $cmdName;
		}
		return $commandName;
	}
	
	/**
	 * @return int
	*/
	
	public static function getCommandCount () : int
	{
		return count(self::getCommandName());
	}
}
?>