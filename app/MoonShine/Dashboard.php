<?php

namespace App\MoonShine;

use MoonShine\Dashboard\DashboardBlock;
use MoonShine\Dashboard\DashboardScreen;
use MoonShine\Dashboard\TextBlock;

class Dashboard extends DashboardScreen
{
	public function blocks(): array
	{
		return [
			DashboardBlock::make([
				TextBlock::make(
					'Welcome to CMS Wahanatatar',
					''
				)
			]),
		];
	}
}
