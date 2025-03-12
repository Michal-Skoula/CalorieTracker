<?php

namespace App\Traits;

trait EnumToArray
{
    public static function valuesToArray(): array
	{
		return array_column(self::cases(),'value');
	}

	public static function keysToArray(): array
	{
		return array_column(self::cases(),'name');
	}
	public static function toAssociativeArray(): array
	{
		return self::cases();
	}
}
