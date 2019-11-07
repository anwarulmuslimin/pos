<?php

class ManualbookController extends Controller
{
	public function actionIndex(){

        $id = $_POST['id'];

        if($id==1){
            $render = "petunjuk_kategori";
        } else if($id==2){
            $render = "petunjuk_item";
        } else if($id==3){
            $render = "petunjuk_transaksi";
        } else if($id==4){
            $render = "petunjuk_laba";
        } else if($id==5){
            $render = "petunjuk_penjualan";
        } else if($id==6){
            $render = "petunjuk_user";
        } else if($id==7){
            $render = "petunjuk_password";
        } else {
            $render = "index";
        }

        return $this->renderPartial($render);
    }

}