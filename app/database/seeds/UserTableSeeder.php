<?php

// Composer: "fzaninotto/faker": "v1.3.0"
// use Faker\Factory as Faker;


class UserTableSeeder extends Seeder {

	public function run()
	{
		// $faker = Faker::create();

		// users : users_descriptions_id_foreign
		// descriptions: descriptions_user_id_foreign
		// foods: foods_restaurant_id_foreign

		// $AdminGroup = Sentry::findGroupById(4);
		// $restaurantGroup = Sentry::findGroupById(6);

		// Sentry::getUserProvider()->create(array(
		// 	'email'		=> 'admin@admin.com',
		// 	'password'	=> '123456',
		// 	'first_name'=> 'admin',
		// 	'last_name'	=> 'admin',
		// 	'activated'	=> 1,
		// ));

		// $admin = Sentry::getUserProvider()->findByLogin('admin@admin.com');
		// $admin->addGroup($AdminGroup);

		// foreach(range(1, 10) as $index) {
		// 	Sentry::getUserProvider()->create(array(
		// 		'email'		=> 'restaurant'.$index.'@restaurant.com',
		// 		'password'	=> '123456',
		// 		'first_name'=> 'restaurant'.$index,
		// 		'last_name'	=> 'restaurant'.$index,
		// 		'activated'	=> 1,
		// 	));
		// 	$restaurant = Sentry::getUserProvider()->findByLogin('restaurant'.$index.'@restaurant.com');
		// 	$restaurant->addGroup($restaurantGroup);
		// }
		
		// $restaurantGroup 	= Sentry::findGroupById(6);
		// $restaurants 		= Sentry::findAllUsersInGroup($restaurantGroup);
		$restaurant = User::find(53);
		// printf(count($restaurants));
		printf($restaurant->email);
		printf($restaurant->description->name);
		// foreach ($restaurants as  $restaurant) {
		// 	printf($restaurant->description->name);
		// }
	}

}