<?php 
class Crud extends CI_Controller{

function __construct(){

parent::__construct();	

$this->load->model('M_data');

$this->load->helper('url');

}


function index(){

$data['user'] = $this->M_data->tampil_data()->result();
$this->load->view('v_tampil',$data);

}
 

function tambah(){

$this->load->view('v_input');

}
 

function tambah_aksi(){

$costumer = $this->input->post('costumer');
$reservation = $this->input->post('reservation');
$rute = $this->input->post('rute');
$transportation = $this->input->post('transportation');
$transport_type = $this->input->post('transport_type');
$user = $this->input->post('user');

 

$data = array(

'costumer' => $costumer,
'reservation' => $reservation,
'rute' => $rute,
'transportation' => $transportation,
'transport_type' => $transport_type,
'user' => $user

);

$this->m_data->input_data($data,'user');

redirect('crud/index');

}
function hapus($id){
		$where = array('ruteid' => $id);
		$this->crud_m->hapus_record($where, 'rute');
		redirect('insert/tampil');
	}

function edit_rute($id){
		$where = array ('ruteid' => $id);
		$data['rute'] = $this->crud_m->edit_datarute($where, 'rute')->result();
		$this->load->view('edit', $data);
	}

function update_rute(){
		$ruteid = $this->input->post('ruteid');
		$from = $this->input->post('from');
		$to = $this->input->post('to');
		$depart_on = $this->input->post('depart');
		$price = $this->input->post('prices');
		$data = array(
			'rute_from' => $from,
			'rute_to' => $to,
			'depart_on' => $depart_on,
			'price' => $price
		);
		$where = array(
			'ruteid' => $ruteid
		);
		$this->crud_m->update_datarute($where, $data, 'rute');
		redirect('insert/tampil');
	}
 

}
