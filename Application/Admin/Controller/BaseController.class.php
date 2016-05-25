<?php
/**
 * Created by PhpStorm.
 * User: cheungscary
 * Date: 16/5/9
 * Time: 下午11:08
 */
namespace Admin\Controller;

use Think\Controller;

class BaseController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!session('isAdmin')) {
            redirect('/admin/login');
        }
    }
}