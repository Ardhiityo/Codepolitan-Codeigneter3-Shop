<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index($page = 1)
	{
		$keyword = $this->input->get('keyword', true);

		$data['title'] = 'Home';
		$data['page'] = 'pages/home/index';
		$data['content'] = $this->home->select([
			'product.id',
			'product.image_url',
			'product.desc',
			'product.title AS product_title',
			'category.title AS category_title',
			'product.price',
			'product.is_available'
		])
			->join('category')
			->like('product.title', $keyword)
			->where('product.is_available', true)
			->orderBy('id', 'desc')
			->paginate($keyword ? 1 : $page)
			->get();
		$data['current_page'] = $page;
		$data['action'] = base_url('/');
		$data['total_rows'] = $this->home->where('is_available', true)->count();
		$data['per_page'] = $this->home->per_page;
		$data['pagination'] = $this->home->makePagination(
			base_url(''),
			$data['total_rows'],
			1
		);

		$this->view($data);
	}
}
