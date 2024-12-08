<?php 
    require_once 'MVC/Models/analytic.php';
    

    class LoginController {
        private $model;
        
        public function __construct(){
            $this->model = new Analytic();
        }

        public function admin()
        {
            $limit = isset($_GET['allPro']) ? $_GET['allPro'] : '';
            $offset = '';
            $days = $this->model->getDaysInCurrentMonth();
            $months= $this->model->getMonthsInYear();
            $years = $this->model->get_years_for_report();
            $annual_revenue = $this->model->calculate_month_revenue();
            $doanhthu_ngay = $this->model->calculate_current_month_daily_revenue();
            $doanhthu_nam = $this->model->calculate_annual_revenue();
            $total_revenue = $this->model->calculate_revenue();
            $revenue = $total_revenue['revenue'];
            $total_dh = $this->model->calculate_total_orders();
            $total_user = $this->model->get_total_users();
            $total_blogs = $this->model->get_total_blogs();
            $product_top = $this->model->product_top();
            $product_nonSell = $this->model->product_notIn_bill();
            $product_nonSell_5 = $this->model->product_notIn_bill(5);
            $product_top_5 = $this->model->product_top(5);
            $category_revenue_report = $this->model->generate_category_revenue_report();
            require_once("MVC/Views/admin/index.php");
        }
    }
?>