<?php
class Cuenta_cobro
{
    //atributo
    public $codigo_cuenta_cobro;
    public $numero_cuenta;
    public $nit;
    public $id_usuario_inmueble;
    public $codigo_month;
    public $fecha;
    public $monto_por_cancelar;
    public $porMora;
    public $estado;

    //construtor de la clase
    function __construct($codigo_cuenta_cobro,$numero_cuenta,$nit,$id_usuario_inmueble,
    $codigo_month,$fecha,$monto_por_cancelar,$porMora,$estado)
    {
        $this->codigo_cuenta_cobro=$codigo_cuenta_cobro;
        $this->numero_cuenta=$numero_cuenta;
        $this->nit=$nit;
        $this->id_usuario_inmueble=$id_usuario_inmueble;;
        $this->codigo_month=$codigo_month;
        $this->fecha=$fecha;
        $this->porMora=$porMora;
        $this->monto_por_cancelar=$monto_por_cancelar;
        $this->estado=$estado;
    }

 //------------------------------------------------------------------------------
    //funtion para obtener todos los produuctos
    public static function Obtener_cuenta_cobro($id){
        $db=Db::getConnect();
        $sql=$db->query("SELECT DISTINCT * FROM cuenta_cobro where codigo_cuenta_cobro='$id'");

        //carga en la lista _factuura cada registro
        $cuenta_cobro=$sql->fetch();
            $lista_cuenta_cobros= new Cuenta_cobro($cuenta_cobro['codigo_cuenta_cobro'],
            $cuenta_cobro['numero_cuenta'],$cuenta_cobro['nit'],$cuenta_cobro['id_usuario_inmueble'],$cuenta_cobro['codigo_month'],$cuenta_cobro['fecha'],
           $cuenta_cobro['monto_por_cancelar'],$cuenta_cobro['porMora'],$cuenta_cobro['estado']);

        return $lista_cuenta_cobros;
    }

    public function Obtener_monto_cancelado($idCuenta){
        $db=Db::getConnect();
        $sql=$db->query("SELECT SUM(abono) as totabono  FROM abonos_pago WHERE id_cuentaCobro='$idCuenta'");
        $cuenta_cobro=$sql->fetch();
        $totalAbono=$cuenta_cobro['totabono'];
        return $totalAbono;
     }
 //------------------------------------------------------------------------------



    // public static function listar_todos(){
    //     $lista_cuenta_cobros=[];
    //     $db=Db::getConnect();
    //     $sql=$db->query('SELECT * FROM cuenta_cobro');

    //     //carga en la lista _factuura cada registro
    //     foreach ($sql->fetchAll() as $cuenta_cobro) {
    //         $lista_cuenta_cobros[]= new Cuenta_cobro($cuenta_cobro['codigo_cuenta_cobro'],$cuenta_cobro['numero_cuenta'],$cuenta_cobro['nit'],$cuenta_cobro['id_usuario'],$cuenta_cobro['codigo_inmueble'],$cuenta_cobro['codigo_month'],$cuenta_cobro['fecha'],$cuenta_cobro['monto_por_cancelar'],$cuenta_cobro['porMora'],$cuenta_cobro['estado']);
    //     }
    //     return $lista_cuenta_cobros;
    // }

    /*Luego trabajamos con la de abajo*/

        // Codigo maestro para las fechas
        // SELECT (datediff(fecha,now())*-1), fecha FROM `cuenta_cobro` where  ((datediff(fecha,now())*-1) <= 30)
        // and ((datediff(fecha,now())*-1) >=0)

        //  Codigo maestro para las fechas
        // SELECT (datediff(fecha,now())*-1), fecha FROM `cuenta_cobro` where  ((datediff(fecha,now())*-1) <= 30)
        // and ((datediff(fecha,now())*-1) >=0)


