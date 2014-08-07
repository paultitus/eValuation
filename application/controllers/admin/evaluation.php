<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evaluation extends CI_Controller {
	function __construct() {
		parent::__construct();
		//refuse access when not logged in as admin
		if (empty($this->session->userdata('role'))) {
			redirect(base_url());
		} else if ($this->session->userdata('role') !== 'admin') {
			$message_403 = "You don't have permission to access the URL you are trying to reach.";
			$heading = '403 Forbidden';
			show_error($message_403,403,$heading);
		}
		$this->load->model('class_model');
		$this->load->model('office_model');
		$this->load->model('evaluator_model');
		$this->office_id = $this->session->userdata('office_id');
	}

	public function index() {
		$this->view();
	}

	public function view() {
		$this->load->model('teacher_model');
		$view_data = array(
			'classes_not_evaluated' => $this->class_model->get_todo($this->office_id),
			'classes_currently_evaluated' => $this->class_model->get_active($this->office_id),
			);
		$data['page_title'] = 'eValuation';
		$data['body_content'] = $this->load->view('contents/admin/evaluation/view',$view_data,TRUE);
		$this->parser->parse('layouts/default', $data);
	}

	public function start($class_id) {
		$result = $this->class_model->get_by_id($class_id);
		//check if ID is valid
		if ($result === FALSE) {
			$error_data = array(
				'error_title' => 'No Such Entry Exists',
				'error_message' => 'Record for the given class ID does not exist in the database.'
				);
			$data['body_content'] = $this->load->view('contents/error', $error_data, TRUE);
		} else {
			$start_result = $this->start_evaluation($class_id);
			$message = '';
			$error = '';
			$success = FALSE;
			if ($start_result) {
				$message = 'Class evaluation was successfully started.';
				$success = TRUE;

				//generate codes
				$this->generate_code($class_id);
			} else {
				$message = 'Class evaluation start failed.';
				$error = $this->db->_error_message();
			}
			$start_data = array('message' => $message, 'error' => $error, 'success' => $success, 'class_id' => $class_id);
			$data['body_content'] = $this->load->view('contents/admin/evaluation/function_result',$start_data,TRUE);

		}
		$data['page_title'] = "eValuation";
		$this->parser->parse('layouts/default', $data);
	}

	private function start_evaluation($class_id) {
		if ($this->class_model->start_evaluation($class_id, $this->session->userdata('user_id'))) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function stop($class_id) {
		$result = $this->class_model->get_by_id($class_id);
		//check if ID is valid
		if ($result === FALSE) {
			$error_data = array(
				'error_title' => 'No Such Entry Exists',
				'error_message' => 'Record for the given class ID does not exist in the database.'
				);
			$data['body_content'] = $this->load->view('contents/error', $error_data, TRUE);
		} else {
			//must go through stop-confirm form
			$confirm = $this->input->post('confirm');

			if ($confirm !== 'TRUE') {
							//confirmation dialog
							$stop_confirm_data = array(
								'class' => $result
								);

				$data['body_content'] = $this->load->view('contents/admin/evaluation/stop_confirm',$stop_confirm_data,TRUE);
			} else {
				$message = '';
				$error = '';
				$success = FALSE;

				//check if there are evaluation forms submitted
				//prevent stop if none
				$this->load->model('evaluation_model');

				if ($this->evaluation_model->get_by_class($class_id)) {
					$stop_result = $this->stop_evaluation($class_id);
					if ($stop_result) {
						$message = 'Class evaluation was successfully stopped.';
						$success = TRUE;
					} else {
						$message = 'Class evaluation stop failed.';
						$error = $this->db->_error_message();
					}
				} else {
					$message = 'Class evaluation stop failed.';
					$error = 'There are no submitted evaluation forms. In order to generate the evaluation report, at least one evaluation form must be submitted.';
				}
				$stop_data = array('message' => $message, 'error' => $error, 'success' => $success);
				$data['body_content'] = $this->load->view('contents/admin/evaluation/function_result',$stop_data,TRUE);
			}
		}
		$data['page_title'] = "eValuation";
		$this->parser->parse('layouts/default', $data);
	}

	private function stop_evaluation($class_id) {
		if ($this->class_model->stop_evaluation($class_id)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function cancel($class_id) {
		$result = $this->class_model->get_by_id($class_id);
		//check if ID is valid
		if ($result === FALSE) {
			$error_data = array(
				'error_title' => 'No Such Entry Exists',
				'error_message' => 'Record for the given class ID does not exist in the database.'
				);
			$data['body_content'] = $this->load->view('contents/error', $error_data, TRUE);
		} else {
			//must go through delete-confirm form
			$confirm = $this->input->post('confirm');

			if ($confirm !== 'TRUE') {
				//confirmation dialog
				$delete_confirm_data = array(
					'class' => $result
					);

				$data['body_content'] = $this->load->view('contents/admin/evaluation/cancel_confirm',$delete_confirm_data,TRUE);
			} else {
				$cancel_result = $this->cancel_evaluation($class_id);
				$message = '';
				$error = '';
				$success = FALSE;
				if ($cancel_result) {
					$message = 'Class evaluation was successfully canceled.';
					$success = TRUE;
				} else {
					$message = 'Class evaluation cancel failed.';
					$error = $this->db->_error_message();
				}
				$cancel_data = array('message' => $message, 'error' => $error, 'success' => $success);
				$data['body_content'] = $this->load->view('contents/admin/evaluation/function_result',$cancel_data,TRUE);
			}
		}
		$data['page_title'] = "eValuation";
		$this->parser->parse('layouts/default', $data);
	}

	private function cancel_evaluation($class_id) {
		if ($this->class_model->cancel_evaluation($class_id, $this->session->userdata('user_id'))) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function code($class_id) {
		$this->load->model('access_code_model');
		$class = $this->class_model->get_by_id($class_id);

		$code_data['class'] = $class;
		$code_data['codes'] = $this->access_code_model->get_by_class($class_id);

		$data['body_content'] = $this->load->view('contents/admin/evaluation/code',$code_data,TRUE);
		$data['page_title'] = "eValuation";
		$this->parser->parse('layouts/code', $data);


		//pdf
		$this->load->helper(array('wkhtmltopdf', 'file'));
		$html = $this->parser->parse('layouts/code', $data, TRUE);

		if (write_file('assets/temp/temp.php', $html)) {
			$filename = $class->year.'-'.format_semester($class->semester).' - '.$class->class_name.' '.$class->section;
			pdf_create($html, $filename);
			delete_files('assets/temp/');
			return TRUE;
		} else {
			return FALSE;
		}
	}

	private function generate_code($class_id) {
		$this->load->model('access_code_model');
		$class = $this->class_model->get_by_id($class_id);

		$codes = array();

		for ($i=0; $i < $class->number_of_students; $i++) { 
			//length of code is 10
			$codes[$i] = bin2hex(openssl_random_pseudo_bytes(5));
			while ($this->access_code_model->code_exists($codes[$i])) {
				$codes[$i] = bin2hex(openssl_random_pseudo_bytes(5));
			}
			$this->access_code_model->add($class->class_id, $codes[$i]);
		}

		return $codes;
	}
}

/* End of file evaluation.php */
/* Location: ./application/controllers/admin/evaluation.php */