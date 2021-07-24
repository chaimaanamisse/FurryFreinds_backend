<?php

namespace App\Controllers;

class MainController extends Controller
{
  public function index()
  {
    //  echo "ceci est la page d'acceuil";
    //  $this->render('main/index');
     $this->render('main/index', [], 'home');
  }
}