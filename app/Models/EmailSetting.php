<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class EmailSetting extends Model
{
    
    protected $table='email_configuration';

    public static function get_email_configuration()
    {
        
        error_reporting(0);
        $config_db=config('database');
        if(!empty($config_db)){
            $default_db=$config_db['default'];
            // echo $default_db;
            // die();
            if(!empty($default_db)){
                $db_connection=$config_db['connections'][$default_db];
                $servername  = $db_connection['host'];
                $database = $db_connection['database'];
                $username = $db_connection['username'];
                $password = $db_connection['password'];

                // Create connection
                $conn = mysqli_connect($servername, $username, $password, $database);
                // Check connection
                if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                }
                
                
                $sql = "SELECT ec.mail_from_name,ec.mail_from_address, ec.smtp_host, ec.smtp_user, ec.smtp_password, ec.smtp_port, ept.protocol_code, ept.protocal_name, eet.encryption_code, eet.encryption_name FROM email_configuration ec INNER JOIN email_protocol_type ept ON ept.id = ec.email_protocol_typeid INNER JOIN email_encryption_type eet ON eet.id = ec.email_encryption_typeid WHERE ec.is_active = 'Y' ORDER BY ec.id DESC LIMIT 1";
                $result = $conn->query($sql);
                $conn->close();


            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $db_rsltArray=$row;
                }
                return $db_rsltArray;
            } else {
                return false;
            }
            
            }
        }
    }
}
