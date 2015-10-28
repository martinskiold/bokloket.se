<?php

  //Databasklass.
  class Database{

    //Instansmedlem för själva länken till databasen.
    private $db;

    //Uprättar anslutning till databas.
    function __construct(){

      //Ansluter till den givna databasen i filen 'db_config.php'.
      $this->db = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

      //Om det blir fel med anslutningen.
      if ($this->db->connect_error) {
        $code  = $mysqli->connect_errno;
        die("Error: ($code) $this->conncetion->connect_error");
      }
    }

    //Kapar anslutning till databas.
    public function close()
    {
      $this->db->close();
    }
    
    //Kör en query mot databasen.
    public function query($sql){
      $result = $this->db->query($sql);
      if(!$result)
      {
        die("Invalid query". mysqli_error());
      }
      return $result;
    }

    //Lägger till en användare i databasen.
    public function createUser($namn,$län,$ort,$tfn,$email,$hash,$salt,$behörighet,$nyckelord){
      $result = $this->db->query("INSERT INTO ".MEDLEM_TABELL." (medlem_id, namn, lan, ort, tfn, email, hash, salt, behorighet, nyckelord) VALUES (null, '" . $namn . "','" . $län . "','" . $ort . "','" . $tfn . "','" . $email . "','" . $hash . "','" . $salt . "','" .$behörighet. "','".$nyckelord."')");
      if(!$result)
      {
        die("Invalid query". mysqli_error($this->db));
      }
      return $result;
    }

    //Hämtar ut den rad som överensstämmer med emailadressen i databasen över användare.
    public function getUser($email){
      $result = $this->db->query("SELECT * FROM ".MEDLEM_TABELL." WHERE email='".$email."'");
      if(!$result)
      {
        die("Invalid query". mysqli_error());
      }
      return $result;
    }

    //Hämtar ut den rad som överensstämmer med medlems-id:t i databasen över användare.
    public function getUserById($medlem_id){
      $result = $this->db->query("SELECT * FROM ".MEDLEM_TABELL." WHERE medlem_id='".$medlem_id."'");
      if(!$result)
      {
        die("Invalid query". mysqli_error());
      }
      return $result;
    }

    public function getUserId($email)
    {
      //Hämtar medlemmen.
      $result = $this->getUser($email);

      //Hämtar första raden ur resultatet.
      $row = mysqli_fetch_row($result);

      //Hämtar medlemmens id.
      $user_id = $row[MEDLEM_ID];

      return $user_id;
    }

    //Lägger till en bok i databasen.
    public function ny_bok($isbn,$title,$author,$genre)
    {
      $result = $this->db->query("INSERT INTO bok (isbn, titel, forfattare, genre)
  VALUES ('" . $isbn . "', '" . $title . "', '" . $author . "', '" . $genre . "')");
      return $result;
    }

    //Hämtar boken med given isbn.
    public function hitta_bok($isbn)
    {
      $result = $this->db->query("SELECT * FROM ".BOK_TABELL." WHERE isbn='".$isbn."'");
      if(!$result)
      {
        die("Invalid query". mysqli_error());
      }
      return $result;
    }

    //Hämtar alla böcker.
    public function alla_bok()
    {
      $result = $this->db->query("SELECT * FROM ".BOK_TABELL);
      if(!$result)
      {
        die("Invalid query". mysqli_error());
      }
      return $result;
    }

    //Hämtar annons med given annons id.
    public function hitta_annons($annons_id)
    {
      $result = $this->db->query("SELECT * FROM ".ANNONS_TABELL." WHERE annons_id='".$annons_id."'");
      if(!$result)
      {
        die("Invalid query". mysqli_error());
      }
      return $result;
    }

    //Lägger till en annons i databasen.
    public function ny_annons($medlem_id,$isbn,$annonstyp,$price,$description,$img,$nyckelord)
    {
      $result = $this->db->query("INSERT INTO annons (annons_id, medlem_id, isbn, annonstyp, pris, beskrivning, bild, antal_lasare, godkand, nyckelord)
  VALUES (null, '" . $medlem_id . "', '" . $isbn . "', '" . $annonstyp . "', '" . $price . "', '" . $description . "', '" . $img . "', 0, 0,'" . $nyckelord . "')");
      if(!$result)
      {
        die("Invalid query". mysqli_error());
      }
      return $result;
    }

    //Hämtar id:t för den senast tillagda annonsen.
    public function senast_annons_id()
    {
      //Hämtar id:t för den senast tillagda annonsen.
      $result = $this->db->query("SELECT MAX(annons_id) AS annons_id FROM annons");
      if(!$result)
      {
        die("Invalid query". mysqli_error());
      }
      return $result;
    }

    //Söker efter en medlem med nyckelordet.
    public function search_annons($nyckelord)
    {
      $result = $this->db->query("SELECT * FROM annons a, bok b WHERE a.isbn=b.isbn AND a.godkand=1 AND a.nyckelord LIKE'%".$nyckelord."%'");
      if(!$result)
      {
        die("Invalid query". mysqli_error());
      }
      return $result;
    }

    //Söker efter en annons med nyckelordet.
    public function search_medlem($nyckelord)
    {
      $result = $this->db->query("SELECT * FROM medlem WHERE nyckelord LIKE'%".$nyckelord."%'");
      if(!$result)
      {
        die("Invalid query". mysqli_error());
      }
      return $result;
    }

    //Söker efter en annons med nyckelordet.
    public function uppdatera_visningar($annons_id,$nuvarande)
    {
      $result = $this->db->query("UPDATE ".ANNONS_TABELL." SET antal_lasare=".$nuvarande." WHERE annons_id='".$annons_id."'");
      if(!$result)
      {
        die("Invalid query". mysqli_error());
      }
      return $result;
    }

    //Godkänner annons.
    public function godkann_annons($annons_id)
    {
      $result = $this->db->query("UPDATE ".ANNONS_TABELL." SET godkand=1 WHERE annons_id='".$annons_id."'");
      if(!$result)
      {
        die("Invalid query". mysqli_error());
      }
      return $result;
    }

    //Tar bort användare med givet id och alla dess annonser.
    public function removeUser($medlem_id)
    {
      $annonser_result = $this->medlem_annonser($medlem_id);
      while($annons = mysqli_fetch_row($annonser_result))
      {
        $this->ta_bort_annons($annons[ANNONS_ID]);
      }

      $result = $this->db->query("DELETE FROM ".MEDLEM_TABELL." WHERE medlem_id=".$medlem_id);

      return $result;
    }

    //Hämtar alla annonser och böcker kopplade till medlemmen.
    public function medlem_annonser($medlem_id)
    {
      //Hämtar annonserna kopplade till medlems-id:t.
      $result = $this->db->query("SELECT * FROM ".ANNONS_TABELL." WHERE medlem_id = '$medlem_id'" );
      if(!$result)
      {
        die("Invalid query". mysqli_error());
      }
      return $result;
    }

    //Tar bort användare med givet id.
    public function ta_bort_annons($annons_id)
    {
      $result = $this->db->query("DELETE FROM ".ANNONS_TABELL." WHERE annons_id=".$annons_id);
      if(!$result)
      {
        die("Invalid query". mysqli_error());
      }
      return $result;
    }


    //Hämtar alla ickegodkända annonser.
    public function okontrollerade_annonser()
    {
        //Hämtar annonserna där "godkand" är 0.
        $result = $this->db->query("SELECT * FROM ".ANNONS_TABELL." WHERE godkand = 0");
        if(!$result)
        {
          die("Invalid query". mysqli_error($this->db));
        }
        return $result;
    }

      //Funktion för att lagra information om intern mailkorrespondans.
      public function lagra_mail_data($email, $annons_id, $namn, $tfn, $meddelande)
      {
        $result = $this->db->query("INSERT INTO kontakt (email, annons_id, namn, tfn, meddelande) VALUES('".$email."','".$annons_id."','".$namn."','".$tfn."','".$meddelande."')");
        if(!$result)
        {
          die("Invalid query". mysqli_error($this->db));
        }
        return $result;
      }


  }



?>