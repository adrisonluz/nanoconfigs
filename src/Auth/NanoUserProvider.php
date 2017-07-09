<?php namespace NanoSoluctions\NanoConfigs\Auth;

use NanoSoluctions\NanoConfigs\Models\NanoUser; 
use Carbon\Carbon; 
use Illuminate\Auth\GenericUser; 
use Illuminate\Contracts\Auth\Authenticatable; 
use Illuminate\Contracts\Auth\UserProvider;

class NanoUserProvider implements UserProvider {
	/**
	 * Retrieve a user by their unique identifier.
	 *
	 * @param  mixed $identifier
	 * @return \Illuminate\Contracts\Auth\Authenticatable|null
	 */
	public function retrieveById($identifier)
	{
	    $qry = NanoUser::where('id','=',$identifier);

	    if($qry->count() >0)
	    {
	        $user = $qry->select('id', 'email', 'name', 'login', 'password')->first();

	        $attributes = array(
	            'id' => $user->id,
	            'email' => $user->email,
	            'password' => $user->password,
	            'name' => $user->name,
	        );

	        return $user;
	    }
	    return null;
	}

	/**
	 * Retrieve a user by by their unique identifier and "remember me" token.
	 *
	 * @param  mixed $identifier
	 * @param  string $token
	 * @return \Illuminate\Contracts\Auth\Authenticatable|null
	 */
	public function retrieveByToken($identifier, $token)
	{
	    $qry = NanoUser::where('id','=',$identifier)->where('remember_token','=',$token);

	    if($qry->count() >0)
	    {
	        $user = $qry->select('id', 'email', 'name', 'login', 'password')->first();

	        $attributes = array(
	            'id' => $user->id,
	            'email' => $user->email,
	            'password' => $user->password,
	            'name' => $user->name,
	        );

	        return $user;
	    }
	    return null;
	}

	/**
	 * Update the "remember me" token for the given user in storage.
	 *
	 * @param  \Illuminate\Contracts\Auth\Authenticatable $user
	 * @param  string $token
	 * @return void
	 */
	public function updateRememberToken(Authenticatable $user, $token)
	{
	    $user->setRememberToken($token);
	    $user->save();
	}

	/**
	 * Retrieve a user by the given credentials.
	 *
	 * @param  array $credentials
	 * @return \Illuminate\Contracts\Auth\Authenticatable|null
	 */
	public function retrieveByCredentials(array $credentials)
	{
	    $qry = NanoUser::where('email','=',$credentials['email']);

	    if($qry->count() >0)
	    {
	        $user = $qry->select('id','email','name','login','password')->first();
	        return $user;
	    }
	    return null;
	}

	/**
	 * Validate a user against the given credentials.
	 *
	 * @param  \Illuminate\Contracts\Auth\Authenticatable $user
	 * @param  array $credentials
	 * @return bool
	 */
	public function validateCredentials(Authenticatable $user, array $credentials)
	{
	    if($user->email == $credentials['email'] && $user->getAuthPassword() == Hash::make($credentials['password']))
	    {
	        //$user->last_email_time = Carbon::now();
	        //$user->save();
	        return true;
	    }
	    return false;
	}
}