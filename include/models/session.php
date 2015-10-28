<?php
        
        define("ERROR",0);
        define("MESSAGE",1);
        define("SOK_ANNONSER_PRIO",0);
        define("SOK_ANNONSER_EJPRIO",1);
        define("SOK_MEDLEMMAR_PRIO",2);
        define("SOK_MEDLEMMAR_EJPRIO",3);

	   	//Aktiverar sessionen.
    	//Tilldelar sessionens email.
    	function login($email,$user_id,$behorighet)
    	{
    		//Ändrar sessionsvariablerna.
			$_SESSION['active']=true;
			$_SESSION['email']=$email;
            $_SESSION['user_id']=$user_id;
            $_SESSION['access']=$behorighet;
    	}

        //Returnerar sessionvariabeln för email.
        function get_email()
        {
            return $_SESSION['email'];
        }

        //Hämtar sessionens användare.
        function get_user_id()
        {
            if(isset($_SESSION['user_id']))
            {
                return $_SESSION['user_id'];
            }
            else
            {
                return false;
            }
        }

        //Kollar ifall sessionen är aktiv.
        function isActive()
        {
            //Kollar om sessionen är aktiv.
            if(isset($_SESSION['active']))
            {
                //Sessionen är aktiv.
                return true;
            }
            else
            {
                //Sessionen är ej aktiv.
                return false;
            }
        }

        //Kollar ifall sessionen har behörigheten admin.
        function isAdmin()
        {
            //Kollar om sessionen är aktiv.
            if(isset($_SESSION['access']))
            {
                if($_SESSION['access']=='Admin')
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                //Sessionen är ej aktiv.
                return false;
            }
        }

        //Verifierar att användaren bestämt sig för att ta bort användarkontot.
        function verify_remove()
        {
            $_SESSION['verify_remove']=true;
        }

        //Verifierar att användaren bestämt sig för att ta bort användarkontot.
        function remove_is_verified()
        {
            if(isset($_SESSION['verify_remove']))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

    	//Deaktiverar sessionen.
    	function logout()
    	{
            
            //Försäkrar att sessionen avslutas (Del 1).
            if(isset($_SESSION['active'])){
                unset($_SESSION['active']);
            }
            if(isset($_SESSION['email'])){
                unset($_SESSION['email']);
            }
            if(isset($_SESSION['user_id'])){
                unset($_SESSION['user_id']);
            }
            if(isset($_SESSION['message'])){
                unset($_SESSION['message']);
            }
            if(isset($_SESSION['message_type'])){
                unset($_SESSION['message_type']);
            }
            if(isset($_SESSION['link_url'])){
                unset($_SESSION['link_url']);
            }
            if(isset($_SESSION['search_result_annonser_prio'])){
                unset($_SESSION['search_result_annonser_prio']);
            }
            if(isset($_SESSION['search_result_medlemmar_prio'])){
                unset($_SESSION['search_result_medlemmar_prio']);
            }
            if(isset($_SESSION['search_result_annonser_ejprio'])){
                unset($_SESSION['search_result_annonser_ejprio']);
            }
            if(isset($_SESSION['search_result_medlemmar_ejprio'])){
                unset($_SESSION['search_result_medlemmar_ejprio']);
            }

            //Försäkrar att sessionen avslutas (Del 2).
    		session_destroy();
    	}



        //-----MESSAGES-----//


        //Sätter sessionsvariabel för meddelande och url för att kunna länka vidare användaren.
        //$type avser om meddelandet är ett error eller ett vanligt meddelande. De definierade konstanterna anger vilka typer som finns.
        function setMessage($message,$link_url,$type)
        {
                $_SESSION['message']=$message;
                $_SESSION['message_type']=$type;
                $_SESSION['link_url']=$link_url;
        }

        //Kontrollerar ifall det finns nytt meddelande.
        function messageWaiting()
        {
            if(isset($_SESSION['message']))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        //Hämtar liggande sessionsmeddelande och återställer sedan meddelandestatusen.
        //Hämtar URL till hemsidan dit användaren ska kunna länka sig till. Returnerar en array med meddelande och url till förra sidan.
        function getMessage()
        {
            //Hämtar meddelande.
            $message = $_SESSION['message'];
            $type = $_SESSION['message_type'];
            $link = $_SESSION['link_url'];

            //Återställer meddelandestatus.
            unset($_SESSION['message']);

            //Återställer meddelandestatus.
            unset($_SESSION['message_type']);

            //Återställer meddelandestatus.
            unset($_SESSION['link_url']);

            //Returnerar meddelande.
            return array($message, $link, $type);
        }



        //----SEARCH VARIABLES----//

        //Sätter värde på sökvariabler.
        function set_search_result($arr_annonser_prio,$arr_annonser_ejprio,$arr_medlemmar_prio,$arr_medlemmar_ejprio)
        {
            //Ändrar sessionsvariabler för sökning.
            $_SESSION['search_result_annonser_prio'] = $arr_annonser_prio;
            $_SESSION['search_result_medlemmar_prio'] = $arr_medlemmar_prio;
            $_SESSION['search_result_annonser_ejprio'] = $arr_annonser_ejprio;
            $_SESSION['search_result_medlemmar_ejprio'] = $arr_medlemmar_ejprio;
        }

        //Hämtar sökvariabler
        function get_search_result()
        {
            //Ändrar sessionsvariabler för sökning.
            $annonser_prio = $_SESSION['search_result_annonser_prio'];
            $medlemmar_prio = $_SESSION['search_result_medlemmar_prio'];
            $medlemmar_ejprio = $_SESSION['search_result_medlemmar_ejprio'];
            $annonser_ejprio = $_SESSION['search_result_annonser_ejprio'];

            //Returnerar sessionsvariablerna.
            return array($annonser_prio,$annonser_ejprio,$medlemmar_prio,$medlemmar_ejprio);
        }

?>