<?php
require_once("../database.php");
require_once("../admin/model_horarie.php");
class horaireDAO
{
    private $db;

    public function __construct()
    {
        $conn = new database();
        $this->db = $conn->getConnection();
    }

    public function get_all_horaire()
    {
        $sql = "SELECT * FROM horaire ORDER BY `date`";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        $resultObj = [];
        foreach ($result as $row) {
            $resultObj[] = new horaire($row->departure_time, $row->destination_time, $row->matricule, $row->date, $row->available_seats, $row->departure_city, $row->destination_city);
        }
        return $resultObj;
    }

    public function get_img_for_company($matricule)
    {
        $sql = "SELECT horaire.matricule AS Hmatricule, bus.company_name AS companyName, (SELECT img FROM company WHERE name = bus.company_name) AS img
        FROM horaire
        INNER JOIN bus ON horaire.matricule = bus.matricule";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $row) {
            if ($row->Hmatricule === $matricule) return $row->img;
        }
    }

    public function get_companies_for_horaire($depart, $arrive, $date)
    {
        $sql = "SELECT DISTINCT company.name
    FROM horaire
    JOIN bus ON horaire.matricule = bus.matricule
    JOIN company ON bus.company_name = company.name
    WHERE horaire.departure_city = ? AND horaire.destination_city = ? AND horaire.date = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$depart, $arrive, $date]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $array_of_names = [];
        foreach ($result as $row) {
            $array_of_names[] = $row['name'];
        }
        return $array_of_names;
    }

    public function get_horaires_for_company($depart, $arrive, $date, $company_name)
    {
        $sql = "SELECT * FROM horaire 
    WHERE horaire.matricule IN (SELECT bus.matricule FROM bus WHERE bus.company_name = ?)
    AND horaire.departure_city = ? AND horaire.destination_city = ? AND date = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$company_name, $depart, $arrive, $date]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $resultObj = [];
        foreach ($result as $horaire) {
            $resultObj[] = new horaire($horaire['departure_time'], $horaire['destination_time'], $horaire['matricule'], $horaire['date'], $horaire['available_seats'], $horaire['departure_city'], $horaire['destination_city']);
        }
        return $resultObj;
    }

    public function get_horaire_by_primaries_key($matricule, $departure_time, $destination_time)
    {
        foreach ($this->get_all_horaire() as $horaire) {
            if ($horaire->getMatricule() === $matricule && $horaire->getDeparture_time() === $departure_time && $horaire->getDestination_time() === $destination_time) {
                return $horaire;
            }
        }
    }

    public function get_horaire_for_search($depart, $arrive, $date)
    {
        $sql = "SELECT * FROM horaire WHERE departure_city = ? AND destination_city = ? AND `date` = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($depart, $arrive, $date));
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        $resultObj = array();
        foreach ($result as $row) {
            $resultObj[] = new horaire($row->departure_time, $row->destination_time, $row->matricule, $row->date, $row->available_seats, $row->departure_city, $row->destination_city);
        }
        return $resultObj;
    }

    public function get_companyName($matricule)
    {
        $sql = "SELECT horaire.matricule AS Hmatricule, bus.company_name AS companyName, (SELECT img FROM company WHERE name = bus.company_name) AS img
        FROM horaire
        INNER JOIN bus ON horaire.matricule = bus.matricule
        ORDER BY companyName";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        $array_of_names = array();
        foreach ($result as $row) {
            if ($row->Hmatricule === $matricule) return $row->companyName;
        }
    }
    public function model_add_horaire()
    {
        extract($_POST);
        $depart = explode(" - ", $depart_arrive)[0];
        $arrive = explode(" - ", $depart_arrive)[1];
        echo $depart . "<br>";
        echo $arrive . "<br>";
        $sql = "INSERT INTO horaire VALUES(?,?,?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$depart_time, $arrive_time, $matricule, $date, $nbr_seats, $depart, $arrive]);
    }

    public function model_update_horaire()
    {
        extract($_POST);
        $depart = explode(' - ', $depart_arrive)[0];
        $arrive = explode(' - ', $depart_arrive)[1];
        $sql = "UPDATE horaire
        SET 
        departure_time = ?, destination_time = ?,
        matricule = ?, `date` = ?,
        available_seats = ?, departure_city = ?,
        destination_city = ?
        WHERE departure_time = ? AND destination_time = ? AND matricule = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$depart_time, $arrive_time, $matricule, $date, $nbr_seats, $depart, $arrive, $old_depart_time, $old_arrive_time, $old_matricule]);
    }

    public function model_delete_horaire($matricule, $departure_time, $destination_time)
    {
        $sql = "DELETE FROM horaire
        WHERE
        departure_time = ? AND
        destination_time = ? AND
        matricule = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$departure_time, $destination_time, $matricule]);
    }
}

class square
{
    private $x;
    public $y;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function jsonSerialize()
    {
        // Use get_object_vars to include private properties
        return get_object_vars($this);
    }
}

// $arr = array();
// $arr[] = new square(1, 0);
// $arr[] = new square(2, 1);
// $arr[] = new square(1, -5);
// echo '<pre>';
// print_r($arr[0]->jsonSerialize());
// $arrayObj = [];
// foreach($arr as $obj) {
//     $arrayObj[] = $obj->jsonSerialize();
// }
// echo json_encode($arrayObj);
// $resultObj = $DAOhoraire->get_horaires_for_company($depart, $arrive, $date, $company);

$DAOhoraire = new horaireDAO();
if (isset($_GET['allHoraire'])) {
    extract($_GET);
    $resultObj = $DAOhoraire->get_all_horaire();
    $resultForJson = array();
    foreach ($resultObj as $obj) {
        $resultForJson[] = $obj->toJson();
    }
    echo json_encode($resultForJson);
}

if (isset($_GET['matricule'])) {
    $matricule = $_GET['matricule'];
    echo $DAOhoraire->get_img_for_company($matricule);
}

if (isset($_GET['company'])) {
    $matricule = $_GET['company'];
    echo $DAOhoraire->get_companyName($matricule);
}

