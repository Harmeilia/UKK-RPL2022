<?php

namespace App\Models;

class User extends BaseModel  {

    public static function authenticate($nik, $nama) {
        $data = BaseModel::csvFileToJson("users.csv");
        var_dump($data);
        foreach ($data as $key => $value) {
            if ($value['nik'] == $nik && $value['nama'] == $nama) {
                return true;
            }
        }
        return false;
    }

    public static function create($nik, $nama, $password) {
        $data = BaseModel::csvFileToJson("users.csv");
        $exists = false;
        foreach ($data as $key => $value) {
            if ($value['nik'] == $nik && $value['nama'] == $nama && $value['password'] == $password) {
                $exists = true;
            }
        }
        
        if ($exists) {
            return -1;
        }

        file_put_contents("users.csv","\r\n".$nik.",".$nama,FILE_APPEND);
        return true;
    }

    public  static function findByNIK($nik) {
        $data = Basemodel :: csvFileToJson("users.csv");
        foreach($data as $key => $value) {
            if ($value['nik'] == $nik) {
                return $value;
            }
        }
        return false;
    }
}