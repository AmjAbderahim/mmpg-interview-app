<?php
require_once "./php/Database.php";
$db = Database::getInstance();
$conn = $db->getConnection();
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$db_tables =array("city","city_informations");
switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
    case '/':
         require "index.php";
         break;
    case '/data':
     echo json_encode($db->getData($db_tables[0]));
        break;
		
 case '/getCityById' : 
  if(!empty($_GET['id'])){
            $params = array("where"=>array('id' =>$_GET['id']));
            $result = $db->getData($db_tables[0],$params);
            //add data from Info Table
            $params1 = array("where"=>array('id_city' => $_GET['id']));
            $result1 = $db->getData($db_tables[1],$params1);
            $result['info'] = $result1;
            echo json_encode($result);
        }
		break;	
case '/getCityByName' : 
  if(!empty($_GET['name'])){
   $params = array("where"=>array('name' =>$_GET['name']));
            $result = $db->getData($db_tables[0],$params);
            //add data from Info Table
            $params1 = array("where"=>array('id_city' => $result[0]["id"]));
            $result1 = $db->getData($db_tables[1],$params1);
            $result['info'] = $result1;
            echo json_encode($result);
        }
		break;	
	
	case '/increaseVisits' : 
  if(!empty($_GET['id'])){ 
                $arr=array('id' => $_GET['id']);
                $condition =array("where"=>$arr);
                $nb = $db->getData($db_tables[0],$condition)[0]["nb_visits"];
                $params = array('nb_visits' => $nb+1);
                $result = $db->update($db_tables[0],$params,$arr); 
                $data = array();
                $data[0]=$result;
                $data[1]=$nb+1;
                echo json_encode($data);
            }
		break;
  default:
        http_response_code(404);
        exit('Ressource Not Found...!');
}

		
?>