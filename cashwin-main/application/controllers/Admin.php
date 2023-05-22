<?php
class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $fun = $this->router->fetch_method();
        if (!$this->session->userdata('login') && $fun != "app_bid_history" && $fun != 'app_startline_bid_history')
            redirect(site_url("admin/login"));
    }
    public function index($type = "", $id = "", $page = 'index')
    {
        if (!$this->session->userdata('login')) {
            redirect(site_url("admin/login"));
        }
        if (!file_exists(APPPATH . 'views/admin/' . $page . '.php')) {
            show_404();
        }
        $data['total_wallet_amt'] = $this->Administrator_Model->getTotalWalletAmt();
        $data['total_users'] = $this->Administrator_Model->get_total_users();
        $data['mumbai_matkas'] = $this->Administrator_Model->getMumbaiMatkaDetails();
        $data['all_matkas'] = $this->Administrator_Model->getMatkaDetails();
        $data['pending_req'] = $this->Administrator_Model->add_pending_point_req();
        $data['users'] = $this->Administrator_Model->get_unapproved_user_profile();
        $data['total_bid_amount'] = $this->Administrator_Model->get_today_bid_amount();
        if ($type == "userbank_allow" && $id) {
            if ($this->Administrator_Model->userbank_allow($id, "user_profile"))
                $this->session->set_flashdata('success', 'Permission allowed successfully.');
            redirect(site_url("admin/index"));
        }
        if (isset($_POST['market_sbmt'])) {
            $matka_id = $this->input->post('market_id');
            $data['market_amount'] = $this->Administrator_Model->get_today_matka_bid_amount($matka_id);
            $data['selected_matka_id'] = $matka_id;
        }
        $this->load->view('admin/index', $data);
    }
    public function home($page = 'home')
    {
        if (!file_exists(APPPATH . 'views/administrator/' . $page . '.php')) {
            show_404();
        }
        $data['title'] = ucfirst($page);
        $this->load->view('administrator/header-script');
        $this->load->view('administrator/header');
        $this->load->view('administrator/header-bottom');
        $this->load->view('administrator/' . $page, $data);
        $this->load->view('administrator/footer');
    }
    public function dashboard($page = 'dashboard')
    {
        if (!file_exists(APPPATH . 'views/administrator/' . $page . '.php')) {
            show_404();
        }
        $data['title'] = ucfirst($page);
        $data['users'] = $this->Administrator_Model->getUserDetails();
        $data['matkas'] = $this->Administrator_Model->getMatkaDetails();
        $this->load->view('administrator/header-script');
        $this->load->view('administrator/header');
        $this->load->view('administrator/header-bottom');
        $this->load->view('administrator/' . $page, $data);
        $this->load->view('administrator/footer');
    }
    // Log in Admin
    public function adminLogin()
    {
        $data['title'] = 'Admin Login';
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('administrator/header-script');
            $this->load->view('administrator/index', $data);
            $this->load->view('administrator/footer');
        } else {
            // get email and Encrypt Password
            $email = $this->input->post('username');
            $encrypt_password = md5($this->input->post('password'));
            $user_id = $this->Administrator_Model->adminLogin($email, $encrypt_password);
            $sitelogo = $this->Administrator_Model->update_siteconfiguration(1);
            if ($user_id) {
                //Create Session
                $user_data = array(
                    'user_id' => $user_id->id,
                    'username' => $user_id->username,
                    'email' => $user_id->email,
                    'login' => true,
                    'role' => $user_id->role_id,
                    'image' => $user_id->image,
                    'site_logo' => $sitelogo['logo_img']
                );
                $this->session->set_userdata($user_data);
                //Set Message
                $this->session->set_flashdata('success', 'Welcome to administrator Dashboard.');
                redirect('administrator/dashboard');
            } else {
                $this->session->set_flashdata('danger', 'Login Credential in invalid!');
                redirect('administrator/index');
            }

        }
    }
    public function app_setting()
    {
        if ($this->input->post('message') != '') {
            $this->Administrator_Model->update_appsetting();
        }
        $data['setting'] = $this->Administrator_Model->app_setting();
        $data['site_setting'] = $this->db->where('id', 1)->get('site_config')->row();
        $this->load->view('admin/app_setting', $data);
    }
    public function contact_setting()
    {
        if ($this->input->post('mobile_number') != '') {
            $this->Administrator_Model->update_contact_setting();
        }
        $data['setting'] = $this->Administrator_Model->app_setting();
        $this->load->view('admin/contact_setting', $data);
    }
    public function how_to_play()
    {
        if ($this->input->post('how_to_play') != '') {
            $this->Administrator_Model->update_how_to_play();
        }
        $data['setting'] = $this->Administrator_Model->app_setting();
        $data['site_setting'] = $this->db->where('id', 1)->get('site_config')->row();
        $this->load->view('admin/how_to_play', $data);
    }
    public function manage_slider($type = FALSE, $id = FALSE)
    {
        if ($type) {
            if ($type == "activate_slider" && $id) {
                $data['status'] = 1;
                if ($this->Administrator_Model->update_slider_status($id, $data))
                    $this->session->set_flashdata('success', 'Slider activated successfully.');
            }
            if ($type == "deactivate_slider" && $id) {
                $data['status'] = 2;
                if ($this->Administrator_Model->update_slider_status($id, $data))
                    $this->session->set_flashdata('success', 'Slider deactivated successfully.');
            }
            redirect(site_url("admin/manage_slider"));
        } else {
            $data['manage_slider'] = $this->db->get('sliders_img')->result_array();
            $this->load->view('admin/manage_slider', $data);
        }
    }
    public function add_slider()
    {
        if (isset($_POST['submit'])) {
            $array['title'] = $this->input->post('title');
            $status = $this->input->post('status');
            $config['allowed_types'] = 'pdf|gif|jpeg|png|jpg';
            $config['upload_path'] = './uploads/slider';
            $config['encrypt_name'] = true;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image')) {
                $data = $this->upload->data();
                $image_path = ("uploads/slider/" . $data['file_name']);
                $array['image'] = $image_path;
            }
            if ($this->input->post('slider_id') != '') {
                $x = $this->db->where('id', $this->input->post('slider_id'))->update('sliders_img', $array);
                $message = '<div class="alert alert-success text-center" id="successMessage">Slider updated successfully</div>';
            } else {
                $x = $this->db->insert('sliders_img', $array);
                $message = '<div class="alert alert-success text-center" id="successMessage">Slider added successfully</div>';
            }
            if ($x) {
                $this->session->set_flashdata('success', $message);
            } else {
                if ($this->input->post('slider_id') != '') {
                    $err_message = '<div class="alert alert-danger text-center" id="successMessage">Unable to update slider </div>';
                } else {
                    $err_message = '<div class="alert alert-danger text-center" id="successMessage">Unable to add slider </div>';
                }
                $this->session->set_flashdata('error', $err_message);
            }
            redirect("admin/manage_slider");
        }
    }
    // log admin out
    public function logout()
    {
        // unset user data
        $this->session->unset_userdata('login');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('image');
        $this->session->unset_userdata('site_logo');
        //Set Message
        $this->session->set_flashdata('success', 'You are logged out.');
        redirect(base_url() . 'admin');
    }
    public function forget_password($page = 'forget-password')
    {
        if (!file_exists(APPPATH . 'views/administrator/' . $page . '.php')) {
            show_404();
        }
        $data['title'] = ucfirst($page);
        $this->load->view('administrator/header-script');
        $this->load->view('administrator/' . $page, $data);
        $this->load->view('administrator/footer');
    }
    public function add_user($page = 'add-user')
    {
        if (!file_exists(APPPATH . 'views/administrator/' . $page . '.php')) {
            show_404();
        }
        // Check login
        if (!$this->session->userdata('login')) {
            redirect('admin/index');
        }
        $data['title'] = 'Create User';
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
        $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('administrator/header-script');
            $this->load->view('administrator/header');
            $this->load->view('administrator/header-bottom');
            $this->load->view('administrator/' . $page, $data);
            $this->load->view('administrator/footer');
        } else {
            //Upload Image
            $config['upload_path'] = './assets/images/users';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2048';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {
                $errors = array('error' => $this->upload->display_errors());
                $post_image = 'noimage.jpg';
            } else {
                $data = array('upload_data' => $this->upload->data());
                $post_image = $_FILES['userfile']['name'];
            }
            $password = md5('password');
            $this->Administrator_Model->add_user($post_image, $password);
            //Set Message
            $this->session->set_flashdata('success', 'User has been created Successfull.');
            redirect('administrator/users');
        }
    }
    // Check user name exists
    public function check_username_exists($username)
    {
        $this->form_validation->set_message('check_username_exists', 'That username is already taken, Please choose a different one.');
        if ($this->User_Model->check_username_exists($username)) {
            return true;
        } else {
            return false;
        }
    }
    // Check Email exists
    public function check_email_exists($email)
    {
        $this->form_validation->set_message('check_email_exists', 'This email is already registered.');
        if ($this->User_Model->check_email_exists($email)) {
            return true;
        } else {
            return false;
        }
    }
    public function users($offset = 0)
    {
        // Pagination Config
        $config['base_url'] = base_url() . 'admin/view_users';
        $config['total_rows'] = $this->db->count_all('users');
        $config['per_page'] = FALSE;
        $config['uri_segment'] = 3;
        $config['attributes'] = array('class' => 'paginate-link');
        // Init Pagination
        $this->pagination->initialize($config);
        $data['title'] = 'Latest Users';
        $data['users'] = $this->Administrator_Model->get_users(FALSE, $config['per_page'], $offset);
        $this->load->view('admin/view_users', $data);
    }
    public function delete($id)
    {
        $table = base64_decode($this->input->get('table'));
        $this->Administrator_Model->delete($id, $table);
        $this->session->set_flashdata('success', 'Data has been deleted Successfully.');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    public function enable($id)
    {
        $table = base64_decode($this->input->get('table'));
        $this->Administrator_Model->enable($id, $table);
        $this->session->set_flashdata('success', 'Disabled Successfully.');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    public function desable($id)
    {
        $table = base64_decode($this->input->get('table'));
        $this->Administrator_Model->disable($id, $table);
        $this->session->set_flashdata('success', 'Enabled Successfully.');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    public function disable($id)
    {
        $table = base64_decode($this->input->get('table'));
        $this->Administrator_Model->disable($id, $table);
        $this->session->set_flashdata('success', 'Enabled Successfully.');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    public function update_user($id = NULL)
    {
        $data['user'] = $this->Administrator_Model->get_user($id);
        if (empty($data['user'])) {
            show_404();
        }
        $data['title'] = 'Update User';
        $this->load->view('administrator/header-script');
        $this->load->view('administrator/header');
        $this->load->view('administrator/header-bottom');
        $this->load->view('administrator/update-user', $data);
        $this->load->view('administrator/footer');
    }
    public function update_user_data($page = 'update-user')
    {
        if (!file_exists(APPPATH . 'views/administrator/' . $page . '.php')) {
            show_404();
        }
        // Check login
        if (!$this->session->userdata('login')) {
            redirect('administrator/index');
        }
        $data['title'] = 'Update User';
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('administrator/header-script');
            $this->load->view('administrator/header');
            $this->load->view('administrator/header-bottom');
            $this->load->view('administrator/' . $page, $data);
            $this->load->view('administrator/footer');
        } else {
            //Upload Image
            $config['upload_path'] = './assets/images/users';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2048';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {
                $id = $this->input->post('id');
                $data['img'] = $this->Administrator_Model->get_user($id);
                $errors = array('error' => $this->upload->display_errors());
                $post_image = $data['img']['image'];
            } else {
                $data = array('upload_data' => $this->upload->data());
                $post_image = $_FILES['userfile']['name'];
            }
            $this->Administrator_Model->update_user_data($post_image);
            //Set Message
            $this->session->set_flashdata('success', 'User has been Updated Successfull.');
            redirect('administrator/users');
        }
    }
    // Check Product SKU  exists
    public function check_sku_exists($sku)
    {
        $this->form_validation->set_message('check_sku_exists', 'That SKU is already taken, Please choose a different one.');
        if ($this->Administrator_Model->check_sku_exists($sku)) {
            return true;
        } else {
            return false;
        }
    }
    // sliders
    public function create_slider($page = 'add-slider')
    {
        if (!file_exists(APPPATH . 'views/administrator/' . $page . '.php')) {
            show_404();
        }
        // Check login
        if (!$this->session->userdata('login')) {
            redirect('administrator/index');
        }
        $data['title'] = 'Create Sliders Image';
        $this->form_validation->set_rules('title', 'Title', 'required');
        if (empty($_FILES['userfile']['name'])) {
            $this->form_validation->set_rules('userfile', 'Document', 'required');
        }
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('administrator/header-script');
            $this->load->view('administrator/header');
            $this->load->view('administrator/header-bottom');
            $this->load->view('administrator/' . $page, $data);
            $this->load->view('administrator/footer');
        } else {
            //Upload Image
            $config['upload_path'] = './assets/images/sliders';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2048';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {
                $errors = array('error' => $this->upload->display_errors());
                $post_image = 'noimage.jpg';
            } else {
                $data = array('upload_data' => $this->upload->data());
                $post_image = $_FILES['userfile']['name'];
            }
            $this->Administrator_Model->create_slider($post_image);
            //Set Message
            $this->session->set_flashdata('success', 'Slider Image has been created Successfull.');
            redirect('administrator/sliders');
        }
    }
    public function get_sliders()
    {
        $data['sliders'] = $this->Administrator_Model->get_sliders();
        $data['title'] = 'Sliders';
        $this->load->view('administrator/header-script');
        $this->load->view('administrator/header');
        $this->load->view('administrator/header-bottom');
        $this->load->view('administrator/sliders', $data);
        $this->load->view('administrator/footer');
    }
    public function update_mobile()
    {
        $data['mob'] = $this->Administrator_Model->get_mobile_data();
        $data['title'] = 'Update Mobile';
        $this->load->view('admin/update-mobile', $data);
    }
    public function report()
    {
        $this->load->view('admin/download_report');
    }
    public function update_mobile_data($page = 'update-mobile')
    {
        if (!file_exists(APPPATH . 'views/admin/' . $page . '.php')) {
            show_404();
        }
        // Check login
        if (!$this->session->userdata('login')) {
            redirect('admin/index');
        }
        $data['title'] = 'Update Mobile';
        $this->form_validation->set_rules('mobile', 'Mobile No.', 'required');
        $this->Administrator_Model->update_mobile_data();
        //Set Message
        $this->session->set_flashdata('success', 'Mobile No. has been Updated Successfull.');
        redirect('admin/update_mobile');
    }
    public function update_slider_data($page = 'update-slider')
    {
        if (!file_exists(APPPATH . 'views/administrator/' . $page . '.php')) {
            show_404();
        }
        // Check login
        if (!$this->session->userdata('login')) {
            redirect('administrator/index');
        }
        $data['title'] = 'Update Slider';
        $this->form_validation->set_rules('title', 'Title', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('administrator/header-script');
            $this->load->view('administrator/header');
            $this->load->view('administrator/header-bottom');
            $this->load->view('administrator/' . $page, $data);
            $this->load->view('administrator/footer');
        } else {
            //Upload Image
            $config['upload_path'] = './assets/images/sliders';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2048';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {
                $id = $this->input->post('id');
                $data['img'] = $this->Administrator_Model->get_slider_data($id);
                $errors = array('error' => $this->upload->display_errors());
                $post_image = $data['img']['image'];
            } else {
                $data = array('upload_data' => $this->upload->data());
                $post_image = $_FILES['userfile']['name'];
            }
            $this->Administrator_Model->update_slider_data($post_image);
            //Set Message
            $this->session->set_flashdata('success', 'Slider Images has been Updated Successfull.');
            redirect('administrator/sliders');
        }
    }
    // $page = 'charts'
    public function view_chart()
    {
        $data = array();
        $data['title'] = 'Charts';
        $data['charts'] = $this->Administrator_Model->getMatkaDetails();
        // $data['users'] = $this->Administrator_Model->get_users(FALSE, $config['per_page'], $offset);
        $this->load->view('admin/list_charts', $data);
    }
    public function add_chart()
    {
        $data['title'] = 'Charts';
        $data['charts'] = $this->Administrator_Model->getMatkaDetails();
        $this->load->view('admin/add_chart', $data);
    }
    public function edit_profile()
    {
        $this->load->view('admin/edit-profile');
    }
    public function chart_add()
    {
        if (!$this->session->userdata('login')) {
            redirect('admin/index');
        }
        $matkaname = $this->input->post('chart');
        $data = array();
        $data['title'] = 'Charts';
        $name = $this->db->where('name', $matkaname)->get('matka')->row_array()['name'];
        $data['transactions'] = $this->Administrator_Model->getChartDetails($name);
        $data['charts'] = $this->Administrator_Model->getChart();
        $this->Administrator_Model->add_chart_data();
        $this->session->set_flashdata('success', 'Chart has been Added Successfully.');
        redirect('admin/add_chart');
    }
    public function cpassword()
    {
        $this->load->view('admin/change-password');
    }
    public function edit_chart($page = 'charts_edit')
    {
        $data = array();
        $data['yield'] = 'administrator/charts_edit';
        $data['title'] = 'Charts';
        $data['charts'] = $this->Administrator_Model->getMatkaDetails();
        $this->load->view('administrator/header-script');
        $this->load->view('administrator/header');
        $this->load->view('administrator/header-bottom');
        $this->load->view('administrator/' . $page, $data);
        $this->load->view('administrator/footer');
    }
    public function chart_update()
    {
        if (!$this->session->userdata('login')) {
            redirect('admin/index');
        }
        $matkaname = $this->input->post('chart');
        $data = array();
        $data['title'] = 'Charts';
        $name = $this->db->where('name', $matkaname)->get('matka')->row_array()['name'];
        $data['transactions'] = $this->Administrator_Model->getChartDetails($name);
        $data['charts'] = $this->Administrator_Model->getChart();
        $this->Administrator_Model->update_chart_data();
        //Set Message
        $this->session->set_flashdata('success', 'Chart has been Updated Successfully.');
        redirect('admin/add_chart');
    }
    public function chartshow($page = 'chartshow')
    {
        $matkaname = $this->input->post('chart');
        $name = $this->db->where('name', $matkaname)->get('matka')->row_array()['name'];
        $data['transactions'] = $this->Administrator_Model->getChartDetails($name);
        if ($data['transactions'] == NULL) {
            echo '<p class="text-center text-warning">Sorry! No Information Found</p>';
        } else {
            $this->load->view('admin/chartshow', $data);
        }
    }
    public function chartupdate($page = 'chartupdate')
    {
        $matkaname = $this->input->post('chart');
        $name = $this->db->where('name', $matkaname)->get('matka')->row_array()['name'];
        $data['transactions'] = $this->Administrator_Model->getChartDetails($name);
        $this->load->view('administrator/header-script');
        $this->load->view('administrator/header');
        $this->load->view('administrator/header-bottom');
        $this->load->view('administrator/' . $page, $data);
        $this->load->view('administrator/footer');
    }
    public function add_matka($page = 'add-matka')
    {
        // Check login
        if (!$this->session->userdata('login')) {
            redirect('admin/index');
        }
        $data['title'] = '';
        $data['users'] = $this->Administrator_Model->getUserDetails();
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/add_matka', $data);
        } else {
            $ref = $this->Administrator_Model->add_daily_market();
            ;
            //Set Message
            redirect('admin/matka/' . $ref);
        }

    }
    public function add_matka2()
    {
        // Check login
        if (!$this->session->userdata('login')) {
            redirect('admin/index');
        }
        $data['title'] = 'Add Updates';
        $data['users'] = $this->Administrator_Model->getUserDetails();
        if ($this->input->post('add_matka2')) {
            $x = $this->Administrator_Model->add_daily_market();
            if ($x)
                $this->session->set_flashdata('success', 'Matka has been Added Successfully.');
            else
                redirect('admin/matka/list');
        }
        $this->load->view('admin/add_matka', $data);
    }
    public function list_matka($offset = 0, $type = 'matka')
    {
        // Pagination Config
        $config['base_url'] = base_url() . 'administrator/matka/';
        $config['total_rows'] = $this->db->count_all('matka');
        $config['per_page'] = FALSE;
        $config['attributes'] = array('class' => 'paginate-link');
        // Init Pagination
        $this->pagination->initialize($config);
        $data['title'] = 'List of Live Updates';
        $data['teams'] = $this->Administrator_Model->listmatka(FALSE, $config['per_page'], $offset, $type);
        $this->load->view('admin/matka', $data);
    }
    public function update_matka($teamId)
    {
        // Check login
        if (!$this->session->userdata('login')) {
            redirect('admin/index');
        }
        $data['title'] = 'Update Live Updates';
        $data['users'] = $this->Administrator_Model->getUserDetails();
        $data['team'] = $this->Administrator_Model->listmatka($teamId);
        $this->form_validation->set_rules('name', 'Matka Name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/update_matka', $data);
        } else {
            $this->Administrator_Model->update_team_data();
            $id = $this->input->post('id');
            $snum = $this->input->post('snum');
            $enum = $this->input->post('snum');
            $num = $this->input->post('num');
            $udate = $this->input->post('udate');
            $set_winner = false;
            $send_notifications = true;
            //Send Notifications
            if ($send_notifications):
                $message = $snum . '-' . $num;
                if ($enum != null)
                    $message .= '-' . $enum;
                @send_notice("", $this->input->post('name'), $message);
            endif;
            //Set Winner
            if ($set_winner):
                $data = array(
                    'matka_id' => $id,
                    'snum' => $snum,
                    'num' => $num,
                    'enum' => $enum
                );
                $closed = ($enum) ? '1' : 0;
                $this->Game_model->getWinner($data, $udate, $closed);
            endif;
            //Set Message
            $this->session->set_flashdata('success', 'Matka has been Updated Successfully.');
            redirect('admin/matka/list');
        }
    }
    public function gamedata()
    {
        $data['matka'] = $this->Administrator_Model->getMatkaName();
        $data['games'] = $this->Administrator_Model->games();
        $bettype = array("Open" => "open", "Closed" => "close");
        $data['from_date'] = $date_from = ($this->input->get('from_date')) ?: date('Y-m-d');
        $data['to_date'] = $date_to = ($this->input->get('from_date')) ?: date('Y-m-d');
        $matka_id = $this->input->get('matka_id');
        $type = $this->input->get('bettype');
        $game_id = $this->input->get('game_id');
        $user_id = $this->input->get('user_id');
        $status = $this->input->get('status');
        $winning_ank = $this->input->get('winning_ank');
        if ($winning_ank == "") {
            $winning_ank = $this->input->get('winning_ank_close');
        }
        $data['select_matka'] = $matka_id;
        $data['winning_ank'] = $winning_ank;
        $data['bettype'] = $bettype;
        $data['type'] = $type;
        $data['gamedata'] = $this->Game->totalGameData(
            $matka_id,
            $type,
            $game_id,
            $user_id,
            $status,
            $date_from,
            $date_to,
            $winning_ank
        );
        $this->load->view('admin/gamedata', $data);
    }
    public function deletegamedata($id)
    {
        $this->Administrator_Model->deletegamedata($id);
        $this->session->set_flashdata('danger', 'Login Credential in invalid!');
        $this->session->set_flashdata('delete', '<div class="alert alert-success">Game data deleted successfully</div>');
        redirect('admin/gamedata');
    }
    public function update_matka_point($id)
    {
        // Check login
        if (!$this->session->userdata('login')) {
            redirect('admin/index');
        }
        $data['title'] = 'Set Winner';
        $data['users'] = $this->Administrator_Model->getUserDetails();
        $data['team'] = $this->Administrator_Model->listmatka($id);
        $this->form_validation->set_rules('udate', 'Set Date', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/set-winner', $data);
        } else {
            //Set Winner
            $matka = $data['team'];
            $udate = $this->input->post('udate');
            $setWinner = strtotime(date("Y-m-d")) - strtotime(date("Y-m-d", strtotime($matka['updated_at'])));
            if ($setWinner != 0) {
                //Set Message
                $this->session->set_flashdata('warning', 'Matka not Updated. First update to set Winner.');
            }
            $data = array(
                'matka_id' => $id,
                'snum' => $matka['starting_num'],
                'num' => $matka['number'],
                'enum' => $matka['end_num']
            );
            $closed = ($matka['end_num']) ? '1' : 0;
            $this->Game_model->getWinner($data, $udate, $closed);
            $this->Chart_Model->declare_result($id, $udate, $closed);
            //Set Message
            $this->session->set_flashdata('success', 'Matka Point distributed to all users.');
        }
    }
    public function winner_list()
    {
        if (!$this->session->userdata('login')) {
            redirect('admin/index');
        }
        $id = $this->input->post('matkaid');
        $bet_type = $this->input->post('bet_type');
        $data['title'] = 'Set Winner';
        $data['users'] = $this->Administrator_Model->getUserDetails();
        $data['team'] = $this->Administrator_Model->listmatka($id);
        $this->form_validation->set_rules('udate', 'Set Date', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/set-winner', $data);
        } else {
            //Set Winner
            $matka = $data['team'];
            $udate = $this->input->post('udate');
            $setWinner = strtotime(date("Y-m-d")) - strtotime(date("Y-m-d", strtotime($matka['updated_at'])));
            if ($setWinner != 0) {
                //Set Message
                $matka_name_w = "Matka";
                $redir = 'admin/games_provider';
                if ($id > 100) {
                    $matka_name_w = "Starline";
                    $redir = 'admin/manage_starline';
                }
                $this->session->set_flashdata('warning', $matka_name_w . ' not Updated. First update to set Winner.');
                redirect($redir);
            }
            $is_jackpot = 0;
            if ($id > 100): // Starline
                $res = explode('-', $matka['s_game_number']);
                $matka['starting_num'] = $res[0];
                $matka['number'] = isset($res[1]) ? $res[1] : "";
                $matka['end_num'] = "";
            endif;
            $matka_det = array(
                'matka_id' => $id,
                'snum' => $matka['starting_num'],
                'num' => $matka['number'],
                'enum' => $matka['end_num']
            );
            $closed = ($bet_type == 'Close') ? '1' : 0;
            $winner_array = $this->Game_model->getWinnerlist($matka_det, $udate, $closed, $is_jackpot);
            $data['winner_array'] = is_array($winner_array) ? $winner_array[0] : array();
            $data['udate'] = $udate;
            if (is_array($winner_array)) {
                $this->load->view('admin/game_winner_list', $data);
            }
        }
    }
    public function starline_update($id)
    {
        $data['users'] = $this->Administrator_Model->starline_update($id);
        $this->load->view('admin/starline_update', $data);
    }
    public function starline_update2($id)
    {
        // Check login
        if (!$this->session->userdata('login')) {
            redirect('admin/index');
        }
        $data['title'] = 'Update Starline';
        $snum = trim($this->input->post('snum'));
        $w = $this->Administrator_Model->starline_update2($id, $snum);
        $snums = explode('-', $snum)[0];
        $num = explode('-', $snum)[1];
        //Set Winner
        $data = array(
            'matka_id' => $id,
            'snum' => $snums,
            'num' => $num,
            'enum' => 0
        );
        $this->Game_model->getStarlineWinner($data);
    }
    public function member_list_team($offset = 0)
    {
        // Pagination Config
        $config['base_url'] = base_url() . 'admin/matka/';
        $config['total_rows'] = $this->db->count_all('matka');
        $config['per_page'] = FALSE;
        $config['attributes'] = array('class' => 'paginate-link');
        // Init Pagination
        $this->pagination->initialize($config);
        $id = $this->session->userdata('user_id');
        $data['title'] = 'List of Live Updates';
        $data['teams'] = $this->Administrator_Model->memberlistteams($id);
        $this->load->view('admin/matka', $data);
    }
    public function get_admin_data()
    {
        $data['changePassword'] = $this->Administrator_Model->get_admin_data();
        $data['title'] = 'Change Password';
        $this->load->view('admin/change-password', $data);
    }
    //updated view_users function on 13/1/21
    public function view_users($type = FALSE, $id = FALSE)
    {
        if ($type) {
            if ($type == "activate" && $id) {
                if ($this->Administrator_Model->enable_user($id, "user_profile"))
                    $this->session->set_flashdata('success', 'User activated successfully.');
            }
            if ($type == "deactivate" && $id) {
                if ($this->Administrator_Model->disable_user($id, "user_profile"))
                    $this->session->set_flashdata('success', 'User deactivated successfully.');
            }
            if ($type == "userbank_allow" && $id) {
                if ($this->Administrator_Model->userbank_allow($id, "user_profile"))
                    $this->session->set_flashdata('success', 'Permission allowed successfully.');
            }
            if ($type == "userbank_block" && $id) {
                if ($this->Administrator_Model->userbank_block($id, "user_profile"))
                    $this->session->set_flashdata('success', 'Permission blocked successfully.');
            }
            $this->session->set_flashdata("status", $status);
            redirect($_SERVER['HTTP_REFERER']); //site_url("admin/view_users")
        }
        if (isset($_POST['update_user'])) {
            if ($this->Administrator_Model->update_user_profile_data())
                $this->session->set_flashdata('success', 'User updated successfully.');
        }
        $data['changePassword'] = $this->Administrator_Model->get_admin_data();
        $data['title'] = 'view ';
        $data['users'] = $this->Administrator_Model->get_user_profile();
        $this->load->view('admin/view_users', $data);
    }
    public function delete_user($action, $id, $mobile)
    {
        if ($action == "delete" && $id != ""):
            if ($this->Administrator_Model->delete_user($id, "user_profile", $mobile))
                $this->session->set_flashdata("success", "User profile deleted successfully.");
            redirect(site_url("admin/view_users"));
        endif;
    }
    public function view_games($id = NULL)
    {
        $data['title'] = 'view ';
        $data['matka_id'] = $id;
        $data['users'] = $this->Administrator_Model->get_games($id);
        $this->load->view('admin/view_games', $data);
    }
    public function view_point_lists($id = NULL)
    {
        $data['title'] = 'view ';
        $data['matka_id'] = $id;
        $data['users'] = $this->Administrator_Model->get_point_lists($id);
        $this->load->view('admin/view_point_lists', $data);
    }
    public function view_user_games()
    {
        $matka_id = $this->input->get('matka_id');
        $game_id = $this->input->get('game_id');
        $data['title'] = 'view ';
        $data['game_id'] = $game_id;
        $data['matka_id'] = $matka_id;
        $data['users'] = $this->Administrator_Model->get_user_games($game_id, $matka_id);
        $this->load->view('admin/view_user_games', $data);
    }
    public function view_history()
    {
        $matka_id = $this->input->get('matka_id');
        $game_id = $this->input->get('game_id');
        $user_id = $this->input->get('user_id');
        $data['title'] = 'view ';
        $data['game_id'] = $game_id;
        $data['matka_id'] = $matka_id;
        $data['users'] = $this->Administrator_Model->get_history($user_id, $matka_id, $game_id);
        $this->load->view('admin/view_game_history', $data);
    }
    public function app_bid_history()
    {
        $user_id = $this->input->get('user_id');
        $data['title'] = 'view ';
        $data['users'] = $this->Administrator_Model->get_bid_history($user_id);
        $this->load->view('admin/app_bid_history', $data);
    }
    public function app_startline_bid_history()
    {
        $user_id = $this->input->get('user_id');
        $data['title'] = 'view ';
        $data['users'] = $this->Administrator_Model->get_startline_bid_history($user_id);
        $this->load->view('admin/app_bid_history', $data);
    }
    public function add_wallet($user_mobile = "", $type = "add")
    {
        $this->load->view('admin/add_wallet', ['user_mobile' => $user_mobile, 'type' => $type]);
    }
    public function add_wallet2()
    {
        $no = $this->input->post('no');
        $wa = $this->input->post('wa');
        $data['users'] = $this->Administrator_Model->add_wallet($no);
        foreach ($data['users'] as $u):
            $data['check'] = $this->Administrator_Model->check_wallet($u['id']);
            $this->Administrator_Model->add_point_req_by_admin($wa, $u['id']);
            if ($data['check'] == NULL) {
                $data['wal'] = $this->Administrator_Model->add_wallet3($u['id'], $wa);
                if ($data['wal'] == TRUE)
                    $this->session->set_flashdata('point_st', 'Points Added successfully.');
            } else {
                $data['wal'] = $this->Administrator_Model->add_wallet2($u['id'], $wa);
                if ($data['wal'] == TRUE)
                    $this->session->set_flashdata('point_st', 'Points Added successfully.');
            }
        endforeach;
        redirect('admin/add_wallet');
    }
    public function notify()
    {
        $this->load->view('admin/add_notification');
    }
    public function notify2()
    {
        $users = array();
        $no = $this->input->post('noti');
        $query = "Insert into tblNotification(notification) values('$no')";
        $d = $this->Administrator_Model->notify($query);
        $user_ids_data = $this->db->where(['on_notif' => 1, 'status' => 'active', 'user_ios_token!=' => ""])->get('user_profile')->result();
        foreach ($user_ids_data as $id) {
            $users[] = $id->user_ios_token;
        }
        @send_notice($users, 'Cashwin', $no);
        if ($d)
            redirect('admin/notify');
    }
    public function add_point_req()
    {
        $data['title'] = 'view ';
        $data['users'] = $this->Administrator_Model->add_point_req();
        $this->load->view('admin/add_point_req', $data);
    }
    public function add_point_req2($req_id = NULL)
    {
        $req = $this->Administrator_Model->add_point_req2($req_id, $this->input->post('approve_comment'));
        $data['title'] = 'view ';
        foreach ($req as $r) {
            $user_id = $r['user_id'];
            $points = $r['request_points'];
            $t = $this->Administrator_Model->add_point_req3($user_id, $points);
        }
        $this->session->set_flashdata(["status" => "Add points request approved successfully."]);
        if ($t)
            redirect($_SERVER['HTTP_REFERER']); //'admin/add_point_req'
    }
    public function add_point_req_cancel($req_id = NULL)
    {
        $req = $this->Administrator_Model->point_req_cancel($req_id, $this->input->post('cancel_comment'));
        $this->session->set_flashdata(["status" => "Add points request Cancelled successfully."]);
        if ($req) {
            redirect('admin/add_point_req');
        }
    }
    public function withdraw_point_req()
    {
        $data['users'] = $this->Administrator_Model->withdraw_point_req();
        $this->load->view('admin/withdraw_point_req', $data);
    }
    public function withdraw_point_req2($id = NULL)
    {
        $req = $this->Administrator_Model->withdraw_point_req2($id, $this->input->post('approve_comment'));
        $data['title'] = 'view ';
        $user_id = $req['user_id'];
        $points = $req['request_points'];
        $t = $this->Administrator_Model->withdraw_point_req3($user_id, $points);
        $this->session->set_flashdata(["status" => "Withdraw points request approved successfully."]);
        if ($t)
            redirect($_SERVER['HTTP_REFERER']);
    }
    public function withdraw_point_req_cancel($req_id = NULL)
    {
        $req = $this->Administrator_Model->point_req_cancel($req_id, $this->input->post('cancel_comment'));
        $this->session->set_flashdata(["status" => "Withdraw point request Cancelled successfully."]);
        if ($req)
            redirect($_SERVER['HTTP_REFERER']);
    }
    public function change_password($page = 'change-password')
    {
        if (!file_exists(APPPATH . 'views/admin/' . $page . '.php')) {
            show_404();
        }
        // Check login
        if (!$this->session->userdata('login')) {
            redirect('admin/index');
        }
        $data['title'] = 'Change password';
        $this->form_validation->set_rules('old_password', 'Old Password', 'required|callback_match_old_password');
        $this->form_validation->set_rules('new_password', 'New Password Field', 'required');
        $this->form_validation->set_rules('confirm_new_password', 'Confirm New Password', 'matches[new_password]');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/' . $page, $data);
        } else {
            $this->Administrator_Model->change_password($this->input->post('new_password'));
            //Set Message
            $this->session->set_flashdata('success', 'Password Has Been Changed Successfull.');
            redirect('admin/change-password');
        }
    }
    public function user_passbook()
    {
        $data['users'] = $this->db->get('user_profile')->result();
        $this->load->view('admin/user_passbook', $data);
    }
    public function passbook()
    {
        if (isset($_POST['submitw'])) {
            $user = $this->input->post('user');
            $data['details'] = $this->Administrator_Model->point_req($user);
            $data['curr_wallet'] = $this->db->select('wallet_points')->where('user_id', $user)->get('tblwallet')->row()->wallet_points;
            $data['from_date'] = $date_from = ($this->input->get('from_date')) ?: date('Y-m-d');
            $this->load->view('admin/passbook.php', $data);
        } else {
            redirect('admin/user_passbook');
        }
    }
    // Check user name exists
    public function match_old_password($old_password)
    {
        $this->form_validation->set_message('match_old_password', 'Current Password Does not matched, Please Try Again.');
        $password = md5($old_password);
        $que = $this->Administrator_Model->match_old_password($password);
        if ($que) {
            return true;
        } else {
            return false;
        }
    }
    public function update_admin_profile()
    {
        $data['user'] = $this->Administrator_Model->get_admin_data();
        $data['title'] = 'Update Profile';
        $this->load->view('admin/update-profile', $data);
    }
    public function update_admin_profile_data($page = 'update-profile')
    {
        if (!file_exists(APPPATH . 'views/admin/' . $page . '.php')) {
            show_404();
        }
        // Check login
        if (!$this->session->userdata('login')) {
            redirect('admin/index');
        }
        $data['title'] = 'Update Profile';
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/' . $page, $data);
        } else {
            //Upload Image
            $config['upload_path'] = './assets/images/users';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2048';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {
                $id = $this->input->post('id');
                $data['img'] = $this->Administrator_Model->get_user($id);
                $errors = array('error' => $this->upload->display_errors());
                $post_image = $data['img']['image'];
            } else {
                $data = array('upload_data' => $this->upload->data());
                $post_image = $_FILES['userfile']['name'];
            }
            $this->Administrator_Model->update_user_data($post_image);
            //Set Message
            $this->session->set_flashdata('success', 'User has been Updated Successfull.');
            redirect('admin/update-profile');
        }
    }
    //forget password functions start
    public function forget_password_mail()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|callback_validate_credentials');
        //check if email is in the database
        $this->load->model('Administrator_Model');
        if ($this->Administrator_Model->email_exists()) {
            //$them_pass is the varible to be sent to the user's email
            $temp_pass = md5(uniqid());
            //send email with #temp_pass as a link
            $this->load->library('email', array('mailtype' => 'html'));
            $this->email->from('admin1234567@gmail.com', "Site");
            $this->email->to($this->input->post('email'));
            $this->email->subject("Reset your Password");
            $message = "<p>This email has been sent as a request to reset our password</p>";
            $message .= "<p><a href='" . base_url() . "administrator/reset-password/$temp_pass'>Click here </a>if you want to reset your password,
                        if not, then ignore</p>";
            $this->email->message($message);
            if ($this->email->send()) {
                $this->load->model('Administrator_Model');
                if ($this->Administrator_Model->temp_reset_password($temp_pass)) {
                    echo "check your email for instructions, thank you";
                }
            } else {
                echo "email was not sent, please contact your administrator";
            }
        } else {
            echo "your email is not in our database";
        }
    }
    public function reset_password($temp_pass)
    {
        $this->load->model('Administrator_Model');
        if ($this->Administrator_Model->is_temp_pass_valid($temp_pass)) {
            $this->load->view('reset-password');
            //once the user clicks submit $temp_pass is gone so therefore I can't catch the new password and   //associated with the user...
        } else {
            echo "the key is not valid";
        }
    }
    public function update_password()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]');
        if ($this->form_validation->run()) {
            echo "passwords match";
        } else {
            echo "passwords do not match";
        }
    }
    public function login()
    {
        $this->load->view('admin/login');
    }
    public function forgot_password()
    {
        $this->load->view('admin/forgot_password');
    }
    public function profile()
    {
        $this->load->view('admin/profile');
    }
    public function view_notification()
    {
        $data['notification'] = $this->Administrator_Model->getNotification();
        $this->load->view('admin/view_notification', $data);
    }
    public function market_gamerate($game_type)
    {
        $data['games'] = $this->Administrator_Model->games($game_type);
        $this->load->view('admin/market_gamerate', $data);
        if (isset($_POST['update'])) {
            $this->Administrator_Model->update_game_rate($this->input->post('update'), $game_type);
            $this->session->set_flashdata('success', 'Game Rate has been updated successfully.');
            echo "<script>history.go(-1)</script>";
        }
    }
    public function gamerate()
    {
        $data['games'] = $this->Administrator_Model->games_rate();
        $this->load->view('admin/gamerate', $data);
        if (isset($_POST['update'])) {
            $this->Administrator_Model->update_game_and_starline_rate($this->input->post('update'));
            $this->session->set_flashdata('success', 'Game Rate has been updated successfull.');
            redirect('admin/gamerate');
        }
    }
    public function market_profit_loss()
    {
        $data['matka'] = $this->Administrator_Model->getMatkaName();
        $data['games'] = $this->Administrator_Model->games();
        $data['title'] = "Profit/Loss Calculations";
        $data['select_date'] = "";
        $data['select_matka'] = "";
        $data['select_session'] = "";
        $data['select_user'] = " ";
        $data['record'] = array();
        if (isset($_POST['prof_loss'])) {
            $matka = $this->input->post('matka');
            $player_id = $this->input->post('hide_player_id');
            $player_name = $this->input->post('player_name');
            $q = $this->db->select('digits,SUM(tblgamedata.points) as amt, tblgamedata.game_id,tblgamedata.matka_id,tblgame.points as p,tblgamedata.bet_type,tblgamedata.date,tblgamedata.time,tblgamedata.status')->join('tblgame', 'tblgamedata.game_id=tblgame.game_id')->where('matka_id', $matka)->where('user_id', $player_id)->group_by('tblgamedata.game_id,tblgamedata.digits')->order_by('tblgamedata.game_id')->get('tblgamedata')->result();
            $q1 = $this->db->select('tblgame.*,digits,SUM(tblgamedata.points) as amt, tblgamedata.game_id,tblgamedata.matka_id,tblgamedata.bet_type,tblgamedata.date,tblgamedata.time,tblgamedata.status')->join('tblgamedata', 'tblgame.game_id=tblgamedata.game_id', 'left')->where('tblgamedata.matka_id', $matka)->where('user_id', $player_id)->group_by('tblgamedata.game_id')->get('tblgame')->result();
            $data['record'] = $q;
            $data['game_bids'] = $q1;
            $data['select_date'] = $originalDate;
            $data['select_matka'] = $matka;
            $data['select_session'] = $session;
            $data['select_user'] = $player_name;
            $data['matka'] = $this->Administrator_Model->getMatkaName();
            $data['games'] = $this->Administrator_Model->games();
        }
        $this->load->view('admin/market_profit_loss', $data);
    }
    public function customer_sale_report1()
    {
        $data['matka'] = $this->Administrator_Model->getMatkaName();
        $data['games'] = $this->Administrator_Model->games();
        $data['select_matka'] = "";
        $data['select_game'] = "";
        $data['select_session'] = "";
        if (isset($_POST['sbmt_btn'])) {
            $date = date('d/m/Y', strtotime($this->input->post('select_date')));
            $matka = $this->input->post('matka');
            $game_type = $this->input->post('game');
            $session = $this->input->post('session');
            $data['select_matka'] = $matka;
            $data['select_game'] = $game_type;
            $data['select_session'] = $session;
            $data['select_date'] = $this->input->post('select_date');
            $this->db->select('digits,SUM(points) as points');
            $this->db->where('date', $date);
            $this->db->where('matka_id', $matka);
            $this->db->where('bet_type', $session);
            $this->db->where('game_id', $game_type)->group_by('digits');
            $result = $this->db->get('tblgamedata')->result();
            if ($game_type == 2) {
                $data['single_digit'] = $result;
            }
            if ($game_type == 3) {
                $data['jodi_digit'] = $result;
            }
            if ($game_type == 7) {
                $data['single_pana'] = $result;
            }
            if ($game_type == 8) {
                $data['double_pana'] = $result;
            }
            if ($game_type == 9) {
                $data['triple_pana'] = $result;
            }
        } else {
            $data['single_digit'] = $this->db->select('digits,SUM(points) as points')->where('game_id', 2)->group_by('digits')->get('tblgamedata')->result();
            $data['jodi_digit'] = $this->db->select('digits,SUM(points) as points')->where('game_id', 3)->group_by('digits')->get('tblgamedata')->result();
            $data['single_pana'] = $this->db->select('digits,SUM(points) as points')->where('game_id', 7)->group_by('digits')->get('tblgamedata')->result();
            $data['double_pana'] = $this->db->select('digits,SUM(points) as points')->where('game_id', 8)->group_by('digits')->get('tblgamedata')->result();
            $data['triple_pana'] = $this->db->select('digits,SUM(points) as points')->where('game_id', 9)->group_by('digits')->get('tblgamedata')->result();
        }
        $this->load->view('admin/customer_sale_report1', $data);
    }
    public function user_bid_history_old()
    {
        $data['matka'] = $this->Administrator_Model->getMatkaName();
        $data['games'] = $this->Administrator_Model->games();
        $data['select_sdate'] = "";
        $data['select_edate'] = "";
        $data['select_matka'] = "";
        $data['select_game'] = "";
        $data['select_session'] = "";
        $data['record'] = $this->db->select('tblgamedata.*,user_profile.username,matka.name,tblgame.name as game_type,')
            ->join('user_profile', 'tblgamedata.user_id=user_profile.id')
            ->join('matka', 'tblgamedata.matka_id=matka.id')
            ->join('tblgame', 'tblgamedata.game_id=tblgame.game_id')
            ->get('tblgamedata')->result();
        $this->load->view('admin/user_bid_history', $data);
    }
    public function winning_prediction2()
    {
        $this->load->view('admin/winning_prediction', $data);
    }
    public function bid_history()
    {
        $this->load->view('admin/bid_history');
    }
    public function sell_report()
    {
        $this->load->view('admin/sell_report');
    }
    public function game_number_data($type = "single-digit")
    {
        $data['prefix'] = "";
        $data['game_type'] = "digit";
        switch ($type) {
            case "single-digit":
                $data['rang'] = range(0, 9);
                break;
            case "jodi-digit":
                $data['rang'] = range(00, 99);
                $data['prefix'] = "0";
                break;
            case "single-pana":
                $data['rang'] = $this->Game_model->pana_digits($type);
                $data['game_type'] = "pana";
                break;
            case "double-pana":
                $data['rang'] = $this->Game_model->pana_digits($type);
                $data['game_type'] = "pana";
                break;
            case "tripple-pana":
                $data['rang'] = $this->Game_model->pana_digits($type);
                $data['prefix'] = "00";
                break;
            case "half-sangam":
                $data['single_ank'] = range(0, 9);
                $data['rang'] = $this->Game_model->pana_digits('all');
                $data['game_type'] = "pana";
                break;
            case "full-sangam":
                $data['single_ank'] = $this->Game_model->pana_digits('all');
                $data['rang'] = $this->Game_model->pana_digits('all');
                $data['game_type'] = "pana";
                break;
            default:
                break;
        }
        $data['type'] = $type;
        $this->load->view('admin/game_number_data', $data);
    }
    public function winning_prediction3($type = "single-digit")
    {
        $data['prefix'] = "";
        $data['game_type'] = "digit";
        switch ($type) {
            case "single-digit":
                $data['rang'] = range(0, 9);
                break;
            case "jodi-digit":
                $data['rang'] = range(00, 99);
                $data['prefix'] = "0";
                break;
            case "single-pana":
                $data['rang'] = range(0, 9);
                $data['num_range'] = ['123', '137', '145'];
                $data['game_type'] = "pana";
                break;
            case "double-pana":
                $data['rang'] = range(0, 9);
                $data['num_range'] = ['123', '137', '145'];
                $data['game_type'] = "pana";
                break;
            case "tripple-pana":
                $data['rang'] = range(000, 999, 111);
                $data['prefix'] = "00";
                break;
            case "half-sangam":
                $data['rang'] = range(0, 9);
                $data['num_range'] = ['123', '137', '145'];
                $data['game_type'] = "pana";
                break;
            case "full-sangam":
                $data['rang'] = range(0, 9);
                $data['num_range'] = ['123', '137', '145'];
                $data['game_type'] = "pana";
                break;
            default:
                break;
        }
        $data['type'] = $type;
        $this->load->view('admin/winning_prediction3', $data);
    }
    public function single_pana()
    {
        $data['rang'] = range(00, 99);
        $this->load->view('admin/single_pana', $data);
    }
    public function game_number_data2()
    {
        $this->load->view('admin/game_number_data');
    }
    public function user_enquiry()
    {
        $data['users'] = $this->Administrator_Model->getUserEnquiry();
        $this->load->view('admin/user_enquiry', $data);
    }
    public function update_matka_status($id)
    {
        $status = $this->db->query("select status from matka where id =$id")->row()->status;
        if ($status == 'active') {
            $enquirystatus = 'inactive';
            $this->session->set_flashdata('success', 'User deactivated successfully.');
        } else {
            $enquirystatus = 'active';
            $this->session->set_flashdata('success', 'User deactivated successfully.');
        }
        $data = array('status' => $enquirystatus);
        $this->db->where('id', $id);
        $this->db->update('matka', $data);
        echo "<script>history.go(-1)</script>";
    }
    public function index2($type = "", $id = "", $page = 'index')
    {
        if (!$this->session->userdata('login')) {
            redirect(site_url("admin/login"));
        }
        if (!file_exists(APPPATH . 'views/admin/' . $page . '.php')) {
            show_404();
        }
        $data['total_wallet_amt'] = $this->Administrator_Model->getTotalWalletAmt();
        $data['total_users'] = $this->Administrator_Model->get_total_users();
        $data['mumbai_matkas'] = $this->Administrator_Model->getMumbaiMatkaDetails();
        $data['all_matkas'] = $this->Administrator_Model->getMatkaDetails();
        $data['pending_req'] = $this->Administrator_Model->add_pending_point_req();
        $data['users'] = $this->Administrator_Model->get_unapproved_user_profile();
        $data['total_bid_amount'] = $this->Administrator_Model->get_today_bid_amount();
        if ($type == "userbank_allow" && $id) {
            if ($this->Administrator_Model->userbank_allow($id, "user_profile"))
                $this->session->set_flashdata('success', 'Permission allowed successfully.');
            redirect(site_url("admin/index2"));
        }
        if (isset($_POST['market_sbmt'])) {
            $matka_id = $this->input->post('market_id');
            $data['market_amount'] = $this->Administrator_Model->get_today_matka_bid_amount($matka_id);
            $data['selected_matka_id'] = $matka_id;
        }
        $this->load->view('admin/index2', $data);
    }
    public function change_security_pin($id)
    {
        $x = $this->Administrator_Model->update_user_pin($id);
        if ($x) {
            $this->session->set_flashdata('success', 'PIN changed successfully.');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function declare_result_ajax()
    {
        $id = $this->input->post('id');
        $snum = $this->input->post('snum');
        $enum = $this->input->post('enum');
        $num = $this->input->post('num');
        $bettype = $this->input->post('bettype');
        $response_data = $this->Administrator_Model->declare_mataka_result_in_db($id, $snum, $enum, $num, $bettype);
        $matka_data = $this->db->where('id', $id)->get('matka')->row();
        $name = $this->input->post('name') ?? ($matka_data ? $matka_data->name : "");
        if ($bettype == 'Close') {
            $r_num = $matka_data->number . $num;
            $number = $r_num;
            $end_number = $snum;
            $start_number = $matka_data->starting_num;
        }
        if (empty($bettype)) {
            $number = $num;
            $end_number = (!empty($enum)) ? $enum : NULL;
            $start_number = (!empty($snum)) ? $snum : NULL;
        }
        if ($bettype == 'Open') {
            $number = $num;
            $end_number = (!empty($enum)) ? $enum : NULL;
            $start_number = (!empty($snum)) ? $snum : NULL;
        }
        $set_winner = false;
        $send_notifications = true;
        //Send Notifications
        if ($send_notifications):
            $message = $start_number . '-' . $number;
            if ($end_number != null)
                $message .= '-' . $end_number;
            @send_notice("", $name, $message);
        endif;
        echo $response_data;
    }
    public function declare_result($type)
    {
        $id = $this->input->post('id');
        $bettype = $this->input->post('bettype');
        $snum = $this->input->post('snum');
        $enum = $this->input->post('enum');
        $num = $this->input->post('num');
        $udate = $this->input->post('udate');
        $data['select_matka'] = $id;
        if ($type == 'matka' || $type == 'dmatka') {
            $data['matka'] = $this->Administrator_Model->getMatkaName($type);
        }
        if ($type == 'starline') {
            $data['matka'] = $this->Administrator_Model->getStarinMatkaName();
        }
        $data['bettype'] = $bettype;
        $pana_type = 'all';
        $data['pana_digit'] = $this->Game_model->pana_digits($pana_type);
        $d = ($this->input->get('date_val')) ?: date('Y-m-d');
        //Set Winner
        if ($set_winner):
            $data = array(
                'matka_id' => $id,
                'snum' => $start_number,
                'num' => $number,
                'enum' => $end_number
            );
            $closed = ($end_number) ? '1' : 0;
            $this->Game_model->getWinner($data, $udate, $closed);
        endif;
        $data['date_val'] = $d;
        $data['chart_data'] = $this->Administrator_Model->getChartData($d, $type);
        $data['data_team'] = $matka_data;
        $data['id'] = $id;
        $data['number'] = $number;
        $data['snum'] = $snum;
        $data['game_type'] = $type;
        $this->load->view("admin/declare_result", $data);
    }
    public function fetch_matka_data()
    {
        $id = $this->input->post('a');
        $game_type = $this->input->post('game_type');
        $date = isset($_POST['c']) ? ($_POST['c']) : date('Y-m-d');
        if ($matka_data->open_declare_date == "0000-00-00 00:00:00")
            $matka_data->open_declare_date = NULL;
        if ($matka_data->close_declare_date == "0000-00-00 00:00:00")
            $matka_data->close_declare_date = NULL;
        echo json_encode($matka_data);
    }
    public function check_declare_result()
    {
        $matka_id = $this->input->post('matkaid');
        $date = date('d/m/Y', strtotime($this->input->post('date')));
        $bet_type = ($this->input->post('bet_type') == 'Open') ? 'open' : 'close';
        $response = $this->Administrator_Model->check_declare_result($matka_id, $date, $bet_type);
        echo json_encode($response);
    }
    public function get_winner_list_ajax()
    {
        $matka_id = $this->input->post('matkaid');
        $date = date('d/m/Y', strtotime($this->input->post('searchdate')));
        $bet_type = ($this->input->post('bet_type') == 'Open') ? 'open' : 'close';
        $data['post'] = $this->Administrator_Model->get_winner_list_ajax($matka_id, $date, $bet_type);
        $this->load->view('admin/game_winner_list', $data);
    }
    public function result_history($game_type)
    {
        $d = "";
        $data['chart_data'] = $this->Administrator_Model->getChartData($d = "", $game_type);
        $data['game_type'] = $game_type;
        $this->load->view('admin/result_history', $data);
    }
    public function update_starline_points($id)
    {
        $starline_data = $this->db->where('id', $id)->get('tblStarline')->row();
        $snum = $starline_data->s_game_number;
        $snums = explode('-', $snum)[0];
        $num = explode('-', $snum)[1];
        //Set Winner
        $data = array(
            'matka_id' => $id,
            'snum' => $snums,
            'num' => $num,
            'enum' => 0
        );
        $this->Game_model->getStarlineWinner($data);
        $this->session->set_flashdata('success', 'Declare Successfully.');
        redirect(site_url("admin/declare_result/starline"));
    }
    public function reverse_game()
    {
        $matka_id = $this->input->post('matkaid');
        $game_date = date('Y-m-d', strtotime($this->input->post('date')));
        $bet_type = ($this->input->post('bet_type') != 'both') ? $this->input->post('bet_type') : "";
        if (true):
            if ($bet_type == 'open') {
                $this->db->set(['starting_num' => "", 'number' => "", 'end_num' => ""])->where(['id' => $matka_id])->update('matka'); //->get_compiled_update('matka');
                $query = $this->db->set(['starting_num' => "", 'result_num' => "", 'open_declare_date' => NULL])->where(['cid' => $matka_id, "date" => $game_date])->get_compiled_update('charts');
                $updateMatka = $this->db->query($query);
                log_message("error", "ADMIN UPDATE SQL:" . $query);
            } elseif ($bet_type == 'close') {
                $this->db->set('end_num', "")->set('number', 'CAST(FLOOR(number/10) AS INT)', false)->where(['id' => $matka_id])->update('matka');
                $this->db->set('close_declare_date', null)->set('end_num', "")->set('result_num', 'CAST(FLOOR(result_num/10) AS INT)', false)->where(['cid' => $matka_id, 'date' => $game_date])->update('charts');
            }
        endif;
        $this->Game_model->reverse_game();
        return true;
    }
    public function show_chart_data()
    {
        $d = ($this->input->post('date_val')) ?: date('Y-m-d');
        $date_val = $this->input->post('date_val');
        $game_type = $this->input->post('type');
        $chart_data = $this->Administrator_Model->getChartData($d, $game_type);
        $output = "";
        $open_declare_date = "";
        $close_declare_date = "";
        $i = 1;
        $i = 1;
        foreach ($chart_data as $team) {
            ?>
            <tr>
                <td>
                    <?php echo $i++; ?>
                </td>
                <td>
                    <?php echo $team['name']; ?>
                </td>
                <td>
                    <?php echo date("M d,Y", strtotime($team['date'])); ?>
                </td>
                <?php
                if ($game_type == 'matka') {
                    ?>
                    <td>
                        <?php echo ($team['open_declare_date'] != null && $team['open_declare_date'] != "" && $team['open_declare_date'] != "0000-00-00 00:00:00") ? date("M d Y H:i:s", strtotime($team['open_declare_date'])) : 'N/A' ?>
                    </td>
                    <td>
                        <?php echo ($team['close_declare_date'] != null && $team['close_declare_date'] != "" && $team['close_declare_date'] != "0000-00-00 00:00:00") ? date("M d Y H:i:s", strtotime($team['close_declare_date'])) : 'N/A' ?>
                    </td>
                    <td>
                        <?php echo ($team['starting_num'] != "") ? $team['starting_num'] . "-" . $team['result_num'][0] : "*-***" ?>
                        <span>
                            <?php
                            if (($team['starting_num'] != "" && $team['starting_num'] != null) && $team['open_declare_date'] != null) {
                                ?>
                                <a type="button" class="btn btn-sm btn-danger waves-light  ml-1"
                                    onclick="reverse_win_amt('<?= $date_val ?>','<?= $team['cid'] ?>','open','win_amt','0','1','0');">Delete</a>
                            <?php } ?>
                        </span>
                    </td>
                    <td>
                        <?php echo $team['end_num'] != "" && $team['end_num'] != null ? $team['result_num'][1] . "-" . $team['end_num'] : "*-***"; ?>
                        <span>
                            <?php
                            if (($team['end_num'] != "" && $team['end_num'] != null) && $team['close_declare_date'] != null) {
                                ?>
                                <a type="button" class="btn btn-sm btn-danger waves-light ml-1"
                                    onclick="reverse_win_amt('<?= $date_val ?>','<?= $team['cid'] ?>','close','win_amt','0','1','0');">Delete</a>
                            <?php } ?>
                        </span>
                    </td>
                <?php } ?>
                <?php
                if ($game_type == 'starline') {
                    ?>
                    <td>
                        <?php echo ($team['open_declare_date'] != null && $team['open_declare_date'] != "") ? date("M d Y H:i:s", strtotime($team['open_declare_date'])) : 'N/A' ?>
                    </td>
                    <td>
                        <?php echo $team['starting_num'] != "" ? $team['starting_num'] . "-" . $team['result_num'] : "*-***"; ?><span>
                            <?php
                            if ($team['open_declare_date'] != null && $team['starting_num'] != "" && $team['starting_num'] != null) {
                                ?>
                                <a type="button" class="btn btn-sm btn-danger waves-light  ml-1"
                                    onclick="reverse_win_amt('<?= $date_val ?>','<?= $team['cid'] ?>','open','win_amt','0','0','0');">Delete</a>
                            <?php } ?>
                        </span>
                    </td>
                <?php } ?>
                <?php
                if ($game_type == 'dmatka') {
                    ?>
                    <td>
                        <?php echo ($team['open_declare_date'] != null && $team['open_declare_date'] != "") ? date("M d Y H:i:s", strtotime($team['open_declare_date'])) : 'N/A' ?>
                    </td>>
                    <td>
                        <?php echo $team['result_num'] != "" ? $team['result_num'] : "*-***"; ?><span>
                            <?php
                            if ($team['open_declare_date'] != null && $team['result_num'] != "" && $team['result_num'] != null) {
                                ?>
                                <a type="button" class="btn btn-sm btn-danger waves-light  ml-1"
                                    onclick="reverse_win_amt('<?= $date_val ?>','<?= $team['cid'] ?>','open','win_amt','0','0','0');">Delete</a>
                            <?php } ?>
                        </span>
                    </td>
                <?php } ?>
            </tr>
        <?php }
        echo $output;
    }


}