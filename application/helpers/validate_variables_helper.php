<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//si no existe la función validate_at_position la creamos
if(!function_exists('validate_at_position'))
{
    /**
     * Funcion para validar at position. Distingue mayusculas y minusculas.
     * Las dos opciones son: Cape Paloma y Cape Trafalgar.
     *
     * @return boolean true si la variable es correcta
     *
     * @param string $atposition con la variable dada por el alumno
     */
    function validate_at_position($atposition)
    {
        $ci =& get_instance();

        $data= array();

        //primero se obtiene el id de la variable atposition
        $ci->db->select('id');
        $ci->db->from('type_variable');
        $ci->db->where('variable', 'atposition');
        $query = $ci->db->get();
        $data=$query->row()->id; 

        //y luego se busca si existe la variable $atposition en la tabla variable y cuyo id corresponta con la variable atposition
        $ci->db->select('*');
        $ci->db->from('variable');
        $ci->db->where('name like BINARY', $atposition); //binary lo que hace es que distinga las mayusculas y minusculas
        $ci->db->where('id_type_variable', $data);
        $result = $ci->db->get();

        if($result->num_rows() != 0)
            return TRUE;
        else
            return FALSE;
    }
}

//si no existe la función validate_beaufort la creamos
if(!function_exists('validate_beaufort'))
{
    /**
     * Funcion para validar el force beaufort
     * Numerico 0-12
     * @return boolean true si force beaufort es correcto
     *
     * @param string $beaufort con la variable dada por el alumno
     */
    function validate_beaufort($beaufort)
    {
        if($beaufort < 0 || $beaufort >12)
            return FALSE;
        else 
            return TRUE;
    }
}

//si no existe la función validate_callsign la creamos
if(!function_exists('validate_callsign'))
{
    /**
     * Funcion para validar el distintivo de llamada
     * Alphanumeric (e.g EDBA5)
     * Rango mínimo 4 caracteres, rango máximo 6 caracteres.
     *
     * @return boolean true si call sign es correcto
     *
     * @param string $callsign con la variable dada por el alumno
     */
    function validate_callsign($callsign)
    {
        // ctype_alnum devuelve TRUE si cada caracter de texto es o bien uno letra o un dígito, FALSE de lo contrario.
        if (ctype_alnum($callsign) && strlen($callsign) >=4 && strlen($callsign) <=6) 
            return TRUE;
        else
            return FALSE;
    }
}

//si no existe la función validate_cardinalpoint la creamos
if(!function_exists('validate_cardinalpoint'))
{
    /**
     * Funcion para validar el cardinal point. Distingue entre mayusculas y minusculas.
     * Correctos: N, E, S , W, NE, NW, SE, SW, NNE, ENE, ESE, SSE, SSW, WSW, WNW, NNW
     *
     * @return boolean true si cardinal point es correcto
     *
     * @param string $cardinalpoint con la variable dada por el alumno
     */
    function validate_cardinalpoint($cardinalpoint)
    {
        //obtiene el id de la variable cardinal point
        $ci =& get_instance();
        $data= array();
        $ci->db->select('id');
        $ci->db->from('type_variable');
        $ci->db->where('variable', 'cardinal point');
        $query = $ci->db->get();
        $data=$query->row()->id;

        //se busca si existe la variable $cardinalpoint en la tabla variable y cuyo id corresponta con la variable cardinal point
        $ci->db->select('*');
        $ci->db->from('variable');
        $ci->db->where('name like BINARY', $cardinalpoint); //binary lo que hace es que distinga las mayusculas y minusculas
        $ci->db->where('id_type_variable', $data);
        $result = $ci->db->get();

        if($result->num_rows() != 0)
            return TRUE;
        else
            return FALSE;
    }
}

//si no existe la función validate_charted_name la creamos
if(!function_exists('validate_charted_name'))
{
    /**
     * Funcion para validar charted name. Distingue entre mayusculas y minusculas.
     * Correcto: BUOY5 y ALFA5.
     *
     * @return boolean true si charted name es correcto
     *
     * @param string $chartedname con la variable dada por el alumno
     */
    function validate_charted_name($chartedname)
    {
        $ci =& get_instance();

        //obtiene el id de la variable charted name
        $data= array();
        $ci->db->select('id');
        $ci->db->from('type_variable');
        $ci->db->where('variable', 'charted name');
        $query = $ci->db->get();
        $data=$query->row()->id; 

        //se busca si existe la variable $chartedname en la tabla variable y cuyo id corresponta con la variable charted name
        $ci->db->select('*');
        $ci->db->from('variable');
        $ci->db->where('name like BINARY', $chartedname); //binary lo que hace es que distinga las mayusculas y minusculas
        $ci->db->where('id_type_variable', $data);
        $result = $ci->db->get();

        if($result->num_rows() != 0)
            return TRUE;
        else
            return FALSE;

    }
}

