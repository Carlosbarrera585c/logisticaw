<?php
//https://www.mobilefish.com/services/php_obfuscator/php_obfuscator.php
/*
 EAS:  Clase para el consumo de
 */
//** jccampoh - 08-04-2019: Creación del método execSP, se encarga de ejecutar un procedimiento almacenado. Recibe como parámetros el objeto de conexión, nombre del procedimiento y una cadena con los parámetros. **/

//eas - 03-05-2019:  Se crea método DispositivoMovil() para detectar si se esta accediento desde un dispositivo móvil o equipo de escritorio.  Retorna 0=no es movil, 1= es movil.

class eas
{
    public function execSP($_pdo, $_nombreSp, $_paramSp = "")
    {
        $sql = " exec $_nombreSp $_paramSp ";
//        echo $sql;
        $statement = $_pdo->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function consultaSQL($_pdo, $_tabla, $_campos, $_condicion)
    {

        $sql = "select $_campos from $_tabla $_condicion ";
        //echo '<script>alert("$sql: '.$sql.' ");</script>';
        $statement = $_pdo->prepare($sql);
        $statement->execute(array());
        return $statement->fetchAll();
    }

    public function consultaSQLValor($_pdo, $_tabla, $_campo, $_condicion)
    {
        $sql = "select $_campo as valor from $_tabla $_condicion ";
        //echo '<script>alert("$sql: '.$sql.' ");</script>';
        $statement = $_pdo->prepare($sql);
        $statement->execute(array());
        $result = $statement->fetchAll();
        $valor='';
        foreach ($result as $rs){
            $valor = $rs['valor'];
        }
        //echo '<script>alert("Valor: '.$sql.' ");</script>';
        return $valor;
    }

    #region [USUARIO:  Funciones para el manejo de las operaciones del usuario]
    public function usuarioLogin($_pdo, $_usuario, $_pwd)
    {
        $sql = "select count(*) as total from CONTROL_OFIMAEnterprise.dbo.MTUSUARIO where CODUSUARIO='".$_usuario."' and PASSWORD='".$_pwd."' ";
        $statement = $_pdo->prepare($sql);
        $statement->execute(array());
        $result = $statement->fetchAll();
        foreach ($result as $rs){
            $valor = $rs['total'];
        }
        //echo '<script>alert("Valor: '.$valor.' ");</script>';
        return $valor;
    }

    public function usuarioBodegas($_pdo, $_usuario){
        $sql = "Select
                    (Select CodEmpresa From MtEmpresa Where CodEmpresa = E.CodEmpresa) As Empresa
                From MvGrupo MV, MVEmpresa E
                join MTEMPRESA emp on emp.CODEMPRESA=E.CODEMPRESA
                Where E.CodGrupo = MV.CodGrupo And MV.CodUsuario = '".$_usuario."' and emp.EMPRESA=1 and emp.CODEMPRESA!='PRUEBAS2017'
                Group By E.CodEmpresa, emp.EMPRESA
                Order By E.CodEmpresa";
        //echo '<script>alert("$sql: '.$sql.' ");</script>';
        $statement = $_pdo->prepare($sql);
        $statement->execute(array());
        return $statement->fetchAll();
    }

    public function usuarioEmpresas($_pdo, $_usuario){
        $sql = "Select
                    (Select CodEmpresa From MtEmpresa Where CodEmpresa = E.CodEmpresa) As Empresa
                From MvGrupo MV, MVEmpresa E
                join MTEMPRESA emp on emp.CODEMPRESA=E.CODEMPRESA
                Where E.CodGrupo = MV.CodGrupo And MV.CodUsuario = '".$_usuario."' and emp.EMPRESA=1 
                Group By E.CodEmpresa, emp.EMPRESA
                Order By E.CodEmpresa";
        $statement = $_pdo->prepare($sql);
        $statement->execute(array());
        return $statement->fetchAll();
    }

    public function UsuarioCodVen($_pdo, $_codusuario){
        $sql = "select CODVEN from interApp_UsuarioVenden where CODUSUARIO='".$_codusuario."' ";
        $statement = $_pdo->prepare($sql);
        $statement->execute(array());
        $result = $statement->fetchAll();
        foreach ($result as $rs){
            $valor = $rs['CODVEN'];
        }
        //echo '<script>alert("CodVen: '.$valor.' ");</script>';
        return $valor;
    }

    public function UsuarioCodUsuario($_pdo, $_codven){
        $sql = "select CODUSUARIO from interApp_UsuarioVenden where CODVEN='".$_codven."' ";
        echo '<script>alert("$sql: '.$sql.' ");</script>';
        $statement = $_pdo->prepare($sql);
        $statement->execute(array());
        $result = $statement->fetchAll();
        foreach ($result as $rs){
            $valor = $rs['CODUSUARIO'];
        }
        //echo '<script>alert("CodVen: '.$valor.' ");</script>';
        return $valor;
    }

    #endregion

    #region CONSECUTIVO
    public function consecutGet($_pdo, $_origen, $_tipodcto){
        $sql = "select (CONSECUT+1) as CONSECUT from CONSECUT where ORIGEN='".$_origen."' and TIPODCTO='".$_tipodcto."'";
        $statement = $_pdo->prepare($sql);
        $statement->execute(array());
        $result = $statement->fetchAll();
        foreach ($result as $rs){
            $valor = $rs['CONSECUT'];
        }
        return $valor;
    }

    public function UsuarioConsecutAsignado($_pdo, $_usuario){
        //echo '<script>alert("$_usuario: '.$_usuario.' ");</script>';
        $sql = "select count(*) as TOTAL from interApp_UsuariosConsecut where CODUSUARIO='".$_usuario."'";
        $statement = $_pdo->prepare($sql);
        $statement->execute(array());
        $result = $statement->fetchAll();
        foreach ($result as $rs){
            $valor = $rs['TOTAL'];
        }
        //echo '<script>alert("Valor: '.$valor.' ");</script>';
        return $valor;
    }

    public function consecutPut($_pdo, $_origen, $_tipodcto, $_consecut){
        $sql = "update CONSECUT set CONSECUT=$_consecut where ORIGEN='".$_origen."' and TIPODCTO='".$_tipodcto."'";
        echo '<script>alert("$sql: '.$sql.' ");</script>';
        $statement = $_pdo->query($sql);
    }
    #endregion


    #region INSERT
    public function realizaInsert($_pdo, $tabla_campos, $_valores){
        $sql = "insert into $tabla_campos values $_valores";
        //echo '<script>alert("$sql: '.$sql.' ");</script>';


        $statement = $_pdo->query($sql);
        $realizado = $statement->rowCount();
        if($realizado>0){
            $mensaje = 1;
        }else{
            $mensaje = 0;
        }
        return $mensaje;
    }
    #endregion

    #region CARTERA
    public function cartera_SaldoCartera($_pdo, $_nit){
        $sql = "select sum(v.deuda - v.pagado) as vr_cartera
                    From vCartera V, TipoDcto T
                    Where V.origen = 'FAC' And V.Origen = T.Origen and V.TipoDcto = T.TipoDcto and (T.DctoMae<>'PD' and T.DctoMae<>'CT') and V.Nit='".$_nit."' and V.TipoDcto <> 'CH'";
        $statement = $_pdo->prepare($sql);
        $statement->execute(array());
        $result = $statement->fetchAll();
        foreach ($result as $rs){
            $valor = $rs['vr_cartera'];
        }
        //echo '<script>alert("Valor: '.$valor.' ");</script>';
        return $valor;
    }
    #endregion


    #region SALDOS_PRODUCTOS
    public function saldoProducto($_pdo, $_codigo, $_bodega){
        $sql = "Select
                    cast(sum(S.ICANTIDAD-S.OCANTIDAD) as int) as SALDO
                From SaldoInv S
                join Mtlote L on L.CODLOTE=S.CODLOTE
                join MTMERCIA m on S.CODIGO=m.CODIGO
                Where
                ( L.Modulo = 'I' OR L.Modulo = 'P' or L.Modulo = 'C')
                AND (S.Codigo='".$_codigo."')
                And ((S.Ano = YEAR(GETDATE())  And S.periodo <= MONTH(GETDATE())  ) OR(S.ANO < YEAR(GETDATE()) ))
                And CodCc = '0'  And S.CodUbica = '0'  And S.CodLote = '0'
                And S.BODEGA='".$_bodega."'";
        $statement = $_pdo->prepare($sql);
        $statement->execute(array());
        $result = $statement->fetchAll();
        foreach ($result as $rs){
            $valor = $rs['SALDO'];
        }
        //echo '<script>alert("Valor: '.$valor.' ");</script>';
        return $valor;
    }
    #endregion


    #region SALDOS_PRODUCTOS
    public function costoProducto($_pdo, $_codigo){
        $_codigo = rtrim($_codigo);
        $sql = "select CAST(CEILING(HCOSTO) as numeric(17,0)) as COSTO from COSTOINV where ANO=YEAR(GETDATE()) and CODIGO='".$_codigo."' and PERIODO=MONTH(GETDATE()) and BODFISCAL=3";
        //echo '<script>alert("SQL: '.$sql.' ");</script>';
        $statement = $_pdo->prepare($sql);
        $statement->execute(array());
        $result = $statement->fetchAll();

        //echo var_dump($result);

        foreach ($result as $rs){
            $valor = $rs['COSTO'];
            //echo '<script>alert("EntraValor: '.$valor.' ");</script>';
        }
        return $valor;
    }
    #endregion


    #region ConfiguraciónGeneral
    function DispositivoMovil() {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }
    #endregion
}