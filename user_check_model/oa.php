<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Oa extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('cookie');
        $this->load->helper('url');
    }

    private function check_token($token) {
        $url        = "http://passport.myqsc.com/api/get_member_by_token?token=$token";
        $content    = file_get_contents($url);
        $content    = json_decode($content);
        if (isset($content->msg) || isset($content->code)) {
            return FALSE;
        }
        if (isset($content->uid)) {
            return $content;
        }
        return FALSE;
    }

    private function cookie_check_online() {
        $token = $this->session->userdata("token");
        $content = $this->check_token($token);
        if ($content === false) {
            header("location: http://passport.myqsc.com/member/auth?redirect=".current_url());
            return;
        }
        return $content;
    }

    private function cookie_check() {
        $info = $this->input->post();

        if ($info) {
            $token = $info['token'];
            $content = $this->check_token($token);
            if ($content === false) {
                header("location: http://passport.myqsc.com/member/auth?redirect=".current_url());
                return;
            }
            $this->session->set_userdata("token", $token);
        } else {
            $token = $this->session->userdata("token");
            $content = $this->check_token($token);
            if ($content === false) {
                header("location: http://passport.myqsc.com/member/auth?redirect=".current_url());
                return;
            }
        }

        $this->load->model("public_model",'', TRUE);
        $exist = $this->public_model->fetch_user_info($content->stuid);
        if ($exist === 0) {
            header("location: http://passport.myqsc.com/member/auth?redirect=".current_url());
            return;
        }
        return $content;
    }

    public function logout() {
        $this->session->sess_destroy();
        header("location: http://passport.myqsc.com/member/logout");
    }
/**
    END of passport_check and local_cookie_save
**/

    public function first_login_check() {
        $data = $this->cookie_check_online();
        $this->load->model("public_model",'', TRUE);
        $result = $this->public_model->first_login_check($data->stuid);
        if ($result == 0) {
            //header("location: ".base_url()."index.php/oa/personal_data");
        }
    }
/**
    END of first_log_check
**/
    public function index()
    {
        $data = $this->cookie_check();
        //$this->first_login_check();
        
        $array = array(
            'stuid' => $data->stuid,
            'username'=>$data->username,
            'page'  => 'notice'
            );
        $this->load->view('frame', $array);
    }

    public function personal_data() {
        $data = $this->cookie_check();
        $this->load->model("public_model", '', TRUE);
        $info = $this->public_model->fetch_user_info($data->stuid);
        $array = array(
            'stuid'     => $data->stuid,
            'realname'  => $info->realname,
            'username'  => $info->username,
            'sex'       => $info->sex,
            'department'=> $info->dep_name,
            'position'  => $info->position_name,
            'telephone' => $info->telephone,
            'shortnum'  => $info->shortnum,
            'email'     => $info->email,
            'qq'        => $info->qq,
            'msn'       => $info->msn,
            'home'      => $info->home,
            'page'      => 'personal_data'
            );
        $this->load->view('frame', $array);
    }

        public function personal_data_submit() {    //belongs to page personal_data
            $info = $this->input->post();
            $data = $this->cookie_check_online();
            $this->load->model("public_model", '' , TRUE);
            $this->public_model->personal_data_submit($data->stuid, $info);
            return ;
        }

    public function message() {
        $data = $this->cookie_check();
        $array = array(
            'stuid' => $data->stuid,
            'username'=>$data->username,
            'page'  => 'message'
            );
        $this->load->view('frame', $array);
    }

    public function freetime() {
        $data = $this->cookie_check();

        $array = array(
            'stuid'     => $data->stuid,
            'username'=>$data->username,
            'page'      => 'freetime'
            );
        $this->load->view('frame', $array);
    }
    
        public function fetch_freetime() {  //belongs to page freetime
            $data = $this->cookie_check_online();
            $this->load->model("public_model", '' , TRUE);
            $result = $this->public_model->fetch_freetime($data->stuid);
            echo $result;
        }

        public function freetime_change() { //belongs to page freetime
            $info = $this->input->post();
            $data = $this->cookie_check_online();
            $this->load->model("public_model", '' , TRUE);
            $this->public_model->freetime_change($data->stuid, $info["time_value"]);
        }
/**
    the END of public functions
**/
    public function onwatch_evaluate() {
        $data = $this->cookie_check();
        $this->load->model("public_model", '' , TRUE);
        $info = $this->public_model->fetch_user_info($data->stuid);
        //if ($info->power == 1) echo "你有权限";      //加权限判断.

        $duty = $this->public_model->fetch_duty_time($data->stuid);
        $array = array(
            'stuid' =>  $data->stuid,
            'username'=>$data->username,
            'duty'  =>  $duty,
            'page'  =>  'onwatch_evaluate'
            );
        $this->load->view('frame', $array);
    }
        public function fetch_watch_user() {    //belongs to onwatch_evaluate
            $data = $this->cookie_check_online();
            $this->load->model("hr_model", '' , TRUE);
            $result = $this->hr_model->fetch_watch_user($data->stuid);
            echo  json_encode($result);
        }

    public function watch_arrangement() {
        $data = $this->cookie_check();
        $array = array(
            'stuid' => $data->stuid,
            'username'=>$data->username,
            'page'  => 'watch_arrangement'
            );
        $this->load->view('frame', $array);
    }

        public function arrange_duty_fetch_department() {       //belongs to watch_arrangement
            $data = $this->cookie_check_online();
            $post = $this->input->post();
            $this->load->model("hr_model", '' , TRUE);
            $result = $this->hr_model->arrange_duty_fetch_department(1 << $post['key']);
            echo json_encode($result);
        }

        public function add_watch_duty() {        //belongs to watch_arrangement
            $data = $this->cookie_check_online();
            $post = $this->input->post();
            $this->load->model("hr_model", '' , TRUE);
            $result = $this->hr_model->add_watch_duty($post["stu_id"], $post["time_value"]);
            if ($result == 0) {
                echo 0;
            } else {
                echo json_encode($result);
            }
        }

        public function fetch_duty_init() {     //belongs to watch_arrangement
            $data = $this->cookie_check_online();
            $this->load->model("hr_model", '' , TRUE);
            $result = $this->hr_model->fetch_duty_init();
            echo json_encode($result);
        }

        public function cancel_duty() {         //belongs to watch_arrangement
            $data = $this->cookie_check_online();
            $post = $this->input->post();
            $this->load->model("hr_model", '' , TRUE);
            $this->hr_model->cancel_duty($post['stu_id'], $post['time_value']);
            echo json_encode("删除成功");
        }

    public function add_member() {
        $data = $this->cookie_check();
        $this->load->model("hr_model", '' , TRUE);
        $department = $this->hr_model->fetch_department();
        $position   = $this->hr_model->fetch_position();
        $power      = $this->hr_model->fetch_power();
        $array = array(
            'stuid' => $data->stuid,
            'username'=>$data->username,
            'department' => $department,
            'position'   => $position,
            'power'  => $power,
            'page'  => 'add_member'
            );
        $this->load->view('frame', $array);
    }
        public function add_member_submit() {
            $data = $this->cookie_check_online();
            $this->load->model("public_model", '' , TRUE);
            $info = $this->public_model->fetch_user_info($data->stuid);

            $post = $this->input->post();
            $this->load->model("hr_model", '' , TRUE);
            $msg = $this->hr_model->add_member_submit($post);
            echo json_encode($msg);
        }

/**
    the END of hr functions
**/
}

/* End of file oa.php */
/* Location: ./application/controllers/oa.php */