//si no existe la función validate_hours la creamos
if(!function_exists('validate_time'))
{
    /**
     * Funcion para validar una hora en formato: hhmm. Desde 0000 hours hasta 2359 
     *  
     * @return boolean true si la hora es correcta
     */
    function validate_time($hours)
    {
        $pattern="/^([0-1][0-9]|[2][0-3])([0-5][0-9])$/";

        //preg_match() devuelve 1 si pattern coincide con el subject dado(en este caso con time), 0 si no, o FALSE si ocurrió un error.
        if(preg_match($pattern,$hours))
            return TRUE;
        return FALSE;
    }
}




if(!function_exists('validate_MMSI'))
{
    /**
     * Funcion para validar el MMSI
     * Numerico: 8 numeros siempre
     * Devuelve TRUE|FALSE
     */
    function validate_MMSI($mmsi)
    {
        if (ctype_digit($mmsi) && strlen($mmsi) == 8)
        {
            echo"is numeric: ".strlen($mmsi);
            echo $mmsi;
            return TRUE;
        }
        return FALSE;
    }

}

if(!function_exists('validate_date'))
{
    /**
     * Funcion para validar la fecha
     * Num caracteres max 17(cuando tiene dos cifras el num) y 16(cuando tiene una cifra)
     * Devuelve TRUE|FALSE
     */
    function validate_date($date)
    {
        $parts = explode(" ", $date);     

        echo "LAS TRES PARTES SON: ";
        echo "<br>";
        echo $parts[0]; //contiene el mes
        echo "<br>";
        echo $parts[1]; //contiene el numero
        echo "<br>";
        //echo $parts[2];
        //echo "<br>";
        
        //Esto comprueba si al final la fecha tiene una coma(ej october 12th,).
        if(substr($parts[1], -1) == ',')
            $parts[1] = substr($parts[1], 0, -1); //En el caso de que tenga una coma se le quita


        //Esto separa el numero de la terminacion(st, nd, rd, th)
        if(strlen($parts[1]) == 4)
        {
            //Si la cadena tiene 4 caracteres entonces nos quedamos con los dos primeros
            $number = substr($parts[1], 0, 2); 
        }else
        {
            //Si la cadena tiene 3 caracteres entonces nos quedamos con el primero
            $number = substr($parts[1], 0, 1);
        }


        //Array con todos los posibles numeros
        $array_nums = array("1st", "2nd", "3rd", "4th", "5th", "6th", "7th" , "8th", "9th", "10th", "11th",
            "12th", "13th", "14th", "15th", "16th", "17th", "18th", "19th", "20th", "21st", "22nd", "23rd",
            "24th", "25th", "26th", "27th", "28th", "29th", "30th", "31st");

        //Array con todos los posibles meses y cuantos dias tiene cada uno
        $array_months = array("January" => 31, "February" => 29, "March" => 31, "April" =>30, "May" => 31,
                    "June" => 30, "July" => 31, "August" => 31, "September" => 30, "October" => 31,
                    "November" => 30, "December" => 31);


        //Si la parte del numero no esta en el array de numeros devuelve FALSE
        if ( ! in_array($parts[1], $array_nums)) {
            echo "en el primero";
            return FALSE;

        }elseif( ! array_key_exists($parts[0], $array_months)) { 
            //Si la parte del mes no esta en el array de los meses devuelve FALSE
           //array_key_exists() devuelve TRUE si la key dada existe en el array
            echo "en el segundo";
            return FALSE;

        }elseif ( $number > $array_months[$parts[0]]  ) {
            //Si el numero que hemos separado antes de las terminaciones es mayor que el maximo numero de dias que tiene ese mes devuelve FALSE
            echo "en el tercero";
            return FALSE;
        }
        //Si no cumple nada de lo anterior entonces devuelve TRUE
        return TRUE;
    }

}


