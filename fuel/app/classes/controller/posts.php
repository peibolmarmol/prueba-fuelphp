<?php

class Controller_Posts extends Controller_Template
{

	public function action_index()
	{
		$posts= Model_Post::find('all');

		$data = array('posts' => $posts);
        $this->template->title = 'Blog Posts';
        $this->template->content = View::forge('posts/index', $data, false);
	}

	public function action_add(){

		if(Input::post('send')){

			$post = new Model_Post();
			$post->title= Input::post('title');
			$post->category= Input::post('category');
			$post->body= Input::post('body');
			$post->tags= Input::post('tags');
			$post->create_date= date('d-m-Y H:i:s');
			$post->save();

			Session::set_flash('success', 'Post Added');

			Response::redirect('/');
		}

		$data = array();
        $this->template->title = 'Add Post';
        $this->template->content = View::forge('posts/add', $data);

	}

	public function action_view($id){

		$post= Model_Post::find('first', array(
			'where' =>  array(
				'id' => $id )
			));

		$data = array('post'=> $post);
        $this->template->title = $post->title;
        $this->template->content = View::forge('posts/view', $data, false);
	}

	public function action_edit($id){

		if(Input::post('send')){

			$post = Model_Post::find(Input::post('post_id'));
			$post->title= Input::post('title');
			$post->category= Input::post('category');
			$post->body= Input::post('body');
			$post->tags= Input::post('tags');
			$post->create_date= date('D-m-y H:i:s');
			$post->save();

			Session::set_flash('success', 'Post Updated');

			Response::redirect('/');
		}	

		$post= Model_Post::find('first', array(
			'where' =>  array(
				'id' => $id)
			));

		$data = array('post'=> $post);
        $this->template->title = 'Edit Post';
        $this->template->content = View::forge('posts/edit', $data, false);
	}

	public function action_delete($id){

		$post= Model_Post::find($id);
		$post->delete();

		Session::set_flash('success', 'Post Deleted');

		Response::redirect('/');
	}

}