    // Listar todos con inner join
    public static function listar_todos(){
        $lista_cuenta_cobros=[];
        $db=Db::getConnect();
        $sql=$db->query("SELECT DISTINCT 
        c.codigo_cuenta_cobro, 
        c.numero_cuenta,
        c.nit, 
        c.id_usuario_inmueble, 
        c.codigo_month,
        c.fecha, 
        concat('$','',c.monto_por_cancelar) as monto_por_cancelars, 
        concat('%','',c.porMora) as mora, 
        c.estado,
        concat(u.nombres,'', u.apellidos)as nombre, 
        u.numero_documento as documento,
        concat(i.numero,'',i.torre) as inmueble, 
        concat(m.mes,'($',m.tarifa,')') as mes,

        concat(concat(concat(concat(concat(concat(
        concat('El Valor Es $', c.monto_por_cancelar),
        concat(', La Mora Es Del %', c.porMora)),
        concat(',Sus Datos Son: ', u.nombres)),
        concat(' ', u.apellidos)),
        concat(', Apt', i.numero)),
        concat('', i.torre)),
        concat(',Generada ', c.fecha))
        as pagos 

        FROM usuario u
        inner join usuario_inmueble ui on u.id_usuario = ui.id_usuario
        inner join inmueble i on ui.codigo_inmueble = i.codigo_inmueble
        inner join cuenta_cobro c on ui.id_usuario_inmueble = c.id_usuario_inmueble
        inner join month m on c.codigo_month = m.codigo_month
        /*Validacion con la profe magn */
        -- where ((datediff(c.fecha,now())*-1) <= 30)
        -- and ((datediff(c.fecha,now())*-1) >=0)
        order by c.fecha desc
        ");
        foreach ($sql->fetchAll() as $cuenta_cobro){
            $itemcuenta_cobross = new Cuenta_cobro($cuenta_cobro['codigo_cuenta_cobro'], $cuenta_cobro['numero_cuenta'],$cuenta_cobro['nit'], $cuenta_cobro['id_usuario_inmueble'],$cuenta_cobro['codigo_month'],  $cuenta_cobro['fecha'], $cuenta_cobro['monto_por_cancelars'],$cuenta_cobro['mora'], $cuenta_cobro['estado']);
            $itemcuenta_cobross->nombreUsuario=$cuenta_cobro['nombre'];
            $itemcuenta_cobross->nombreInmueble=$cuenta_cobro['inmueble'];
            $itemcuenta_cobross->nombreMes=$cuenta_cobro['mes'];
            $itemcuenta_cobross->nombreDocumento=$cuenta_cobro['documento'];
            $itemcuenta_cobross->nombrePagos=$cuenta_cobro['pagos'];

            

            $lista_cuenta_cobros[]= $itemcuenta_cobross;
        }
        return $lista_cuenta_cobros;
    }



    public static function listar_cuenta_cobro_usuario($id_usuario){
        $lista_cuenta_cobros=[];
        $db=Db::getConnect();
        $sql=$db->query("SELECT DISTINCT c.codigo_cuenta_cobro, c.nit, c.numero_cuenta, c.id_usuario_inmueble, c.codigo_month,
        c.fecha, concat('$','',c.monto_por_cancelar) as monto_por_cancelars, concat('%','',c.porMora) as mora, c.estado,
        concat(u.nombres,'', u.apellidos)as nombre, u.numero_documento as documento,
        concat(i.numero,'',i.torre) as inmueble, concat(m.mes,'($', m.tarifa,')') as mes
        FROM usuario u
        inner join usuario_inmueble ui on u.id_usuario = ui.id_usuario
        -- left join usuario u on ui.id_usuario = u.id_usuario
        inner join inmueble i on ui.codigo_inmueble = i.codigo_inmueble
        inner join cuenta_cobro c on ui.id_usuario_inmueble = c.id_usuario_inmueble
        inner join month m on c.codigo_month = m.codigo_month
        /*Validacion con la profe magn */
        where u.id_usuario='$id_usuario' 
        order by c.fecha desc");

        foreach ($sql->fetchAll() as $cuenta_cobro){
            $itemcuenta_cobro= new Cuenta_cobro($cuenta_cobro['codigo_cuenta_cobro'], $cuenta_cobro['nit'], $cuenta_cobro['numero_cuenta'], $cuenta_cobro['id_usuario_inmueble'], $cuenta_cobro['codigo_month'], $cuenta_cobro['fecha'], $cuenta_cobro['monto_por_cancelars'], $cuenta_cobro['mora'], $cuenta_cobro['estado'],$cuenta_cobro['nombre']);
            $itemcuenta_cobro->nombreUsuario=$cuenta_cobro['nombre'];
            $itemcuenta_cobro->nombreInmueble=$cuenta_cobro['inmueble'];
            $itemcuenta_cobro->nombreMes=$cuenta_cobro['mes'];
            $itemcuenta_cobro->nombreDocumento=$cuenta_cobro['documento'];

            $lista_cuenta_cobros[]= $itemcuenta_cobro;
        }
        return $lista_cuenta_cobros;
    }



 //la funcion de registrar
 public static function registrar_cuenta_cobro($cuenta_cobro){
    //print_r($cuenta_cobro);
    $db=Db::getConnect();
    $insert=$db->prepare('INSERT INTO cuenta_cobro VALUES(
        :codigo_cuenta_cobro, :numero_cuenta, :nit, :id_usuario_inmueble,
        :codigo_month, :fecha, :monto_por_cancelar, :porMora, :estado)');

        $insert->bindValue('codigo_cuenta_cobro',$cuenta_cobro->codigo_cuenta_cobro);
        $insert->bindValue('numero_cuenta',$cuenta_cobro->numero_cuenta);
        $insert->bindValue('nit',$cuenta_cobro->nit);
        $insert->bindValue('id_usuario_inmueble',$cuenta_cobro->id_usuario_inmueble);
        $insert->bindValue('codigo_month',$cuenta_cobro->codigo_month);
        $insert->bindValue('fecha',date("y-m-d"));
        $insert->bindValue('monto_por_cancelar',$cuenta_cobro->monto_por_cancelar);
        $insert->bindValue('porMora',$cuenta_cobro->porMora);
        $insert->bindValue('estado',$cuenta_cobro->estado);
        if($insert->execute()){
            echo "Registro exitoso.";
        }else{
            echo "Problemas en el registro.";
         }
        }


    public static function modificar_cuenta_cobro($codigo_cuenta_cobro,$numero_cuenta,$nit,$id_usuario_inmueble,
    $codigo_month,$fecha,$monto_por_cancelar,$porMora,$estado){
        $db=Db::getConnect();
        $update=$db->prepare("UPDATE cuenta_cobro SET
        numero_cuenta='$numero_cuenta',
        nit='$nit',
        id_usuario_inmueble='$id_usuario_inmueble',
        codigo_month='$codigo_month',
        fecha='$fecha',
        monto_por_cancelar='$monto_por_cancelar',
        porMora='$porMora',
        estado='$estado'
        WHERE codigo_cuenta_cobro='$codigo_cuenta_cobro'");
        $update->execute();
    }


    //la función para eliminar
    public static function eliminar_cuenta_cobro($codigo_cuenta_cobro){
        $db=Db::getConnect();
        $update=$db->prepare("DELETE FROM cuenta_cobro
        WHERE codigo_cuenta_cobro=$codigo_cuenta_cobro");
        $update->execute();
    }


    public static function Obtener_ultima_cuenta_cobro(){
        //buscar
        $db=Db::getConnect();
        $select=$db->prepare("SELECT DISTINCT codigo_cuenta_cobro,codigo_month
        FROM cuenta_cobro
        order by codigo_cuenta_cobro  desc
        LIMIT 1;");
        $select->execute();
        //asignar al objeto cuenta cobro
        $codigo_cuenta_cobroDb=$select->fetch();
        return $codigo_cuenta_cobroDb;
    }
      // esta es de la notificacion
      public static function notificar_cuenta_cobro_propietario($id_usuario){
        $db=Db::getConnect();
        $select=$db->prepare("SELECT c.estado FROM cuenta_cobro c 
        inner join usuario_inmueble ui on (c.id_usuario_inmueble=ui.id_usuario_inmueble)
        inner join usuario u on (ui.id_usuario = u.id_usuario)
        where u.id_usuario = '$id_usuario'");
        $select->execute();
        $codigo_cuenta_cobroDb=$select->fetchAll();
        return $codigo_cuenta_cobroDb;
    }

    public static function desactivarEstadoLista($codigo_cuenta_cobro){
        require_once('../conexion.php');
        $db = Db::getConnect();
        $update = $db->prepare("UPDATE cuenta_cobro SET estado='0' WHERE codigo_cuenta_cobro=$codigo_cuenta_cobro");
        $update->execute();
    }

    public static function activarEstadoLista($codigo_cuenta_cobro){
        require_once('conexion.php');
        $db = Db::getConnect();
        $update = $db->prepare("UPDATE cuenta_cobro SET estado='1' WHERE codigo_cuenta_cobro=$codigo_cuenta_cobro");
        $update->execute();
    }

    public static function desactivar_estado_cuenta_cobro($codigo_cuenta_cobro){
        require_once('../conexion.php');
        $db = Db::getConnect();
        $update = $db->prepare("UPDATE cuenta_cobro SET estado='0' WHERE codigo_cuenta_cobro=$codigo_cuenta_cobro");
        $update->execute();
    }

    public static function activar_estado_cuenta_cobro($codigo_cuenta_cobro){
        require_once('../conexion.php');
        $db = Db::getConnect();
        $update = $db->prepare("UPDATE cuenta_cobro SET estado='1' WHERE codigo_cuenta_cobro=$codigo_cuenta_cobro");
        $update->execute();
    }

    // public static function buscar_cuenta_cobro($dato){
    //     $lista_cuenta_cobros =[];
    //     $db=Db::getConnect();
    //     $sql=$db->query("SELECT DISTINCT * FROM cuenta_cobro
    //     WHERE numero_cuenta like '%$dato%'
    //     OR nit like '%$dato%'
    //     ");
    //       //carga en la lista _factuura cada registro
    //   foreach ($sql->fetchAll() as $cuenta_cobro) {
    //     $lista_cuenta_cobros[]= new Cuenta_cobro($cuenta_cobro['codigo_cuenta_cobro'],$cuenta_cobro['numero_cuenta'],$cuenta_cobro['nit'],$cuenta_cobro['id_usuario'],$cuenta_cobro['codigo_inmueble'],$cuenta_cobro['codigo_month'],$cuenta_cobro['fecha'],$cuenta_cobro['monto_por_cancelar'],$cuenta_cobro['porMora'],$cuenta_cobro['estado']);
    // }
    // return $lista_cuenta_cobros;
    // }

    // public static function buscar_cuenta_cobro($dato){
    // $datos = trim($dato);
    // $lista_cuenta_cobros =[];
    // $db=Db::getConnect();
    // $sql=$db->query("SELECT  c.codigo_cuenta_cobro, c.nit, c.numero_cuenta, c.id_usuario_inmueble, c.codigo_month,
    //     c.fecha, concat('$','',c.monto_por_cancelar) as monto_por_cancelars, concat('%','',c.porMora) as mora, c.estado,
    //     i.torre, i.numero, i.numero_matricula,
    //     u.nombres, u.apellidos,
    //     concat(u.nombres,'',u.apellidos) as nombre, concat(i.numero,'',i.torre) as inmueble, concat(m.mes,'( $',m.tarifa,')') as mes

    //    FROM usuario u
    //     left join usuario_inmueble ui on u.id_usuario = ui.id_usuario
    //     left join inmueble i on ui.codigo_inmueble = i.codigo_inmueble
    //     left join cuenta_cobro c on ui.id_usuario_inmueble = c.id_usuario_inmueble
    //     left join month m on c.codigo_month = m.codigo_month 

    //     WHERE c.numero_cuenta like '%$datos%' OR c.nit like '%$datos%'
    //     OR c.monto_por_cancelar like '%$datos%' OR c.porMora like '%$datos%'
    //     OR c.fecha like '%$datos%' OR c.nit like '%$datos%'
    //     OR u.nombres like '%$datos%' OR u.apellidos like '%$datos%'
    //     OR i.torre like '%$datos%' OR i.numero like '%$datos%'
    //     OR i.numero_matricula like '%$dato%' OR m.mes like '%$datos%'
    //     OR m.tarifa like '%$datos%' OR c.estado like '%$datos%'
    //     ");

    //     foreach ($sql->fetchAll() as $cuenta_cobro){
    //         $itemcuenta_cobro= new Cuenta_cobro($cuenta_cobro['codigo_cuenta_cobro'], $cuenta_cobro['nit'], $cuenta_cobro['numero_cuenta'], $cuenta_cobro['id_usuario_inmueble'], $cuenta_cobro['codigo_month'], $cuenta_cobro['fecha'], $cuenta_cobro['monto_por_cancelars'], $cuenta_cobro['mora'], $cuenta_cobro['estado']);
    //         $itemcuenta_cobro->nombreUsuario=$cuenta_cobro['nombre'];
    //         $itemcuenta_cobro->nombreInmueble=$cuenta_cobro['inmueble'];
    //         $itemcuenta_cobro->nombreMes=$cuenta_cobro['mes'];

    //         $lista_cuenta_cobros[]= $itemcuenta_cobro;
    //     }
    //     return $lista_cuenta_cobros;
    // }


    //---------------------------------------------------------------------
    //recien agregadas
    public function modificar_cuenta_cobroMora($codigo_cuenta_cobro,$mora){
        $db=Db::getConnect();
        $update=$db->prepare("UPDATE cuenta_cobro SET
        porMora='$mora'
        WHERE codigo_cuenta_cobro='$codigo_cuenta_cobro'");
        $update->execute();
    }


    public static function UpMora(){
        $fechaActual= date("Y-m-d");
        foreach(Cuenta_cobro::listar_todos() as $cuenta_cobro){
          if($cuenta_cobro->fecha<$fechaActual and $cuenta_cobro->estado==0){
              
              Cuenta_cobro::modificar_cuenta_cobroMora($cuenta_cobro->codigo_cuenta_cobro,1.5);
          }
        }

  }

  public static function consultar_valor($codigo_cuenta_cobro){
    //buscar
    $monto_por_cancelar=9;
    $db=Db::getConnect();
    $select=$db->prepare("SELECT DISTINCT * FROM cuenta_cobro 
    WHERE codigo_cuenta_cobro=$codigo_cuenta_cobro");
    $select->execute();
    foreach ($select->fetchAll() as $cuenta_cobro) {
        $monto_por_cancelar=$cuenta_cobro['monto_por_cancelar'];
    }
    return $monto_por_cancelar;
  }
//Recien agregadas------------------------------------------------------------


}

?>