if(!function_exists('validate_number'))
{
    /**
     * Funcion para validar un number
     * Numerico: maximo 3 caracteres
     * Devuelve TRUE|FALSE
     */
    function validate_number($number)
    {
        if (ctype_digit($number) && strlen($number) <= 4)
        {
            return TRUE;
        }
        return FALSE;
    }

}



if(!function_exists('validate_speed'))
{
    /**
     * Funcion para validar la velocidad
     * Numerico: maximo 4 caracteres. Máximo : 35-40 nudos. 
     * Devuelve TRUE|FALSE
     */
    function validate_speed($speed)
    {
        //strpos evita que se introduzca una velocidad con un punto en vez de una coma
        if ($speed < 0 || $speed > 40 || strpos($speed, '.'))
        {
            return FALSE;
        }
        return TRUE;
    }

}



if(!function_exists('validate_vhfchannel_hourswithin'))
{
    /**
     * Funcion para validar el vhf channel
     * Numerico: maximo 2 caracteres
     * Devuelve TRUE|FALSE
     */
    function validate_vhfchannel_hourswithin($vhfchannel)
    {
        if (is_numeric($vhfchannel) && strlen($vhfchannel) <= 2 && $vhfchannel != 0)
        {
            echo"is numeric: ".strlen($vhfchannel);
            return TRUE;
        }
        return FALSE;
    }
}

if(!function_exists('validate_mvname'))
{
    /**
     * Funcion para validar el mvnombre. Distingue minusculas y mayusculas. Hay que ponerlo tal cual para que 
     * este correcto.
     * Please use "Casey", “Babieca", Draco",  "Fairfax", "Payton" , "Xanadu", "Castor", "Pollux", "Berenice".
     * Devuelve TRUE|FALSE
     */
    function validate_mvname($name)
    {
        echo 'el nombre es'.$name;
        $ci =& get_instance();
        $data= array();
        $ci->db->select('id');
        $ci->db->from('type_variable');
        $ci->db->where('variable', 'mvname');
        $query = $ci->db->get();
        $data=$query->row()->id; //Obtiene el id de la variable name

        $ci->db->select('*');
        $ci->db->from('variable');
        $ci->db->where('name like BINARY', $name); //binary lo que hace es que distinga las mayusculas y minusculas
        $ci->db->where('id_type_variable', $data);
        $result = $ci->db->get();

        if($result->num_rows() != 0)
            return TRUE;
        else
            return FALSE;

    }
}






if(!function_exists('validate_search_pattern'))
{
    /**
     * Funcion para validar el search pattern. Distingue mayusculas y minusculas.
     * Please use "DELTA2",  "DELTA5".
     * Devuelve TRUE|FALSE
     */
    function validate_search_pattern($searchpattern)
    {
        
        $ci =& get_instance();
        $data= array();
        $ci->db->select('id');
        $ci->db->from('type_variable');
        $ci->db->where('variable', 'search pattern');
        $query = $ci->db->get();
        $data=$query->row()->id; //Obtiene el id de la variable name

        $ci->db->select('*');
        $ci->db->from('variable');
        $ci->db->where('name like BINARY', $searchpattern); //binary lo que hace es que distinga las mayusculas y minusculas
        $ci->db->where('id_type_variable', $data);
        $result = $ci->db->get();

        if($result->num_rows() != 0)
            return TRUE;
        else
            return FALSE;

    }
}

if(!function_exists('validate_datum'))
{
    /**
     * Funcion para validar datum. Distingue mayusculas y minusculas.
     * Please use "SEA2", "SEA5".
     * Devuelve TRUE|FALSE
     */
    function validate_datum($datum)
    {
        
        $ci =& get_instance();
        $data= array();
        $ci->db->select('id');
        $ci->db->from('type_variable');
        $ci->db->where('variable', 'datum');
        $query = $ci->db->get();
        $data=$query->row()->id; //Obtiene el id de la variable name

        $ci->db->select('*');
        $ci->db->from('variable');
        $ci->db->where('name like BINARY', $datum); //binary lo que hace es que distinga las mayusculas y minusculas
        $ci->db->where('id_type_variable', $data);
        $result = $ci->db->get();

        if($result->num_rows() != 0)
            return TRUE;
        else
            return FALSE;

    }
}

