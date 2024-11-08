<?php
class abmMenuRol
{
     public function abm($datos) {
            $resp = false;
    
            if ($datos['accion'] == 'editar') {
                if ($this->modificacion($datos)) {
                    $resp = true;
                }
            }

            if ($datos['accion'] == 'borrar') {
                if ($this->baja($datos)) {
                    $resp = true;
                }           
            }

            if ($datos['accion'] == 'nuevo') {
                if ($this->alta($datos)) {
                    $resp = true;
                }
            }
    
            return $resp;
        }

    public function buscar($param)
    {
        $where = " true ";
        $objMenuRol = new menuRol();

        if ($param != null) {
            if (isset($param['idmenu'])) {
                $where .= " and idmenu ='" . $param['idmenu'] . "'";
            }

            if (isset($param['idrol'])) {
                $where .= " and idrol ='" . $param['idrol'] . "'";
            }
        }

        $arreglo = $objMenuRol->listar($where);

        return $arreglo;
    }

    public function modificacion($param)
    {
        $resp = false;
        $objMenuRol = new menuRol();
        $abmRol = new abmRol();
        $abmMenu = new abmMenu();

        $listaRol = $abmRol->buscar(['idrol' => $param['idrol']]);
        $listaMenu = $abmMenu->buscar(['idmenu' => $param['idmenu']]);

        $objMenuRol->setear($listaMenu[0], $listaRol[0]);

        if ($objMenuRol->modificar()) {
            $resp = true;
        }

        return $resp;
    }

    public function baja($param)
    {
        $resp = false;
        $objMenuRol = new menuRol();
        $abmMenu = new abmMenu();
        $abmRol = new abmRol();

        $listaMenu = $abmMenu->buscar(['idmenu' => $param['idmenu']]);
        $objRol = $abmRol->buscar(['idrol' => $param['idrol']]);

        $objMenuRol->setear($listaMenu[0], $objRol[0]);

        if ($objMenuRol->eliminar()) {
            $resp = true;
        }

        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $objMenuRol = new menuRol();
        $abmMenu = new abmMenu();
        $abmRol = new abmRol();

        $listaMenu = $abmMenu->buscar(['idmenu' => $param['idmenu']]);
        $objRol = $abmRol->buscar(['idrol' => $param['idrol']]);

        $objMenuRol->setear($listaMenu[0], $objRol[0]);

        if ($objMenuRol->insertar()) {
            $resp = true;
        }
        return $resp;
    }
}