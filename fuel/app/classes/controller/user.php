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
		{	Session::set_flash('success','YA Estás logeado');
			Response::redirect('/');
		}
		//si pulsa login
		if(Input::method()=='POST' && Input::post('LOGIN'))
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

	public function action_register(){

	// is registration enabled?
    if ( ! \Config::get('application.user.registration', false))
    {
        // inform the user registration is not possible
        //Messages::error(__('login.registation-not-enabled'));

        // and go back to the previous page (or the homepage)
        \Response::redirect_back();
    }

		if(Auth::check())
		{

			Response::redirect('/');
		}

		//si pulsa registrarse
		if(Input::method()=='POST' && Input::post('REGISTER'))
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
					['username' => $val->validate('username')]
				);
				if($create_user)
				{
					Session::set_flash('success','Usuario registrado');
					$auth = Auth::instance();
					if($auth->login($val->validated('email'), $val->validated('password')) 
						|| Auth::check())
					{
						$current_user = Model_User::find_by_username(Auth::get_screen);
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
			else{
				Session::set_flash('error','Está fallando aquí' );
			}
		}
		
		$data = array();
        $this->template->title = 'Register';
        $this->template->content = View::forge('user/register', $data, false);
		



	}

}