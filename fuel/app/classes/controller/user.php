<?php


class Controller_User extends Controller_Template{

	//public $template ='template_admin';

	public function action_index()
	{
		Response::redirect('user/login');
	}

	public function action_login()
	{	//si esta logeado
		//redirigimos a home
		if(Auth::check())
		{	Session::set_flash('success','Ya estás logeado');
			Response::redirect('/');
		}
		//si pulsa login
		if(/*Input::method()=='POST' &&*/ Input::post('login'))
		{
			$val = Validation::forge();
			$val->add_field('email', 'Tu email', 'required');
			$val->add_field('password', 'Tu contraseña', 'required');
			if($val->run())
			{	
				//validar credenciales
				$auth = Auth::instance();
				if($auth->login($val->validated('email'), $val->validated('password')))
				{
					//exito
					Session::set_flash('success','Estás logeado');
					Response::redirect('/');
					
					

				}
			}
			else
			{
				Session::set_flash('error','El usuario no es correcto');
				Response::redirect('user/login');
			}
		}
		//else
		//{
		$data = array();
        $this->template->title = 'Login';
        $this->template->content = View::forge('user/login', $data, false);
		//}


	}

	public function action_logout(){

		if(Auth::check())
		{

			Auth::logout();

			Session::set_flash('success','Sesión finalizada');

			Response::redirect('/');
		}
		else
		{
			Response::redirect('/');
		}

	}

	public function action_delete(){

		if(Auth::check())
		{

			Auth::delete_user(Auth::get_screen_name());

			Session::set_flash('success','Usuario eliminado');

			Response::redirect('/');
		}
		else
		{	
			Response::redirect('/');
		}

	}

	public function action_register(){

		if(Auth::check())
		{

			Response::redirect('/');
		}

		//si pulsa registrarse
		if(/*Input::method()=='POST'*/ Input::post('REGISTER') )
		{


			$val = Validation::forge();
			$val->add_field('username', 'Tu nombre', 'required');
			$val->add_field('email', 'Tu email', 'required');
			$val->add_field('password', 'Tu contraseña', 'required');
			$val->add_field('password_confirm', 'Confirma tu contraseña', 'required');
			if($val->run())
			{	
				//validar credenciales
				$auth = Auth::instance();
				$create_user=$auth->create_user(
					$val->validated('username'),
					$val->validated('password'),
					$val->validated('email'),
					1,
					['username' => $val->validated('username')]
				);
				if($create_user)
				{
					Session::set_flash('success','Usuario registrado');
					$auth = Auth::instance();
					if($auth->login($val->validated('email'), $val->validated('password')) 
						|| Auth::check())
					{
						$current_user = Model_User::find_by_username(Auth::get_screen_name());
						View::set_global('current_user', $current_user);
						View::set_global('logged_in', $current_user);

						Session::set_flash('success','Bienvenido '.$current_user->username );
						Response::redirect('/');

					}
					else{
						//nuevo usuario creado
						//usuario no está logeado
						Response::redirect('/');


					}
				}
				else{

					//error creando usuario
					Session::set_flash('error','Ha habido un problema creando el usuario' );

					Response::redirect('/');
				}	
				
				if($auth->login($val->validated('email'), $val->validated('password')))
				{
					//exito
					Session::set_flash('success','Estás logeado');
					Response::redirect('/');
					
					

				}
			}

		}
		
		$data = array();
        $this->template->title = 'Register';
        $this->template->content = View::forge('user/register', $data, false);
		



	}

	public function action_update()
	{
		if(!Auth::check())
		{

			Response::redirect('/');
		}

		//si pulsa registrarse
		if(/*Input::method()=='POST'*/ Input::post('update') )
		{


			$val = Validation::forge();
			$val->add_field('email', 'Tu email', 'required');
			$val->add_field('old_password', 'Tu antigua contraseña', 'required');
			$val->add_field('password', 'Nueva contraseña', 'required');
			if($val->run())
			{	
				//validar credenciales
				$auth = Auth::instance();
				$update_user=$auth->update_user(
					array(
						'email' => $val->validated('email'),
						'password' =>$val->validated('password'),
						'old_password' =>$val->validated('old_password'),
					//	'username' =>$val->validated('username'),
				)
					
/*
					$val->validated('username'),
					$val->validated('password'),
					$val->validated('email'),
					1,
					['username' => $val->validated('username')]*/
				);
				if($update_user)
				{
					Session::set_flash('success','Usuario actualizado');
					Response::redirect('/');
				}
				else
				{
					Session::set_flash('error','Error al actualizar');
					Response::redirect('/');
				}
				
				
			}
			else{
				Session::set_flash('error','Datos incorrectos');
				Response::redirect('user/update');

			}

		}
		
		$data = array();
        $this->template->title = 'Editar Usuario';
        $this->template->content = View::forge('user/update', $data, false);

	}

}