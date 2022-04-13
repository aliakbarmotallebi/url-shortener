<?php namespace Aliakbar\UrlShortener\Controllers\Dashboard;

use Aliakbar\UrlShortener\Helper\View;

class DashboardController extends View{

  public function __construct()
  {
    return "Create First Controller the Method __construct";
  }

  public function index()
  {
    $this->render("dashboard\index.html.php");
  }
}
