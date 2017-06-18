<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Activation;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	

    	Role::truncate();
    	foreach ( User::get() as $user ) {
    		$user->roles()->detach();
    		$user->delete();
    	};

		$roles = [
			['slug' => 'voiter', 'name' => 'Голосующий'],
			['slug' => 'сontestant', 'name' => 'Конкурсант'],
		];

		foreach ( $roles as $role ) {
			Role::create([
				'slug' => $role['slug'],
				'name' => $role['name']
			]);
		}

		$users = [
			['email' => 'test1@mail.ru','password' => 'admin', 'first_name' => 'Василий','last_name' => 'Иванов', 'description' => "'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.'",'voite_count' => 10, 'file_path' => 'crew-peter-finlan.jpg','sex' => 1],
			['email' => 'test2@mail.ru','password' => 'admin', 'first_name' => 'Александр','last_name' => 'Розенбаум', 'description' => "'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.'",'voite_count' => 20, 'file_path' => 'crew-dude.jpg','sex' => 1],
			['email' => 'test3t@mail.ru','password' => 'admin', 'first_name' => 'Светлана','last_name' => 'Жданова', 'description' => "'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.'",'voite_count' => 10, 'file_path' => 'crew-mary-lou.jpg','sex' => 0],
			['email' => 'test4@mail.ru','password' => 'admin', 'first_name' => 'Федор','last_name' => 'Филиппов', 'description' => "'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.'",'voite_count' => 31, 'file_path' => 'crew-blaz-robar.jpg','sex' => 1],
			['email' => 'test8@mail.ru','password' => 'admin', 'first_name' => 'Василий','last_name' => 'Иванов', 'description' => "'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.'",'voite_count' => 10, 'file_path' => 'crew-peter-finlan.jpg','sex' => 1],
			['email' => 'test5@mail.ru','password' => 'admin', 'first_name' => 'Александр','last_name' => 'Розенбаум', 'description' => "'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.'",'voite_count' => 20, 'file_path' => 'crew-dude.jpg','sex' => 1],
			['email' => 'test6t@mail.ru','password' => 'admin', 'first_name' => 'Светлана','last_name' => 'Жданова', 'description' => "'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.'",'voite_count' => 10, 'file_path' => 'crew-mary-lou.jpg','sex' => 0],
			['email' => 'test7@mail.ru','password' => 'admin', 'first_name' => 'Федор','last_name' => 'Филиппов', 'description' => "'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.'",'voite_count' => 31, 'file_path' => 'crew-blaz-robar.jpg','sex' => 1],
		];

		$сontestant = Sentinel::findRoleBySlug("сontestant");

		foreach ($users as $user) {
			$credentials = [
		        'email'    => $user["email"],
		        'password' => $user["password"],
		    ];

		    $userModel = Sentinel::register($credentials);

		    if ( $userModel ) {
		        $сontestant->users()->attach($userModel);

		        $userModel->first_name = $user['first_name'];
		        $userModel->last_name = $user['last_name'];
		        $userModel->description = $user['description'];
		        $userModel->voite_count = $user['voite_count'];
		        $userModel->file_path = $user['file_path'];
		        $userModel->sex = $user['sex'];

		        $userModel->save();

		        //Sentinel::authenticateAndRemember([ 'email' => $user["email"], 'password' => $user["password"] ]);
			}
		}
    }
}
