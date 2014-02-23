class laravel_app
{

	file { '/var/www/app/storage':
		mode => 0777
	}
}
