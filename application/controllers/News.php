<?php
class News extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('news_model');
                $this->load->helper('url_helper');
        }

		public function index()
		{
				
		        $data['news'] = $this->news_model->get_news();
		        $data['title'] = 'Index';
		
		        $this->load->view('templates/header', $data);
		        $this->load->view('news/index', $data);
		        $this->load->view('templates/footer');
		}

		public function view($slug = NULL)
		{
				
		        $data['news_item'] = $this->news_model->get_news($slug);
		
		        if (empty($data['news_item']))
		        {		
		        		echo "error: News/view/ -> $slug";
		                show_404();
		        }
		
		        $data['title'] = $data['news_item']['title'];
		
		        $this->load->view('templates/header', $data);
		        $this->load->view('news/view', $data);
		        $this->load->view('templates/footer');
		}
		
		public function create()
		{
			
			$this->load->helper('form');
			$this->load->library('form_validation');
		
			$data['title'] = 'Create';
		
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('text', 'Text', 'required');

			if ($this->form_validation->run() === FALSE)
			{
				echo "News/view/ -> form validation -> false";
				echo "<br>";
				
				$this->load->view('templates/header', $data);
				$this->load->view('news/create');
				$this->load->view('templates/footer');
		
			}
			else
			{
				echo "News/view/ -> form validation -> true";
				echo "<br>";
				$this->news_model->set_news();
				$this->load->view('news/success');
			}
		}
		
}