if(!function_exists('validate_bearing_course'))
{
    /**
     * Funcion para validar el bearing y el course(son iguales)
     * Minimo: 3 números (4 caracteres)
     * Máximo: 4 números (5 caracteres)
     * Cantidad máxima: 360º
     * Ejemplo: 005º y 140,5º
     * Devuelve TRUE|FALSE
     */
    function validate_bearing_course($bearing)
    {
        $degrees   = 'º';
        $pos_degrees = strpos($bearing, $degrees);
       
       //Si pos_degrees no tiene el º de los grados devuelve falso
        if ($pos_degrees === FALSE) 
        {  
            return FALSE;
        }
        else
        { 
            $sin_degrees = mb_substr($bearing, 0, -1);  // devuelve la cadena sin el ultimo caracter

            if(strpos($sin_degrees, ',')) //Si los grados tienen coma puede llegar solo a 359 grados.
            {
                $pattern_1="/^(00[1-9]|0[1-9][0-9]|[1-2][0-9][0-9]|3[0-5][0-9])$/";
                $pattern_2="/^([1-9])$/";

                $parts = explode(",", $sin_degrees);

                if(preg_match($pattern_1, $parts[0]) && preg_match($pattern_2, $parts[1]) )
                    return TRUE;
                return FALSE;

            }
            else //Si no tiene coma puede llegar a 360 grados
            {
                $pattern_3="/^(00[1-9]|0[1-9][0-9]|[1-2][0-9][0-9]|3[0-5][0-9]|360)$/";

                //preg_match() devuelve 1 si pattern coincide con el subject dado(en este caso con time), 0 si no, o FALSE si ocurrió un error.
                if(preg_match($pattern_3, $sin_degrees))
                    return TRUE;
                return FALSE;
            }

        }        
    }
}

if(!function_exists('validate_frequency'))
{
    /**
     * Funcion para validar la frecuencia. Distingue mayusculas y minusculas.
     * Alphanumeric (e.g. 1213,5 MHz)
     * Rango mínimo 1 dígito.
     * Rango máximo 5 dígitos (6 caracteres)
     * Devuelve TRUE|FALSE
     */
    function validate_frequency($frequency)
    {
        $parts = explode(" ", $frequency);

        echo "LAS TRES PARTES SON: ";
        echo "<br>";
        echo $parts[0];
        echo "<br>";
        echo $parts[1];
        echo "<br>";


        if(substr($parts[1], -1) == ',')
            $parts[1] = substr($parts[1], -1); 

        if($parts[0] > 0 && $parts[0] < 9999 && strlen($parts[0]) <=6 && !strcmp($parts[1], "MHz") && !strpos($frequency, '.'))
            return TRUE;
        else
            return FALSE;
    }
}

if(!function_exists('validate_distance'))
{
    /**
     * Funcion para validar la distancia y los metros.
     * Numeric (e.g. 1213,5 )
     * Rango mínimo 1 dígito.
     * Rango máximo 5 dígitos (6 caracteres)
     * Devuelve TRUE|FALSE
     */
    function validate_distance($distance)
    {

        if($distance > 0 && $distance < 9999 && strlen($distance) <=6 && !strpos($distance, '.'))
            return TRUE;
        else
            return FALSE;
    }
}



if(!function_exists('validate_namelightvessel'))
{
    /**
     * Funcion para validar el name light vessel. Distingue mayusculas y minusculas.
     * Please use "TRACY5".
     * Devuelve TRUE|FALSE
     */
    function validate_namelightvessel($name)
    {

        $ci =& get_instance();
        $data= array();
        $ci->db->select('id');
        $ci->db->from('type_variable');
        $ci->db->where('variable', 'name lightvessel');
        $query = $ci->db->get();
        $data=$query->row()->id; //Obtiene el id de la variable name

        $ci->db->select('*');
        $ci->db->from('variable');
        $ci->db->where('name like BINARY', $name); //binary lo que hace es que distinga las mayusculas y minusculas
        $ci->db->where('id_type_variable', $data);
        $result = $ci->db->get();

        if($result->num_rows() != 0)
            return TRUE;
        else
            return FALSE;
    }
}

