<?php
namespace App\Models;
use CodeIgniter\Model;
class AuthModel extends  Model {

    protected $tbluser = "tbl_users";

    public function __construct(){

        $this->db = \Config\Database::connect('default'); 

    }

    public function authenticate($req){

        $email = $req['email'];
        $pass = $req['password'];

        $user = $this->db->table($this->tbluser)->where('email', $email)->get();

        if($user->getNumRows() >= 0 && $user->getNumRows() <= 1){
            
            $userpass = $this->db->table($this->tbluser)->where( array ('email' => $email, 'pass' => $pass))->get();

            if($userpass->getNumRows() >= 0 && $userpass->getNumRows() <= 1){
                $res = $userpass->getRowArray();
                if(isset($res)){
                    $arr = [
                        'userID' => $res['userID'],
                        'name' => $res['name']
                    ];

                    return $arr;
                }
            }else{
                return false;
            }
        
        }else{
            return false;
        }


    }


}