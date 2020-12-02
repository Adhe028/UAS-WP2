<?php
class Session_model extends CI_Model
{

public function belumLogin(){
        return $this->session->userdata('user_name') === null;
    }
}