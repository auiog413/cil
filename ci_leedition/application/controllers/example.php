<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Example extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        
        $this->load->helper('url');
        $methods = get_class_methods(__CLASS__);
        $base_url = base_url() . strtolower(__CLASS__) . '/';
        $excludes = array(
            'index', '__construct', 'get_instance', '_display_result', '_display_result_smarty', '_display_prepare'
        );
        
        $example_list = array(
            'general'       => array(
                'name'      => '常规',
                'examples'  => array()
            ),
            'libraries'     => array(
                'name'      => '类库',
                'examples'  => array()
            ),
            'helpers'       => array(
                'name'      => '辅助函数',
                'examples'  => array()
            ),
        );
        
        foreach ($methods as $key => $method)
        {
            if ( ! in_array($method, $excludes))
            {
                list($category, $object) = explode('_', $method);
                $reflection = new ReflectionParameter(array(__CLASS__, $method), 'name');
                $link_name = $reflection->getDefaultValue();
                $url = $base_url . $method;
                $example_list[$category]['examples'][] = array('name' => $link_name, 'url' => $url);
            }
        }
        
        $this->load->view('example_list', array('example_list' => $example_list));
    }

    public function helpers_captcha($name = '验证码辅助函数') {
        $this->load->helper('captcha');
        $vals = array(
            'word' => 'Random word',
            'img_path' => './statics/captcha/',
            'img_url' => '/statics/captcha/',
            'img_width' => '150',
            'img_height' => 30,
            'expiration' => 7200
        );

        $result = create_captcha($vals);
        
        $this->_display_result($result, __METHOD__);
    }

    public function libraries_sessions($name = 'Session 类')
    {
        $this->load->library('session');
        
        $result = '';
        
        $this->_display_result($result, __METHOD__);
    }
    
    public function general_models($name = '模型扩展子类 CIL_Model')
    {
        // 可以在 CIL_Model 的子类中设置要使用的数据库连接配置
        $this->load->model('example_model');
        
        $condition = array(
            'where' => array('id' => '1')
        );
        
        $selection = array(
            'fields' => 'title,content,created_time,updated_time'
        );
        
        // 使用 $this->example_model->get($condition, $selection); 得到对象格式的数据
        $result = $this->example_model->get_array($condition, $selection);
        
        $this->_display_result($result, __METHOD__);
    }
    
    private function _display_result_smarty($result, $method)
    {
        $v_data = $this->_display_prepare($result, $method);
        
        foreach ($v_data as $key => $value) {
            $this->template->assign($key, $value);
        }
        
        $this->template->display('example_result.tpl');
    }
    
    private function _display_result($result, $method)
    {
        $v_data = $this->_display_prepare($result, $method);
        $this->load->view('example_result', $v_data);
    }
    
    private function _display_prepare($result, $method)
    {
        $v_data = array('code' => '', 'result'=>'', 'name' => '', 'doc_url' => '');
        list($class, $method) = explode('::', $method);
        $reflection = new ReflectionMethod($class, $method);
        $start = $reflection->getStartLine();
        $end = $reflection->getEndLine() - 3;
        
        $file_arr = file(__FILE__);
        
        for ($i = $start; $i < $end; $i++)
        {
            $v_data['code'] .= substr($file_arr[$i], 8);
        }
        
        $reflection = new ReflectionParameter(array($class, $method), 'name');
        $v_data['name'] = $reflection->getDefaultValue();
        
        $doc_url = '';
        $doc_path_arr = explode('_', $method);
        $doc_path = array_shift($doc_path_arr);
        $doc_file = implode('_', $doc_path_arr);
        
        $doc_url = 'docs/' . $doc_path . '/' . $doc_file;
        
        if ($doc_path == 'libraries' OR $doc_path == 'general')
        {
            $doc_url .= '.html';
        }
        elseif ($doc_path == 'helpers')
        {
            $doc_url .= '_helper.html';
        }
        
        $v_data['doc_url'] = file_exists($doc_url) ? '/' . $doc_url: '';
        
        $v_data['result'] = var_export($result, true);
        
        return $v_data;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */