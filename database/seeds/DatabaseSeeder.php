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
			['email' => 'test1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Евгения','last_name' => 'Полещук', 'sex' => 0,'file_path' => 'Полещук-Евгения.jpg',],
			['email' => 'test2@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Алена','last_name' => 'Куприк', 'sex' => 0,'file_path' => 'Куприк-Алена.jpg',],
			['email' => 'test13@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Баира','last_name' => 'Логинова', 'sex' => 0,'file_path' => 'Логинова-Баира.jpg',],
			['email' => 'test14@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Борис','last_name' => 'Пай', 'sex' => 1,'file_path' => 'Пай-Борис.jpg',],
			['email' => 'tes3t1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Елизавета','last_name' => 'Тотунова', 'sex' => 0,'file_path' => 'Тотунова-Елизавета.jpg',],
			['email' => 'tes2t1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Вадим','last_name' => 'Дубров', 'sex' => 1,'file_path' => 'Дубров-Вадим.jpg',],
			['email' => 'te5st1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Екатерина','last_name' => 'Ким', 'sex' => 0,'file_path' => 'Ким-Екатерина.jpg',],
			['email' => 'tes23t1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Александра','last_name' => 'Бадмаева', 'sex' => 0,'file_path' => 'Бадмаева-Александра.jpg',],
			['email' => 'te21st1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Татьяна','last_name' => 'Беспрозванных', 'sex' => 0,'file_path' => 'Беспрозванных-Татьяна.jpg',],
			['email' => 'te3st1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Михаил','last_name' => 'Бадмаев', 'sex' => 1,'file_path' => 'Бадмаев-Михаил.jpg',],
			['email' => 'te13st1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Анна','last_name' => 'Буянова', 'sex' => 0,'file_path' => 'Буянова-Анна.jpg',],
			['email' => 'tceesdwt1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Алексей','last_name' => 'Буянов', 'sex' => 1,'file_path' => 'Буянов-Алексей.jpg',],
			['email' => 'tecwrerst1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Павел','last_name' => 'Ионкин', 'sex' => 1,'file_path' => 'not.jpg',],
			['email' => 'techrst1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Алена','last_name' => 'Адьянова', 'sex' => 0,'file_path' => 'not.jpg',],
			['email' => 'tecest1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Максим','last_name' => 'Крупский', 'sex' => 1,'file_path' => 'Крупский-Максим.jpg',],
			['email' => 'testcth1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Александр','last_name' => 'Мирошниченко', 'sex' => 1,'file_path' => 'Мирошниченко-Александр.jpg',],
			['email' => 'tesbtt1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Татьяна','last_name' => 'Ганжа', 'sex' => 0,'file_path' => 'Ганжа-Татьяна.jpg',],
			['email' => 'tesgcert1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Дарья','last_name' => 'Сотникова', 'sex' => 0,'file_path' => 'Сотникова-Дарья.jpg',],

			['email' => 'tbjest1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Заяна','last_name' => 'Бадмаева', 'sex' => 0,'file_path' => 'Бадмаева-Заяна.jpg',],
			['email' => 'tesbht1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Екатерина','last_name' => 'Шипеева', 'sex' => 0,'file_path' => 'Шипеева-Екатерина.jpg',],
			['email' => 'tewtst1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Андрей','last_name' => 'Нужный', 'sex' => 1,'file_path' => 'Нужный-Андрей.jpg',],
			['email' => 'tewst1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Саглара','last_name' => 'Архинчеева', 'sex' => 0,'file_path' => 'not.jpg',],
			['email' => 'tewefst1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Дарья','last_name' => 'Озаева', 'sex' => 0,'file_path' => 'Озаева-Саглара.jpg',],
			['email' => 'tetyjst1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Ирина','last_name' => 'Видова', 'sex' => 0,'file_path' => 'Видова-Ирина.jpg',],
			['email' => 'tyjest1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Анатолий','last_name' => 'Убушаев', 'sex' => 1,'file_path' => 'Убашаев-Анатолий.jpg',],
			['email' => 'tesett1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Михаил','last_name' => 'Нужный', 'sex' => 1,'file_path' => 'Нужный-Михаил.jpg',],
			['email' => 'tefdst1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Илья','last_name' => 'Молоканов', 'sex' => 1,'file_path' => 'Молоканов-Илья.jpg',],
			['email' => 'testbf1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Лейла','last_name' => 'Ахмедова', 'sex' => 0,'file_path' => 'not.jpg',],
			['email' => 'tesrett1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Наталья','last_name' => 'Соколова', 'sex' => 0,'file_path' => 'Соколова-Наталья.jpg',],

			['email' => 'terst1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Евгения','last_name' => 'Алтынова', 'sex' => 0,'file_path' => 'Алтынова-Евгения.jpg',],
			['email' => 'tetst1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Борис','last_name' => 'Шурунгов', 'sex' => 1,'file_path' => 'not.jpg',],
			['email' => 'teseryt1@mail.ru','password' => 'wfwrwrwrf', 'first_name' => 'Мария','last_name' => 'Шурунгова', 'sex' => 0,'file_path' => 'not.jpg',],

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
		        $userModel->voite_count = 0;
		        $userModel->file_path = $user['file_path'];
		        $userModel->sex = $user['sex'];

		        $userModel->save();

		        //Sentinel::authenticateAndRemember([ 'email' => $user["email"], 'password' => $user["password"] ]);
			}
		}
    }
}
