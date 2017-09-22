<?php
namespace Helpers;

class Auth
{
	public static function startSession()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	}

	public static function verifyPassword(string $password, string $hash):bool
	{
		return password_verify($password, $hash);
	}

	public static function login(array $user)
	{
		if ( isset($user['password']) ) {
			unset($user['password']);
		}

		$_SESSION['user'] = $user;
	}

	public static function logout()
	{
		unset($_SESSION['user']);
	}

	public static function isLogin()
	{
		return $_SESSION && isset($_SESSION['user']) && $_SESSION['user'];
	}

	public static function getUser()
	{
		return $_SESSION['user'];
	}

	public static function getLogin()
	{
		return $_SESSION['user']['login'];
	}

	public static function isAdmin()
	{
		return (int) $_SESSION['user']['admin'];
	}
}