if(!function_exists('validate_waypoint'))
{
    /**
     * Funcion para validar el name light vessel. Distingue mayusculas y minusculas.
     * Please use "TRACY5".
     * Devuelve TRUE|FALSE
     */
    function validate_waypoint($waypoint)
    {

        $ci =& get_instance();
        $data= array();
        $ci->db->select('id');
        $ci->db->from('type_variable');
        $ci->db->where('variable', 'waypoint');
        $query = $ci->db->get();
        $data=$query->row()->id; //Obtiene el id de la variable name

        $ci->db->select('*');
        $ci->db->from('variable');
        $ci->db->where('name like BINARY', $waypoint); //binary lo que hace es que distinga las mayusculas y minusculas
        $ci->db->where('id_type_variable', $data);
        $result = $ci->db->get();

        if($result->num_rows() != 0)
            return TRUE;
        else
            return FALSE;
    }
}

if(!function_exists('validate_type'))
{
    /**
     * Funcion para validar el name light vessel. Distingue mayusculas y minusculas.
     * Please use "TRACY5".
     * Devuelve TRUE|FALSE
     */
    function validate_type($type)
    {

        $ci =& get_instance();
        $data= array();
        $ci->db->select('id');
        $ci->db->from('type_variable');
        $ci->db->where('variable', 'type');
        $query = $ci->db->get();
        $data=$query->row()->id; //Obtiene el id de la variable name

        $ci->db->select('*');
        $ci->db->from('variable');
        $ci->db->where('name like BINARY', $type); //binary lo que hace es que distinga las mayusculas y minusculas
        $ci->db->where('id_type_variable', $data);
        $result = $ci->db->get();

        if($result->num_rows() != 0)
            return TRUE;
        else
            return FALSE;
    }
}

if(!function_exists('validate_fromport'))
{
    /**
     * Funcion para validar el name light vessel. Distingue mayusculas y minusculas.
     * Please use "TRACY5".
     * Devuelve TRUE|FALSE
     */
    function validate_fromport($fromport)
    {

        $ci =& get_instance();
        $data= array();
        $ci->db->select('id');
        $ci->db->from('type_variable');
        $ci->db->where('variable', 'fromport');
        $query = $ci->db->get();
        $data=$query->row()->id; //Obtiene el id de la variable name

        $ci->db->select('*');
        $ci->db->from('variable');
        $ci->db->where('name like BINARY', $fromport); //binary lo que hace es que distinga las mayusculas y minusculas
        $ci->db->where('id_type_variable', $data);
        $result = $ci->db->get();

        if($result->num_rows() != 0)
            return TRUE;
        else
            return FALSE;
    }
}

if(!function_exists('validate_object'))
{
    /**
     * Funcion para validar el name light vessel. Distingue mayusculas y minusculas.
     * Please use "TRACY5".
     * Devuelve TRUE|FALSE
     */
    function validate_object($object)
    {

        $ci =& get_instance();
        $data= array();
        $ci->db->select('id');
        $ci->db->from('type_variable');
        $ci->db->where('variable', 'object');
        $query = $ci->db->get();
        $data=$query->row()->id; //Obtiene el id de la variable name

        $ci->db->select('*');
        $ci->db->from('variable');
        $ci->db->where('name like BINARY', $object); //binary lo que hace es que distinga las mayusculas y minusculas
        $ci->db->where('id_type_variable', $data);
        $result = $ci->db->get();

        if($result->num_rows() != 0)
            return TRUE;
        else
            return FALSE;
    }
}

if(!function_exists('validate_locationaboard'))
{
    /**
     * Funcion para validar el name light vessel. Distingue mayusculas y minusculas.
     * Please use "TRACY5".
     * Devuelve TRUE|FALSE
     */
    function validate_locationaboard($locationaboard)
    {

        $ci =& get_instance();
        $data= array();
        $ci->db->select('id');
        $ci->db->from('type_variable');
        $ci->db->where('variable', 'location aboard');
        $query = $ci->db->get();
        $data=$query->row()->id; //Obtiene el id de la variable name

        $ci->db->select('*');
        $ci->db->from('variable');
        $ci->db->where('name like BINARY', $locationaboard); //binary lo que hace es que distinga las mayusculas y minusculas
        $ci->db->where('id_type_variable', $data);
        $result = $ci->db->get();

        if($result->num_rows() != 0)
            return TRUE;
        else
            return FALSE;
    }
}

//end application/helpers/ayuda_helper.php